<?php 
session_start();
if(!$_SESSION['email']){
	header("location:logininput.html");
}
// tjek om brugeren er logget ind.

include 'coninclude.php';
// inkluderer connection til db
?>

<head> 
	<title>	Madplan.dk </title> <! title på min tjemmeside>
	<link rel="icon" href="images.png" />	<! jeg linker et billede for at gøre det lidt pæner>
	<meta charset="utf-8"> <! includer danske tegn >
	<link rel="stylesheet" type="text/css" href="eksamencss.css"><! jeg inkluderer css document>	
	
<script>
	function ajaxreques(stringsearch) {
	
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 || xmlhttp.status==200) {		
				return xmlhttp.responseText;
			}

		}
				
		xmlhttp.open("POST","opskreftserver.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(stringsearch);
		return xmlhttp.onreadystatechange();
	}
			
	function search(){
		var search = document.getElementById('searchret').value;
		var stringsearch = "&search="+search+"&mycase=E";
		
		Response = ajaxreques(stringsearch);
		document.getElementById('liste').innerHTML = Response;	
		}

	function showopskreft(v){
		var navnO = document.getElementById(v).value;
		var showops = "&navnO="+navnO+"&mycase=F"+"&myid="+v;
		
		Response = ajaxreques(showops);
		document.getElementById(v+"d").innerHTML = Response;
	}

	function hideret(v){
		var navnO = document.getElementById(v).value;
		var hideops = "&navnO="+navnO+"&mycase=G"+"&myid="+v;

		Response = ajaxreques(hideops);
		document.getElementById(v+"d").innerHTML = Response;	
	}

	function addtofav(v){
		var gemfav = "&mycase=H"+"&myid="+v;
		
		Response = ajaxreques(gemfav);
		alert(Response);
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
								
					<input type="text" onkeyup="return search();" id="searchret" class="ekstraknap">
					
					<h1>Opskrefter:</br></h1>
					
					<div id="liste">
						<?php
							$opskrefter= array();
						$get=mysqli_query($con,"SELECT NavnO FROM opskreft WHERE Status = 'Active'");
						
						while($opskreft= mysqli_fetch_array($get)){
							array_push($opskrefter,$opskreft);
						}
						$antal = count($opskrefter);
						
						for($i=0; $i< $antal; $i++){
						?><div id="<?php echo$i."d";?>">
						<input type="button" id="<?php echo$i;?>" value="<?php echo$opskrefter[$i]['NavnO'];?>" onclick="return showopskreft(id);" class="opskreftknap">
						<br></div>
						<?php		
						}
						?>					
					</div>
				</div>
			</div>