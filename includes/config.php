<?php
$tmp = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
if (is_numeric(substr($tmp, -1, 1))) {
	$tld = 'loc';
} else {
	$tld = substr($tmp, strrpos($tmp, '.') + 1);
}
$http_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';

define('SITE_HOME', $http_protocol."www.padiyaravallikattu-kudumbayogam.$tld");

const DB_TYPE = 'mysql';
const DB_PORT = 3306; // Port is ignored by PDO, if host is localhost. Use 127.0.0.1 to use a non default port
if ($tld === 'loc' || $tld == '') {
    ob_start();
    error_reporting(-1);
    define('DB_HOST', 'localhost');
    define('ENV_DEVELOPMENT', true);
} else {
    ob_start();
    error_reporting(-1);
    define('DB_HOST', 'mysql.hostinger.in');
    define('ENV_DEVELOPMENT', false);
}

define('DB_NAME', 'u552501200_mb');
define('DB_USER', 'u552501200_mille');
define('DB_PASS', 'vimal9946463913');
define('ROOT', str_replace('\\', '/', realpath(__DIR__ . '/..')));
define('HOME', str_replace('\\', '/', realpath(__DIR__ . '/../..')));
define('DATE_TIME', date("U"));
