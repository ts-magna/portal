<?php 
if (isset($_POST['code']) && $_POST['email']) {

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
    $password_repeat = htmlentities($_POST['password-repeat']);
    if ($password != $password_repeat) {
      throw new Exception ('Passwords do not match.');
    }
    
    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
      'email' => $email
    ));
    
    if ($user->checkResetPasswordCode($code)) {
      if ($user->attemptResetPassword($code, $password)) {
        echo 'Password successfully reset.';
        exit;
      } else {
        throw new Exception('User password could not be reset.');  
      }
    } else {
      throw new Exception('User password could not be reset.');  
    }
  } catch (Exception $e) {
    echo $e->getMessage();
    exit;
  }
}
?>