<?php

// Start session
session_start();
include 'connect.php';
if(!($_SESSION['VALID'] == 'TRUE')){
	header('Location: new-user');
} 
$errorMessage="";

$formCol = '		

			<div class="panel panel-primary">
			<div class="panel-heading"><h1>Register - UserID: '.$_SESSION["ID"].'</h1></div>
			<form action="" method="post" id="register2">
			<div class="panel-body"><table id="form" class="table">
				<tr>
					<td>Email address: </td>
					<td><input type="text" name="email" id="email" /></td>
				</tr>
				<tr>
					<td>Confirm e-mail: </td>
					<td><input type="text" name="email2" id="email2" /></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" id="password"/></td>
				</tr>
				<tr>
					<td>Confirm Password: </td>
					<td><input type="password" name="password2" id="password2"/></td>
				</tr>
				<tr>
					<td>First name: </td>
					<td><input type="text" name="fname" id="fname"/></td>
				</tr>
				<tr>
					<td>Last name: </td>
					<td><input type="text" name="lname" id="lname"/></td>
				</tr>
				<tr>
					<td colspan=2><button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
				</tr>
			</table>
			</form></div></div>';


if (isset($_POST['submit'])) {

// Include the composer autoload file
include_once "vendor/autoload.php";

  // configure database
  $dsn      = 'mysql:dbname=patients_crestarlabs;host=mysql.crestarlabs.com';
  $u = 'root_patients';
  $p = 'fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg';
  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));
  
  // validate input and create user record
  // send activation code by email to user
  try {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $fname = strip_tags($_POST['fname']);
    $lname = strip_tags($_POST['lname']);
    $password = strip_tags($_POST['password']);
    
    $user = Cartalyst\Sentry\Facades\Native\Sentry::createUser(array(
        'email'    => $email,
        'password' => $password,
        'first_name' => $fname,
        'last_name' => $lname,
        'activated' => false
    ));

    $code = $user->getActivationCode();
    

    // get cartalyst User ID for addition to PatID table
    $patID = $_SESSION["ID"];
    $userID = $user->getID();    
    $query = "UPDATE patients_crestarlabs.pat SET `UserID` = '".$userID."', PACT = 1 where `PatID` = '".$patID."'";
    $con->query($query);

    $headers = "From: admin@crestarlabs.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $subject = 'Your activation code';
    $message = '<html><body>';
    $message = 'Code: ' . $code. ' UserID: ' . $userID;
    $message = $message.'<br>Click the following link to activate your account:<br>';
    $message = $message.'<a href="https://patients.crestarlabs.com/confirm.php?code='.$code.'&email='.$email.'">Click here</a>';
    $message .= '</body></html>';
    if (!mail($email, $subject, $message, $headers)) {
      throw new Exception('Email could not be sent.');
    }    
    $formCol = '<h1>Thanks!</h1>
		<p>User successfully registered and activation code sent. Please check your e-mail for your activation link.</p>';
    //exit;
  } catch (Exception $e) {
    $errorMessage = '<div class="row"><div class="col-md-12"><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$e->getMessage().'</div></div></div>';
    //exit;
  }
}


$con->close();


include 'header.php';
include 'public-nav.php';

?>

<div class="container">
	<?php echo $errorMessage;?>
	<div class="row-fluid">
		<div class="col-md-4" id="left-col">
			<div class="panel panel-success">
			<div class="panel-heading"><h1>Instructions</h1></div>
			<div class="panel-body"><p>Please use a valid e-mail address - you will need to check your e-mail in order to confirm your account.
			</p>
			<p>Password must be between 8 and 32 charecters. It is recommended that you use a combination
			of numbers and letters so that it is not easy to guess</p>
			</div></div>
		</div>
		<div class="col-md-8">
			<?php echo $formCol; ?> 
		</div>
	</div> 
</div>


<?php include 'footer.php' ?>






