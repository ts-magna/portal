<?php

//start session
include 'loginit.php';
include 'connect.php';

$x_login="HCO-MERIT-333";
$x_amount="558.49";
$x_fp_sequence = "CR15U08500123";
$x_fp_timestamp = time();
$x_transaction_key="XCCJq5D9XP3uCFanIWs0";

include 'header.php';

?>
<?php if($_POST["x_response_code"]== 1){
echo "Specimen paid on - ".$_POST['x_fp_sequence']."<br>Amount paid - ".$_POST['x_amount']."<br>Full Transaction verbiage - ".$_POST['exact_ctr']."<br>";
$payment="UPDATE mlp_lab_data.COPAY SET COPAY_PMT = '".$_POST['x_amount']."', TRANSACTION = '".$_POST['exact_ctr']."' WHERE CHART LIKE '%".$_POST['x_fp_sequence']."'";
$con->query($payment);
}


?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<div class="panel panel-primary front">
		<div class="panel-heading"><h2 class="form-signin-heading">Billing</h2></div>
		<div class="panel-body">
		<table class="table">
				<thead>
					
					<th>Specimen Number</th>
					<th>Total Owed</th>
					<th>Total Payments</th>
					<th>Payment</th>
				</thead>

		<?php echo $_SESSION['USER']."<BR>"; 
		$bills = "SELECT substring(COPAY.CHART from 5) as CHART, COPAY.COPAY_AMT, COPAY.COPAY_PMT FROM mlp_lab_data.COPAY join patients_crestarlabs.pat on (COPAY.USERID = pat.PatID) where pat.UserID = '".$_SESSION['USER']."'";
		$result = $con->query($bills);
		if(!is_object($result)){echo $con->error;}
		while ($row=$result->fetch_row()){
		$x_amount = $row[1] - $row[2];
		$x_payment = $row[2];
		$x_fp_sequence = $row[0];
		$hash_val = hash_hmac("MD5",$x_login."^".$x_fp_sequence."^".$x_fp_timestamp."^".$x_amount."^", $x_transaction_key);
		echo '
		<form action="https://demo.globalgatewaye4.firstdata.com/pay" method="POST" name="myForm" id="myForm">		
		<input name="x_login" value="HCO-MERIT-333" type="hidden"> 
		<input name="x_amount" value="'.$x_amount.'" type="hidden"> 
		<input name="x_fp_sequence" value="'.$x_fp_sequence.'" type="hidden"> 
		<input name="x_fp_timestamp" value="'.$x_fp_timestamp.'" type="hidden"> 
		<input name="x_fp_hash" value="'.$hash_val.'" type="hidden"> 
		<input name="x_show_form" value="PAYMENT_FORM" type="hidden"> 
		<input name="x_relay_response" value="TRUE" type="hidden">
		<tr><td>'.$x_fp_sequence.'</td>
		<td>$'.$x_amount.'</td>
		<td>$'.$x_payment.'</td>
		<td><button type="submit" name="submit" value="Checkout" class="btn btn-lg btn-primary btn-block">Pay Your Bill</button></td></tr>
		</form>';
		}

		?>
		</table>
		</div></div>

		</div>
	</div>
</div>


<?php include 'footer.php'; 
mysqli_close($con);
?>

