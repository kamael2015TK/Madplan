<?php
// side 1 Madplan.php
include 'coninclude.php';

// inkluderer connection til db
?>
<html> 
	<head> 
		<title>	Madplan.dk </title> <! title på min tjemmeside>
		<link rel="icon" href="images.png" />	<! jeg linker et billede for at gøre det lidt pæner>
		<meta charset="utf-8"> <! includer danske tegn >
		<link rel="stylesheet" type="text/css" href="eksamencss.css"><! jeg inkluderer css document>	
		<script src="madplanjava.js"></script>		
	</head>
 
	<body>


			
			<! laver en div som skal være min menue>	
			<div id="menueline">				
					<input type="button" onclick="logindfelt()" value="log ind" class="knap" />
					<input type="button" onclick="window.location='madplan.php'" value="Hovedside" class="knap" />
					<input type="button" onclick="omos()" value="Om os" class="knap" />
			</div> 
			
			<! laver en div som skal være Logo til hjemmesiden og en søge felt hvor man vil kunne finde en opskreft man kan lide>
			<div class="topLogo">	
				<a href="madplan.php" >
					<div class="topSearch">		
						Madplanen.dk   	
					</div>
				</a>
				
				<div class="topSearch">
					<input type="text" onkeyup="return search();" id="searchret" class="indputfelt" placeholder="Søg efter en opskrift">
					<! input felt til at søge>
				</div>
				
				<a href="madplan.php" >
					<div class="topSearch">		
						Madplanen.dk   	
					</div>
				</a>
			</div>
			
			
			<! her vil jeg lave en div som så skal være kroppen for det hele der bliver vist>
			<div class="newbody">
			
				<! her skal der være top 10 opskrifter(hvis jeg når at lave det)> 
				<div class="side">
					Top 10 Retter: </br>	
							<?php
							// top 10 opskrefter 
							$query = mysqli_query($con, "SELECT * FROM `opskreft` WHERE `Status` = 'Active' ORDER BY `Populaer` DESC");
							// laver query og får top 10 opskrefter sorterer efter største til minste
							$opskreftarray = array(); // tom array
							
							while($opskreft = mysqli_fetch_array($query)){
								array_push($opskreftarray,$opskreft); // samler data i en tom array 
							}
							
							$antaltop =count($opskreftarray); // tæller hvor mane der er 
						
							if($antaltop > 10){
								$antaltop = 10;
							}
							// sører for at der kun 10 opskrefter der bliver vist 
							for($top = 0; $top < $antaltop; $top++){
								echo $opskreftarray[$top]['NavnO']."<br>";
								//for lykke til at udskrive top 10 opskrefter 
							} 
							?>
				</div>
				
				<! hoved delen>	
				<div class="mainbody" id= "mainbody">
					
					<?php
					// jeg vil vise opskrefter til brugerne 
						$opskrefter= array();
						$get=mysqli_query($con,"SELECT NavnO FROM opskreft WHERE Status = 'Active' ORDER BY NavnO ASC"); 
							
						while($opskreft= mysqli_fetch_array($get)){
							array_push($opskrefter,$opskreft);
						}
						$antal = count($opskrefter);
						if($antal>10){
							$antal=10;
						}	// jeg vil kun vise 10 opskrefter maks
						for($i=0; $i< $antal; $i++){ ?>
						
						<div id="<?php echo$i."d";?>">
							<input type="button" id="<?php echo$i;?>" value="<?php echo $opskrefter[$i]['NavnO'];?>" onclick="return showopskreft(id);" class="opskreftknap"><br>
						</div>
						<?php		
						}
					?>	
				</div>
			</div>
	</body>
</html> 