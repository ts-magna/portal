<?php 

// page init
session_start();
include 'connect.php';
$formResponse ="";
$_SESSION["ID"]="clear";
$_SESSION["VALID"]="FALSE";

// grab recaptcha library
require_once "recaptchalib.php";

// your secret key
$secret = "6LdUrQ4TAAAAABgDbDz6vaHBWc3kVNNHJHclpYuR";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

$leftCol = "<h1>Left Column</h1>";
$rightCol = "<h1>Right Column</h1>";



$leftCol .= "<p>Session ID: ".$_SESSION["ID"]."</p>";

if ($response != null && $response->success) {

$patID = strip_tags($_POST['patID']);
$DOB = strip_tags($_POST['DOB']);
$DOS = strip_tags($_POST['DOS']);

$query = "SELECT * FROM patients_crestarlabs.pat WHERE `PatID` = '".$patID."' and `DOS` = '".$DOS."' and `DOB` = '".$DOB."' and PACT = 0";
$results = $con->query($query);
$query2 = "SELECT * FROM patients_crestarlabs.pat WHERE `PatID` = '".$patID."' and `DOS` = '".$DOS."' and `DOB` = '".$DOB."' and PACT = 1";
$results2 = $con->query($query2);

	if($results->num_rows == 1){
		$_SESSION["ID"]=$patID;
		$_SESSION["VALID"]="TRUE";
		$leftCol .= "<p>".$_SESSION["ID"]."</p>"; 
		header('Location: register');
	}
	elseif($results2->num_rows ==1){
		$formResponse = '<div class="row"><div class="col-md-12"><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				This Patient ID has already been activated. If you need to reset your password,
				visit the password reset page <a href="./pass-reset">here</a> and reset your password.<br>
				If you have not previously activated this Patient ID and believe you are recieving this message
				in error, please e-mail <a href="mailto:support@crestarlabs.com">support@crestarlabs.com</a> or visit 
				our contact page <a href="./contact">here</a> and choose "Account issue" to contact us.</div></div></div>'; 

	}
	else{
	$formResponse = '<div class="row"><div class="col-md-12"><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			These credentials do not match any records in the system. If you believe this is in error
			please e-mail <a href="mailto:support@crestarlabs.com">support@crestarlabs.com</a> or visit 
			our contact page <a href="./contact">here</a> and choose "Record not found" to contact us.</div></div></div>';

	}



}
mysqli_close($con);
?>


<?php include 'header.php'; ?>
<?php include 'public-nav.php'; ?>


<div class = "container">
	<div class = "row-fluid">
		
		<div class="col-md-3"></div>
		<div class = "col-md-6" id = "mid-col" align="center">
		<? echo $formResponse; ?>
		<div class="panel panel-primary">
		<div class="panel-heading"><h1>Register</h1></div>
		<div class="panel-body">
		<form action="" method="post" id="register">

		<table id="form" class="table">
			<tr>
				<td>Patient ID:</td><td><input type="text" name="patID" id = "patID"/></td>
			</tr>
			<tr>
				<td>Date of Birth (YYYY-MM-DD):</td><td><input type="text" name="DOB" class="datepicker" id="DOB"/></td>
			</tr>
			<tr>
				<td>Date of Service (YYYY-MM-DD):</td><td><input type="text" name="DOS" class="datepicker" id="DOS" /></td>
			</tr>
			<tr>
				<td colspan=2><div align="right" class="g-recaptcha" data-sitekey="6LdUrQ4TAAAAADPVQR6JhHHrHnSleVvtZL7m-eiM"></div></td>
			</tr>
			<tr>
				<td colspan=2 align="right">I agree to the <a href="#" data-toggle="modal" data-target="#termsinfo">Terms and Conditions</a> of this portal <input type="checkbox" name="terms" id="terms" value="TRUE"></div> 
			</tr>
			<tr>
				<td colspan=2><button style="float:right;" type="submit" name="submit" class="btn btn-primary">Submit</button></td>
			</tr>
		</table>
		</form>
		</div></div>
		</div> <!-- mid-col -->
		<div class="col-md-3"></div>


	</div> <!-- row -->
</div> <!-- container -->


<!-- Modal -->
<div class="modal fade" id="termsinfo" tabindex="-1" role="dialog" aria-labelledby="termsinfo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Terms and Conditions</h4>
      </div>
      <div class="modal-body">
        <h3 align="center">FRAUD WARNING</h3>
	<p>Any person who knowingly with the intent to defraud any medical agency by concealing and filing false 
	information for medical care or treatment may be found to have committed a fraudulent act which is a crime and may be subject to criminal and civil penalties. </p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<?php include 'footer.php' ?>


