<?php

// Start session
include 'loginit.php';
include 'connect.php';

$con= new mysqli("mysql.crestarlabs.com","root_patients","fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg","patients_crestarlabs");
$query="select * from patients_crestarlabs.rpts";
$result = $con->query($query);


if (isset($_POST['submit'])){
	$PSPECNO = $_POST['submit'];
	$rpt="select * from patients_crestarlabs.rpts where `PSPECNO` = '".$PSPECNO."'";
	$results = $con->query($rpt);
	$row = $results->fetch_array();
	

	// Takes the base64 data and returns it to the site
	$pdf = base64_decode($row[5]);
	file_put_contents($PSPECNO.'.pdf',$pdf);
	header('Content-type: application/pdf');
	header('Content-Disposition: attachment; filename='.$PSPECNO.'.pdf');
	echo $pdf;

	// deletes temp PDF and updates record count for report generated
	unlink($PSPECNO.'.pdf');
	$query = "UPDATE patients_crestarlabs.rpts set cnt = cnt + 1 where `PSPECNO` = '".$PSPECNO."'";
	$con->query($query);
	mysqli_close($con);
}

if(isset($currentUser)){
	$_SESSION['USER'] = $currentUser->getID();
	include "header.php";
	include "user-nav.php";
}
else{
	header("location: ./");
}


?>

<div class="container">
<div class="row">
<div class="col-md-12">
<?php echo $_POST['submit']; ?>
<br><br>
<form method="post">
<?php
while ($row=$result->fetch_row()){
	echo 
	"ID: ".$row[1]."
	<br>PSPECNO: ".$row[2]."
	<br><button type='submit' 
	name='submit' value='".$row[2]."'/>
	Submit</button><br>";
}

mysqli_close($con);
?>
</form>
</div>
</div>
</div>

<?php include "footer.php"; ?>