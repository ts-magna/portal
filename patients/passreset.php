<?php

// Start session
session_start();
$colMid = '
		<h1>Reset Password</h2>
		<form action="" method="post" id="reset-request">
		<table class="table">
		<tr>
			<td>Email address: </td>
			<td><input type="text" name="email" id="email"></td>
		</tr>
		<tr>
			<td colspan=2><button align="center" type="submit" name="submit" class="btn btn-primary">Submit</button></td>

		</tr>
		</table>
		</form>
';
include 'loginit.php';
include 'reset-request.php';



include 'header.php';
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

<?php include 'footer.php'; ?>