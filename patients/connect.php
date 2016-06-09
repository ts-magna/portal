<?php

$con= new mysqli("mysql.crestarlabs.com","root_patients","fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg","patients_crestarlabs");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>