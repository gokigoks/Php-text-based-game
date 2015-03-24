   <?php
require_once 'Database.php';
require_once 'Character.php';

class Level{

	
	protected $background,$level,$story;

	public function __construct(){

		//unset($_SESSION['enemy_hp']); 

		if(isset($_SESSION['curr_stage'])){

			$db = Database::getInstance();
			$pdo = $db->getConnection();
			$query = "SELECT level,background,story,intro from level ";
			$query.= "WHERE level = :level";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':level'=>$_SESSION['current_stage']));	
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->background = $row['background'];
			$this->level = $row['level'];
			$this->story = $row['story'];
			$this->intro = $row['intro'];

		}else{
			$char = unserialize($_SESSION['character']);
			$_SESSION['current_stage'] = $char->getCurrentStage();
			$db = Database::getInstance();
			$pdo = $db->getConnection();
			$query = "SELECT level,background,story from level ";
			$query.= "WHERE level = :level";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':level'=>$_SESSION['current_stage']));	
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->background = $row['background'];
			$this->level = $row['level'];
			$this->story = $row['story'];

		}


	}


	public function getLevel(){
		return $this->level;
	}

	public function getStory(){
		return $this->story;
	}

	public function getBackground(){
		return $this->background;
	}

	// public function level1(){

	// 	DEFINE('level',1);
	// 	DEFINE('background','./../images/arcania.jpg');
	// }

	// public function level2(){
	// 	DEFINE('level',2);
	// 	DEFINE('background','./../images/desertbackground.jpg');

	// }
	// public function level3(){
	// 	DEFINE('level',2);
	// 	DEFINE('background','./../images/darkjungle.jpg');

	// }
	// public function level4(){
	// 	DEFINE('level',2);
	// 	DEFINE('background','./../images/desertbackground.jpg');

	// }
	// public function level5(){
	// 	DEFINE('level',2);
	// 	DEFINE('background','./../images/desertbackground.jpg');

	// }
	// public function level5(){
	// 	DEFINE('level',2);
	// 	DEFINE('background','./../images/desertbackground.jpg');

	// }
	// public function level6(){
	// 	DEFINE('level',2);
	// 	DEFINE('background','./../images/desertbackground.jpg');

	// }

}