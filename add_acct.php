<?php include 'header.php';
include 'pg_connect.php';


if (isset($_POST['submit'])) {
	

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

	$query1 = "select acct from acct order by acct desc limit 1";
	$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
	while($row = pg_fetch_row($result)){
	$acct = $row[0];
	$acct = $acct + 1;
	}
	$current = date("Y-m-d H:i:s");
	
	$query2 = "INSERT INTO acct (acct, aefdt, aact, aname1, aname2, aadd1, aadd2, acity, astate, azip, aphone, afax, acontact,modby) 
	VALUES( '".$acct."', '".$current."', TRUE, '".$aname1."', '".$aname2."', '".$aadd1."', '".$aadd2."', '".$acity."', '".$astate."', '".$azip."', '".$aphone."', '".$afax."', '".$acontact."','%SYS')"; 
	
	$result2 = pg_query($query2) or die('Query Failed ' . pg_last_error());
	
    $acctadd = '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	Account added successfully! The new account number is '.$acct.': '.$aname1.'. If you need to edit this account, please goto <a href="./edit_acct.php">the edit account page</a> and select the account by name.</div>';

    $errorMessage = '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Warning Message</div>';
    
}

?>




<div class="container">
	<div class="row-fluid">
		<div class="col-md-12">
		<?php echo $acctadd;
		?>
		</div>
		<h2>Account Signup</h2>
		<div class="col-md-12">
			<form action="" method="post" id="add_acct">
			<table class="table borderless">
				<tbody>
					<tr>
						<td colspan="4">Account Name 1</td>
						<td colspan="6"><input class="form-control" type="text" name="aname1" id="aname1"></td>
					</tr>
					<tr>
						<td colspan="4">Account Name 2</td>
						<td colspan="6"><input class="form-control" type="text" name="aname2" id="aname2"></td>
					</tr>
					<tr>
						<td colspan="4">Account Address 1</td>
						<td colspan="6"><input class="form-control" type="text" name="aadd1" id="aadd1"></td>
					</tr>
					<tr>
						<td colspan="4">Account Address 2</td>
						<td colspan="6"><input class="form-control" type="text" name="aadd2" id="aadd2"></td>
					</tr>
					<tr>
						<td colspan="1">City</td>
						<td colspan="3"><input class="form-control" type="text" name="acity" id="acity"></td>
						<td colspan="1">State</td>
						<td colspan="2"><input class="form-control" type="text" name="astate" id="astate"></td>
						<td colspan="1">Zip</td>
						<td colspan="2"><input class="form-control" type="text" name="azip" id="azip"></td>
					</tr>
					<tr>
						<td colspan="1">Phone</td>
						<td colspan="4"><input class="form-control" type="text" name="aphone" id="aphone"></td>
						<td colspan="1">Fax</td>
						<td colspan="4"><input class="form-control" type="text" name="afax" id="afax"></td>
					</tr>
					<tr>
						<td colspan="4">Contact info</td>
						<td colspan="6"><input class="form-control" type="text" name="acontact" id="acontact"></td>
					</tr>
					<tr>
						<td colspan="10"><button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
		<div class="col-md-12">
		<?php ?>
		</div>
	</div>
</div>




</script>





















<?php include 'footer.php'; ?>