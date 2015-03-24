 <?php
require_once 'Database.php';

	
	
class User{
	protected $user_id, $character_id,$current_equip,$current_weapon,$user_hp,$username;
	
	public function __construct(){



	}

	protected function login(){
			


	}	


		public function verifyLogin($username, $pass){
		

			$param = array(':user'=>$username, ':pass'=>$pass);
			$db = Database::getInstance();
			$pdo = $db->getConnection();	
			$verify = "SELECT * from user where user_name = :user AND password = :pass";
			$verify = $pdo->prepare($verify);
			$verify->execute(array(':user'=>$username,':pass'=>$pass));
			$count = $verify->fetch();
				//verify if account exists
				if($count)
				{
					$query = "select u.user_id, character_id, curr_equip, curr_weapon,character_hp,curr_stage FROM user u, character_table c ";
					$query .= "WHERE u.user_name = :user ";
					$query .= "AND u.password = :pass AND c.user_id = (SELECT user_id FROM user WHERE user_name = :user);";
					$stmt = $pdo->prepare($query);
					$stmt->execute($param);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);

							
						if($user= $stmt->fetch()){
							
							
							$this->user_id = $user['user_id'];
							$this->current_equip = $user['curr_equip'];
							$this->character_id = $user['character_id'];
							$this->current_weapon = $user['curr_weapon'];
							$this->user_hp = $user['character_hp'];
							$this->current_stage = $user['curr_stage'];

							$level = $user['curr_stage'];
							$_SESSION['user'] = serialize($this);
							$this->username = $username;

							
							header("location:./../../main/scene".$level.".php");
						}
						else{

							if(isset($_SESSION['newuser'])){

								//unsetting previously loggin session
								unset($_SESSION['newuser']);
								unset($_SESSION['user']); 
							}

							$_SESSION['newuser'] = $username;
							header("location:./../../main/create.php");
						}



					} //end of if



			echo "account does not exist";
			
	}



		//getters

		public function getUserId(){
			return $this->user_id;
		}
		public function getCurrentStage(){	
			return $this->current_stage;
		}

		public function getCharacterId(){
			return $this->character_id;
		}

		public function getCurrentEquip(){
			return $this->current_equip;
		}

		public function getWeapon(){
			return $this->current_weapon;
		}

		public function setArmor($armor){
			$this->current_equip = $armor;
		}

		public function setWeapon($weapon){
			$this->current_weapon = $weapon;
		}
		
		public function getUserHp(){
			return $this->user_hp;
		}

		public function getUsername(){
			return $this->username;
		}
		// -- end


		/*
		** register function
		*/
		public function register($username,$pass){

			$db = Database::getInstance();
			$pdo = $db->getConnection();

			//verification
			$stmt = $pdo->prepare('SELECT * from user WHERE user_name = :user');	
			$stmt->execute(array(":user"=>$username));
			$count = $stmt->fetchColumn();
				if($count==0)
				{


					$params = array(":user"=>$username,":pass"=>$pass);
					$query = "INSERT INTO user (user_name,password)";
					$query.= "VALUES (:user,:pass);";
					$stmt = $pdo->prepare($query);
					session_start();
					$_SESSION['newuser'] = $username;
					
					if($stmt->execute($params))
					{	
						
						header("location:./../../main/create.php");
					}
					else
					{
						echo "failed to perform query";
					}
					echo "condition met!";
				}
				else
				{	echo $count; }
			echo "no results!";	
		}



//last bracket
}