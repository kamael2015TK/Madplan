<?php 
session_start();
if(!$_SESSION['brugerID']){
header("location:madplan.php");}
// tjek om brugeren er logget ind
include 'coninclude.php';

$myemail= $_SESSION['brugerID']; // gemmer email fra en session 
$brugerid =	mysqli_fetch_array(mysqli_query($con,"SELECT ID FROM `madplanbruger` WHERE Email = '$myemail' "));// fetcher bruger id ud 
?>
<html> 

	<head> 
		<title>	Madplan.dk </title> <! title på min tjemmeside>
		<link rel="icon" href="images.png" />	<! jeg linker et billede for at gøre det lidt pæner>
		<meta charset="utf-8"> <! includer danske tegn >
		<link rel="stylesheet" type="text/css" href="eksamencss.css"><! jeg inkluderer css document>	
		<script>
			function printdiv(){			
			var morgenmad = document.getElementById('morgenmad').innerHTML;	
			var frokkost = document.getElementById('frokkost').innerHTML;	
			var aftensmad = document.getElementById('aftensmad').innerHTML;	
			var mywindow = window.open('', 'mainbody', 'height=600,width=800');
			mywindow.document.write('<html><head><title>Print</title></head><body> <div style="position: absolute;left:0px;"> ');
			mywindow.document.write(morgenmad);
			mywindow.document.write('</div><div style="position: absolute;left:200px;">');	
			mywindow.document.write(frokkost);	
			mywindow.document.write('</div><div style="position: absolute;left:400px;">');	
			mywindow.document.write(aftensmad);	
			mywindow.document.write('</div></body></html>');

			mywindow.print();
			mywindow.close();
			
			}
		// print af madplanen 
		
		</script>
	</head>
 
<body> 
	<div class="body">
		<! laver en div som skal være Logo til hjemmesiden>
		<a href="index.php" >		
			<div class="topLogo">		
					<div class="topSearch">		
						Madplanen.dk  dsdfs 	
					</div>			
			</div>
		</a>
		<div class="menueline">	
			<a href="logud.php">		<div class="knap">Logud				</div></a>
			<a href="opretenret.php"> 	<div class="knap">Opræt en Ret		</div></a>
			<a href="Serchret.php"> 	<div class="knap">Søg Ret			</div></a>
			<a href="indkoobsliste.php"><div class="knap">Indkøbsliste		</div></a>
			<a href="minmadplan.php"> 	<div class="knap">lav din madplan	</div></a>
			<a href="index.php">		<div class="knap">Hovedside 		</div></a>
		</div> 

			<! her vil jeg lave en div som så skal være kroppen for det hele der bliver vist>
			<div class="newbody">
				
				<div class="side">
					Top 10 Retter: </br>	
					<?php
					// top 10 opskrefter 
					$query = mysqli_query($con, "SELECT * FROM `opskreft` WHERE `Status` = 'Active' ORDER BY `Populaer` DESC");
					$opskreftarray = array();
					
					// gemmer navne 
					while($opskreft = mysqli_fetch_array($query)){
						array_push($opskreftarray,$opskreft);
					}
					// tæller hvor mange der er i dette array
					$antaltop =count($opskreftarray);
					// der skal kun vises 10
					if($antaltop > 10){
						$antaltop = 10;
					}
					// print af navne ud
					for($top = 0; $top < $antaltop; $top++){
						echo $opskreftarray[$top]['NavnO']."<br>";
						
					} 
					?>
					
				</div>
				
				<! hoved delen>	
				<div class="mainbody" id="mainbody">
				
				<input type="button" value="Udskriv madplan" onclick=" return printdiv();" class="ekstraknap">
					<div class="madplanprint" style="left: 0px;" id="morgenmad">  
						<?php
						// tjekker hvad dato det var igår 
							$dato = date("Y.m.d",strtotime(-1 ."days"));
							// querry til morgen mad der har dato fra igår (igår er ikke inkluderet) og frem 
							$morgenmadquery = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Bruger` ='$brugerid[0]' AND `type` = 'Morgenmad' AND `Dato` > '$dato'");
							 
							$morgenmad = array();
								
							while($morgenmadeks = mysqli_fetch_array($morgenmadquery )){
								array_push($morgenmad, $morgenmadeks);
							}	
							
							$morgenmadretantal = count($morgenmad);
							// tjekker om der er nogle madplan
							if($morgenmadretantal == 0){
								echo " du har ikke oprættet madplan til morgenmad";
							}
							else{
								echo "Morgen Mad Madplan </br>";
								for($printM = 0; $printM<$morgenmadretantal; $printM++){
									echo $morgenmad[$printM]['Dato']." ".$morgenmad[$printM]['Dag']."<br> ".$morgenmad[$printM]['Ret']."<br><hr> ";
								}
							}
						?>
						
						
					</div>
					
					<div class="madplanprint"style="left: 330px;" id="frokkost"> 
						<?php
							
							$frokkostquery = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Bruger` ='$brugerid[0]' AND `type` = 'Frokkost' AND `Dato` > '$dato'");
							 
							$frokost = array();
								
							while($frokostex = mysqli_fetch_array($frokkostquery)){
								array_push($frokost, $frokostex);
							}	
							
							$frokostretantal = count($frokost);
							
							if($frokostretantal == 0){
								echo " du har ikke oprættet madplan til Frokkost";
							}
							else{
								echo "Frokkost Madplan </br>";
								for($printF = 0; $printF<$frokostretantal; $printF++){
									echo $frokost[$printF]['Dato']." ".$frokost[$printF]['Dag']."<br> ".$frokost[$printF]['Ret']."<br><hr> ";
								}
							}
						?>
						
						
					</div>
					
					<div class="madplanprint"style="left: 660px;" id="aftensmad"> 
						<?php
							
							$aftensmadquery = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Bruger` ='$brugerid[0]' AND `type` = 'Aftensmad' AND `Dato` > '$dato'");
							 
							$aftensmad = array();
								
							while($aftensmadex = mysqli_fetch_array($aftensmadquery)){
								array_push($aftensmad, $aftensmadex);
							}	
							
							$aftensmadretantal = count($aftensmad);
							
							if($aftensmadretantal == 0){
								echo " du har ikke oprættet madplan til Aftensmad";
							}
							else{
								echo "Aftensmad Madplan </br>";
								for($printA = 0; $printA<$aftensmadretantal; $printA++){
									echo $aftensmad[$printA]['Dato']." ".$aftensmad[$printA]['Dag']."<br> ".$aftensmad[$printA]['Ret']."<br><hr> ";
								}
							}
						?>
						
						
					</div>

				</div>
			</div>
	<div>
</body>
</html> 
