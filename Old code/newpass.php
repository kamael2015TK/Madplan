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
			<div>
<?php
// tjekker om email er sat 
if(!isset($_REQUEST['key'])){echo "404 server not found";}
else{

	include 'coninclude.php';// connection 

	$key= urldecode($_REQUEST['key']);
	$token = $_GET['token'];
	$status = 1;
	
	if($test = mysqli_prepare($con, "SELECT * FROM `madplanbruger` WHERE `Email` = ? AND `Token` = ? AND `Status` = ?")){
	mysqli_stmt_bind_param($test,"ssi",$key,$token,$status);
	mysqli_stmt_execute($test);
	mysqli_stmt_store_result($test);
		if(mysqli_stmt_num_rows($test) != 0){
			?>
			<form method="Post" action="" name="change"  >	
				<div class="skivind">
					<table style="border: 5px solid black;"> 
								
						<tr> 
							<td> <input type="password" name="code1" placeholder="Password" class="verifyknap" /></td>
						</tr>

						<tr> 
							<td> <input type="password" name="code2" placeholder="Gentag pasword" class="verifyknap" /></td>
						</tr>
										
						<tr>
							<td><input type="submit"  value="Submit Pasword" class="verifyknap"></td>
						</tr>
					</table>			
				</div>
			</form>
			
			<?php
			
			
			
			
			
			if(isset($_REQUEST['code1']) && $_REQUEST['code2']){
				$pass=$_REQUEST['code1'];
				$pass2 = $_REQUEST['code2'];
				
				if($pass != $pass2){
					echo "din password matcher ikke";
				}
				else{
					echo "nice";
				}
			}
			
		}
		else{
			echo "Du har alerede skiftet din password for at gøre det igen skal du sende os anmodning igen, eller kontakt vores suport";
		}
		
	}
}
	
?>

