<?php 

	
	require_once './../../asset/classes/Character.php';
	require './../../asset/classes/Level.php';

	$level = new Level(2);

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
		 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<link href="./asset/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../asset/css/scene1.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<script>
			$( document ).click(function () {
				if ( $( ".p1:first" ).is( ":hidden" ) ) {
				$( ".p2" ).fadeIn( "slow" );
				} 
				else{
					$( ".p1" ).hide("slow");
				}
			});
		</script>	

		    <style type="text/css">
		    .centerDiv {
		      	background-image: url('../../asset/images/longhouse.jpg');
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
					<div class = "p1">You wander into the peaceful town <?php?>
					</div>

					<div class = "p2"><?php echo $level->getStory();?>
					 			 <div class = "start"> 
					 			 	<a href = "./batle.php" />START JOURNEY >>></a>
					 			 </div>
					</div>

					
				</div>

		
		</div>

	

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
</body>

</html>

?>