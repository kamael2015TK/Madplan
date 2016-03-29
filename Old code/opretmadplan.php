<head> 
	<title>	Madplan.dk </title> <! title på min tjemmeside>
	<link rel="icon" href="images.png" />	<! jeg linker et billede for at gøre det lidt pæner>
	<meta charset="utf-8"> <! includer danske tegn >
	<link rel="stylesheet" type="text/css" href="eksamencss.css"><! jeg inkluderer css document>	
</head>

<?php 
session_start();
if(!$_SESSION['email']){
header("location:logininput.html");
}
// tjekker om brugeren er logget ind 
include 'coninclude.php';

$antal = $_REQUEST['antaldage'];
$type=$_REQUEST['type'];
$myemail= $_SESSION['email'];
$brugerid =	mysqli_fetch_array(mysqli_query($con,"SELECT ID FROM `madplanbruger` WHERE Email = '$myemail' "));
$indseattest = true; // variabel som jeg bruger til at tæste hvis brugeren indtastet de forkede datoer (hakker) 

$antal = htmlentities($antal);
$antal = mysqli_real_escape_string($con,$antal);
// det er en test 
$type = htmlentities($type);
$type = mysqli_real_escape_string($con,$type);

for($i=0; $i<$antal; $i++){
	$dag= $_POST[$i];
	$dag= htmlentities($dag);
	$dag= mysqli_real_escape_string($con,$dag);
	
	$tjekdag =mysqli_query($con,"SELECT * FROM `madplan` WHERE `Bruger` = '$myemail' AND `Dato`= '$dag'");
	if(mysqli_num_rows($tjekdag) != 0){
		$indseattest = false;
	}
}
if($indseattest == true){

	for($i=0; $i<$antal; $i++){
		$dag= htmlentities($_POST[$i."dag"]);
		$dag= mysqli_real_escape_string($con,$dag);

		$dato= htmlentities($_POST[$i."dato"]);
		$dato= mysqli_real_escape_string($con,$dato);

		$ret= htmlentities($_POST[$i."mm"]);
		$ret= mysqli_real_escape_string($con,$ret);
	
		$antalpersoner= htmlentities($_POST[$i."antal"]);
		$antalpersoner= mysqli_real_escape_string($con,$antalpersoner);
		// hakker sikring 
		
		$tjek = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Dato` =  '$dato' And `type` = '$type' AND `Bruger` = '$brugerid[0]'");
		if(mysqli_num_rows($tjek)==0){
		// sidste tjek om man ikke overskriver sin data
			mysqli_query($con, "INSERT INTO `madplan`(`ID`, `Dato`, `Dag`, `Ret`, `AntalP`, `type`, `Bruger`) 
								VALUES (0,'$dato','$dag ','$ret','$antalpersoner','$type','$brugerid[0]' )");
		
			$antalvalgt = mysqli_fetch_array(mysqli_query($con, "SELECT `Populaer` FROM `opskreft` WHERE `NavnO` = '$ret'"));
			$nyeantal = $antalvalgt[0]+1;
			// jeg laver en ranking system hvor for hver valgt vil dens ranking stige 
			
			mysqli_query($con, "UPDATE `opskreft` SET `Populaer`= '$nyeantal' WHERE `NavnO` = '$ret'");
		}
	}
	
	echo "din mad plan er oprætet du kan går ind og printer indkøbsliste under indkøbsliste";
	?><script>setTimeout(function(){window.location ="minmadplan.php"},2000);</script><?php

}
else{
	echo "der er noget som gik galt, prøv igen";
	?><script>setTimeout(function(){window.location ="minmadplan.php"},2000);</script><?php
}
?>
 <meta charset="utf-8">
