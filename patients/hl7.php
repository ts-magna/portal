<?php
$con= new mysqli("mysql.crestarlabs.com","root_patients","fYFc#-8FTLnSL8uyXt@sC@k#SEcACSg","patients_crestarlabs");

// Check connection
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function between ($this, $that, $inthat){
	return before ($that, after($this, $inthat));
};

$num = 0;
$data=array();
$dir = './hl7/';
$files = scandir($dir);
foreach($files as $a){ // read directory
	if(strpos($a,'.HL7') !== false){
		$b = $dir.$a;
		$data = array_map(function($v){return str_getcsv($v, "\t");}, file($b));
		foreach($data as $val){
			foreach($val as $seg){
				if(strpos($seg,'PID|') !== false){
					$PID = explode("|",$seg);
					$fname = explode("^",$PID[5]);
					$PatID = $PID[3];
					$DOB = $PID[7];
					echo "Full segment: ".$seg."<br>";
					echo "Patient ID: ".$PatID."<br>";
					echo "Patient First Name: ".$fname[0]."<br>";
					echo "Patient Last Name: ".$fname[1]."<br>";
					echo "DOB: ".$DOB."<br>";
				} // PID
				
				if(strpos($seg,'ORC|') !== false){
					$ORC = explode("|",$seg);
					$PSPECNO = $ORC[3];
					$REQ = $ORC[2];
					$DOS = $ORC[9];
					echo "PSPECNO: ".$PSPECNO."<br>";
					echo "REQ: ".$REQ."<br>";
					echo "DOS: ".$DOS."<br>";
				}

				if(strpos($seg,'OBX|') !== false){
					$OBX = explode("|",$seg);
					if($OBX[3] == 'RPT'){
						$RPT = explode("^",$OBX[5]);
						$PDF = $RPT[4];
						echo "PDF REPORT:<br>".$PDF."<br>";
					}
				} // OBX

			} // Read each line

		} // Read file into multi-array

	$rpts = "INSERT IGNORE INTO patients_crestarlabs.rpts (`PatID`, `PSPECNO`,`REQ`,`DOS`,`PDF`) VALUES ('".$PatID."','".$PSPECNO."','".$REQ."','".$DOS."','".$PDF."')";
	$pat = "INSERT IGNORE INTO patients_crestarlabs.pat (`PatID`, `DOS`,`DOB`) VALUES ('".$PatID."','".$DOS."','".$DOB."')";

	$con->query($rpts);
	$con->query($pat);
	rename('./hl7/'.$a,'./hl7/archive/'.$a);
	} // Read each file like .hl7

} // Read directory



mysqli_close($con);

?>