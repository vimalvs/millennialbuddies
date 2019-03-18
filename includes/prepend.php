<?php
session_start();
include 'config.php';
include ROOT.'/vendor/autoload.php';

include ROOT.'/lib/SiteManager.php';
include ROOT.'/lib/DbManager.php';
use Symfony\Component\Dotenv\Dotenv;



function is_login() {
	if (empty($_SESSION['is_login']))  {
		return false;
	}
	return true;
}

function printr($var)  {
	$args = func_get_args();

	echo '<pre>';
	$str = '';
	foreach ($args as $arg) {
		$str .= print_r($arg, true);
	}
	echo $str;
	echo '</pre>';
}
function is_assoc_array($var) {
	if (!is_array($var))return 0;
	$keys = array_keys($var);
	return (array_keys($keys) !== $keys);
}
try {
$dotenv = new Dotenv();
} catch (Exception $e) {
	printr($e);
}
$dotenv->load('../.env');
define("SENDGRID_KEY", getenv("SENDGRID_API_KEY"));




?>