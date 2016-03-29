<?php 
session_start();
if(!$_SESSION['email']){
header("location:logininput.html");
}
// tjek om brugeren er logget ind 

include 'coninclude.php';

?>

	<head> 
		<title>	Madplan.dk </title> <! title på min tjemmeside>
		<link rel="icon" href="images.png" />	<! jeg linker et billede for at gøre det lidt pæner>
		<meta charset="utf-8"> <! includer danske tegn >
		<link rel="stylesheet" type="text/css" href="eksamencss.css"><! jeg inkluderer css document>	
			
		<script>
		function ajaxrequest(sendstring){
			// ajax funktion
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 || xmlhttp.status==200) {		
				return xmlhttp.responseText;
				}
			}
			xmlhttp.open("POST","opskreftserver.php",false);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(sendstring);
			return xmlhttp.onreadystatechange();
		}
		
		function sendDate(){
			//sender med ajax til php server request til at printe liste til næste x antal dage
			var antaldage = document.getElementById('antaldage').value;
			var type = document.getElementById('type').value;
// tjek om antal er et nummer 			
			if(isNaN(antaldage) || antaldage== ""){
				alert('Husk at skrive antal af dage');
				return false;
			}
// jeg vil kun lave madplan 30 dage frem
			if (antaldage > 30 || antaldage<1){
				alert('du kan kun oprette madplan 30 dage frem');
				return false;
			}
			else{
			
			var stringdate = "&antaldage="+antaldage+"&type="+type+"&mycase=D";// string der skal sendes
			Response = ajaxrequest(stringdate); // sender til ajax og får response 
			document.getElementById('vaelg').innerHTML = Response;		// sætter en div til at visse response
			return false;
			}
		}

		function makemadplan(){
			// bare en simpel test om antal personner er skrevet ind 
			var antaldage = document.getElementById('antaldage').value;
			for(i=0;i<antaldage; i++){
			var Antal = document.getElementById(i+"antal").value;
			// test om antal personer er  et nummer 	
				if(Antal == "" || isNaN(Antal)){
					alert("husk at skrive antal af personer med tal og hust ak udfylde alle fælter");
					return false;
				}
			}
		}

		function checkradio(myname,myvalue){
		// tjek om der er trukket favorit eller min opskrefter 
			if(myvalue == "min"){
				var changeto = "&mycase=I&myid="+myname;
			}
			else{
				var changeto ="&mycase=J&myid="+myname;
			}
			Response = ajaxrequest(changeto);
			document.getElementById(myname).innerHTML = Response;
		}
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
			<!side stuff> 
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
				<?php 
					$dag = date("l");// kalder dag frem 
					// oversætter dag
					switch ($dag) {
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
					$dag = "Fredag";
					break;
				case "Sunday":
					$dag = "Fredag";
					break;
				
				
					}
					
					
					echo "I dag er det " .$dag." den ". date("d.m.Y") . "<br>";
					echo "Du skal vælge hvor mage dage du vil lave madplan til ";
				
				?>
					<form onsubmit="return sendDate();">
						<input type = "Text" id="antaldage" class="madplanknapper" placeholder="Antal Dage"/>
						<select id="type" class="madplanknapper"> 
							<option> Aftensmad</option>
							<option> Frokkost</option>
							<option> Morgenmad</option>
						</select>
						<input type ="submit" value="Næste" class="madplanknapper"/>
					</form>	
					
				<div id="vaelg">
				
				</div>
				<div id="nue">
				
				
				</div>
				
				<div id="makaka">
				</div>
				</div>	
		
		</div>
