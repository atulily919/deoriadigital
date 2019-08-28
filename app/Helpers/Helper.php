<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper {
	public static function shout(string $string) {
		return strtoupper($string);
	}

	function getloginDetail() {
		return [
			'mysql_ext' => [
				'driver' => 'mysql',
				'host' => '192.168.3.246',
				'port' => '22',
				'database' => 'flexidial',
				'username' => 'root',
				'password' => 'yb9738z',
				'charset' => 'utf8mb4',
				'collation' => 'utf8mb4_unicode_ci',
				'prefix' => '',
				'options' => ['mode' => 'ssl'],
				'strict' => false,
				'engine' => null,
			],
		];

	}
}