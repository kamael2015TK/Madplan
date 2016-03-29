 <?php
// connecter til en db
include 'coninclude.php';

// sikre mig imåd sql ingektion og samler variabler. 
$Navn = htmlentities($_POST['Navn']);
$Email = htmlentities($_POST["Email"]);
$usernavn = htmlentities($_POST['UserNavn']);
$BrugerID = 0;
$status = 0;
$token = randomstring();
$date = date("Y/m/d");

// pasword kryptering
$options = ['cost' => 12,];
$Password =  password_hash($_POST['Pass'], PASSWORD_BCRYPT, $options);
$Password = htmlentities($Password);

// test variabel
$test = true;
	//test om der findes bruger med det navn eller med email 
	if($testbruger = mysqli_prepare($con, "SELECT * FROM `madplanbruger` WHERE `UserName` = ? OR `Email` = ? ")){
		mysqli_stmt_bind_param($testbruger,"ss",$usernavn,$Email);
		mysqli_stmt_execute($testbruger);	
		mysqli_stmt_store_result($testbruger);
		if(mysqli_stmt_num_rows($testbruger) != 0){		
			$test = false;
			header("location:madplan.php");	
		}
		mysqli_stmt_close($testbruger);
	}	
		

	// tjekker black liste for email 	
	if($testemailb = mysqli_prepare($con, "SELECT * FROM `blacklist` WHERE `Email` = ?")){
		mysqli_stmt_bind_param($testemailb ,"s",$Email);
		mysqli_stmt_execute($testemailb );	
		mysqli_stmt_store_result($testemailb );
	
		if(mysqli_stmt_num_rows($testemailb ) != 0){
			$test = false;
			header("location:madplan.php");
		}
	
		mysqli_stmt_close($testemailb);
	}
	// hvis testen var ok så vil jeg gemme men hvis den er ikke ok (det burte ikke ske pga min javascript) så vil det returnerer tilbage
	if($test == false){
		header("location:madplan.php");
	}	
	else{
		// sender en email til brugeren 
		$subject = "godkend din account";	
		$txt = "for at godkende din acount skal du ";
		$txt .="<a href='http://localhost.eksammen/confirm.php?&key=$Email&token=$token'>klikke her </a> <meta charset='utf-8'>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$sentmail = mail($Email,$subject,$txt, $headers);
		
		if($gembrugeren=mysqli_prepare($con, "INSERT INTO `madplanbruger`(`ID`, `Name`, `UserName`, `Password`, `Email`, `Status`, `Token`, `Dato`) VALUES (?,?,?,?,?,?,?,?)")) {    
			mysqli_stmt_bind_param($gembrugeren, "issssiss" ,$BrugerID,$Navn,$usernavn,$Password,$Email,$status,$token,$date);
			mysqli_stmt_execute($gembrugeren);
			mysqli_stmt_close($gembrugeren);
		}


		header("location:madplan.php");
	}