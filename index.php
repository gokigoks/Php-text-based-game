<?php


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Dragon quest</title>
		<link rel="shortcut icon" href="asset/images/icon.png">
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="./asset/css/bootstrap.min.css" rel="stylesheet">
		<link href="./asset/css/main.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>

<body>
		<div class="centerDiv">
					<?php 
				include('./main/view/battleview.php');
				// $view = new battleview();
				// 	echo $view->getMsg();
			?>
			
			<table class="ui" style="background-repeat: no-repeat">
				
				<tr><td><div class="logo"><img src="./asset/images/gamelogo.png"></div><div class="text"></div></td></tr>
				

			</table>	
		<!-- <a href="./main/login.php"><img src="./asset/images/wati.png" class="play_button"></a>
 -->		
 			<a href="./main/login.php"><img src = "./asset/images/btn.png" class="play_button" /></a>
 		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>