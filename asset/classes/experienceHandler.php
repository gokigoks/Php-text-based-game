<?php

	//namespace asset\classes;

	require_once 'Character.php';
	require_once 'Enemy.php';
	require_once 'Database.php';
	
		/*
		*
		* this handles experience for the user
		*
		*/

	 class ExperienceHandler{	
	/*
 	*
 	* @handles level ups and current xp of user
 	*
 	*/


 	protected $user , $enemy;

 	protected $level;

 	protected $current_exp ,$next_level ,$current_level;

 	private $pdo, $db;




 	public function __construct(Object $user ,Object $enemy)
 	{
 		
 		$this->user = $user;
 		$this->enemy = $enemy;

 		$this->db = Database::getInstance();
		$this->pdo = $this->db->getConnection();
		$params = array(':user' => $user->getUserId());

		$query = "SELECT current_exp, next_level, character_level ";
		$query.= "from character_table ";
		$query.= "WHERE user_id = :user";

			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$row = $stmt->fetch();

			$this->current_xp = $row['current_exp'];
			$this->next_level = $row['next_level'];
			$this->current_level = $row['character_level'];
			
		
 	}
 	/*
 	**
 	*	
 	**
 	*/

 	public function handle() {

	if(($this->current_exp + $this->enemy->getExp()) > $this->next_level) 
			{
				//$num = $this->current
				$this->characterLevelUp();

			}
			else
			{
				$this->addExperience();
			}

 	}

 	//public function 

 	public function addExperience(){

 		
		$params = array(':exp'=>$this->enemy->getExp(),
			':user'=>$this->user->getUserId());

		$query = "UPDATE character_table ";
		$query.= "SET current_exp = current_exp + :exp ";
		$query.= "WHERE user_id = :user";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(':exp',$params[':exp'],PDO::PARAM_INT);
			$stmt->bindValue(':user',$params[':user'],PDO::PARAM_INT);
			$stmt->execute();

 	}

 	public function calculateNextLevel(){

	 		$next = $this->next_level * 2;
 		
	 		return $next;

 	}

 	public function characterLevelUp()	{


 		$params = array(':exp'=>$this->calculateNextLevel(),
			':user'=>$this->user->getUserId());

		$query = "UPDATE character_table ";
		$query.= "SET next_level = :exp, ";
		$query.= " current_exp = 0 ";
		$query.= "WHERE user_id = :user";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(':exp',$params[':exp'],PDO::PARAM_INT);
			$stmt->bindValue(':user',$params[':user'],PDO::PARAM_INT);
			$stmt->execute();

			$this->statIncrease();



 	}

 	public function statIncrease() {

 		$class = $this->user->getClassName();

 		if($class == 'mage')
 		{

 			$stat = array(':str' => 2, ':dex' => 3, ':int' => 5, ':user' => $this->user->getUserId());
 			$hp = 30;
 			
 		}
 		elseif($class == 'warrior')
 		{
 			$stat = array(':str' => 5, ':dex' => 3, ':int' => 1, ':user' => $this->user->getUserId());
 			$hp = 80;
 			
 		}
 		else{

 			$stat = array(':str' => 3, ':dex' => 5, ':int' => 2, ':user' => $this->user->getUserId());
 			$hp = 45;
 		}

 		$params = array(

 			':str' => $stat[':str'],
 			':dex' => $stat[':dex'],
 			':int' => $stat[':int'],
 			':hp' => $hp,
 			':user' => $stat[':user']

 			);

 		

 		$query = "UPDATE character_table ";
 		$query.= "SET character_str = character_str + :str, character_dex = character_dex + :dex, character_int = character_int + :int ";
 		$query.= "character_hp = character_hp + :hp ";
		$query.= "WHERE user_id = :user";

		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(':str',$params[':str'],PDO::PARAM_INT);
		$stmt->bindValue(':dex',$params[':dex'],PDO::PARAM_INT);
		$stmt->bindValue(':int',$params[':int'],PDO::PARAM_INT);
		$stmt->bindValue(':hp',$params[':hp'],PDO::PARAM_INT);
		$stmt->bindValue(':user',$params[':user'],PDO::PARAM_INT);
		$stmt->execute();


 	}


 	/*
 	* ````
 	* 
 	* ````
 	*/



 }