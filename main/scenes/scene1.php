<?php
	require './../../asset/classes/Character.php';	
	require './../../asset/classes/Level.php';	
	
	
	$level = new Level();
	$level->unsetHp();
	 

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Dragon quest</title>
		<link rel="shortcut icon" href="../../asset/images/icon.png">
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<link href="../../asset/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../asset/css/scene1.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<script>
			$( document ).click(function () {
				if ( $( ".p1:first" ).is( ":hidden" ) ) {
				$( ".p2" ).fadeIn( "slow" );
				} 
				else{
					$( ".p1" ).hide();
				}
			});
		</script>	

		    <style type="text/css">
		    .centerDiv {
		      	background-image: url('../../asset/images/lonewanderer.jpg');
		      	background-repeat: no-repeat;
		      	background-size: 100%;
		    }
		    </style>

			<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		</head>

<body>
	
	

		<div class="centerDiv">
				
				<div class = "paragraph">
					<div class = "p1">On the dawn of time the world was formed with barren lands,collosal trees, and everlasting dragons.It was lost in the usher of tell-tales; how the dragons came about and where they are now. As it seemed they disappeard almost instantaniously.A millenium has passed and Men live their presperous lives in an illusionary peace as travelers tell tales of winged beasts breating fire death in rumors;
					far villages being burned with no survivors.The flows of time are being distorted. A new age is on a verge of rising.
					 The dragons are here.
					</div>

					<div class = "p2">Lord Lucius quickly assembles important people to discuss this matter. Rumors or not, 
					the signs are evident and if itt was true,he feared it is the end of the world as we know it.you are the stranger;
					 Even to yourself. A man with no memories from his past. With only a pendant and your name.You are on a quest to find out who you are.
					 And how your destiny intertwine with the fate of the world.
					 			 <div class = "start"> 
					 			 	<a href = "./batle.php" />START JOURNEY >>>
					 			 </div>
					</div>

					
				</div>

		
		</div>

	

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>