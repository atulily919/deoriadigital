<?php

return [

	'env' => env('APP_ENV', 'production'),
	'debug' => filter_var(env('APP_DEBUG', true), FILTER_VALIDATE_BOOLEAN),
	'url' => 'http://localhost',
	'timezone' => 'UTC',
	'locale' => 'en',
	'fallback_locale' => 'en',

	'key' => env('APP_KEY', 'LEynnBaQoqsLncOWZwgdtfxxWU2hEyfp'),

	'cipher' => 'AES-256-CBC',

	'log' => 'daily',

	'providers' => [

		Illuminate\Auth\AuthServiceProvider::class,
		Illuminate\Broadcasting\BroadcastServiceProvider::class,
		Illuminate\Bus\BusServiceProvider::class,
		Illuminate\Cache\CacheServiceProvider::class,
		Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
		Illuminate\Cookie\CookieServiceProvider::class,
		Illuminate\Database\DatabaseServiceProvider::class,
		Illuminate\Encryption\EncryptionServiceProvider::class,
		Illuminate\Filesystem\FilesystemServiceProvider::class,
		Illuminate\Foundation\Providers\FoundationServiceProvider::class,
		Illuminate\Hashing\HashServiceProvider::class,
		Illuminate\Mail\MailServiceProvider::class,
		Illuminate\Pagination\PaginationServiceProvider::class,
		Illuminate\Pipeline\PipelineServiceProvider::class,
		Illuminate\Queue\QueueServiceProvider::class,
		Illuminate\Redis\RedisServiceProvider::class,
		Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
		Illuminate\Session\SessionServiceProvider::class,
		Illuminate\Translation\TranslationServiceProvider::class,
		Illuminate\Validation\ValidationServiceProvider::class,
		Illuminate\View\ViewServiceProvider::class,

		App\Providers\AppServiceProvider::class,
		App\Providers\AuthServiceProvider::class,
		App\Providers\EventServiceProvider::class,
		App\Providers\RouteServiceProvider::class,

	],

	'aliases' => [

		'App' => Illuminate\Support\Facades\App::class,
		'Artisan' => Illuminate\Support\Facades\Artisan::class,
		'Auth' => Illuminate\Support\Facades\Auth::class,
		'Blade' => Illuminate\Support\Facades\Blade::class,
		'Cache' => Illuminate\Support\Facades\Cache::class,
		'Config' => Illuminate\Support\Facades\Config::class,
		'Cookie' => Illuminate\Support\Facades\Cookie::class,
		'Crypt' => Illuminate\Support\Facades\Crypt::class,
		'DB' => Illuminate\Support\Facades\DB::class,
		'Eloquent' => Illuminate\Database\Eloquent\Model::class,
		'Event' => Illuminate\Support\Facades\Event::class,
		'File' => Illuminate\Support\Facades\File::class,
		'Gate' => Illuminate\Support\Facades\Gate::class,
		'Hash' => Illuminate\Support\Facades\Hash::class,
		'Lang' => Illuminate\Support\Facades\Lang::class,
		'Log' => Illuminate\Support\Facades\Log::class,
		'Mail' => Illuminate\Support\Facades\Mail::class,
		'Password' => Illuminate\Support\Facades\Password::class,
		'Queue' => Illuminate\Support\Facades\Queue::class,
		'Redirect' => Illuminate\Support\Facades\Redirect::class,
		'Redis' => Illuminate\Support\Facades\Redis::class,
		'Request' => Illuminate\Support\Facades\Request::class,
		'Response' => Illuminate\Support\Facades\Response::class,
		'Route' => Illuminate\Support\Facades\Route::class,
		'Schema' => Illuminate\Support\Facades\Schema::class,
		'Session' => Illuminate\Support\Facades\Session::class,
		'Storage' => Illuminate\Support\Facades\Storage::class,
		'URL' => Illuminate\Support\Facades\URL::class,
		'Validator' => Illuminate\Support\Facades\Validator::class,
		'View' => Illuminate\Support\Facades\View::class,
		'Input' => Illuminate\Support\Facades\Input::class,

	],

	'app_modules' => [
		"Dashboard" => ["disp" => "Home", "icon" => "home", "dash" => "", "onclick" => "menuAction('dashboard');"],
		"Social" => ["disp" => "Social", "icon" => "globe", "dash" => "", "onclick" => "menuAction('social');"],
		"HR" => ["disp" => "Records", "icon" => "user", "dash" => "",
			"submenu" => [
				"New Record" => ["showBlock('EmpRecord?empid=_NEW_');"],
				"Quick Search" => ["hrmsSearch();"],
				"Text Search" => ["menuAction('record/textsearch');"],
				"Master Report" => ["showBlock('MainReport');"],
				"Bulk Upload" => ["menuAction('record/bulkupload');"]]],
		"Task" => ["disp" => "Tasks", "icon" => "edit", "dash" => "", "onclick" => "showBlock('Workflow');"],
		"Dialer" => ["disp" => "Dialer", "icon" => "phone", "dash" => "Dialer",
			"submenu" => ["Dialer" => ["kDialerModel();"],
				"Reports" => ["menuAction('dialer/reports');"],
			]],
		"DialerCampaign" => ["disp" => "Dialer", "icon" => "phone", "dash" => "",
			"submenu" => [
				"Campaigns" => ["menuAction('dialer/campaigns');", "A"],
				"Lists" => ["menuAction('dialer/lists');", "A"],
				"Bulk Upload" => ["menuAction('record/bulkupload');", "A"],
			]],
		"DialerQC" => ["disp" => "Dialer", "icon" => "phone", "dash" => "",
			"submenu" => [
				"RecordingQC" => ["menuAction('dialer/recqc');", "A"],
				"RecordingArchive" => ["menuAction('dialer/recarchive');", "A"],
			]],
		"Admin" => ["disp" => "Admin", "icon" => "gear", "dash" => "",
			"submenu" => ["Masters" => ["showBlock('Masters');"],
				"Delete Record" => ["showBlock('DeletePerson');"],
				"Access Log" => ["menuAction('admin/accesslog');"],
				"DialerReports" => ["menuAction('dialer/areports');"],
			]],
		"Notification" => ["disp" => "Notification", "icon" => "home", "dash" => "", "onclick" => ""],
		"Message" => ["disp" => "Message", "icon" => "home", "dash" => "", "onclick" => ""],
		"Web" => ["disp" => "Web", "icon" => "home", "dash" => "", "onclick" => ""],
		"Record" => ["disp" => "Record", "icon" => "file", "dash" => "", "onclick" => ""],
		"User" => ["disp" => "User", "icon" => "home", "dash" => "", "onclick" => ""],
		"Role" => ["disp" => "Role", "icon" => "home", "dash" => "", "onclick" => ""],
		"DialMode" => ["disp" => "DialMode", "icon" => "home", "dash" => "", "onclick" => ""],
		"SupervisorModule" => ["disp" => "SupervisorModule", "icon" => "globe", "dash" => "", "onclick" => "menuAction('SupervisorModule');"],
		"Notes" => ["disp" => "Notes", "icon" => "globe", "dash" => "", "onclick" => "menuAction('notes');"],
		"RLP" => ["disp" => "RLP", "icon" => "globe", "dash" => "", "onclick" => "menuAction('rlp');"],
		"Group" => ["disp" => "Group", "icon" => "home", "dash" => "", "onclick" => "",
			"title" => env('app_name', 'Application'),
			"keywords" => "Kstych",
			"author" => "Kstych",
			"description" => "Kstych",
			"brand" => env('app_name', 'Application'),
			"logo_s" => "favicon.png"],
	],

	'app_groups' => [], //loaded from db
	'admindebug' => filter_var(env('APP_ADMIN_DEBUG', true), FILTER_VALIDATE_BOOLEAN),
	'name' => env('app_name', 'Application'),
	'app_title' => env('app_title', 'Welcome'),
	'app_ip' => env('app_ip', '127.0.0.1'),
	'protocol' => env('APP_PROTOCOL', 'http://'),
	'domain' => env('app_domain', 'localhost'),
	'sipssldomain' => env('app_sipssldomain', env('app_domain', 'localhost')),
	'webdomain' => env('web_domain', env('app_domain', 'localhost')),
	'email' => env("app_emailid", "siddharth@kstych.com"),
	'app_version' => "4.2.12",
	'mytheme' => 'layout',
	'app_admin' => env('app_admin', 'admin'),
	'app_support_ids' => [1],
	'gcm_apikey' => env("gcm_apikey", ""),
	'extAuth' => env("extAuth", ""),
	'extAuthParams' => env("extAuthParams", ",,"),
	'facebook_appid' => env("facebook_appid", ""),
	'facebook_appkey' => env("facebook_appkey", ""),

	'kstych_RTCLK' => env("kstych_RTCLK", "1"),
	'kstych_CTRL' => env("kstych_CTRL", "1"),
	'kDialer_keeplocalconf' => env("kDialer_keeplocalconf", "0"),
	'kstych_useice' => env("kstych_useice", "yes"),
	'kstych_viewportMeta' => env("kstych_viewportMeta", "responsive:1:1"),
	'APP_Multiple_Logins' => env("APP_Multiple_Logins", "yes"),
	'asterisk_slaves' => env("asterisk_slaves", "127.0.0.1:1001:21000:1:240"),
	'asterisk_manager' => env("asterisk_manager", "127.0.0.1"),
	'html5conf_domain' => env("html5conf_domain", "kstych.com"),

	'xssGlobal' => env('xssGlobal', 'tag,hent'),
	'xssGlobalIgnoreKeys' => env('xssGlobalIgnoreKeys', 'content,pdata,courseintroductiondiv,coursecoverphoto,data,rlog,rstring,fbstr,rtstr'),
	'skiplog' => ",style,jshead,jsbody,dialer/liveusers,",
	'echosqllogs' => env('echosqllogs', 0),

	'hdfcnodes' => [
		"10.3.178.68" => "COP:RSM1:Mumbai:NA:NA:NA",
		"10.3.177.86" => "COP:RSM1:Mumbai:NA:NA:NA",
		"10.3.179.121" => "COP:RSM1:Mumbai:NA:NA:NA",
		"10.3.178.89" => "Prime:RSM1:Mumbai:NA:NA:NA",
		"10.34.169.161" => "COP:RSM2:Hyderabad:NA:NA:NA",
		"10.34.169.152" => "Prime:RSM2:Hyderabad:NA:NA:NA",
		"10.34.171.215" => "COP:RSM2:Hyderabad:NA:NA:NA",
		"10.28.245.156" => "COP:RSM1:Ahmedabad:NA:NA:NA",
		"10.28.244.81" => "Prime:RSM1:Ahmedabad:NA:NA:NA",
		"10.68.20.208" => "COP:RSM3:Delhi:Rajouri:NA:NA",
		"10.68.22.9" => "COP:RSM3:Delhi:Rajouri:NA:NA",
		"10.8.9.117" => "Prime:RSM3:Delhi:VikasPuri:NA:NA",
		"10.8.9.144" => "Prime:RSM3:Delhi:VikasPuri:NA:NA",
		"10.10.148.23" => "Prime:RSM3:Delhi:VikasPuri:NA:NA",
		"10.10.148.24" => "COP:RSM3:Delhi:VikasPuri:NA:NA",
		"10.26.27.103" => "Prime:RSM1:Pune:NA:NA:NA",
		"10.61.108.66" => "Prime:RSM3:Chandigarh:NA:NA:NA",
		"10.15.9.107" => "Prime:RSM4:Kolkata:NA:NA:NA",
		"10.32.225.253" => "Prime:RSM2:Benglore:NA:NA:NA",
		"10.4.120.98" => "Prime:RSM2:Chennai:NA:NA:NA",
		"10.4.120.54" => "COP:RSM2:Chennai:NA:NA:NA",
		"10.9.152.26" => "COP:RSM3:Indore:NA:NA:NA",
		"10.3.177.14" => "Flexydial:NA:NA:NA:NA:NA",
	],

];
