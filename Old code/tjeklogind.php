<?php
include "coninclude.php"; // connection til DB 
session_start();

$username=$_POST['uname'];
$Pass=$_POST['Password'];
$status = 1;
// xss sikring


if ($test = mysqli_prepare($con, "SELECT Password, ID FROM `madplanbruger` WHERE `UserName` = ? OR `Email` = ? AND `Status` = ?")) {    
	mysqli_stmt_bind_param($test, "ssi", $username, $username, $status);
    mysqli_stmt_execute($test);		
	mysqli_stmt_store_result($test);
	mysqli_stmt_bind_result($test,$dbPass,$dbID);
	mysqli_stmt_fetch($test);
	// mysqli_prepare gøre det umulight at lave sql ingektions
	
	if(mysqli_stmt_num_rows($test) != 0){	
	// test om password er rigtig 
		if (password_verify($Pass,$dbPass)) { 
			if($dbID == 1){				
				$_SESSION['adminID'] = $dbID;
				header("location:admin.php");
				// hvis id er lige med 1 så ved jeg at det er administrator der er logget ind 
			}
			else{
			//ellers så er det en almenelig bruger 
			
				$_SESSION['brugerID'] = $dbID;
				header("location:index.php");
			}
		}
		
		else{
			header("location:madplan.php");
			// hvis password er forkedt 			
		}
		mysqli_stmt_close($test);	
	}
	else{
		header("location:madplan.php");
		// hvis user name er forkedt 
	}
}