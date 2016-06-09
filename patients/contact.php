<?php

// Start session
include 'loginit.php';
include 'connect.php';

if(isset($currentUser)){
	$_SESSION['USER'] = $currentUser->getID();
	include "header.php";
	include "user-nav.php";
}
else{
	include "header.php";
	include "public-nav.php";
}


?>












<?php include 'footer.php'; ?>