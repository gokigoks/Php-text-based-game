<?php
	
	require './../asset/classes/User.php';
	require './../asset/classes/Enemy.php';
	require './../asset/classes/Character.php';
	require './../asset/classes/battle.php';
	require './../asset/classes/Level.php';
	/*
	** Dependencies
	*/

		// if(!isset($_SESSION['enemy'])){


		// 	$enemy = new Enemy(1);
			
		// 	}
		// 		$_SESSION['enemy'] = $enemy;
	 	 

		// if(!isset($_SESSION['character'])){
				
		//  $_SESSION['character'] = new Character();
			
		// }
		//  $user = $_SESSION['character'];
		
		$level = new Level();
		$user = new Character();
		$enemy = new Enemy(1);

		if(isset($_GET['move'])){

			if($_GET['move']=='attack')
			{
				echo $user->attack($enemy);
				

			}

		}

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
		<link href="../asset/css/main.css" rel="stylesheet">
		<link href="../asset/css/battle.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>


<body>
		<div class="centerDiv" >
				
				<div class = "container">

				<div class = "battle3">
				You encounter a hostile <?php echo $enemy->getName().'<br>';
					echo "<br>".$user->getMessage();
					
				 ?>
				</div>
				<div class = "battle2"><br>
					enemy Hp : <?php   
						// if($_SESSION['enemy_hp']==0){ echo "0/".$enemy->getMaxHp(); //unset($_SESSION['enemy_hp']);
						// }
						// else {echo $enemy->getCurrentHp() . '/' .$enemy->getMaxHp(); }
						echo $enemy->getCurrentHp().' / '.$enemy->getMaxHp();
					?>
					
				</div>
					<div class = "battle1">
						<div class= "stats-cont"> 
							<a href="batle.php?move=attack"><div class = "hp">attack</div></a>
							<div class = "mana">HP <?php echo $user->getCurrentHp().'/'.$user->getMaxHp().'<br>'; ?></div>
							<a href=""><div class= "inv">Inventory</div></a>
							<a href=""><div class = "flee">Flee</div></a>
						</div>
					</div>
				</div>
		
		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>
<?php echo $user->getCurrentHp()-$enemy->getAttack().'/'.$user->getMaxHp();?>

