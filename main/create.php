<?php
	require_once './../asset/classes/Character.php';	

	if(isset($_POST['submit']) && isset($_POST['class'])){
		$new = new Character();

		echo $_POST['class'];
		echo $_SESSION['newuser'];
		Character::makeCharacter($_POST['class']);
		echo "hi natawag ko";
	}

	

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Dragon quest</title>
		<link rel="shortcut icon" href="../asset/images/icon.png">
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../asset/css/bootstrap.min.css" rel="stylesheet">
		<link href="../asset/css/main.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>

<body>
	
		<div class="centerDiv">
					
			
			<table class="ui" style="background-repeat: no-repeat">
				
				<tr><td><div class="logo"><img src="../asset/images/gamelogo.png"></div><div class="text"></div></td></tr>
			</table>	



				<form action="" method="POST">

					
						<div class = "char-cont">
							<div class = "char">	
								<img src = "../asset/images/warrior.png" class="warrior">
								<img src = "../asset/images/archers.png" class="archers">
								<img src = "../asset/images/mage.png" class="mage">
							</div>

							<div class = "radio-btn">	
								<input type="radio" name="class" value="warrior">Warrior
								<input type="radio" name="class" value="rogue">Rogue
								<input type="radio" name="class" value="mage">Mage
							</div><input type="submit" value="choose" name="submit">

						</div>
							<!-- <a href = "register.php"><input type = "button" class = "confirm" value="Confirm"></a>	 -->					
 								<img src = "../asset/images/choose.png" class = "destiny_image">	
 								<img src = "../asset/images/create.png" class="scros2">
					
				</form>

		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>