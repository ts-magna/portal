<?php
// Include the composer autoload file
include_once "vendor/autoload.php";

  // configure database
  $dsn      = 'mysql:dbname=patients_crestarlabs;host=mysql.crestarlabs.com';
  $u = 'root_patients';
  $p = 'fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg';
  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));

// check for form submission
if (isset($_POST['submit'])) {
  try {
    // validate input
    $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $password = strip_tags(trim($_POST['password']));
    
    // set login credentials
    $credentials = array(
      'email'    => $username,
      'password' => $password,
    );

    // authenticate
    $currentUser = Cartalyst\Sentry\Facades\Native\Sentry::
      authenticate($credentials, false);
header( 'Location: https://patients.crestarlabs.com/');
    echo 'Logged in as ' . $currentUser->getLogin(); 
  } catch (Exception $e) {
    $errormsg = 'Authentication error: ' . $e->getMessage();
  }
}

?>