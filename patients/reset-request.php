<?php

if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

if (isset($_POST['submit'])) {
// Include the composer autoload file
include_once "vendor/autoload.php";

  // configure database
  $dsn      = 'mysql:dbname=patients_crestarlabs;host=mysql.crestarlabs.com';
  $u = 'root_patients';
  $p = 'fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg';
  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));



  // validate input and find user record
  // send reset code by email to user
  try {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
      'email' => $email
    ));
    
    $code = $user->getResetPasswordCode();
    
    $headers = "From: admin@crestarlabs.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $subject = 'Your Password reset code';
    $message = '<html><body>';
    $message .= 'Click the following link to set a new password: <a href="https://patients.crestarlabs.com/resetform.php?code='.$code.'&email='.$email.'">Reset Password</a>';
    $message .= '<br><br>If the link above does not work, goto <a href="https://patients.crestarlabs.com/resetform">https://patients.crestarlabs.com/resetform</a> ';
    $message .= 'and enter the code '.$code.' on the site.';
    $message .= '</body></html>';
    if (!mail($email, $subject, $message, $headers)) {
      throw new Exception('Email could not be sent.');
    }    
    
    $colMid = "<h1>Password reset code sent.</h1>";   
    //exit;
  } catch (Exception $e) {
    $resetError = "<p>". $e->getMessage()."</p>";
    //exit;
  }
}
?>

