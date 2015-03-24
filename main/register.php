<?php
	require_once './../asset/classes/User.php';

		$condition = true;
		$blankfield = "style='border-color:red;'";
		$fields = array('user'=>'black','email'=>'black','pass'=>'black','pass2'=>'black',);

		if(isset($_POST['submit'])) {
			
				$msg = '';
			    $array = array('user','email','pass','pass2');
				foreach($array as $row)
					{	

						if( !isset($_POST[$row]) || $_POST[$row]==='' || empty($_POST[$row])){
							$msg =  "please fill up the ".$row." field <br>";
							$fields[$row] = 'red';
							$condition = false;
						}
						elseif ($_POST['pass'] != $_POST['pass2']) {
						 	$msg =  "passwords are not matched! <br>";
						 	$condition = false;
						 } 
						 else
						 {
						    
						    $username = $_POST['user'];
						    $pass = $_POST['pass'];

						    
						 }

					}

					if($condition == true)
					{	
						echo "codition true!!";
						$user = new User();
						$user->register($username, $pass);
					}
			echo "for submitted!";		
			unset($condition,$_POST[$row],$_POST['submit'],$_POST['user'],$_POST['email']);	
			echo $msg;
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

			?>
			
			<table class="ui" style="background-repeat: no-repeat">
				
				<tr><td><div class="logo"><img src="../asset/images/gamelogo.png"></div><div class="text"></div></td></tr>
			</table>	


			
				<form action="" method="POST">

					
						<div class = "reg-cont">
							Username :<input type = "text" style="border-color:<?php echo $fields['user']; ?>;" class = "reg-user" placeholder="Enter your username" name="user"><br/><br/>
							Email : <input type ="email" style="border-color:<?php echo $fields['email']; ?>;"  class="reg-mail" placeholder="Enter your email address" name="email"><br/><br/>
							Password :<input type ="password" style="border-color:<?php echo $fields['pass']; ?>;"  class="reg-pass" placeholder="Enter your password" name="pass"><br/><br/>
							Confrim password : <input type="password" style="border-color:<?php echo $fields['pass2']; ?>;"  class="reg-pass2" placeholder="Confirm your password" name="pass2">
						</div>
							<input type = "submit" class = "confirm"  name="submit">
						<!-- <a href = "scene1.php"><input type = "submit" class = "playerbtn" value="Log-In"></a>
						<a href = "register.php"><input type = "button" class = "playerbtn2" value="Register"></a>
							<img src = "../asset/images/username.png" class = "login_image">
							<img src = "../asset/images/password.png" class = "password_image">
 -->								<img src = "../asset/images/note2.png" class="scros">
					
				</form>
			
		
				
			



					
				
		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>