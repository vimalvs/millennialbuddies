<?php
session_start();
include 'site_config.php';
include ROOT.'/vendor/autoload.php';

include ROOT.'/lib/SiteManager.php';
include ROOT.'/lib/DbManager.php';
use Symfony\Component\Dotenv\Dotenv;



function extractVars() {
	$args = func_get_args();
	foreach ($args as $arg) {
		$GLOBALS[$arg] = isset($_POST[$arg]) ? $_POST[$arg] : (isset($_GET[$arg]) ? $_GET[$arg] : '');
	}
}

function extractCleanVars() {
	$args = func_get_args();
	foreach ($args as $arg) {
		$GLOBALS[$arg] = getCleanVar($arg, NULL, NULL);
	}
}

function extractCleanPostVars() {
	$args = func_get_args();
	foreach ($args as $arg) {
		$GLOBALS[$arg] = getCleanPostVar($arg, NULL, NULL);
	}
}

/**
 * Sanitizes and returns a REQUEST parameter
 *
 * @param	string	$var The input parameter
 * @param	string	$default Default value if the parameter is not present
 * @param	string	$allowed_tags If specified, data will be stripped of tags other than $allowed_tags
 * @return	mixed The requested parameter
 */
function getCleanVar($var, $default = NULL, $strip_tags = NULL) {
	$returnVar = null;
	if (is_array($var)) {
		if (is_array($default)) {
			foreach ($var as $k => $v) {
				$returnVar[$k] = getCleanVar($v, isset($default[$k]) ? $default[$k] : null, $escape);
			}
		} else {
			foreach ($var as $k => $v) {
				$returnVar[$k] = getCleanVar($v, $default, $escape);
			}
		}
		return $returnVar;
	} else {
		$val = isset($_POST[$var]) ? $_POST[$var] : (isset($_GET[$var]) ? $_GET[$var] : $default);
		if (is_array($val)) {
			array_walk_recursive($val, 'sanitizeData', $strip_tags);
		} elseif (!is_null($val)) {
			sanitizeData($val, NULL, $strip_tags);
		}
		return $val;
	}
}

/**
 * Sanitizes and returns a POST parameter
 *
 * @param	string	$var The input parameter
 * @param	string	$default Default value if the parameter is not present
 * @param	string	$allowed_tags If specified, data will be stripped of tags other than $allowed_tags
 * @return	mixed The requested parameter
 */
function getCleanPostVar($var, $default = NULL, $strip_tags = NULL) {
	$returnVar = null;
	if (is_array($var)) {
		if (is_array($default)) {
			foreach ($var as $k => $v) {
				$returnVar[$k] = getCleanPostVar($v, isset($default[$k]) ? $default[$k] : null, $escape);
			}
		} else {
			foreach ($var as $k => $v) {
				$returnVar[$k] = getCleanPostVar($v, $default, $escape);
			}
		}
		return $returnVar;
	} else {
		$val = isset($_POST[$var]) ? $_POST[$var] : $default;
		if (is_array($val)) {
			array_walk_recursive($val, 'sanitizeData', $strip_tags);
		} elseif (!is_null($val)) {
			sanitizeData($val, NULL, $strip_tags);
		}
		return $val;
	}
}

/**
 * Sanitize a given input html code injection. 
 *
 * @param	string	&$var The input data
 * @param	string	$key Placeholder for array index, when invoked using array_walk_recursive
 * @param	string	$allowed_tags If specified, data will be stripped of tags other than $allowed_tags
 * @return	void
 */
function sanitizeData(&$var, $key, $allowed_tags = NULL) {
	$var = htmlspecialchars(is_null($allowed_tags) ? $var : strip_tags($var, $allowed_tags));
}
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
$dotenv->load(ROOT.'/.env');
define("SENDGRID_KEY", getenv("SENDGRID_API_KEY"));




?>