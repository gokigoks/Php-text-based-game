<?php
	require './../asset/classes/User.php';
				session_start();
				// if(isset($_SESSION['user_cred']['user_id']))
				// {
				// 	header("location:batle.php");
				// }

			   	/*
				** verifying for login. 
				** verify login function in User.php
				*/
				unset($_SESSION['enemy_hp'],$_SESSION['user_hp']);

					
			   	if(isset($_POST['submit']))
				{
					if(isset($_POST['username'],$_POST['password']))
						{	
							$user = $_POST['username'];
							$password = $_POST['password'];
							$new_user = new User();
							echo $new_user->verifyLogin($user,$password);
						}

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
					<?php 
				include('./view/battleview.php');
				// $view = new battleview();
				// 	echo $view->getMsg();
			?>
			
			<table class="ui" style="background-repeat: no-repeat">
				
				<tr><td><div class="logo"><img src="../asset/images/gamelogo.png"></div><div class="text"></div></td></tr>
			</table>	



				<form method="post" action="">

					
						<input type = "text" class = "playerinput" title= "Please provide your username" placeholder="Username" name="username">
						<input type = "password" class = "playerinput2" title= "Please provide your username" placeholder="Password" name="password">
						<input type = "submit" class = "playerbtn" value="Log-In" name="submit">
						<a href = "register.php"><input type = "button" class = "playerbtn2" value="Register"></a>
							<img src = "../asset/images/username.png" class = "login_image">
							<img src = "../asset/images/password.png" class = "password_image">
								<img src = "../asset/images/note2.png" class="scros">
					
				</form>

		
				
			



					
				
		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>