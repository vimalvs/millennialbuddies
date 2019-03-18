<?php
include '../includes/prepend.php';

$user_email = $_POST['email'];
if (empty($user_email)) {
	echo("Please Enter Your Email");
} else {
	$pdbo = SiteManager::getDatabase1();
	if (!$pdbo->getRecord("subscribe_list", ["user_email" => trim($user_email)])) {
		if ($pdbo->insertRecord("subscribe_list", ["created_at" => DATE_TIME, "user_email" => $user_email])) {
			echo ("Your email successfully added to our subscribe list. Thank You.");
		} else {
			echo("Sorry for the inconvenience. Your request can't be process right now.");
		}
	} else {
		echo("You are already in the subscribe list");
	}
}
exit;
