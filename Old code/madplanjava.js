	 // funktion modtager variabel functionsvariabel og sender det til en php side der så skal loade de data jeg skal bruge 
	function ajaxreques(functionsvariabel) { 
		xmlhttp=new XMLHttpRequest(); // starter nye request
		xmlhttp.onreadystatechange=function() { // skal blive aktiveret hver gang der sker noget nyt
			if (xmlhttp.readyState==4 || xmlhttp.status==200) {		
				return xmlhttp.responseText;
				// efter man har sendt request spørger jeg om request er klar 4 betyder at request er klar og 200 betyder at serveren er ok
				//derefter retunere jeg response text. 
			}

		}
				
		xmlhttp.open("POST","Servermadplan.php",false);//sender data ved hjælp af post til opskreftserverto, men den skal gøre det synkront. 
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded"); // fortæller hvad for en data type jeg skal sende
		xmlhttp.send(functionsvariabel); // data jeg sender
		return xmlhttp.onreadystatechange(); //jeg retunere det jeg får tilbagesh
	}
	// funktion som skal loade logind side frem 
	function logindfelt(){
		var logind = "&mycase=logindfelt";
		response = ajaxreques(logind);
		document.getElementById('mainbody').innerHTML = response;
	}
	
	//funktion som tjekker om alt er ok før den sender dig viderer til test php side
	function logtjek(){
		//tjekker om logind og pssword er tom
		var ema = document.forms["logind"]["uname"].value;
		var p = document.forms["logind"]["Password"].value;
				
		if(ema=="" || p==""){						
			document.getElementById('errorlog').innerHTML= "Husk at udfylde alle fælter";
			return false;
		}
	}
	
	// funktion til at loade regirsterer dig felt 
	function showreg(){
		var reg = "&mycase=registrerer";
		response = ajaxreques(reg);
		document.getElementById('skiftfelt').innerHTML = response;	
	}
	
	// funktion til at tjekke om brugeren har skrevet de ting som jeg vil have det
	function createU(){
		var Navn = document.forms["formcreate"]["Navn"].value;
		var UserNavn = document.forms["formcreate"]["UserNavn"].value;
		var Pass = document.forms["formcreate"]["Pass"].value;	
		var Pass2 = document.forms["formcreate"]["Pass2"].value;
		var  Email = document.forms["formcreate"]["Email"].value;
			
		if(Navn == "" || Pass == "" || Pass2 == ""  || Email == "" || UserNavn == ""){
			document.getElementById('errorreg').innerHTML= "Husk at udfylde alle fælter";
			return false;
		}
				
		if(Pass != Pass2){
			document.getElementById('errorreg').innerHTML= "Din kodeore er forskellige";
			return false;
		}
		
		// jeg bruger det del af koden til at tjekke om der findes det email eller bruger navn til at give brugeren bedre oplevelse
		var brugertjek = "&mycase=Brugertjek&email="+Email+"&UserNavn="+UserNavn;
		response = ajaxreques(brugertjek);
		document.getElementById('errorreg').innerHTML = response;	
		
		if(document.getElementById('test') == null){ 
			document.getElementById("Createuser").submit();
		}
		else {
			return false;
		}
	}
	
	
	//funktion til at visse frem glemt password. 
	function showforget(){
		var forgetpass = "&mycase=forgetpass";
		response = ajaxreques(forgetpass);
		document.getElementById('skiftfelt').innerHTML = response;
	}
	
	//functiontion til at tjekke og sende emails
	function emcheck(){
		var em = document.forms["forget"]["emailf"].value;
		if(em==""){
			document.getElementById('errorpass').innerHTML= "Husk at udfylde alle fælter";
			return false;
		}
		else{	
			//skal skrives lidt mere kode til det =) 
		}
	}
	
	// dette funktion skal loade om os side
	function omos(){
		var omos = "&mycase=omos";
		response = ajaxreques(omos);
		document.getElementById('mainbody').innerHTML = response;
		
	
	}
	
	
	
	/*
		
	function search(){
		var search = document.getElementById('searchret').value; // gemmer variabel 		
		var stringsearch = "&search="+search+"&mycase=E"; 	// laver en string som jeg sender

		Response = ajaxreques(stringsearch); // gemmer response
		document.getElementById('liste').innerHTML = Response;	 // viser response på en hjemmeside
		//funktion til at søge 
	}

	function showopskreft(v){
		var navnO = document.getElementById(v).value;						
		var showops = "&navnO="+navnO+"&mycase=F"+"&myid="+v;
						
		Response = ajaxreques(showops);
		document.getElementById(v+'d').innerHTML = Response;			
		//Funktion til at vise opskreft 
	}

	function hideret(v){
		var navnO = document.getElementById(v).value;
		var hideops = "&navnO="+navnO+"&mycase=G"+"&myid="+v;
			
		Response = ajaxreques(hideops);
		document.getElementById(v+'d').innerHTML = Response;
		//funktion til at gemme opskreft
	}*/
