#!/bin/bash
####################################################################################
##### (c) Siddharth Upmanyu            #############################################
##### Install Instructions             #############################################
##### Fedora 23/24 (64 bit)            #############################################
##### Copy Code to /home and configure details in custom/.env           ############
#  >_ dnf -y update ; reboot                                            ############
#  >_ ./cron.sh server                                                  ############
####################################################################################

export PATH=$PATH:/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin

cwd=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
cd $cwd ; cd ..
app_path=`pwd`

if [ ! -f custom/.env ]; then
	echo "ERROR : .env file not found"
	exit
fi
source custom/.env

#Defs
if [ -z "$asterisk_extensions" ]; then asterisk_extensions="31331,_X!"; fi
if [ -z "$asterisk_manager" ]; then asterisk_manager="$app_ip"; fi
if [ -z "$asterisk_slaves" ]; then asterisk_slaves="$app_ip:1001:2000:1:30"; fi

if [ -z "$app_sslcertfile" ]; then app_sslcertfile="SSLCertificateFile /etc/pki/tls/certs/localhost.crt"; fi
if [ -z "$app_sslcertkeyfile" ]; then app_sslcertkeyfile="SSLCertificateKeyFile /etc/pki/tls/private/localhost.key"; fi
if [ -z "$app_sslcertchainfile" ]; then app_sslcertchainfile=""; fi
#####

for file in /etc/*-release; do
	while IFS="=" read -r key value; do
		case "$key" in
			"NAME") OSNAME="$value" ;;
			"VERSION_ID") OSVER="$value" ;;
		esac
	done < "$file"
done
OSARCH=$(uname -m | sed 's/x86_//;s/i[3-6]86/32/')

echo "Running from : $app_path"
echo "$OSNAME $OSARCH $OSVER"

######################################################################## Functions
function checkInstallDeps
{
	rpm -qa | grep -qw rpmfusion-nonfree-release || dnf install --nogpgcheck -y http://download1.rpmfusion.org/free/fedora/rpmfusion-free-release-$(rpm -E %fedora).noarch.rpm http://download1.rpmfusion.org/nonfree/fedora/rpmfusion-nonfree-release-$(rpm -E %fedora).noarch.rpm
	checkErrorExit
	rpm -qa | grep -qw rpmfusion-free-release || dnf install --nogpgcheck -y http://download1.rpmfusion.org/free/fedora/rpmfusion-free-release-$(rpm -E %fedora).noarch.rpm http://download1.rpmfusion.org/nonfree/fedora/rpmfusion-nonfree-release-$(rpm -E %fedora).noarch.rpm
	checkErrorExit
	
	array=( php-xml ImageMagick php php-gd php-mbstring php-mcrypt php-imap php-mysql php-pear php-xml php-xmlrpc php-process curl perl-libwww-perl libxml2 ncurses screen sox mariadb mariadb-server ntp php-pecl-memcache httpd mod_ssl mod_perl tar perl wget python-boto python-pip cockpit iptables-services libreoffice libreoffice-headless git ffmpeg swftools libmad libid3tag id3v2 libquicktime system-config-network resiprocate-turn-server asterisk asterisk-sip dahdi-tools asterisk-dahdi libpri make wget openssl-devel ncurses-devel newt-devel libxml2-devel kernel-devel gcc gcc-c++ sqlite-devel certbot php-opcache nload iftop redhat-lsb-core zip )
	for i in "${array[@]}"
	do
		if  ! rpm -qa | grep -qw $i ; then
			echo "Installing : $i"
			echo ""
			dnf install --nogpgcheck -y $i
			checkErrorExit
		fi 
	done
}
function installDahdi
{
	if [-d cd $app_path/custom/extras/dahdi-linux-complete ]; then
		cd $app_path/custom/extras/dahdi-linux-complete
		
		echo "Making Dahdi.."
		make
		checkErrorExit
		echo ""
		echo "Installing Dahdi.."
		make install
		checkErrorExit
		make config
		checkErrorExit
		
		## /etc/modprobe.d/dahdi.conf << options wcte13xp default_linemode=e1
		## modprobe wcte13xp default_linemode=e1

		service dahdi restart
		checkErrorExit
		
		dahdi_genconf -v
		dahdi_cfg -v
		
	fi
}
function checkErrorExit
{
	if [ $? -ne 0 ]; then
		echo "==============  ERROR ================"
		exit
	fi
}
function schemaSetup
{
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY PASSWORD '*8849732369915B4FCF3EF1C8BC04CEB9A23C8D88' WITH GRANT OPTION;";
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "CREATE DATABASE IF NOT EXISTS $DB_DATABASE;";
	cd $app_path/application/;php $app_path/application/artisan migrate

	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "update diallines set status='Free',conf='',channel='',server='';" $DB_DATABASE
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "update sipids set status=0,user=0,ready=0,confup=0,clients='',server='';" $DB_DATABASE
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "update users set presence=0;" $DB_DATABASE
	
	AsteriskServers=$(echo $asterisk_slaves | tr "," "\n")
	for server in $AsteriskServers
	do
		IFS=':' read -r -a ServerArr <<< "$server"
		
		if [ "${ServerArr[0]}" != "" ] ; then
			mysql -u$DB_USERNAME -p$DB_PASSWORD -e "update diallines set status='Free',conf='',channel='',server='${ServerArr[0]}' where id>=${ServerArr[3]} and id<=${ServerArr[4]};" $DB_DATABASE
			mysql -u$DB_USERNAME -p$DB_PASSWORD -e "update sipids set status=0,user=0,ready=0,confup=0,server='${ServerArr[0]}' where id>=${ServerArr[1]} and id<=${ServerArr[2]};" $DB_DATABASE
			mysql -u$DB_USERNAME -p$DB_PASSWORD -e "delete from kqueues where status='New' and type='SIP_${ServerArr[0]}';" $DB_DATABASE
		fi
	done
	
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "SET GLOBAL max_allowed_packet = 524288000;";
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "SET GLOBAL query_cache_size = 524288000;";
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "SET GLOBAL query_cache_limit = 10485760;";
	mysql -u$DB_USERNAME -p$DB_PASSWORD -e "SET GLOBAL query_cache_type = 1;";
}
function vhostSetup
{
	# Setup updates pre-startup
	echo "<Directory $app_path>" > /etc/httpd/conf.d/$app_domain.conf
	echo "Order allow,deny" 		>> /etc/httpd/conf.d/$app_domain.conf
	echo "Allow from all" 			>> /etc/httpd/conf.d/$app_domain.conf
	echo "AllowOverride all" 		>> /etc/httpd/conf.d/$app_domain.conf
	echo "Require all granted" 	>> /etc/httpd/conf.d/$app_domain.conf
	echo "</Directory>" 				>> /etc/httpd/conf.d/$app_domain.conf
	echo "ServerAdmin contact@$app_domain" >> /etc/httpd/conf.d/$app_domain.conf
	
	echo "<VirtualHost *:80>" >> /etc/httpd/conf.d/$app_domain.conf
	echo "ServerName $app_domain" >> /etc/httpd/conf.d/$app_domain.conf
	echo "DocumentRoot $app_path/application/public" >> /etc/httpd/conf.d/$app_domain.conf
	echo "CustomLog /var/log/httpd/$app_domain.log combined" >> /etc/httpd/conf.d/$app_domain.conf
	echo "ErrorLog /var/log/httpd/$app_domain-error.log" >> /etc/httpd/conf.d/$app_domain.conf
	echo "LogLevel emerg" >> /etc/httpd/conf.d/$app_domain.conf
	echo "</VirtualHost>" >> /etc/httpd/conf.d/$app_domain.conf
	echo "<VirtualHost *:443>" >> /etc/httpd/conf.d/$app_domain.conf
	echo "ServerName $app_domain" >> /etc/httpd/conf.d/$app_domain.conf
	echo "DocumentRoot $app_path/application/public" >> /etc/httpd/conf.d/$app_domain.conf
	echo "CustomLog /var/log/httpd/ssl-$app_domain.log combined" >> /etc/httpd/conf.d/$app_domain.conf
	echo "ErrorLog /var/log/httpd/ssl-$app_domain-error.log" >> /etc/httpd/conf.d/$app_domain.conf
	echo "LogLevel emerg" >> /etc/httpd/conf.d/$app_domain.conf
	echo "SSLEngine on" >> /etc/httpd/conf.d/$app_domain.conf
	echo $app_sslcertfile >> /etc/httpd/conf.d/$app_domain.conf
	echo $app_sslcertkeyfile >> /etc/httpd/conf.d/$app_domain.conf
	echo $app_sslcertchainfile >> /etc/httpd/conf.d/$app_domain.conf
	echo "</VirtualHost>" >> /etc/httpd/conf.d/$app_domain.conf
}
function cronSetup
{
	ccentry="* * * * * $app_path/application/cron.sh > /var/log/kcron_$app_domain.log 2>&1"
	crontab -l > tcb.txt
	grep -Fq "$ccentry" tcb.txt || echo "$ccentry" >> tcb.txt
	crontab tcb.txt
	rm -f tcb.txt
}
function astAGISetup
{
	echo "#!/bin/bash" > /etc/asterisk/kstych-$app_domain.sh
	echo "cd $app_path/application" >> /etc/asterisk/kstych-$app_domain.sh
	echo "php artisan KstychPAGI" >> /etc/asterisk/kstych-$app_domain.sh
	chmod +x /etc/asterisk/kstych-$app_domain.sh

	echo "" > /etc/asterisk/kstych-$app_domain.conf
	AstExts=$(echo $asterisk_extensions | tr "," "\n")
	for exten in $AstExts
	do
		echo "exten => $exten,1,AGI(/etc/asterisk/kstych-$app_domain.sh)" >> /etc/asterisk/kstych-$app_domain.conf
		echo "exten => $exten,2,Hangup" >> /etc/asterisk/kstych-$app_domain.conf
	done
}
function astFilesSetup
{
	mkdir -p -m 777 /etc/asterisk/keys
	#dtlscert.sh -C asterisk.kstych.com -O "KstychPvtLtd" -d /etc/asterisk/keys
	cp -f $app_path/application/public/assets/extras/data/asterisk/*.conf /etc/asterisk/
	cp -f $app_path/application/public/assets/extras/data/asterisk/keys/* /etc/asterisk/keys/
	cp -n $app_path/application/public/assets/extras/data/dahdi/chan_dahdi.conf /etc/asterisk/
	cp -n $app_path/application/public/assets/extras/data/dahdi/dahdi-channels.conf /etc/asterisk/
	
	sed -i "s/REPLACESERVERIP/$app_ip/g" /etc/asterisk/sip.conf
	sed -i "s/REPLACESERVERIP/$app_ip/g" /etc/asterisk/manager.conf
	sed -i "s/REPLACEMANAGER/$asterisk_manager/g" /etc/asterisk/manager.conf
	sed -i "s/REPLACESERVERIP/$app_ip/g" /etc/asterisk/rtp.conf
	
	cp -f $app_path/application/public/assets/extras/data/asterisk/asterisk.service /etc/systemd/system/
	
	AsteriskServers=$(echo $asterisk_slaves | tr "," "\n")
	for server in $AsteriskServers
	do
		IFS=':' read -r -a ServerArr <<< "$server"
		
		if [ "${ServerArr[0]}" == "$app_ip" ] ; then
			echo "" > /etc/asterisk/users-$app_domain.conf
			for (( c=${ServerArr[1]}; c<=${ServerArr[2]}; c++ ))
			do
				echo "[$c]" >> /etc/asterisk/users-$app_domain.conf
			done
		fi
	done

	chmod +r /etc/asterisk/keys/*
	chown -R asterisk:asterisk /etc/asterisk
	chmod +r /etc/pki/tls/certs/localhost.crt
	chmod +r /etc/pki/tls/private/localhost.key
}
function phpiniSetup
{
	sed -e '/^[^;]*max_execution_time/s/=.*$/= 3600/' -i /etc/php.ini
	sed -e '/^[^;]*max_input_time/s/=.*$/= 3600/' -i /etc/php.ini
	sed -e '/^[^;]*memory_limit/s/=.*$/= 4096M/' -i /etc/php.ini
	sed -e '/^[^;]*post_max_size/s/=.*$/= 64M/' -i /etc/php.ini
	sed -e '/^[^;]*upload_max_filesize/s/=.*$/= 1024M/' -i /etc/php.ini
}
function reTurnSetup
{
	cp -f $app_path/application/public/assets/extras/data/reTurn/* /etc/reTurn/
	sed -i "s/REPLACESERVERIP/$app_ip/g" /etc/reTurn/users.txt
	sed -i "s/REPLACESERVERIP/$app_ip/g" /etc/reTurn/reTurnServer.config
}
function selinuxSetup
{
	sed -e '/^[^#]*SELINUX/s/=.*$/=disabled/' -i /etc/selinux/config
	sed -e '/^[^#]*SELINUX/s/=.*$/=disabled/' -i /etc/sysconfig/selinux
}
function restartServices
{
	systemctl disable httpd.service
	systemctl disable mariadb.service
	systemctl disable ntpd.service
	systemctl disable iptables.service
	systemctl disable ip6tables.service
	systemctl disable firewalld.service
	systemctl disable cockpit.socket
	systemctl disable asterisk.service
	systemctl disable resiprocate-turn-server.service

	systemctl stop httpd.service
	systemctl stop mariadb.service
	systemctl stop ntpd.service
	systemctl stop iptables.service
	systemctl stop ip6tables.service
	systemctl stop firewalld.service
	systemctl stop cockpit.socket
	systemctl stop asterisk.service
	systemctl stop resiprocate-turn-server.service

	systemctl start httpd.service
	systemctl start ntpd.service
	systemctl start mariadb.service
	systemctl start cockpit.socket
	systemctl start resiprocate-turn-server.service
	systemctl start asterisk.service
	systemctl start iptables.service
	systemctl start ip6tables.service
	
	iptables -F

	iptables -A INPUT -p tcp --dport 22 -j ACCEPT
	iptables -A INPUT -p tcp --dport 25 -j ACCEPT
	iptables -A INPUT -p tcp --dport 80 -j ACCEPT
	iptables -A INPUT -p tcp --dport 443 -j ACCEPT
	iptables -A INPUT -p tcp --dport 1935 -j ACCEPT
	iptables -A INPUT -p tcp --dport 3478 -j ACCEPT
	iptables -A INPUT -p tcp --dport 5038 -j ACCEPT
	iptables -A INPUT -p tcp --dport 3306 -j ACCEPT
	iptables -A INPUT -p tcp --dport 8088 -j ACCEPT
	iptables -A INPUT -p tcp --dport 8089 -j ACCEPT
	iptables -A INPUT -p tcp --dport 9090 -j ACCEPT
	iptables -A INPUT -p tcp --match multiport --dports 10000:20000 -j ACCEPT
	iptables -A INPUT -p udp --dport 3478 -j ACCEPT
	iptables -A INPUT -p udp --match multiport --dports 10000:60000 -j ACCEPT
	iptables -I OUTPUT -j ACCEPT
}
function generalSetup
{
	hostname localhost
	ulimit -n 65000
	swapoff -a
	timedatectl set-timezone UTC
	timedatectl set-ntp yes
	grep -q -F 'Storage=none' /etc/systemd/journald.conf || echo 'Storage=none' >> /etc/systemd/journald.conf

	chmod -R 777 $app_path/application/storage
	chmod -R 777 $app_path/custom/app
}
function mysqlSetup
{
	systemctl start mariadb.service
	if ! mysql -u$DB_USERNAME -p$DB_PASSWORD -e ";" ; then

		systemctl stop mariadb.service
		mysqld_safe --skip-grant-tables &
		sleep 10
		mysql -u root -e "update user set password=PASSWORD('$DB_PASSWORD') where User='$DB_USERNAME';flush privileges;" mysql

		pkill mysqld_safe
		pkill mysqld
		
		systemctl restart mariadb.service

	fi
}
function sshdCheck
{
	pgrep sshd 
	if [ $? -ne 0 ] && [ "$runLevelVar" -ge 3 ] ; then
		service sshd restart;
	fi
}
function dailyTasks
{
	####################################################################################
	# Daily Script
	####################################################################################
	nowtime=$(date +%k%M)
	if [ $nowtime -eq "000" ] 
			then
			
			rm -f $app_path/application/storage/logs/laravel-*.log
			touch $app_path/application/storage/logs/laravel-$(date +%Y-%m-%d).log
			chmod -R 777 $app_path/application/storage
			chmod -R 777 $app_path/custom/app
			
			#### Asterisk Date-wise Call Recording Folder creation START ######
            mkdir -p /var/spool/asterisk/astrec/$(date +%Y)/$(date +%m)/$(date +%d)/inb
            mkdir -p /var/spool/asterisk/astrec/$(date +%Y)/$(date +%m)/$(date +%d)/out
            chown asterisk.asterisk -R /var/spool/asterisk/astrec/$(date +%Y)/$(date +%m)/$(date +%d)
			#### Asterisk Date-wise Call Recording Folder creation END ######

			mkdir -p $app_path/custom/db
            chmod -R 777 $app_path/custom/db

			mysqldump -u$DB_USERNAME -p$DB_PASSWORD --single-transaction $DB_DATABASE | gzip > $app_path/custom/db/$DB_DATABASE.sql.gz
	fi
}
function astPAMICheck
{
	AsteriskServers=$(echo $asterisk_slaves | tr "," "\n")
	for server in $AsteriskServers
	do
		IFS=':' read -r -a ServerArr <<< "$server"

		if ! screen -list | grep -q "AMI_$app_domain${ServerArr[0]}"; then
			/usr/bin/screen -d -m -S AMI_$app_domain${ServerArr[0]} bash -c "cd $app_path/application/;php $app_path/application/artisan KstychPAMI ${ServerArr[0]}"
		fi
	done
}
function createCall
{
	echo "create"
	AsteriskServers=$(echo $asterisk_slaves | tr "," "\n")
	for server in $AsteriskServers
	do
		IFS=':' read -r -a ServerArr <<< "$server"

		if ! screen -list | grep -q "CreateCall_$app_domain${ServerArr[0]}"; then
			/usr/bin/screen -d -m -S CreateCall_$app_domain${ServerArr[0]} bash -c "cd $app_path/application/;php $app_path/application/artisan CreateCall"
		fi
	done
}
function hangUpCall
{
	echo "hang"
	AsteriskServers=$(echo $asterisk_slaves | tr "," "\n")
	for server in $AsteriskServers
	do
		IFS=':' read -r -a ServerArr <<< "$server"

		if ! screen -list | grep -q "HangUpCall_$app_domain${ServerArr[0]}"; then
			/usr/bin/screen -d -m -S HangUpCall_$app_domain${ServerArr[0]} bash -c "cd $app_path/application/;php $app_path/application/artisan PredictiveCallHangUp"
		fi
	done
}
function waitForLock
{
	if [ ! -f /tmp/cronsh-$app_domain.lock ]; then
		touch /tmp/cronsh-$app_domain.lock
	else
		exit
	fi
	while : ; do
		if [ ! -f /tmp/cronsh.lock ]; then
			touch /tmp/cronsh.lock
			break
		fi
		sleep 1
	done
}
function clearLock
{
	rm -f /tmp/cronsh.lock
	rm -f /tmp/cronsh-$app_domain.lock
}
########################################################################

######################################################################## Direct Commands
if [ "$1" == "packages" ] ; then
	checkInstallDeps
	exit
fi
if [ "$1" == "dahdi" ] ; then
	installDahdi
	exit
fi
if [ "$1" == "schema" ] ; then
	schemaSetup
	exit
fi
########################################################################

######################################################################## Main Script
waitForLock
if [ "$OSNAME" == "Fedora" ] && [ $OSVER -gt 21 ] ; then
	pgrep httpd 
	if [ $? -ne 0 ] || [ "$1" == "server" ] ; then

		generalSetup
		vhostSetup
		cronSetup
		astAGISetup
		astFilesSetup
		reTurnSetup
		phpiniSetup
		selinuxSetup
		mysqlSetup
		
		restartServices
		schemaSetup

	fi
	sshdCheck
	dailyTasks
	astPAMICheck
	createCall
	hangUpCall
fi
clearLock
cd $app_path/application;php artisan schedule:run
########################################################################
