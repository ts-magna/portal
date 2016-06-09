<?php

// Start session
include 'loginit.php';
include 'connect.php';

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



$rpts = "SELECT rpts.PatID, PSPECNO, REQ, rpts.DOS FROM patients_crestarlabs.rpts join pat on (rpts.PatID = pat.PatID) where pat.UserID = '".$_SESSION['USER']."'";
$result = $con->query($rpts);



?>

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-primary front">
			<div class="panel-heading"><h1>Reports</h1></div>
			<form method="post">
			<div class="panel-body"><table class="table">
				<thead>
					
					<th>Specimen Number</th>
					<th>Requisition Number</th>
					<th>Report Date</th>
					<th>Generate Report</th>
				</thead>
				<tbody>
			<?php while ($row=$result->fetch_row()){
				echo "<tr>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td><button type='submit' name='submit' value='".$row[1]."' class='btn btn-lg btn-primary btn-block'>Report</button></td></tr>";
			}
			?>
				</tbody>
			</table>
			</form>
			</div></div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>				







<?php

include "footer.php";
mysqli_close($con);
?>