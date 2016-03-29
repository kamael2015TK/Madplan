<?php 
// dette document er til den første side hvor man vill kunne nun læsse opskrift 
include 'coninclude.php';// connect til en db
$mycase =$_REQUEST['mycase']; // jeg skal vede hvad for en kode der skal bruges.


if($mycase== "E"){
// den første er til at søge efter nogle bestemte retter
	$opskrefter= array(); // tom array til at gemmen retterne i
	$get=mysqli_query($con,"SELECT NavnO FROM opskreft WHERE Status = 'Active' ORDER BY NavnO ASC"); // laver en query som skal udskrive opskrefter 
	
	if(mysqli_num_rows($get) == 0){
		echo "Der er ikke oprettet nogle opskrefter på denne hjemmeside";
	}
	// her tjekker jeg om der er nogle opskrefter i db
	else{
		while($opskreft= mysqli_fetch_array($get)){
			array_push($opskrefter,$opskreft); // jeg gemmer det hele jeg finder i min array
		}
		
		$antal= count($opskrefter); // antal af opskrefter gemt
		if($antal>10){
			$antal=10; // jeg vil kun vise 10 opskrefter pr side så derfor sørger for at der kan maks være 10
		}
		
		$mystring= $_REQUEST['search']; //med Ajax sender jeg en variabel der heder search som jeg brugerne skriver i indput felt
		$lowermystring = strtolower($mystring);  // laver string til små bokstaver for at får bedre søgning
		$lowermystring = trim($lowermystring); // fjerner mellemrum(start slut, dog ikke imellem teksten)
		if($lowermystring == ""){
			// det er en if statment som kun vil virke når brugeren slettede alt fra søg feltet
			for($i=0; $i< $antal; $i++){
	?>			<div id="<?php echo $i."d";?>">
					<input type="button" id="<?php echo $i; ?>" value="<?php echo$opskrefter[$i]['NavnO'];?>" onclick="return showopskreft(id);" class="opskreftknap">
					<br>
				</div>
	<?php		
			}
		
		}
		
		else{

			$matchopskrefter = array(); // laver en tom array hvor jeg vil gemme navne der matcher
			for($i=0; $i<$antal; $i++){ // kører igennem alle opskrefter fra min db
				$loveropskrefter = strtolower($opskrefter[$i]['NavnO']); // laver string til små bokstaver for at får bedre søgning
				if(substr_count($loveropskrefter,$lowermystring) != 0){
					array_push($matchopskrefter, $opskrefter[$i]['NavnO']); 
					// hvis min navnstring indeholder søge string så gemmer det navn i min array(matchopskrefter)
				}
			}
			
			$newantal=count($matchopskrefter); // antal af opskrefter der matcher
			if($newantal>10){
				$newantal=10;
			}
			
			if($newantal==0){
				echo " der er ikke nogle opskrefter med det navn";
			}
			else{
				for($a=0; $a < $newantal; $a++){ // udskriver 10 opskrefter der matcher søgning
				?>	
					<div id="<?php echo $a."d";?>">
						<input type="button" id="<?php echo $a; ?>" value="<?php echo $matchopskrefter[$a];?>" onclick="return showopskreft(id);" class="opskreftknap">
						<br>
					</div>
				<?php		
				}
			}
		}
	}
}

if($mycase== "F"){ // dette er kode der bliver aktiveret når en bruger kliker på vis opskreft
	$navnO = htmlentities($_REQUEST['navnO']);
	$navnO = mysqli_real_escape_string($con, $navnO);
	
	$myid= $_REQUEST['myid']; 
	//definer variabler sendt med Ajax
	$get=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM opskreft WHERE Status = 'Active' AND NavnO='$navnO'")); 
	// får alle informationer om en opskreft brugeren har klikket på
	$retID = $get['ID']; // pga min db relationer så skal jeg kende IDen af en ret brugeren er intereseret i
	
	$allingra= array(); // tom array til gemme ingradienserne
	$getingra = mysqli_query($con,"SELECT * FROM `ingrad` WHERE RetID = '$retID'");
	
	while($getallingra= mysqli_fetch_array($getingra)){
		array_push($allingra, $getallingra);
	}
	$antal=count($allingra);
	// jeg udskriver det opskreft som brugeren trykket på
	?>
	<div class="divborder">
	RetNavn: <input type = "button" value="<?php echo $get['NavnO'];?>" id="<?php echo $myid; ?>" onclick="return hideret(id);" class="opskreftknap"/><br>
	Ingradienser:<br> <?php 
	for($i=0;$i<$antal; $i++){
		echo $allingra[$i]['Maengte']." ".$allingra[$i]['Enhed']." ".$allingra[$i]['Navn']."<br>";
	}
	?>
	<br>
	Tilberedning: <?php echo "<br>".$get['opskreft'];
?> <br> <br></div><?php
}

if($mycase == "G"){ // dette kode kan kun blive aktiveret hvis brugeren trykker på opskrefteren når den er vist og ersterter opskreftern med en knap
	$navnO = htmlentities($_REQUEST['navnO']);
	$navnO = mysqli_real_escape_string($con, $navnO);
	
	$myid= $_REQUEST['myid'];
	$get=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM opskreft WHERE Status = 'Active' AND NavnO='$navnO'"));
	?>	
	<input type = "button" value="<?php echo $get['NavnO'];?>" id="<?php echo $myid;?>" onclick="return showopskreft(id);" class="opskreftknap"><br>
	<?php
}

