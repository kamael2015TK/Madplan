<?php 
include 'coninclude.php'; // inkluderer connection til db

$Uname = $_POST['emailf'];
$token = randomstring();
$status = 1;
if ($getEmail = mysqli_prepare($con, "SELECT `Email` FROM `madplanbruger` WHERE `Email` = ? OR `UserName` = ? AND Status = ?")) {    
	mysqli_stmt_bind_param($getEmail, "ssi", $Uname,$Uname,$status);
    mysqli_stmt_execute($getEmail);		
	mysqli_stmt_store_result($getEmail);
	mysqli_stmt_bind_result($getEmail,$dbemail);
	mysqli_stmt_fetch($getEmail);
	
	if(mysqli_stmt_num_rows($getEmail) != 0){
		
		$subject = "Ny Password";	
		$txt = "Du skal ";
		$txt .="<a href='http://localhost.eksammen/newpassword.php?&key=$dbemail&token=$token'>klikke her </a> for at kunne nulstille din password <meta charset='utf-8'>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$sentmail = mail($dbemail,$subject,$txt, $headers);
	}
	mysqli_query($con, "UPDATE `madplanbruger` SET `Token`= '$token' WHERE Email = '$dbemail' ");
	mysqli_stmt_close($getEmail);
}
header("location:madplan.php");