<?php include 'header.php';
include 'pg_connect.php';


if (isset($_POST['submit'])) {
	

    $phy = strip_tags($_POST['npi']);
    $phytitle = strip_tags($_POST['phytitle']);
    $phyfname = strip_tags($_POST['phyfname']);
	$phylname = strip_tags($_POST['phylname']);
	$phymname = strip_tags($_POST['phymname']);
	$phycred = strip_tags($_POST['phycred']);

	$exists = 0;
	$query1 = "select npi from phy where npi = '".$phy."' ";
	$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
	while($row = pg_fetch_row($result)){
	$phyadd = '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	This provider aleady exisits in the system - if you want to edit the provider, please use the \'Update\' button instead.</div>';
	$exists = 1;
	
	}
	
	if($exists == 0){
	// get current timestamp
	$current = date("Y-m-d H:i:s");
	
	$query2 = "INSERT INTO phy
	VALUES( '".$phy."', '".$current."', TRUE, '".$phytitle."', '".$phyfname."', '".$phylname."', '".$phymname."', '".$phycred."', '%SYS')"; 
	
	$result2 = pg_query($query2) or die('Query Failed ' . pg_last_error());
	
    $phyadd = '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	Provider added successfully! The new provier number is '.$phy.': '.$phyfname.' '.$phylname.'. If you need to edit this provier, please goto <a href="./edit_phy.php">the edit provider page</a> and select the provider by name.</div>';

    $errorMessage = '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Warning Message</div>';
	}
}

if(isset($_POST['delete'])){
	$query = "update phy set phyact = FALSE where npi = '".$_POST['delete']."' ";
	$result = pg_query($query) or die('Query Failed: ' . pg_last_error());
	$acctnote = '<div class="alert alert-dismissible alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Provider '.$_POST['delete'].' deactivated successfully!</div>';
	
}

if(isset($_POST['edit'])){

// set acct
$phy = strip_tags($_POST['edit']);

// set and run pull query
$query = "select npi, phytitle, phycred, phyfname, phymname, phylname from phy where phyact = TRUE and npi = '".$phy."'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$disabled = "disabled";
$hidden = "<input type='hidden' id='npi' value='".$phy."' name='npi'";
// set form for edit screen
while($row=pg_fetch_row($result)){
	$phytitle = $row[1];
	$phycred = $row[2];
	$phyfname = $row[3];
	$phymname = $row[4];
	$phylname = $row[5];
	}
}

if(isset($_POST['update'])){
	
	$phy = strip_tags($_POST['npi']);
    $phytitle = strip_tags($_POST['phytitle']);
    $phyfname = strip_tags($_POST['phyfname']);
	$phylname = strip_tags($_POST['phylname']);
	$phymname = strip_tags($_POST['phymname']);
	$phycred = strip_tags($_POST['phycred']);
	
	$exists = 0;
	$query1 = "select count(npi) as cnt_npi from phy where npi = '".$phy."' and phyact = TRUE ";
	$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
	while($row = pg_fetch_row($result)){
	
		if($row[0] == 0){
		$phyadd = '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		This provider does not exist, please create a new provider by clicking the submit button.</div>';
		$exists = 0;
		}
		if($row[0] > 0){
		$deactivate = "update phy set phyact = FALSE where npi = '".$phy."'  ";
		$result = pg_query($deactivate) or die('Query Failed: ' . pg_last_error());
		
		// get current timestamp
		$current = date("Y-m-d H:i:s");
		
		$update = "INSERT INTO phy
		VALUES( '".$phy."', '".$current."', TRUE, '".$phytitle."', '".$phyfname."', '".$phylname."', '".$phymname."', '".$phycred."', '%SYS')"; 
		
		$result2 = pg_query($update) or die('Query Failed: ' . pg_last_error());
		$phyadd = '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		Provider '.$phy.' - '.$phyfname.' '.$phylname.' has been updated in the system.</div>';
		
		
		}
	}
	
	
}


?>




<div class="container">
	<div class="row-fluid">
		<div class="col-md-12">
		<?php echo $phyadd;
		?>
		</div>
		<h2>Provider Sign-up</h2>
		<div class="col-md-12">
			<form action="" method="post" id="add_acct">
			<table class="table borderless"><?php echo $hidden; ?>
				<tbody>
					<tr>
						<td colspan="4">Provider NPI</td>
						<td colspan="6"><input class="form-control" type="text" name="npi" id="npi" value="<?php echo $phy;?>" <?php echo $disabled;?>></td>
					</tr>
					<tr>
						<td colspan="2">Provider Title</td>
						<td colspan="3"><input class="form-control" type="text" name="phytitle" id="phytitle" value="<?php echo $phytitle;?>"></td>
						<td colspan="2" class="text-center">Provider Credentials</td>
						<td colspan="3"><input class="form-control" type="text" name="phycred" id="phycred" value="<?php echo $phycred;?>"></td>
					</tr>
					<tr>
						<td colspan="1" class="text-center">First Name</td>
						<td colspan="3"><input class="form-control" type="text" name="phyfname" id="phyfname" value="<?php echo $phyfname;?>"></td>
						<td colspan="1" class="text-center">Middle Name</td>
						<td colspan="1"><input class="form-control" type="text" name="phymname" id="phymname" value="<?php echo $phymname;?>"></td>
						<td colspan="1" class="text-center">Last Name</td>
						<td colspan="3"><input class="form-control" type="text" name="phylname" id="phylname" value="<?php echo $phylname;?>"></td>
					</tr>
					<tr>
						<td colspan="5"><button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
						<td colspan="5"><button type="submit" class="btn btn-primary" name="update">Update</button></td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
		<div class="col-md-12">
		<?php
		$query = 'SELECT npi, phyfname, phylname FROM phy where phyact = TRUE';
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
		// Printing results in HTML
		echo "<table class='table' id='edit_tbl'>\n";
		echo "<thead><th>NPI</th><th>First Name</th><th>Last Name</th><th>Edit Account</th><th>Deactivate account?</th></thead>";
		while($row = pg_fetch_row($result)){
			echo "<tr><form action='' method='post' id='edit_acct'><td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[2]."</td><td><button type='submit' class='btn btn-primary' name='edit' value='".$row[0]."'>Edit</button></form></td>
			<td><form action='' method='post' id = 'delete_acct' onsubmit=\"return confirm('Are you sure you want to deactivate this provider?');\">
			<button type='submit' class='btn btn-primary' name='delete' value='".$row[0]."'>Deactive provider?</button></form></td></tr>";
		
		}
		echo "</table>\n";
		
		?>
		</div>
	</div>
</div>




</script>





















<?php include 'footer.php'; ?>