   <?php
require_once 'Database.php';
require_once 'Character.php';
	
class Level{

	
	protected $background,$level,$story;

	public function __construct(){

	 	

		if(isset($_SESSION['current_stage']))
		{

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
				
			
			$char = new Character();
			$user = $char->user->getUserId();
			$db = Database::getInstance();
			$pdo = $db->getConnection();
			$query = "SELECT level,background,story,intro from level ";
			$query.= "WHERE level = (SELECT curr_stage from character_table where user_id = :user)";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':user'=>$user));	
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->background = $row['background'];
			$this->level = $row['level'];
			$this->story = $row['story'];
			$this->intro = $row['intro'];

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

	public function getIntro(){
		return $this->intro;
	}

	public function unsetHp(){
		unset($_SESSION['user_hp']);
		unset($_SESSION['enemy_hp']);
		unset($_SESSION['outcome']);
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