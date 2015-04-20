<?php

	require_once './../asset/classes/Character.php';
	require_once './../asset/classes/Inventory.php';
	$char = new Character();
	$inv = new Inventory();


	if(isset($_GET['wep'])){
		$inv->setWeapon($_GET['wep']);
	}

	if(isset($_GET['armor'])){
		$inv->setArmor($_GET['armor']);
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
		<link href="../asset/css/inventory.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>

<body>
		<div class="centerDiv-2">
			<div class = "inv-cont">
				<img src="../asset/images/inv-logo.png">

				<div class = "main-nav">
					 <ul id="main-nav">
			            <li class="portfolio">Weapon</li>
			            <li class="services">Armor</li>
		       		 </ul>
		       	</div>
			    
			 	<div class = "warrior">
			    	<img src = "./../asset/images/<?php echo $char->getClassName();?>.png" class="warrior-inv"> 
			    		<div class = "war-div">
			    		<?php	echo $char->getClassName(); ?>
			    		</div>   		
			    </div>

			    <div class = "weapon">
			    	<?php
			    		$row = $inv->getWeapons();
			    		foreach ($row as $value) {
			    		echo "<a href='inventory.php?wep=".$value['weapon_name']."'>".$value['weapon_name'].'</a>  &nbsp '.$value['damage'].' damage <br>';
			    			
			    		}
			    		var_dump($_SESSION['url']);
			    	?>
			    </div>

			     <div class = "armor">
			    <!-- 	 <ul>
			            <li class="current">Items</li>
			            <li class="portfolio">Weapon</li>
			            <li class="services">Armor</li>
		       		 </ul> -->
		       		 	<?php
			    		$row = $inv->getArmors();
			    		foreach ($row as $value) {
			    			echo      "<a href='inventory.php?armor=".$value['armor_name']."'> ".$value['armor_name']." </a> &nbsp ".$value['defense']." def <br>";
			    			
			    		}
			    	?>
			    </div>

			    <div class = "stats">
			    	<ul id ="stats">
				    	 <li class="current">ATTACK : <?php echo $char->getAttack(); ?></li><br />
				         <li class="portfolio">DEF : <?php echo $char->getDefense(); ?></li><br />
				         <li class="services">STR : <?php echo $char->getStr(); ?></li><br />
				         <li class="current">DEX : <?php echo $char->getDex(); ?></li><br />
				         <li class="portfolio">INT : <?php echo $char->getInt(); ?></li>
				    </ul>
			    	<img src = "../asset/images/coins.png" class = "coins">
			    	<?php  echo $char->getGold(); 
			    	echo "<br>";
			    	echo "<a href='scenes/".$_SESSION['url']."'>BACK</a>";
			    	?>
			    	<br>
			    	<a href>

			    </div>

			</div>			
 		</div>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>