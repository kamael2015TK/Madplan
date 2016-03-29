<?php 
// madplan server er en tredje side som skal bruges til at loade de felter je skal bruge på min side hvor alle har adgang til 
include 'coninclude.php';// connect til en db
$mycase =$_REQUEST['mycase']; // jeg skal vede hvad for en kode der skal bruges.

// funktion der vil vise logind side.
	if($mycase == "logindfelt"){
		?>
			<div id="skiftfelt">
				<form method="Post" name= "logind" onsubmit="return logtjek()" action="tjeklogind.php">	
					<div class="skivind">
						<table width="100%"> 
							<tr> 
								<td><div id="errorlog"></div></td> 
							</tr>
							
							<tr>
								<td><input type="text" name="uname" placeholder="Email/Bruger navn" class="verifyknap" /></td>
							</tr>
							
							<tr> 
								<td> <input type="password" name="Password" placeholder="Password"class="verifyknap" /></td>
							</tr>
													
							<tr>
								<td><input type="submit"  value="Log ind" class="verifyknap" ></td>
							</tr>
						</table>			
					</div>
				</form>
			</div>
			
			<input type="button" onclick="showreg();" class="downknap" value="Opret en bruger" />
			<input type="button" onclick="showforget();"  class="downknap" value="Glemt mit password" />
		<?php
	}
	
	// funktion til at vise registrere dig felter 
	if($mycase == "registrerer"){
		?>
			<form name="formcreate" id="Createuser" method="Post" action="createuser.php">	
				<div class="skivind">
					<table> 
						<tr> 
							<td><div id="errorreg"></div></td> 
						</tr>
							
						<tr>
							<td><input type="text" name="Navn" placeholder="Navn" class="verifyknap"/></td>
						</tr>
						
						<tr>
							<td><input type="text" name="UserNavn" placeholder="Bruger Navn" class="verifyknap"/></td>
						</tr>
								
						<tr> 
							<td> <input type="password" name="Pass" placeholder="Password" class="verifyknap"/></td>
						</tr>
								
						<tr> 
							<td> <input type="password" name="Pass2" placeholder="Gentag Password" class="verifyknap"/></td>
						</tr>

						<tr> 
							<td><input type="email" name="Email" placeholder="E-mail"class="verifyknap"/></td>
						</tr>
								
						<tr>
							<td><input type="button"  value="Register" class="verifyknap" onclick="createU()"></td>
						</tr>
					</table>			
				</div>
			</form>
		<?php
	}
	
	//funktion til at visse glemt dit password felter
	if($mycase == "forgetpass"){
		?>
			<form method="Post" action="glemtpass.php" onsubmit="return emcheck()" name="forget">	
				<div class="skivind">
					<table> 
						<tr> 
							<td><div id="errorpass"></div></td> 
						</tr>
						
						<tr> 
							<td> <input type="email" name="emailf" placeholder="Email" class="verifyknap"/></td>
						</tr>
											
						<tr>
							<td><input type="submit"  value="Send me an Email" class="verifyknap"></td>
						</tr>
					</table>			
				</div>
			</form>
		<?php
	}

	if($mycase == "omos"){
		echo "nothing yet";
	}
	
	if($mycase == "Brugertjek"){
		$email = htmlentities($_POST['email']);
		$brugernavn = htmlentities($_POST['UserNavn']);
		
		
		if($testbrugernavn = mysqli_prepare($con, "SELECT * FROM `madplanbruger` WHERE `UserName` = ? ")){
		mysqli_stmt_bind_param($testbrugernavn,"s",$brugernavn);
		mysqli_stmt_execute($testbrugernavn);	
		mysqli_stmt_store_result($testbrugernavn);
		if(mysqli_stmt_num_rows($testbrugernavn) != 0){
		
			echo "der findes en bruger med det bruger navn <input type='text' value='false' id='test' hidden />";
		
		}
		mysqli_stmt_close($testbrugernavn);
		}	
		
		if($testemail = mysqli_prepare($con, "SELECT * FROM `madplanbruger` WHERE `Email` = ?")){
		mysqli_stmt_bind_param($testemail ,"s",$email);
		mysqli_stmt_execute($testemail );	
		mysqli_stmt_store_result($testemail );
		if(mysqli_stmt_num_rows($testemail ) != 0){
		
			echo "der findes en bruger med den samme e-mail <input type='text' value='false' id='test' hidden />";
		
		}
		mysqli_stmt_close($testemail );
		}
		
		if($testemailb = mysqli_prepare($con, "SELECT * FROM `blacklist` WHERE `Email` = ?")){
		mysqli_stmt_bind_param($testemailb ,"s",$email);
		mysqli_stmt_execute($testemailb );	
		mysqli_stmt_store_result($testemailb );
		if(mysqli_stmt_num_rows($testemailb ) != 0){
		
			echo "Din email er desvære på black liste <br> for at kunne oprette en bruger skal du skrive til os
			<br> du kan skrive til os hvir du går ind på om os og trykker send os mail. <input type='text' value='false' id='test' hidden />";
		
		}
		mysqli_stmt_close($testemailb);
		}
		
		else{
			echo "tjek din email for aktiverings link vi gør opmærksome på at email kan ende i spam folder";
		}
		

		
	}