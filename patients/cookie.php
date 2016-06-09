<?php 

session_start();
echo "Old session 'ID':<b> ".$_SESSION["ID"]."</b><br>";
if (isset($_POST['setVar'])){
$patID = strip_tags($_POST['patID']);
$_SESSION["ID"]=$patID;
echo "New session 'ID':<b> ".$_SESSION["ID"]."</b><br>";
}
?> 

<html>
<head>
</head>
<body>
<br>
<form action="" method="post">
<input type="text" id="patID" name="patID">
<input type="submit" name="setVar" value="setVar">
</form>

</body>
</html>