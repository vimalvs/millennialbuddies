<?php

include 'includes/prepend.php';

$user_name = $_POST['user_name'];
$user_email = $_POST['user_mail'];
$user_gender = $_POST['user_gender'];
$user_password = $_POST['user_password'];
if (empty($user_name)) {
	echo("Please Enter Your Name");
} elseif (empty($user_email)) {
	echo("Please Enter Your Email");
}  elseif (empty($user_password)) {
	echo("Please Enter Your password");
} else {
	$pdbo = SiteManager::getDatabase1();
	if (!$pdbo->getRecord("users", ["email" => trim($user_email)])) {
		if ($pdbo->insertRecord("users", ["name" => $user_name, "email" => $user_email, "gender" => $user_gender, 'password' => password_hash(trim($user_password), PASSWORD_BCRYPT)])) {
			echo ("Your account created successfully.");
		} else {
			echo("Sorry for the inconvenience. Your request can't be process right now.");
		}
	} else {
		echo("You are already a registered member.");
	}
}
exit;
