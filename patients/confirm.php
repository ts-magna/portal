<?php 
//start session
include 'loginit.php';

if (isset($_GET['code']) && $_GET['email']) {

// Include the composer autoload file
include_once "vendor/autoload.php";

  // configure database
  $dsn      = 'mysql:dbname=patients_crestarlabs;host=mysql.crestarlabs.com';
  $u = 'root_patients';
  $p = 'fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg';
  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));

  // find user by email address
  // activate user with activation code
  try {
    $code = strip_tags($_GET['code']);
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
      'email' => $email
    ));
    if ($user->attemptActivation($code)) {
      $colMid = 'User activated.';
    } else {
      throw new Exception('User could not be activated.');  
    }
  } catch (Exception $e) {
    $resetError = "<p>".$e->getMessage()."</p>";
  }
}

include 'header.php'
?>

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<?php echo $resetError; echo $colMid; ?>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>





<?php include 'footer.php' ?>