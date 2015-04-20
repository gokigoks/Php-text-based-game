<?php
require_once 'Database.php';
require_once 'battle_engine.php';
require_once 'Object.php';

class Enemy implements battle, Object{

	/*
	*	This class is serialized and persisted
	*
	*
	**/

	private $enemy_name,$enemy_hp,$enemy_defense,$enemy_damage,$enemy_level,$max_hp,$msg,$xp,$gold;


	public function __construct($level){
			
		$this->enemy_level = $level;
		$db = Database::getInstance();
		$pdo = $db->getConnection();	


			$query = "select enemy_id, enemy_defense, enemy_damage, enemy_name,enemy_hp,exp,gold FROM enemy ";
			$query .= "WHERE enemy_level = :level ";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':level' => $level ));
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			// $rowcnt = $result->num_rows;
			// $user = mysqli_fetch_assoc($result);
			
		if($enemy= $stmt->fetch()){
			
			
			$this->enemy_name = $enemy['enemy_name'];
			$this->enemy_damage = $enemy['enemy_damage'];
			$this->enemy_defense = $enemy['enemy_defense'];
			$this->gold = $enemy['gold'];
			$this->max_hp = $enemy['enemy_hp'];	
			$this->xp = $enemy['exp'];

			
			
			
		}
		
			//return 'login failed!';
			return 'query failed'.' '.$query;
		
	}
	public function getMessage(){
			return $this->msg;
		}

	

	public function getCurrentHp(){
		if(!isset($_SESSION['enemy_hp'])){
			$_SESSION['enemy_hp'] = $this->max_hp;
		}
		return $_SESSION['enemy_hp'];
	}

	public function getAttack(){

		return $this->enemy_damage;

	}



	public function getExp(){
		return $this->xp;
	}

	public function getGold(){
		return $this->gold;
	}

	public function getDrops(){
				
	}

	public function getMaxHp(){
       return $this->max_hp;
	}

	public function getDefense(){

		return $this->enemy_defense;

	}

	public function getName(){
		return $this->enemy_name;
	}

	public function setHp($hp){

		$_SESSION['enemy_hp']= $hp;

	}

	public function calculateDefense()	{

		$defense = $this->enemy_defense / 2;
		return $defense;

	}

	public function calculateAttack(){
		$min_attack = $this->getAttack()*0.80;
		$max_attack = $this->getAttack()*1.20;

		$final = round(rand($min_attack,$max_attack));

		return $final;
	}


	public function attack(Object $target){

		$attack = $this->calculateAttack() - $target->calculateDefense();
		$dodge = $target->Dodge();

		if($target->getCurrentHp() > $attack && !$dodge)
		{	
			$target->setHp($target->getCurrentHp() - $attack);
			if($target->getCurrentHp()==0 || $target->getCurrentHp()<0){
				
				$_SESSION['outcome'] = true;
				$this->msg = $this->getName()." attacked for ".$attack."!!!";
				$this->msg = "Player has been defeated by ".$this->getName()." <br>";
				$this->msg .= "you have been revived in a local shrine";
				$this->msg .="<a href='scene".$_SESSION['current_stage'].".php'>return asdasdto town</a>";
				
					
			}	
			
			$this->msg =  'The '.$this->getName().' attacked dealing '.$attack.' damage<br>';
		}
		elseif($dodge)
		{
			$this->msg = "Player was able to dodge the attack!!";
			return $this->msg;
		}	
		else
		{	
			$_SESSION['outcome'] = true;
			$this->msg = get_class($target)." has been defeated..<br>";
			$this->msg .="<a href='scene".$_SESSION['current_stage'].".php'>return to town</a>";
			return $this->msg;
		}
		

	}	

	
//last bracket
}