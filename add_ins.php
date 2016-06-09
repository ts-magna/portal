<?php include 'header.php';
include 'pg_connect.php';


if (isset($_POST['submit'])) {
	

	$insid = strip_tags($_POST['insid']);
	$insabvr = strip_tags($_POST['insabvr']);
	$insname = strip_tags($_POST['insname']);
	$insadd1 = strip_tags($_POST['insadd1']);
	$insadd2 = strip_tags($_POST['insadd2']);
	$inscity = strip_tags($_POST['inscity']);
	$insstate = strip_tags($_POST['insstate']);
	$inszip = strip_tags($_POST['inszip']);
	$insphone = strip_tags($_POST['insphone']);
	$insfax = strip_tags($_POST['insfax']);

	$exists = 0;
	$query1 = "select insid from ins where insname = '".$insname."' ";
	$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
	while($row = pg_fetch_row($result)){
	$insadd = '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	The insurance name exists in the system already, please use the \'Update\' button instead.</div>';
	$exists = 1;
	}
	$query1 = "select insid from ins where insabvr = '".$insabvr."' ";
	$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
	while($row = pg_fetch_row($result)){
	$insadd = '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	The insurance abbreviation exists in the system already, please use the \'Update\' button instead.</div>';
	$exists = 1;
	}
	
	
	if($exists == 0){
		// get current timestamp
		$current = date("Y-m-d H:i:s");
		$query1 = "select insid from ins order by insid desc limit 1";
		$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
		while($row = pg_fetch_row($result)){
		$insid = $row[0];
		$insid = $insid + 1;
		}
		
		$query2 = "INSERT INTO ins
		VALUES( '".$insid."', '".$current."', TRUE, '".$insabvr."', '".$insname."', '".$insadd1."', '".$insadd2."', '".$inscity."', '".$insstate."', '".$inszip."', '".$insphone."', '".$insfax."', '%SYS')"; 
		
		$result2 = pg_query($query2) or die('Query Failed ' . pg_last_error());
		
		$insadd = '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		Provider added successfully! The new provier number is '.$insabvr.': '.$insname.'. If you need to edit this provier, please goto <a href="./edit_phy.php">the edit provider page</a> and select the provider by name.</div>';
	
		$errorMessage = '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Warning Message</div>';
	}
}

if(isset($_POST['delete'])){
	$query = "update ins set insact = FALSE where insid = '".$_POST['delete']."' ";
	$result = pg_query($query) or die('Query Failed: ' . pg_last_error());
	$insadd = '<div class="alert alert-dismissible alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Insurance ID '.$_POST['delete'].' deactivated successfully!</div>';
	
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
		$insadd = '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
		$insadd = '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		Provider '.$phy.' - '.$phyfname.' '.$phylname.' has been updated in the system.</div>';
		
		
		}
	}
	
	
}


?>




<div class="container">
	<div class="row-fluid">
		<div class="col-md-12">
		<?php echo $insadd;
		?>
		</div>
		<h2>Insurance Sign-up</h2>
		<div class="col-md-12">
			<form action="" method="post" id="add_acct">
			<table class="table borderless"><?php echo $hidden; ?>
				<tbody>
					<tr>
						<td colspan="1">Ins. Abvr.</td>
						<td colspan="2"><input class="form-control" type="text" name="insabvr" id="insabvr" value="<?php echo $insabvr;?>" <?php echo $disabled;?>></td>
						<td colspan="2">Insurance Name</td>
						<td colspan="5"><input class="form-control" type="text" name="insname" id="insname" value="<?php echo $insname;?>" <?php echo $disabled;?>></td>						
					</tr>
					<tr>
						<td colspan="1">Ins. Address 1</td>
						<td colspan="4"><input class="form-control" type="text" name="insadd1" id="insadd1" value="<?php echo $insadd1;?>"></td>
						<td colspan="1" class="text-center">Ins. Address 2</td>
						<td colspan="4"><input class="form-control" type="text" name="insadd2" id="insadd2" value="<?php echo $insadd2;?>"></td>
					</tr>
					<tr>
						<td colspan="1" class="text">City</td>
						<td colspan="3"><input class="form-control" type="text" name="inscity" id="inscity" value="<?php echo $inscity;?>"></td>
						<td colspan="1" class="text">State</td>
						<td colspan="1"><input class="form-control" type="text" name="insstate" id="insstate" value="<?php echo $insstate;?>"></td>
						<td colspan="1" class="text">Zip</td>
						<td colspan="3"><input class="form-control" type="text" name="inszip" id="inszip" value="<?php echo $inszip;?>"></td>
					</tr>
					<tr>
						<td colspan="1">Phone</td>
						<td colspan="4"><input class="form-control" type="text" name="insphone" id="insphone" value="<?php echo $insphone;?>"></td>
						<td colspan="1" class="text-center">Fax</td>
						<td colspan="4"><input class="form-control" type="text" name="insfax" id="insfax" value="<?php echo $insfax;?>"></td>
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
		$query = 'SELECT insid, insabvr, insname, inscity, insstate FROM ins where insact = TRUE';
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
		// Printing results in HTML
		echo "<table class='table' id='edit_tbl'>\n";
		echo "<thead><th>Ins. Abvr</th><th>Insurance</th><th>City, State</th><th>Edit Account</th><th>Deactivate account?</th></thead>";
		while($row = pg_fetch_row($result)){
			echo "<tr><form action='' method='post' id='edit_acct'><td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[3].", ".$row[4]."</td><td><button type='submit' class='btn btn-primary' name='edit' value='".$row[0]."'>Edit</button></form></td>
			<td><form action='' method='post' id = 'delete_acct' onsubmit=\"return confirm('Are you sure you want to deactivate this insurance?');\">
			<button type='submit' class='btn btn-primary' name='delete' value='".$row[0]."'>Deactivate insurance?</button></form></td></tr>";
		
		}
		echo "</table>\n";
		
		?>
		</div>
	</div>
</div>




</script>


<?php include 'footer.php'; ?>