<?php 
session_start();
if(!$_SESSION['email']){
header("location:logininput.html");
}
// tjek om brugeren er logget ind 
$myemail= $_SESSION['email'];
include 'coninclude.php';
?>

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
				mywindow.document.write('</div><div style="position: absolute;left:250px;">');	
				mywindow.document.write(frokkost);	
				mywindow.document.write('</div><div style="position: absolute;left:500px;">');	
				mywindow.document.write(aftensmad);	
				mywindow.document.write('</div></body></html>');

				mywindow.print();
				mywindow.close();
				}
				// udskriver indkøbsliste
		</script>
	</head>
 
<body> 
	<div class="body">
		<! laver en div som skal være Logo til hjemmesiden>
		<a href="index.php" >		
			<div class="topLogo">		
					<div class="topSearch">		
						Madplanen.dk   	
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
		
		<div class="newbody">	
			<div class="side">
				Top 10 Retter: </br>	
				<?php
				// top 10 opskrefter 
				$query = mysqli_query($con, "SELECT * FROM `opskreft` WHERE `Status` = 'Active' ORDER BY `Populaer` DESC");
				$opskreftarray = array();
				
				while($opskreft = mysqli_fetch_array($query)){
					array_push($opskreftarray,$opskreft);
				}
					
				$antaltop =count($opskreftarray);
				
				if($antaltop > 10){
					$antaltop = 10;
				}
				
				for($top = 0; $top < $antaltop; $top++){
					echo $opskreftarray[$top]['NavnO']."<br>";
					
				} 
				?>
			</div>
			
			<! hoved delen>	
			<div class="mainbody">
			
				<input type="button" onclick="printdiv();" value="print liste" class="ekstraknap">
				<div class="madplanprint" style="left: 0px;" id="morgenmad">  
				Morganmad
					<?php 
					$startdag =	date("Y.m.d",strtotime(-1 ."days"));
					$brugerid =	mysqli_fetch_array(mysqli_query($con,"SELECT ID FROM `madplanbruger` WHERE Email = '$myemail' "));
					
					$morgenmadquery = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Bruger` ='$brugerid[0]' AND `type` = 'Morgenmad' AND `Dato` > '$startdag'");
					$morgenmad = array();
									
					while($morgenmadeks = mysqli_fetch_array($morgenmadquery )){
						array_push($morgenmad, $morgenmadeks);
					}	
					$morgenmadretantal = count($morgenmad);
					
					if($morgenmadretantal == 0){
						echo " du har ikke oprættet madplan til morgenmad<br>så du har ikke en indkøbs liste";
					}
					else{
						for($printM = 0; $printM<$morgenmadretantal; $printM++){
							$retMorgenmad = $morgenmad[$printM]['Ret'];
							$retIDMA = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `opskreft` WHERE `NavnO` ='$retMorgenmad'"));
							$antalPersonerM = $morgenmad[$printM]['AntalP'];
							$retIDM=$retIDMA['ID'];
							$retIDMP=$retIDMA['AntalP'];
							
							$ingradquery = mysqli_query($con, "SELECT * FROM `ingrad` WHERE `RetID` = '$retIDM' ");
							$ingradM = array();
							
							while($ingradMex = mysqli_fetch_array($ingradquery)){
									array_push($ingradM,$ingradMex);
							}
							
							$antalingradM = count($ingradM);
							echo "<br>".$morgenmad[$printM]['Dag']." ".$morgenmad[$printM]['Dato']." <br>";
							for($M = 0; $M < $antalingradM;  $M++){
								$maengteM = $ingradM[$M]['Maengte'];
								$nyeMaengteM =$maengteM/$retIDMP*$antalPersonerM;
								
								echo $nyeMaengteM." ".$ingradM[$M]['Enhed']." ".$ingradM[$M]['Navn']." <br><hr>";
							}
						}
					}
					?>
				</div>
				
				<div class="madplanprint"style="left: 330px;" id="frokkost"> 
					Frokkost
					<?php 
					
					$frokkostquery = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Bruger` ='$brugerid[0]' AND `type` = 'Frokkost' AND `Dato` > '$startdag'");
					$frokkost= array();
									
					while($frokkosteks = mysqli_fetch_array($frokkostquery)){
						array_push($frokkost, $frokkosteks );
					}	
					$frokkostretantal = count($frokkost);
					
					if($frokkostretantal == 0){
						echo " du har ikke oprættet madplan til morgenmad<br>så du har ikke en indkøbs liste";
					}
					else{
						for($printF = 0; $printF<$frokkostretantal; $printF++){
							$retFrokkost= $frokkost[$printF]['Ret'];
							$retIDFA = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `opskreft` WHERE `NavnO` ='$retFrokkost'"));
							$antalPersonerF = $frokkost[$printF]['AntalP'];
							$retIDF=$retIDFA['ID'];
							$retIDFP=$retIDFA['AntalP'];
							
							$ingradqueryF = mysqli_query($con, "SELECT * FROM `ingrad` WHERE `RetID` = '$retIDF' ");
							$ingradF = array();
							
							while($ingradFex = mysqli_fetch_array($ingradqueryF)){
									array_push($ingradF,$ingradFex);
							}
							
							$antalingradF = count($ingradF);
							echo "<br>".$frokkost[$printF]['Dag']." ".$frokkost[$printF]['Dato']." <br>";
							for($F = 0; $F < $antalingradF;  $F++){
								$maengteF = $ingradF[$F]['Maengte'];
								$nyeMaengteF =$maengteF/$retIDFP*$antalPersonerF;
								
								echo $nyeMaengteF." ".$ingradF[$F]['Enhed']." ".$ingradF[$F]['Navn']." <br><hr>";
							}
						}
					}
					?>
				</div>
				
				<div class="madplanprint"style="left: 660px;" id="aftensmad">
					Aftensmad
					<?php 
					
					$aftensmadquery = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Bruger` ='$brugerid[0]' AND `type` = 'Aftensmad' AND `Dato` > '$startdag'");
					$aftensmad = array();
					
					while($aftensmadeks = mysqli_fetch_array($aftensmadquery)){
						array_push($aftensmad, $aftensmadeks);
					}	
					$aftensmadretantal = count($aftensmad);
					
					if($aftensmadretantal == 0){
						echo " du har ikke oprættet madplan til Aftensmad <br>så du har ikke en indkøbs liste";
					}
					else{
						for($printA = 0; $printA<$aftensmadretantal; $printA++){
							$retAftensmad = $aftensmad[$printA]['Ret'];
							$retIDAA = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `opskreft` WHERE `NavnO` ='$retAftensmad '"));
							$antalPersonerA = $aftensmad[$printA]['AntalP'];
							$retIDA=$retIDAA['ID'];
							$retIDAP=$retIDAA['AntalP'];
							
							$ingradqueryA = mysqli_query($con, "SELECT * FROM `ingrad` WHERE `RetID` = '$retIDA' ");
							$ingradA = array();
							
							while($ingradAex = mysqli_fetch_array($ingradqueryA)){
									array_push($ingradA,$ingradAex);
							}
							
							$antalingradA = count($ingradA);
							echo "<br>".$aftensmad[$printA]['Dag']." ".$aftensmad[$printA]['Dato']." <br>";
							for($A = 0; $A < $antalingradA;  $A++){
								$maengteA = $ingradA[$A]['Maengte'];
								$nyeMaengteA =$maengteA/$retIDAP*$antalPersonerA;
								
								echo $nyeMaengteA." ".$ingradA[$A]['Enhed']." ".$ingradA[$A]['Navn']." <br><hr>";
							}
						}
					}
					?>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>			