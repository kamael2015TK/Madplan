<html> 
	<head> 
		<title>	Madplan.dk </title> <! title på min tjemmeside>
		<link rel="icon" href="images.png" />	<! jeg linker et billede for at gøre det lidt pæner>
		<meta charset="utf-8"> <! includer danske tegn >
		<link rel="stylesheet" type="text/css" href="eksamencss.css"><! jeg inkluderer css document>	
		<script src="madplanjava.js"></script>		
	</head>
 
	<body>

		<div class="body"> 
			
			<! laver en div som skal være min menue>	
			<div class="menueline">				
					<input type="button" onclick="logindfelt()" value="log ind" class="knap" />
					<input type="button" onclick="window.location='madplan.php'" value="Hovedside" class="knap" />
					<input type="button" onclick="omos()" value="Om os" class="knap" />
			</div> 

<?php 
if(!isset($_REQUEST['key'])){
	echo "404 Error the server is dead";
}
// tjek om variabel key er sat

else{
	include 'coninclude.php';
	// gemmer variabeler
	$key = urldecode($_REQUEST['key']);
	$token =urldecode($_REQUEST['token']);
	$status = 1;
	
	if($Activate=mysqli_prepare($con, "UPDATE `madplanbruger` SET `Status`=? WHERE `Email` = ? AND `Token` = ? ")) {    
		mysqli_stmt_bind_param($Activate, "iss" ,$status,$key,$token);
		mysqli_stmt_execute($Activate);
		mysqli_stmt_close($Activate);
		echo "din account er aktiv";
	}
	else{
		echo "der er sket en fejl kontak venlist vores support";
	}
}
?>
		</div>
	</body>