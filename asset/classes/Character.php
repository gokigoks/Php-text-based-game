<?php
	require_once 'Database.php';
	require_once 'armor.php';
	require_once 'User.php';
	require_once 'battle_engine.php';
	require_once 'experienceHandler.php';

    
	class Character implements battle, Object{


		/*
		*	This class is serialized and persisted
		*
		*
		**/

		protected $character_id, $current_equip, $current_weapon,$user_id,$defense,$curr_hp,$max_hp, $attack,$msg,$current_stage,$class,$character_level;
		protected $user,$weapon_name,$critical,$gold,$exp;
		protected $str,$dex,$int;
		

		public function __construct(){
				


				if(isset($_SESSION['user'])){

				$this->user = unserialize($_SESSION['user']);
				
				$this->curr_hp = $this->user->getUserHp();
				$this->max_hp = $this->user->getUserHp(); 
				$this->user_id = $this->user->getUserId();
				$this->attack = $this->getAttack();
				$this->defense = $this->getDefense();
				$_SESSION['character'] = serialize($this); 	
					self::getStats(); //assigning current stats
				
				}
				else
				{
					echo "user not logged in";
					header("location:./../../main/login.php");

				}

				
		}

		public function updateCharacter(){


				$db= Database::getInstance();
	 			$pdo = $db->getConnection();
				$query = "SELECT character_str, character_dex, character_int ,class,character_level,weapon,equipped, curr_stage from character_table";
				$query.= " WHERE user_id = :user";

				$stmt = $pdo->prepare($query);
				$stmt->execute(array(':user'=>$this->user_id));
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$row = $stmt->fetch();
				$this->class = $row['class'];
				$this->str = $row['character_str'];
				$this->dex = $row['character_dex'];
				$this->int = $row['character_int'];
				$this->character_level = $row['character_level'];
				$this->current_stage = $row['curr_stage'];
				$this->current_equip = $row['equipped'];
				$this->current_weapon = $row['weapon'];		
				unset($_SESSION['enemy_hp']);
		}

		public function getStats(){

			//gathering stats for the player
 			$db= Database::getInstance();
 			$pdo = $db->getConnection();
			$query = "SELECT character_str, character_dex, character_int ,class,character_level,weapon,equipped from character_table";
			$query.= " WHERE user_id = :user";

			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':user'=>$this->user_id));
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$row = $stmt->fetch();
			
			$this->str = $row['character_str'];
			$this->dex = $row['character_dex'];
			$this->int = $row['character_int'];
			$this->class = $row['class'];
			unset($attack,$defense);

			$this->current_equip = $row['equipped'];
			$this->current_weapon = $row['weapon'];


		}

		public function getClassName(){
			return $this->class;
		}

		public function getCurrentStage(){

			if(!isset($this->current_stage)){
				$db= Database::getInstance();
	 			$pdo = $db->getConnection();
				$query = "SELECT curr_stage from character_table";
				$query.= " WHERE user_id = :user";
				$stmt = $pdo->prepare($query);
				$stmt->execute(array(':user'=>$this->user_id));
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$row = $stmt->fetch();

				$this->current_stage = $row['curr_stage'];
			
				}
			$_SESSION['current_stage'] = $this->current_stage;

			return $this->current_stage;
		}



		public static function makeCharacter($class){

			 $db = Database::getInstance();
			 $pdo = $db->getConnection();
			 $user = $_SESSION['newuser'];	 
				 //getting required data

			 
			 	$search = "SELECT u.user_id, u.password, c.equip, c.weapon, c.start_hp,c.start_str,c.start_dex, c.start_int  FROM classes c, user u";
			 	$search.= " WHERE c.classes_name = :class AND u.user_id = (SELECT user_id FROM user WHERE user_name = :username);";
			 	$stmt = $pdo->prepare($search);
			 	$stmt->execute(array(':class'=>$class ,'username'=> $user));
			 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
			 	$data = $stmt->fetch();	


			 	$user_id = $data['user_id'];
			 	$password = $data['password'];
			 	$equip = $data['equip'];
			 	$weapon = $data['weapon'];
			 	$start_hp = $data['start_hp'];
			 	$str = $data['start_str'];
			 	$dex = $data['start_dex'];
			 	$int = $data['start_int'];

					 		//populate 2 tables (user,character)
					 $query = "UPDATE user SET curr_equip = :equip, ";
					 $query.= "curr_weapon = :weapon, ";
					 $query.= "class = :class ";
					 $query.= "WHERE user_id = :user";
					 $stmt2 = $pdo->prepare($query);
					
						if( $stmt2->execute(array(':equip'=>$equip,':weapon'=>$weapon,':class'=>$class,':user'=>$user_id)))
						{
							
							$query2 = "INSERT INTO character_table (user_id,character_str,character_dex,character_int,character_hp,equipped,weapon)";
							$query2.= "VALUES( :user , :str , :dex , :int , :hp , :equip , :weapon);";
							$stmt2 = $pdo->prepare($query2);
							$params = array(':user'=>$user_id,':str'=>$str,':dex'=>$dex,':int'=>$int,':hp'=>$start_hp,':equip'=>$equip,':weapon'=>$weapon);
							

							if($stmt2->execute($params)){
								
								$new = new User();	
								$new->verifyLogin($user,$password);

							}


						}
						else{
							return "error! something bad happened.. ";
						}

					}

						//end of function
		
		/*
		** START OF SETTERS AND GETTERS
		*/


		public function getMessage(){
			return $this->msg;
		}

		public function getCurrentEquip(){

		}

		public function getUserId() {

			return $this->user_id;
		}

		public function getDefense(){
			if(!isset($this->defense)){
			$db = Database::getInstance();
			$pdo = $db->getConnection();
			$query = "SELECT defense from armor ";
			$query .="WHERE armor_id = :armor;";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(':armor'=>$this->current_equip));
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$row = $stmt->fetch();
			$this->defense = $row['defense'];

			}

			return $this->defense;
		}

		public function getAttack(){
			
			if(!isset($this->attack)){
				$db = Database::getInstance();
				$pdo = $db->getConnection();
				$query = "SELECT damage from weapon ";
				$query .="WHERE weapon_id = :weapon;";
				$stmt = $pdo->prepare($query);
				$stmt->execute(array(':weapon'=>$this->current_weapon));
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$row = $stmt->fetch();
				$this->attack = $row['damage'];
			}
			return $this->attack;
		}
	

		public function getEquipped(){
			
			
			return $this->user->current_equip;

			
		}

		public function advanceCurrentStage(){

				$db = Database::getInstance();
				$pdo = $db->getConnection();
				$this->current_stage += 1; //advancing the stage of the user
				/*
				*
				*/
				$query = "UPDATE character_table ";
				$query .= "SET curr_stage = :stage";
				$query .= "WHERE user_id = :user ";
				$stmt1 = $pdo->prepare($query);
				$stmt1->execute(array(':stage'=>$this->current_stage, ':user'=>$this->user->getUserId()));

		}

		public function getWeaponName(){

			if(!isset($this->weapon_name))
				{
					$db = Database::getInstance();
					$pdo = $db->getConnection();
					$query = "SELECT weapon_name from weapon ";
					$query.= "WHERE weapon_id = :weapon";
					$stmt = $pdo->prepare($query);
					$stmt->execute(array(':weapon'=>$this->current_weapon));
					$weapon = $stmt->fetch(PDO::FETCH_ASSOC);
					$this->weapon_name = $weapon['weapon_name'];
				}
			return $this->weapon_name;			

		}

		public function getCharacterLevel(){

			return $this->character_level;

		}

		public function _setArmor($armor){	

				$db = Database::getInstance();
				$pdo = $db->getConnection();

				/*
				*
				*/
				$query = "UPDATE user ";
				$query .= "SET curr_equip = (SELECT armor_id from armor WHERE armor_name =:armor)";
				$query .= "WHERE user_id = :user ";
				$stmt1 = $pdo->prepare($query);
				$stmt1->execute(array(':armor'=>$armor, ':user'=>$this->user->getUserId()));
				//$result = $mysqli->query($query);
				/**
				*get the new armor id
				*/
				$setUserArmor = "SELECT armor_id, defense from armor WHERE armor_name = :armor";
				$stmt2 = $pdo->prepare($setUserArmor);
				$stmt2->execute(array(':armor'=>$armor));
				$stmt2->setFetchMode(PDO::FETCH_ASSOC);
				$result = $stmt2['armorid'];
				$this->defense = $stmt2['defense'];
				
				$this->user->setArmor($result);
				$_SESSION['user'] = $this->user;

				return $setUserArmor;

		}

		public function setWeapon($weapon){

				$db = Database::getInstance();
				$pdo = $db->getConnection();

				/*
				*
				*/
				$query = "UPDATE user ";
				$query .= "SET curr_equip = (SELECT weapon_id from armor WHERE armor_name =:weapon)";
				$query .= "WHERE user_id = :user ";
				$stmt1 = $pdo->prepare($query);
				$stmt1->execute(array(':weapon'=>$weapon, ':user'=>$this->user->getUserId()));
				//$result = $mysqli->query($query);
				/**
				*get the new armor id
				*/
				$setWeapon = "SELECT weapon_id,weapon_name, damage from armor WHERE weapon_name = :weapon";
				$stmt2 = $pdo->prepare($setUserArmor);
				$stmt2->execute(array(':armor'=>$armor));
				$stmt2->setFetchMode(PDO::FETCH_ASSOC);
				$result = $stmt2['weapon_id'];
				$damage = $stmt2['damage'];
				
				$this->user->setWeapon($result);
				$this->attack = $damage;
				$_SESSION['user'] = $this->user;
				$this->weapon_name = $stmt2['weapon_name'];
				
				return $damage;

		}


		public function getStr(){

			return $this->str;
		}


		public function getDex(){

			return $this->dex;
		}


		public function getInt(){

			return $this->int;
		}


		public function getCurrentHp(){

			if(!isset($_SESSION['user_hp'])){
			$_SESSION['user_hp'] = $this->max_hp;
			}
			return $_SESSION['user_hp'];
		}


		public function getMaxHp(){
			return $this->max_hp;
		}


		public function setHp($hp){
			$_SESSION['user_hp'] = $hp;
		}

		/*
		** END OF SETTERS AND GETTERS
		*/

		public function calculateAttack(){


			if($this->class == 'warrior'){

				$dominant_stat = $this->str;
				$multiplier = 10;

			}elseif($this->class == 'rogue'){

				$dominant_stat = $this->dex;
				$multiplier = 12;

			}elseif($this->class == 'mage'){

				$dominant_stat = $this->int;
				$multiplier = 15;
			}

				/*
				*	creates a range for the overall damage
				*/
				$min_attack = round($this->getAttack()*.70);

				
				$max_attack = round($this->getAttack()*1.20);


				$final = rand($min_attack,$max_attack);
				$final += round($final* ($dominant_stat/100+1));

				/*  last addition
				*	adds damage based on level 
				*	so that character will not be too dependent on equipment
				**/
				$final += $final + $this->character_level * $multiplier;

				return $final;

			}


			public function calculateDefense() {

				$defense = $this->defense + $this->defense * ($this->str/100);

				return $defense;

			}



			public function Dodge(){

				  $dodge = $this->dex;

				  if($dodge > 40) { $dodge = 40; }

				  if(rand(0,150) > 150-$dodge)
				  {
				  	return true;
				  }

				return false;	  
			}



			public function getCritical(){

				$chances = rand(0,100);

				if($this->dex > $chances){

					$this->critical = round(rand($this->getAttack()/2,$this->getAttack()));
					$critMsg = 'CRITICAL HIT ! <br>';
					return $this->critical;

				}
				else
				{
					return 0;
				}


			}

			public function getGold(){
				

					if(!isset($this->gold)){
						$db = Database::getInstance();
						$pdo = $db->getConnection();
						$query = "SELECT current_gold from character_table ";
						$query .="WHERE user_id = :user;";

						$stmt = $pdo->prepare($query);
						$stmt->execute(array(':user'=>$this->user->getUserId()));
						$stmt->setFetchMode(PDO::FETCH_ASSOC);

						$row = $stmt->fetch();
						$this->gold = $row['current_gold'];
					}	

				return $this->gold;

			}

			/*
			**
				@
			*
			*/


			public function flee(){

			$level = $_SESSION['current_stage'];
				$num = rand(0,10);
				$link = "flee successful! <br>";
				$link .= "<a href='scene".$level.".php'>back to town</a>";


					if($num>5) {
						
						$link = "flee successful! <br>";
						$link .= "<a href='scene".$level.".php'>back to town</a>";

								
						return $link;
					}

				return "you failed to escape! <br>";
			}

			/*
			**

			*
			*
			*/

			public function Win(Object $target){

				$gold = $target->getGold();
				$exp = $target->getExp();
				$user = $this->user_id;
				$db = Database::getInstance();
				$pdo = $db->getConnection();


				$params = array(':gold'=>$gold,':user'=>$user);
					$query = "UPDATE character_table ";
					$query.= "SET current_gold = current_gold + :gold ,";
					$query.= "curr_stage = curr_stage + 1 ";
					$query.= "WHERE user_id = :user";

				$_SESSION['outcome'] = true;


				//$this->updateCharacter();	
				
				$stmt = $pdo->prepare($query);
				$stmt->execute($params);

				$expHandler = new ExperienceHandler($this,$target);
				$expHandler->handle();
				
				$this->getStats();
				$_SESSION['current_stage'] += 1;
				$level = $this->current_stage + 1;
				$msg= "<a href='scene".$level.".php'>";
				return "<a href='scene".$level.".php'>proceed to next town</a>";

			}


			/*
			**
			*	
			**
			*/

			public function attack(Object $target){
				var_dump($this->calculateAttack());
				var_dump($this->class);

				$attack = ($this->calculateAttack()  - $target->calculateDefense()) + $this->getCritical();
				if($target->getCurrentHp() > $attack)
				{	
					$target->setHp($target->getCurrentHp() - $attack);
					
					if($target->getCurrentHp()==0 || $target->getCurrentHp()<0){
						

						
						$this->msg =  $target->getName().' has been defeated!! you get '.$taret->getGold().' gold pieces!!<br>';
						$this->msg .="proceed journey";
						
					}	
					
					$this->msg = 'you used your '.$this->getWeaponName().' to attack and dealt '.$attack.' damage';
					
				}
				else
				{	
					$target->setHp(0);
					$level = $this->user->getCurrentStage();
					$this->msg = "enemy has been defeated!<br>";
					
						
					$this->msg .=" you are received ".$target->getGold()."gold and ".$target->getExp()." experience!! <br>";
					$this->msg.= "</br>".$this->Win($target);
					//$this->msg .= "<a href='./scenes/scene".$level.".php'>next level!</a>";

					

				}

				return;
			}
		

		public function clearedStage(){


		}


//last curly brace
	}