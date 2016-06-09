<?php
include 'pg_connect.php';
include 'header.php';
$current = date("Y-m-d H:i:s");



/*
$query = "select acct from acct where aact = TRUE order by acct desc limit 1";
	
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
while($row = pg_fetch_row($result)){
	
	echo "Last account: ".$row[0];
}


*/



?>



<div class="container">
<div class="row-fluid">
<div class="col-lg-2">
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>

</div>
<div class="col-lg-8">
  <div id="signature-pad" class="m-signature-pad">
    <div class="m-signature-pad--body">
      <canvas></canvas>
    </div>
    <div class="m-signature-pad--footer">
      <div class="description">Sign above</div>
      <button type="button" class="btn btn-primary button clear" data-action="clear">Clear</button>
      <button type="button" class="btn btn-primary button save" data-action="save">Save</button>
    </div>
  </div>
 </div>
 
 <div class="col-lg-2">
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
Test<br>
 </div>

</div>
</div> 
 
  <script src="js/signature_pad.js"></script>
  <script src="js/app.js"></script>
  
 </body>
 </html>