<?php
	require_once 'Database.php';
	require_once 'User.php';
	require_once 'Character.php';


	class inventory{

		protected $user_id, $item,$armor,$weapon;

		public function __construct(){

			$user =  unserialize($_SESSION['user']);
			$this->user_id = $user->getUserId();
			
			// $this->weapon = $this->getWeapons();
			// $this->item = $this->getItems();
			// $this->armor = $this->getArmors();

		}

		public function getWeapons(){

			$db = Database::getInstance();
			$pdo = $db->getConnection();

			$query = "SELECT weapon_name, damage from weapon ";
			$query.= "WHERE user_id = :user";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':user'=>$this->user_id));
			$array = $stmt->fetchAll();

			return $array;
		}

		public function getArmors(){

			$db = Database::getInstance();
			$pdo = $db->getConnection();

			$query = "SELECT armor_name, defense from armor ";
			$query.= "WHERE user_id = :user";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':user'=>$this->user_id));
			$array = $stmt->fetchAll();

			return $array;
		}
		
		public function setArmor($armor){

			$db = Database::getInstance();
			$pdo = $db->getConnection();


			$params =  array(':armor' => $armor , ':user'=> $this->user_id);


			$query = "UPDATE character_table ";
			$query .="SET equipped = (SELECT armor_id from armor WHERE armor_name = :armor) ";
			$query .="WHERE user_id = :user";

			$stmt = $pdo->prepare($query);
			$stmt->execute($params);

	//			$url = $_SESSION['url'];


			header("location:./../main/inventory.php");



		}


		public function setWeapon($weapon){
			$db = Database::getInstance();
			$pdo = $db->getConnection();


			$params =  array(':weapon' => $weapon , ':user'=> $this->user_id);


			$query = "UPDATE character_table ";
			$query .="SET weapon = (SELECT weapon_id from weapon WHERE weapon_name = :weapon) ";
			$query .="WHERE user_id = :user";

			$stmt = $pdo->prepare($query);
			$stmt->execute($params);

	//			$url = $_SESSION['url'];


			header("location:./../main/inventory.php");

		}

	}