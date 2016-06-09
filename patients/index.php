<?php

// Start session
include 'loginit.php';




// if form submitted
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
    // if authentication fails, capture failure message
    Cartalyst\Sentry\Facades\Native\Sentry::authenticate($credentials, false);
    header('Location: http://172.30.1.110');  
  } catch (Exception $e) {
    $failMessageText = $e->getMessage();
    $failMessage = '<div class="row"><div class="col-md-12"><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$failMessageText.'</div></div></div>';
   // $failMessage = '<div class="row"><div class="col-md-12"><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Username or password are incorrect. If you forgot your password, click "Forgot your password?"</div></div></div>';
  } 
}


include 'header.php';

?>    

 
  <?php if (isset($currentUser)): ?>

  <?php $_SESSION['USER'] = $currentUser->getID(); ?>
	<div class = "container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-success front">
				<div class="panel-heading"><h2 class="form-signin-heading">Patient Portal Features</h2></div>
				<div class="panel-body-success">
					<h3><a href="./results">VIEW LAB TESTING RESULTS</a></h3>
					<p>
					<ul><li>Web access to view reports and lab testing results</li>
					<li>Receive explanations about your testing results</li>
					<li>Share information with your physicians, pharmacists, or other healthcare providers</li>
					<li>Make informed health decisions with your healthcare professionals based on the results of your testing</li>
					</ul>
					</p>
					
					<h3>MOBILE ACCESSIBILITY</h3>
					<p>
					<ul><li>Get easy and secure access to your results via your mobile phone or other connected portable device</li>
					<li>Access when you need it, where you need it without the security risk of carrying paper copies.</li>
					</ul>
					</p>
					<h3><a href="./billpay">VIEW STATEMENT INFORMATION</a></h3>

				</div></div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-danger front">
					<div class="panel-heading"><h2 class="form-signin-heading">Second Div</h2></div>
					<div class="panel-body">

					</div>
				</div>


			</div>
		</div>
	</div> <!-- container -->


  <?php else: ?>


 
	<div class = "container">
		<?php echo $failMessage; ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success front">
				<div class="panel-heading"><h2 class="form-signin-heading">Welcome</h2></div>
				<div class="panel-body-success">
					<h3>Welcome to the Crestar Labs Patient Access Portal</h3>
					<p>Accessing your personal health information has never been easier. Your personal information may be accessed easily and securely from your computer, smart phone, or connected device.
					</p>
				</div></div>
			</div>
		</div>


		<div class = "row">
			<div class = "col-md-6">
				<div class="panel panel-primary front">
					<div class="panel-heading"><h2 class="form-signin-heading">Log In</h2></div>
					<div class="panel-body"><form class="form-signin"  method="post">
					<label for="inputEmail">Username:</lable>
					<input type="email" id="username" name="username" class="form-control" placeholder="Email Address" required autofocus>
					<label for="inputPassword">Password: </label>
					<input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Log In">Sign in</button>
				</form><br>
				<p><a href="./passreset">Forgot your password?</a></p> </div>
			</div></div> <!-- col3 -->
			<div class = "col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"><h2>New Users</h2></div>
					<div class="panel-body">
						<h3>What you will need to register:</h3>
							<ul><li>Specimen Number (Provided on the card that you recieved in the mail)</li>
							<li>Date of Birth</li>
							<li>Date of Service</li></ul>
						<a href="./new-user" class="btn btn-primary">Register</a>
					<br><br><br></div></div>
			</div>
		</div> <!-- row -->
	</div> <!-- container -->
  <?php endif; ?>

<br>



<?php include "footer.php"; ?>

