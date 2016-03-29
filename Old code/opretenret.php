<?php 
session_start();
if(!$_SESSION['email']){
header("location:logininput.html");}
// fordi man har email som en unik
?>
<html> 

	<head> 
		<title>	Madplan.dk </title> <! title på min tjemmeside>
		<link rel="icon" href="images.png" />	<! jeg linker et billede for at gøre det lidt pæner>
		<meta charset="utf-8"> <! includer danske tegn >
		<link rel="stylesheet" type="text/css" href="eksamencss.css"><! jeg inkluderer css document>	
			
		<script>
		function ajaxrequest(sendstring){
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					return xmlhttp.responseText;
				}
					
			}
			xmlhttp.open("POST","opskreftserver.php",false);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(sendstring);
			return xmlhttp.onreadystatechange();
		
		}	
		

		
		// denne funktion er til at tilføre navn til databasen
		function retnavnn(){
			var name = document.getElementById('retn').value;
			var antalpersoner = document.getElementById('antalpersoner').value;
			// tjek om den ikke er tom
			if(name==""){
				alert("Skriv rettens navn");
				return false;
			}
		
			if(isNaN(antalpersoner) || antalpersoner==""){
				alert("Input skal være et tal");
				return false;
			}
		
			else{	
				// laver en string som skal sendes til server php
				var string = "&retnavn=" + name+"&antalpersoner="+antalpersoner+"&mycase=A";
				var response = ajaxrequest(string);
				document.getElementById("respopskreftnavn").innerHTML = response ;
				var testnavn = document.getElementById('testnavn').value;
				// tester om vi har samme navne hvis ikke så fortsæt
				
				if(testnavn != "nope"){
					document.getElementById('navn').style.visibility = "hidden";
					document.getElementById('ingr').style.visibility = "visible";
					return false;
				}				
				return false;
			}
		}
		
		// funktion som skal tilføre ingradienser 
		function sendingra(){
			
			var enhed = document.getElementById('enhed').value;
			var maengte = document.getElementById('maengte').value;
			var ingranavn = document.getElementById('ingranavn').value;
			var name= document.getElementById('retn').value;
			var testingra = true; 
			var testmaengte = isNaN(maengte);
			//test så man ikke skriver tomme fælter
			if(maengte == "" || ingranavn== ""){
				alert("du skal skrive ingradiens og hvor mængte af ingradiensen man skal bruge");
			return false;
			}
				
			// tjek om noget navn indeholder tal
			for (a=0; a<10; a++){
				var searchingra = ingranavn.indexOf(a);
				if(searchingra != "-1"){			
					testingra = false;
					break;
				}
			}
			// tjekker de regtige text typer
			if(testingra == false || testmaengte == true){
			alert(" Du må ikke bruge tal i ingradiens navne eller bukstaver i mængte");
			return false;
			}
			// laver en string der skal sendes til php side
			var stringing ="&ingnavn="+ingranavn+"&enhed="+enhed+"&meangte="+maengte+"&retnavn="+name+"&mycase=B";
			Response = ajaxrequest(stringing);
			document.getElementById("respopskreftingra").innerHTML = Response;
			document.getElementById('maengte').value = "";
			document.getElementById('ingranavn').value ="";
	
			return false;
		}

		function next(v){
			// laver frem og tilbage funktion til at skifte mellem tilførj ingradiens til tilberedning  
			if(v =="next->"){
				document.getElementById('ingr').style.visibility="hidden";
				document.getElementById('opskreft').style.visibility="visible";
			}
			if(v=="<-tilbage"){
				document.getElementById('ingr').style.visibility="visible";
				document.getElementById('opskreft').style.visibility="hidden";
			}		
		}

		function sendopskreft(){
			// sender tilberedning og gemmer input væk. 
			var text=document.getElementById('opskrefttext').value;
			var name= document.getElementById('retn').value;
				document.getElementById('opskreft').style = "visibility:hidden";
			if(text==""){
				alert("du kan ikke skrive en tom opskreft");
				return false;
			}
			
			var stringops = "&text="+text+"&mycase=C"+"&retnavn="+name;
			Response = ajaxrequest(stringops);
			document.getElementById("respopskreftops").innerHTML = Response;
			return false;
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
				<! hoved delen>	
				<div class="mainbody">	
			
					<div id="navn"; style="visibility:none;" class="opretopskreft"> 
						<form method="Post" action="" name="opskrift" onsubmit="return retnavnn();">
							<table>
								<tr>
									<td colspan="2"> <input type="text" placeholder="Ret navn" id="retn" name="retn" class="ekstraknap"/>	</td>
								</tr>
								<tr>
									<td> <input type="text" id="antalpersoner" placeholder="Antal" class="madplanknapper">	</td>
									<td> <input type="submit" value="Næste" name="retnavn" class="madplanknapper"/>					</td>
								</tr>
							</table>
						</form>
					</div>
			
					<div id="ingr"; style="visibility:hidden;"  class="opretopskreft"> 
					
						<form method="Post" action="" name=" opskrift" onsubmit="return sendingra();">
							<table>
								<tr>
								
									<td><input type="text" placeholder="ingradiens navn" name="ingnavn"  id="ingranavn" class="ekstraknap" /></td>
									<td><input type="text" placeholder="mængte" name="maengte" id="maengte" class="madplanknapper"/></td>
									<td>
										<select name="enhed" id="enhed" class="madplanknapper">
										  <option>g</option>
										  <option>st</option>
										  <option>ml</option>
										  <option>tsk</option>
										  <option>spk</option>
										  <option>ds</option>
										</select> 
									</td>				
								</tr>
								
								<tr> 
									<td><input type="submit" value="Tilføj Ingradiens" name="tilfing" class="ekstraknap"></td>
									<td colspan="2"><input type="button" onclick=" next( value );" value="next->" class="ekstraknap"></td>
							</table>
					
						</form>
					</div>			
					
					<div id="opskreft" style="visibility: hidden" class="opretopskreft">
							<form method="post" onsubmit=" return sendopskreft()">
								<table> 
									<tr>
										<td colspan="2">
											<textarea rows="10" cols="50" id="opskrefttext"></textarea>
										</td>
									</tr>
									<tr>
										<td><center> <input type="button" onclick="next( value );" value="<-tilbage" class="madplanknapper"></center></td>
										<td> <center><input type="submit" value="afslut" class="madplanknapper"></center> </td>
									</tr>
								</table>
							</form>
					</div>			
									
					<div class="opskreft" style="right:380px;">
						<div id="respopskreftnavn" class="retnavn" style="top: 28px;">
							<a id ="testnavn" hidden value="ya"> yes </a>					
						</div>
						
						<div id="respopskreftingra" class="retnavn" >
						</div>		
					</div>
					
					<div class="opskreft">
						
						<textarea rows="16" cols="23" id="respopskreftops" disabled style="top:120px; position: absolute; right: 50px; left:85px; color: black; background-image: url('bgtext.png'); "></textarea>
			
					</div>
				</div>			
			</div>
		</div>
</body>
</html> 
