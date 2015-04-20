<?php
	
	require './../../asset/classes/User.php';
	require './../../asset/classes/Enemy.php';
	require './../../asset/classes/Character.php';
	require './../../asset/classes/battle.php';
	require './../../asset/classes/Level.php';
	/*
	** Dependencies
	*/	
		$hidebutton = false;

		if(isset($_SESSION['outcome']) && $_SESSION['outcome']==true){

			$hidebutton = true;
		}

		$file = basename(__FILE__);
		$_SESSION['url'] = $file;

		$level = new Level();
		$user = new Character();
		$enemy = new Enemy($user->getCurrentStage());


			/*
			**
			*/
			$background = $level->getBackground();
			$stage = $level->getLevel();
			$story = $level->getStory();
			$intro = $level->getIntro();

			$fleeLink=""; // empty

		if(isset($_GET['move'])){

			if($_GET['move']=='attack')
			{
				echo $user->attack($enemy);
				echo $enemy->attack($user);
				
			}
			if($_GET['move']=='flee') 
			{

			$fleeLink =	$user->flee();

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
		<link href="./../asset/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../asset/css/main.css" rel="stylesheet">
		<link href="../../asset/css/battle.css" rel="stylesheet">
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
					echo "<br>".$enemy->getMessage();
					echo "<br>".$user->getMessage()."<br>";
					echo $fleeLink;
					
				 ?>
				</div>
				<div class = "battle2"><br>
					<img src="../../asset/images/goblin.png" class = "mons">
					<div class = "hp-cont">
					enemy Hp : <?php   
						// if($_SESSION['enemy_hp']==0){ echo "0/".$enemy->getMaxHp(); //unset($_SESSION['enemy_hp']);
						// }
						// else {echo $enemy->getCurrentHp() . '/' .$enemy->getMaxHp(); }

						echo $enemy->getCurrentHp().' / '.$enemy->getMaxHp();
					?>
					</div>
					
				</div>
					<div class = "battle1">
						<div class= "stats-cont"> 
							<?php if(!isset($_SESSION['outcome'])) { ?>
							<a href="batle.php?move=attack"><div class = "hp">attack</div></a>
							<div class = "mana">HP <?php echo $user->getCurrentHp().'/'.$user->getMaxHp().'<br>'; ?></div>
							<a href="../inventory.php"><div class= "inv">Inventory</div></a>
							<a href="battle2.php?move=flee"><div class = "flee">Flee</div></a>
							<?php } 
							else {

							}
							?>

						</div>
					</div>
				</div>
		
		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>