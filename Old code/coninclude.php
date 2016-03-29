<?php 
$con= mysqli_connect("localhost","root","","Madplan") or die("Error " . mysqli_error($con));
// selv om det er en linje det drejer sig om skal jeg inkluderer det til flere documenter 
// fordi når jeg skal sætte det online skal jeg ændre på connection. og nå jeg inkluderer det på denne måde
// vil det være nemmer for mig efter. 

// funktion der skal generere tokens 
	function randomstring($length = 12) {
		$tegn = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$lengthstring = strlen($tegn);
		$Randomst= '';
		for ($i = 0; $i < $length; $i++) {
			$Randomst .=  $tegn[rand(0, $lengthstring - 1)];
		}
		return $Randomst;
	}
?>