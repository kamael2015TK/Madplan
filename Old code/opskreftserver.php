<?php 
session_start();
if(!$_SESSION['email']){
header("location:logininput.html");
}
// her sikrer jeg mig at den der kommer ind på denn side har en bruger med en aktivt session 
include 'coninclude.php';
$mycase =$_REQUEST['mycase']; // jeg skal vede hvor skal jeg hen i kode så jeg sender en string som vil virker ligesom en nøgle til koden
$myemail= $_SESSION['email']; // finder brugeren 
$brugerid =	mysqli_fetch_array(mysqli_query($con,"SELECT ID FROM `madplanbruger` WHERE Email = '$myemail' ")); // bruger id


if($mycase=="A"){
	// kode til at oprette en ret. 
	$Date= date("Y.m.d");
	
	$antalpersoner = htmlentities($_REQUEST['antalpersoner']);
	$antalpersoner = mysqli_real_escape_string($con,$antalpersoner);

	$retnavn=htmlentities($_REQUEST['retnavn']);
	$retnavn=mysqli_real_escape_string($con,$retnavn);
	mysqli_query($con, "DELETE FROM `opskreft` WHERE `ForfO` = '$myemail' AND `Status`= 'Not Aktive'"); // jeg sletter alle opskrefter som ikke er aktive af denne bruger:
	
	if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM `opskreft` WHERE `NavnO` = '$retnavn'"))==0){
		
		mysqli_query($con,"INSERT INTO `opskreft`(`ID`, `NavnO`, `Status`, `opskreft`, `ForfO`, `Populaer`,`AntalP`, `Dato` ) 
						VALUES ('0','$retnavn','Not Aktive','','$myemail','0','$antalpersoner','$Date')");
		// indsætter de informationer som jeg skal bruge i min db				

	$query1=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `opskreft` WHERE `NavnO` = '$retnavn'")); // jeg vil gerne vise hvad brugeren laver
	echo "Ret Navn: ".$query1['NavnO']; // jeg udskriver retnavn
	?><input type="text" value="ya" id="testnavn" hidden><?php
	}
	else{
		?><input type="text" value="nope" id="testnavn" hidden><?php
		echo "der findes en opskrift med det samme navn <br> vælg et et navn som beskriver dit ret";
	}
}

if($mycase=="B"){ 
$retnavn=htmlentities($_REQUEST['retnavn']);
$retnavn=mysqli_real_escape_string($con,$retnavn);	

$ingnavn=htmlentities($_POST['ingnavn']);
$ingnavn=mysqli_real_escape_string($con,$ingnavn);

$ingenhed=htmlentities($_POST['enhed']);
$ingenhed=mysqli_real_escape_string($con,$ingenhed);

$ingmeangte=htmlentities($_POST['meangte']);
$ingmeangte=mysqli_real_escape_string($con,$ingmeangte);

// jeg samler vaiabler som jeg sender

$newquery=mysqli_query($con, "SELECT ID FROM opskreft WHERE NavnO = '$retnavn'");

	if(mysqli_num_rows($newquery)==0){
		echo "navn matcher ikke"; //tjekker om man ike sprunget en trin over
	}
	else{
	$retid=mysqli_fetch_array($newquery);
	$retid=$retid[0];

	$sqltjek=mysqli_query($con, "SELECT * FROM ingrad WHERE RetID = '$retid' AND Navn= '$ingnavn'");
	
		if(mysqli_num_rows($sqltjek)!=0 ){

		}
		else{
			mysqli_query($con, "INSERT INTO `ingrad`(`IngID`, `RetID`, `Maengte`, `Enhed`, `Navn`) 
			VALUES (0,'$retid','$ingmeangte','$ingenhed','$ingnavn')");
		}
		// udskriver alt det som brugeren skal se
	?>	
	
	
	<table class="table">
			<tr> <td colspan="3"> Ingradienser:</td></tr>
			<tr style="height: 20px;"></tr>
			<tr>
				<td> mængte </td>
				<td> enhed  </td>
				<td> navn  </td>
			</tr>
			<?php
		$sql=mysqli_query($con, "SELECT * FROM ingrad WHERE RetID = '$retid'");
			while($liste = mysqli_fetch_array($sql)){
		?> 	<tr> 
				<td> <?php echo $liste['Maengte'];?></td>
				<td> <?php echo $liste['Enhed'];?></td>
				<td style="max-width: 150px; overflow: initial;"> <?php echo $liste['Navn'];?></td>
					
			</tr>
				
			<?php
				
			}
			?></table><?php
	}
	
}

if($mycase=="C"){
	$retnavn=$_REQUEST['retnavn'];

	$retnavn=htmlentities($retnavn);
	$retnavn=mysqli_real_escape_string($con,$retnavn);
	
	$email= $_SESSION['email'];
	if(isset($_POST['text'])){
	$text=htmlentities($_POST['text']);
	$text=mysqli_real_escape_string($con,$text);

	$sqlops=mysqli_query($con,"UPDATE `opskreft` SET opskreft='$text',Status = 'Active'  WHERE NavnO = '$retnavn'");
	// indætter tilberedning ind i db
	
	$ops = mysqli_fetch_array(mysqli_query($con,"SELECT opskreft FROM opskreft WHERE NavnO = '$retnavn'"));
	echo $ops['opskreft'];
	}
}

if($mycase=="D"){
$type = $_REQUEST['type'];	
$type =htmlentities($type);
$type= mysqli_real_escape_string($con, $type); 
// dette del af koden bliver aktiveret når man skal lave mad plan. 
	$opskrefter = array(); // tom array til navne
	$get=mysqli_query($con,"SELECT NavnO FROM opskreft WHERE Status = 'Active' AND forfO = '$myemail'"); // skal ekstrekter navne fra db

	while($opskreft = mysqli_fetch_array($get)){
		array_push($opskrefter,$opskreft); // ekstrekter navne + gemmer dem  i en array. 
	}
	$antal = count($opskrefter); // antal opskrefter
	
	// tjek om der allerede findes en opskreft 
	for($a=0; $a<30; $a++){ 
		$startdag = date("Y.m.d",strtotime($a."days")); 
		$tjekdag = mysqli_query($con, "SELECT * FROM `madplan` WHERE `Bruger` = '$brugerid[0]' AND `Dato`= '$startdag' AND type = '$type'");
			if(mysqli_num_rows($tjekdag) == 0){	
			break;
			}
	}
	if($a>0){
	echo "du har mal plan til næste ".$a." dage så derfor vil malplan starte fra ".date("Y.m.d",strtotime($a."days"));
	$day = date("l",strtotime($a."days"));
	}
	else{ 
	$day = date("l");
	}
	
	$antaldage =htmlentities($_POST['antaldage']);
	$antaldage=mysqli_real_escape_string($con,$antaldage);
	

	
		switch ($day) {
    case "Monday":
        $dag = "Mandag";
        break;
	case "Tuesday":
        $dag = "Tirsdag";
        break;
	case "Wednesday":
        $dag = "Onsdag";
        break;
	case "Thursday":
        $dag = "Torsdag";
        break;	
	case "Friday":
        $dag = "Fredag";
        break;
    case "Saturday":
        $dag = "Lørdag";
        break;
	case "Sunday":
        $dag = "Søndag";
        break; 
		}
	$dayarray = array("Mandag","Tirsdag","Onsdag","Torsdag", "Fredag","Lørdag", "Søndag");
	$daynumber = array_search($dag, $dayarray);
?>
		<form onsubmit="return makemadplan();" method= "POST" action="opretmadplan.php">
		<input type ="text" hidden  name="antaldage" value="<?php echo $antaldage;?>">
		<input type ="text" hidden  name="type" value="<?php echo $type;?>">
			<table class="table">
			<tr>
				<td> Dag</td>
				<td> Dato</td>
				<td> <?php echo $type; ?></td>
			</tr>
<?php
	for ($i=0; $i<$antaldage; $i++){
		if($daynumber>6){
			$daynumber = 0;
		}
		$nyei= $i+$a;
	$d=strtotime($nyei."days");
?>			<tr>
				<td> <input type="text" name="<?php echo $i."dag";?>" 	value="<?php echo $dayarray[$daynumber]; 	?>" id="<?php echo $i."dag";?>" hidden 	/><?php echo $dayarray[$daynumber]; 	?></td>
				<td> <input type="text" name="<?php echo $i."dato";?>" 	value="<?php echo date("Y-m-d", $d);		?>" id="<?php echo $i."dato";?>" hidden /><?php echo date("Y-m-d", $d);			?></td>
				<td>
					<div id="<?php echo $i?>">
						<select id="<?php echo $i."mm";?>" name="<?php echo $i."mm";?>" class="madplanknapper" style="width:200px;"><?php
					
							for($ito = 0; $ito < $antal; $ito++){?>
								<option><?php
									echo $opskrefter[$ito]['NavnO'];?>
								</option><?php
							}?>
						</select>					
						<input type= "text" id="<?php echo $i."antal"; ?>" placeholder="Antal Personer" name="<?php echo $i."antal";?>" class="madplanknapper"></br>
					</div>
					
						<input type="radio" name="<?php echo $i;?>" value="min" checked onchange="checkradio(name,value);">Min Retter</input>
						<input type="radio" name="<?php echo $i;?>" value="favorit" onchange="checkradio(name,value);">favoritter </input>
				
				</td>
			</tr>
<?php		
	$daynumber++;	
	
	}
	?>		<tr> 
				<td></td>
				<td></td>
				<td><input type = "submit" value = " Opræt Madplan" class="madplanknapper" style="width: 200px;"> </td>
			</tr>
		</table>
	</form><?php
}

// koden for søg opskreft// 
if($mycase== "E"){
	$opskrefter= array();
	$get=mysqli_query($con,"SELECT NavnO FROM opskreft WHERE Status = 'Active'");
	
	while($opskreft= mysqli_fetch_array($get)){
		array_push($opskrefter,$opskreft);
	}
	$antal= count($opskrefter);
	
	
	$mystring= $_REQUEST['search'];
	$lowermystring = strtolower($mystring); 
	$lowermystring = trim($lowermystring);
	if($lowermystring == ""){
			for($i=0; $i< $antal; $i++){
?>	<div id="<?php echo $i."d";?>">
	<input type="button" id="<?php echo $i; ?>" value="<?php echo$opskrefter[$i]['NavnO'];?>" onclick="return showopskreft(id);" class="opskreftknap">
	<br>
	</div>
<?php		
	}
	
	}
	else{

	$matchopskrefter = array();
	for($i=0; $i<$antal; $i++){
		$loveropskrefter = strtolower($opskrefter[$i]['NavnO']);
		if(substr_count($loveropskrefter,$lowermystring) != 0){
			array_push($matchopskrefter, $opskrefter[$i]['NavnO']);
		}
	}
	$newantal=count($matchopskrefter);
	if($newantal==0){}
	else{
		for($a=0; $a < $newantal; $a++){
?>	<div id="<?php echo $a."d";?>">
	<input type="button" id="<?php echo $a; ?>" value="<?php echo $matchopskrefter[$a];?>" onclick="return showopskreft(id);" class="opskreftknap">
	<br>
	</div>
<?php		
	}
	}
	}
	
}


// kode til vis ingradienser//
if($mycase== "F"){
	$navnO = $_REQUEST['navnO'];
	$navnO = htmlentities($navnO);
	$navnO = mysqli_real_escape_string($con,$navnO);
	$myid= $_REQUEST['myid'];
	$get=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM opskreft WHERE Status = 'Active' AND NavnO='$navnO'"));
	$retID = $get['ID'];
	$allingra= array();
	$getingra = mysqli_query($con,"SELECT * FROM `ingrad` WHERE RetID = '$retID'");
	
	while($getallingra= mysqli_fetch_array($getingra)){
		array_push($allingra, $getallingra);
	}
	$antal=count($allingra);
	?>
	<div class="divborder">
	RetNavn: <input type = "button" value="<?php echo $get['NavnO'];?>" id="<?php echo $myid; ?>" onclick="return hideret(id);" class="opskreftknap">
	Ingradienser: <?php 
	for($i=0;$i<$antal; $i++){
		echo $allingra[$i]['Maengte']." ".$allingra[$i]['Enhed']." ".$allingra[$i]['Navn']."<br>";
	}
	?>
	tilberedning: <?php echo "<br>".$get['opskreft'];
	?>
	<br>
	<input type="button" value="Tilføj til favoriter" id="<?php echo $get['NavnO'];?>" onclick="return addtofav(id);" class="ekstraknap">
	</div>
	<?php 
}

if($mycase == "G"){
	$navnO = $_REQUEST['navnO'];
	$navnO = htmlentities($navnO);
	$navnO = mysqli_real_escape_string($con,$navnO);
	$myid= $_REQUEST['myid'];
	$get=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM opskreft WHERE Status = 'Active' AND NavnO='$navnO'"));
	?>	
	<input type = "button" value="<?php echo $get['NavnO'];?>" id="<?php echo $myid;?>" onclick="return showopskreft(id);" class="opskreftknap"><br>
	<?php
}

//kode som skal tilfører favoriter
if($mycase == "H"){
	$myret = htmlentities($_REQUEST['myid']);
	$myret = mysqli_real_escape_string($con,$myret);

	$retid = mysqli_fetch_array(mysqli_query($con,"SELECT ID FROM opskreft WHERE Status = 'Active' AND NavnO='$myret'"));
	$brugerid =	mysqli_fetch_array(mysqli_query($con,"SELECT ID FROM `madplanbruger` WHERE Email = '$myemail' "));

	$sqltest = mysqli_query($con, "SELECT * FROM `favoriter` WHERE `retID`= '$retid[0]' AND `brugerID`= '$brugerid[0]'");
	$tjek = mysqli_num_rows($sqltest);


	if($tjek != 0){
	echo "no go mate du har allerede tilførede dette ret til favoriter";
	}
	else{
	mysqli_query($con, "INSERT INTO `favoriter`(`fID`, `retID`, `brugerID`) VALUES (0,'$retid[0]','$brugerid[0]')");
	
	echo "ret er tilføret til favoriter";
	}
	
}



if($mycase == "I"){	
// kode som skifter til min retter
	$myid= $_REQUEST['myid'];
	$opskrefter= array();
	$get=mysqli_query($con,"SELECT NavnO FROM opskreft WHERE Status = 'Active' AND forfO = '$myemail'");
	
	while($opskreft= mysqli_fetch_array($get)){
		array_push($opskrefter,$opskreft);
	}
	$antal = count($opskrefter);
	if($antal == 0){
		echo "du har ikke lavet nogle ratter";
	}
	else{
	?>
					<select class="madplanknapper" style="width:200px;" name="<?php echo $myid."mm";?>" ><?php
					
						for($ito = 0; $ito < $antal; $ito++){?>
							<option><?php
								echo $opskrefter[$ito]['NavnO'];?>
							</option><?php
						}?>
					</select>
					<input type= "text" id="<?php echo $myid."antal"; ?>" placeholder="Antal Personer" name="<?php echo $myid."antal";?>" class="madplanknapper"></br>
	<?php
	}
}

if($mycase == "J"){
// kode som skifter til favorit retter
	$myid= $_REQUEST['myid'];
	$brugerid =	mysqli_fetch_array(mysqli_query($con,"SELECT ID FROM `madplanbruger` WHERE Email = '$myemail' "));	
	$getfavoritquery = mysqli_query($con, "SELECT `retID` FROM `favoriter` WHERE `brugerID` = '$brugerid[0]'");
	
	$favoritretid= array();
	while($getfavorit = mysqli_fetch_array($getfavoritquery)){
	array_push($favoritretid,$getfavorit);
	}
	
	$antalfavoriter=count($favoritretid);
	if($antalfavoriter == 0){
	echo "du har ikke nogle favoriter";
	}
	else{
		
	$favliste=array();
	for($i=0;$i<$antalfavoriter;$i++){
	
	$newfavret=$favoritretid[$i]['retID'];
	$favret = mysqli_fetch_array(mysqli_query($con,"SELECT NavnO FROM opskreft WHERE Status = 'Active' AND ID ='$newfavret'"));
		array_push($favliste,$favret);
	}

	?>
		<select class="madplanknapper" style="width:200px;" name="<?php echo $myid."mm";?>" ><?php
		
			for($ito = 0; $ito < $antalfavoriter; $ito++){?>
				<option><?php
					echo $favliste[$ito]['NavnO'];?>
				</option><?php
			}?>
		</select>
		<input type= "text" id="<?php echo $myid."antal"; ?>" placeholder="Antal Personer" name="<?php echo $myid."antal";?>" class="madplanknapper"></br>
	<?php
	
	
	}
}
