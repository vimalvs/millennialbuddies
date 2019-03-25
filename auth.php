<?php
include 'includes/prepend.php';
include 'config.php';
 

extractCleanPostVars('action', 'auth_email', 'auth_password', 'auth_remember', 'auth_captcha', 'format', 'p');

if (empty($action)) $action = 'login';
if ($action === 'login') {
	// if page requested by submitting login form
	if( !empty($auth_email) && !empty($auth_password)) {

		$user_exist = get_user_by_email($auth_email);

		// user exist?
		if($user_exist)	{
			if (password_verify(trim($auth_password), $user_exist['password'])) {
			    echo 'Password is valid!';
			    $_SESSION["user_connected"] = true;
			    $_SESSION["user_name"] = $user_exist['name'];
			    $_SESSION["user_email"] = $user_exist['email'];
			    $_SESSION["user_id"] = $user_exist['id'];
				header("Location: home.php");
			} else {
				header("Location: login.php?error=password_mismatch");
			}
		} else {
			header("Location: login.php?error=user_not_exist");
		}
	}
}

/*
* get the user data from database by email and password
**/
function get_user_by_email($email) {
	$pdbo = SiteManager::getDatabase1();
	return $pdbo->getRecord("users", ['email' => $email]);
}
 
/*
* get the user data from database by provider name and provider user id
**/
function get_user_by_provider_and_id( $provider_name, $provider_user_id )
{
	return mysqli_query_excute( "SELECT * FROM users WHERE hybridauth_provider_name = '$provider_name' AND hybridauth_provider_uid = '$provider_user_id'" );
}
 
/*
* get the user data from database by provider name and provider user id
**/
function create_new_hybridauth_user( $email, $first_name, $last_name, $provider_name, $provider_user_id )
{
	// let generate a random password for the user
	$password = md5( str_shuffle( "0123456789abcdefghijklmnoABCDEFGHIJ" ) );
 
	mysqli_query_excute(
		"INSERT INTO users
		(
			email,
			password,
			first_name,
			last_name,
			hybridauth_provider_name,
			hybridauth_provider_uid,
			created_at
		)
		VALUES
		(
			'$email',
			'$password',
			'$first_name',
			'$last_name',
			$provider_name,
			$provider_user_id,
			NOW()
		)"
	);
}