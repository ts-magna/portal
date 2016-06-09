<?php

// Start session
include 'loginit.php';

if(isset($_GET['code']) && $_GET['email']){

$code = strip_tags($_GET['code']);
$email = strip_tags($_GET['email']);

}
$colMidError="";
$colMid= '<h1>Reset Password</h2>
	<form action="" method="post" id="reset">
	<table id="form" class="table">
		<tr>
			<td>Email address: </td>
			<td><input type="text" name="email" id="email" value="'.$email.'"></td>
		</tr>
		<tr>
			<td>Reset code: </td>
			<td><input type="text" name="code" id="code" value="'.$code.'" /></td>
		</tr>
		<tr>
			<td>New password: </td>
			<td><input type="password" name="password" id="password"/></td>
		</tr>
		<tr>
			<td>Confirm Password: </td>
			<td><input type="password" name="password2" id="password2" /> <br/>
		<tr>
			<td colspan=2><button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
		</tr>
	</table>
	</form>';






if (isset($_POST['submit'])){

// Include the composer autoload file
include_once "vendor/autoload.php";

  // configure database
  $dsn      = 'mysql:dbname=patients_crestarlabs;host=mysql.crestarlabs.com';
  $u = 'root_patients';
  $p = 'fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg';
  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));

  // find user by email address
  // attempt password reset
  try {
    $code = strip_tags($_POST['code']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlentities($_POST['password']);
    
    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
      'email' => $email
    ));
    
    if ($user->checkResetPasswordCode($code)) {
      if ($user->attemptResetPassword($code, $password)) {
        $colMid= 'Password successfully reset.';
        //exit;
      } else {
        $colMidError = "<p>Password was unable to be reset.</p>";  
      }
    } else {
        $colMidError = "<p>Password was unable to be reset.</p>";    }
  } catch (Exception $e) {
    $colMidError = $e->getMessage();
    //exit;
  }
}



include 'header.php';


?>

<div class="container">
	<div class="row">
		<div class='col-md-2'></div>
		<div class='col-md-8'>
			<?php echo $colMidError; echo $colMid; ?>
		</div>
		<div class='col-md-2'></div>
	</div>
</div>




<?php include 'footer.php'; ?>