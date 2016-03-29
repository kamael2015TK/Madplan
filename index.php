<html>

	<head>
	<link rel="stylesheet" type="text/css" href="madplanCss.css">
	<meta charset="UTF-8"/>
	
	
	<!meta http-equiv="refresh" content="3" >
	
	</head>
	
	<body>
		<header class="bodyStruckture">
			<div class="menueElements">
				Madplanen
			</div>
			
			<div class="menueElements" id="menueButton">
				<input type="button" value="Opret" class="menueButtons" id="imageAdd" />
				<input type="button" value="Log ind" class="menueButtons"/>
			</div>
		</header>
		
		<div class="bodyStruckture" id="mainBody">
			<div class="mainPart">
			
<!//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////>
¨
				<div class="searchField" > 
					<input type="text" class="inputSearch" placeholder="Søg efter Ingradiens" />
					<input type="submit" value="&#128269;" class="searchSubmit">
				</div>
			

				<div>
					<h1> Top 10 Retter</h1>
					<p>
							<?php 
							for($i = 1; $i <= 10; $i++){
								echo "Stegt flæsk ".$i."<br>"; 
							}
							
							?>
					</p>
				</div>


				
			</div>
<!/////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////>

			<div class="mainPart" id="mainContent">	
				</br>
				</br>
				<div class="mainBodyPart" id="pictureBlock">
					<?php 
						for($i = 1; $i < 6; $i++){
							?>
							<img src="picture<?php echo $i;?>.jpg" id="Picture<?php echo $i;?>">
							<?php
						}
					?> 
				</div>
				<div class="mainBodyPart">
					<input type="radio">
					<input type="radio">
					<input type="radio">
					<input type="radio">
					<input type="radio">
				</div>
				<div class="mainBodyPart" id="contendPart">
				
					<?php 
					for($i = 1; $i <= 25; $i++){
						echo "test".$i."<br>"; 
					}
					?>
				</div>			
			</div>
			
<!////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////>
			<div class="mainPart">
			
				<div class="searchField"> 
					<input type="text"  class="inputSearch" placeholder=" Søg Ret" />
					<input type="submit" value="&#128269;" class="searchSubmit">
				</div>
				
				
				<div >
					<h1> Top 10 Søgte Retter</h1>
					<p>
					
						<?php 
						for($i = 1; $i <= 10; $i++){
							echo "Stegt flæsk ".$i."<br>"; 
						}
						?>
					</p>
				</div>

					
			</div>
			
<!////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////>
		</div>
		
	</body>
	
</html>