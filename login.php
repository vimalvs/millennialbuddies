<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Millenial Buddies</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="google-signin-client_id" content="879114558300-jk71s30erehipgbjo91opig7inhq5b4v.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <!-- Favicons -->
  <link href="img/favicon.ico" rel="icon">
  <link href="img/favicon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">

  <!-- Bootstrap css -->
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.theme.default.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/modal-video/css/modal-video.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: eStartup
    Theme URL: https://bootstrapmade.com/estartup-bootstrap-landing-page-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

<style>
	
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
.g-signin2 {
}
.g-signin2 > div {
	margin-bottom: 20px;
	width: 100% !important;
}
</style>

<form class="form-signin text-center" action="auth.php" method="post">
	<a href="/"><img src="/img/logo.jpg" alt="logo" width="150" height="100"></a>
	<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
	<label for="inputEmail" class="sr-only">Email address</label>
	<input type="email" name="auth_email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
	<label for="inputPassword" class="sr-only">Password</label>
	<input type="password" name="auth_password" id="inputPassword" class="form-control" placeholder="Password" required>
  <?php if (!empty($_GET['error'])):?>
    <?php $error = $_GET['error'];?>
    <?php if ($error == 'password_mismatch'):?>
      <div class="alert alert-danger">
        Invalid Password
      </div>
    <?php elseif ($error == 'user_not_exist'):?>
      <div class="alert alert-danger">
        User Not Exist. Please <a href="#register" data-toggle="modal" data-target="#registerModal">Signup</a>
      </div>
    <?php endif;?>  
  <?php endif;?>
	<div class="checkbox mb-3">
		<label>
			<input type="checkbox" name="auth_remember" value="remember-me"> Remember me
		</label>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <input type="hidden" name="action" value="login">
  <input type="hidden" name="p" value="1">
  <div class="p-4">
    <a href="#register" data-toggle="modal" data-target="#registerModal">Quick Signup</a>
  </div>
</form>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">User Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <label>Name</label>
          <input type="text" name="user_name" required="true" id="fin_user_name" class="form-control" aria-describedby="nameHelpBlock">
          <small id="nameHelpBlock" class="form-text text-muted">
            Your Profile Name
          </small>
          <label>Gender</label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" checked>
            <label class="form-check-label" for="gender_male">
              Male
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female">
            <label class="form-check-label" for="gender_female">
              Female
            </label>
          </div>
          <div>
          <label>Email</label>
          <input type="email" name="user_email" required="true" id="fin_user_email" class="form-control" aria-describedby="emailHelpBlock">
          <small id="emailHelpBlock" class="form-text text-muted">
              Used for login purpose eg:something@someone.com
          </small>
          </div>
          <label for="inputPassword5">Password</label>
          <input type="password" id="fin_user_password" name="user_password" required="true" class="form-control" aria-describedby="passwordHelpBlock">
          <small id="passwordHelpBlock" class="form-text text-muted">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </small>

          
        </form>
      </div>
      <div class="modal-footer">
        <a data-dismiss="modal" href="#login" class="text-sm">Login</a>
        <button type="button" class="btn btn-primary btn-create-acc">Create Account</button>
      </div>
    </div>
  </div>
</div>

 <footer class="text-center">

    <div class="copyrights">
      <div class="container">
        <p>&copy; Copyrights Millenialbuddies. All rights reserved.</p>
      </div>
    </div>

  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/notify.min.js"></script>
  <script>
    (function() {
      function validateEmail(email) {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return re.test(String(email).toLowerCase());
      }
      $('.btn-create-acc').click(function () {
        var user_name = $('#fin_user_name').val();
        var user_mail = $('#fin_user_email').val();
        var user_gender = $("input[name='gender']:checked").val();
        var user_password = $("#fin_user_password").val();
        if (user_name == '' || user_name == undefined) {
          alert('Please enter your name');
        } else if (user_mail == '' || user_mail == undefined) {
          alert('Please enter your email');
        } else if (!validateEmail(user_mail)) {
          alert('Please enter a valid email');
        } else if (user_password == '' || user_password == undefined) {
          alert('Please enter your password');
        } else {
          $.ajax({
            method: "POST",
            url: "/register.php",
            data: { user_name: user_name,user_mail:user_mail,user_gender:user_gender,user_password:user_password }
          })
            .done(function( msg ) {
              $.notify(msg, "success");
              $('#registerModal').modal('hide')
            });          
        }
        console.log(user_name, user_mail, user_gender, user_password);
      })
    }())
  </script>



	<script type="text/javascript">
	  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	  (function(){
	  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	  s1.async=true;
	  s1.src='https://embed.tawk.to/5c7f45703341d22d9ce78d36/default';
	  s1.charset='UTF-8';
	  s1.setAttribute('crossorigin','*');
	  s0.parentNode.insertBefore(s1,s0);
	  })();
	</script>
	<script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);

        var xhr = new XMLHttpRequest();
		xhr.open('POST', 'https://yourbackend.example.com/tokensignin');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
		  console.log('Signed in as: ' + xhr.responseText);
		};
		xhr.send('idtoken=' + id_token);
      }
	</script>
</body>
</html>
