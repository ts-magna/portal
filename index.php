<?php

include 'header.php';

?>



<div class = 'container'>
  <div class = 'row'>
    <div class = 'col-md-12'>
HTML Test<br>
<?php echo "This is a php test<br>"; ?>

<button onclick="scriptTest()">Javascript test</button>
<br>
<p id="test"></p>
<script>
function scriptTest(){
	document.getElementById("test").innerHTML = "Javascript test is here<br>";
	
}
</script>

<?php
include 'pg_connect.php';

	
/*
$ID = 1;
$TESTTEXT = "This is some test text";	
$query = "INSERT INTO test (id,test) VALUES ('1','This is some test text')";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

*/	
	
// Performing SQL query
$query = 'SELECT acct, aname1, aname2 FROM acct';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
pg_free_result($result);





?>
    </div> <!-- col-md-12 -->
  </div>  <!-- row -->
</div> <!-- container -->



<?php

include "footer.php";

?>