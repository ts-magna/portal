<?php include 'header.php';
include 'pg_connect.php';

if (isset($_POST['submit'])) {
	
	$acct = strip_tags($_POST['acct']);
    $aname1 = strip_tags($_POST['aname1']);
    $aname2 = strip_tags($_POST['aname2']);
    $aadd1 = strip_tags($_POST['aadd1']);
	$aadd2 = strip_tags($_POST['aadd2']);
	$acity = strip_tags($_POST['acity']);
	$astate = strip_tags($_POST['astate']);
	$azip = strip_tags($_POST['azip']);
	$aphone = strip_tags($_POST['aphone']);
	$afax = strip_tags($_POST['afax']);
	$acontact = strip_tags($_POST['acontact']);

	$query1 = "update acct set aact = FALSE where acct = '".$acct."' ";
	$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
	
	
	

	$current = date("Y-m-d H:i:s");
	
	$query2 = "UPDATE acct set aefdt = '".$current."', aact = TRUE, aname1 = '".$aname1."', aname2 = '".$aname2."', aadd1 = '".$aadd1."', aadd2 = '".$aadd2."', acity = '".$acity."', astate = '".$astate."', 
	azip = '".$azip."', aphone = '".$aphone."', afax = '".$afax."', acontact = '".$contact."', modby = '%SYS' where acct = '".$acct."' ";
	
	$result2 = pg_query($query2) or die('Query Failed ' . pg_last_error());
	
    $acctnote = '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	Account edited successfully!</div>';

    $errorMessage = '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Warning Message</div>';
    
}

if(isset($_POST['delete'])){
	$query = "update acct set aact = FALSE where acct = '".$_POST['delete']."' ";
	$result = pg_query($query) or die('Query Failed: ' . pg_last_error());
	$acctnote = '<div class="alert alert-dismissible alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Account '.$_POST['delete'].' deactivated successfully!</div>';
	
}

if(isset($_POST['update'])){

// set acct
$acct = strip_tags($_POST['update']);

// set and run pull query
$query = "select acct, aname1, aname2, aadd1, aadd2, acity, astate, azip, aphone, afax, acontact from acct where aact = TRUE and acct = '".$acct."'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// set form for edit screen
while($row=pg_fetch_row($result)){
$acctedit = '
	<h2>Edit Account: '.$row[0].'</h2>
		<div class="col-md-12">
			<form action="" method="post" id="add_acct">
			<input type="hidden" name="acct" id="acct" value="'.$row[0].'">
			<table class="table borderless" id="edit_acct">
				<tbody>
					<tr>
						<td colspan="4">Account Name 1</td>
						<td colspan="6"><input class="form-control" type="text" name="aname1" id="aname1" value = "'.$row[1].'"></td>
					</tr>
					<tr>
						<td colspan="4">Account Name 2</td>
						<td colspan="6"><input class="form-control" type="text" name="aname2" id="aname2" value = "'.$row[2].'"></td>
					</tr>
					<tr>
						<td colspan="4">Account Address 1</td>
						<td colspan="6"><input class="form-control" type="text" name="aadd1" id="aadd1" value = "'.$row[3].'"></td>
					</tr>
					<tr>
						<td colspan="4">Account Address 2</td>
						<td colspan="6"><input class="form-control" type="text" name="aadd2" id="aadd2" value = "'.$row[4].'"></td>
					</tr>
					<tr>
						<td colspan="1">City</td>
						<td colspan="3"><input class="form-control" type="text" name="acity" id="acity" value = "'.$row[5].'"></td>
						<td colspan="1">State</td>
						<td colspan="2"><input class="form-control" type="text" name="astate" id="astate" value = "'.$row[6].'"></td>
						<td colspan="1">Zip</td>
						<td colspan="2"><input class="form-control" type="text" name="azip" id="azip" value = "'.$row[7].'"></td>
					</tr>
					<tr>
						<td colspan="1">Phone</td>
						<td colspan="4"><input class="form-control" type="text" name="aphone" id="aphone" value = "'.$row[8].'"></td>
						<td colspan="1">Fax</td>
						<td colspan="4"><input class="form-control" type="text" name="afax" id="afax" value = "'.$row[9].'"></td>
					</tr>
					<tr>
						<td colspan="4">Contact info</td>
						<td colspan="6"><input class="form-control" type="text" name="acontact" id="acontact" value = "'.$row[10].'"></td>
					</tr>
					<tr>
						<td colspan="10"><button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>';

}
}

?>





<div class="container">
	<div class="row-fluid">
		<div class="col-md-12">
		<?php echo $acctnote;
		?>
		</div>
		<?php echo $acctedit;	?>	
		<div class="col-md-12">
		<?php
		$query = 'SELECT acct, aname1, aname2 FROM acct where aact = TRUE';
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
		// Printing results in HTML
		echo "<table class='table' id='edit_tbl'>\n";
		echo "<thead><th>Account</th><th>Account Name</th><th>Acct Name cont.</th><th>Edit Account</th><th>Deactivate account?</th></thead>";
		while($row = pg_fetch_row($result)){
			echo "<tr><form action='' method='post' id='edit_acct'><td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[0]."</td><td><button type='submit' class='btn btn-primary' name='update' value='".$row[0]."'>Edit</button></form></td>
			<td><form action='' method='post' id = 'delete_acct' onsubmit=\"return confirm('Are you sure you want to deactivate this account?');\">
			<button type='submit' class='btn btn-primary' name='delete' value='".$row[0]."'>Deactive account?</button></form></td></tr>";
		
		}
		echo "</table>\n";
		
		?>
		</div>
	</div>
</div>















<?php include 'footer.php'; ?>