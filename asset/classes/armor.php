<?php
	///require 'item.php';
	require_once 'Database.php';
	require_once 'User.php';
	//namespace asset/classes/armor as Armor;
	session_start();
	
	class armor{
		protected $defense, $user,$current_equip;
		//protected $strReq,$intReq,$dexReq;
				
			public function __construct(){
				$this->user = $_SESSION['user'];
				$this->current_equip = $this->user->getCurrentEquip();
			}
			public function assignItem(){

			}
			
			public function getDefense(){
				$db = Database::getInstance();
				$mysqli = $db->getConnection();
				$query = "SELECT defense from armor ";
				$query .="WHERE armor_id = ".$this->current_equip.";";
				$result = $mysqli->query($query);
				$row = mysqli_fetch_assoc($result);	
				$this->defense = $row['defense'];

				return $this->defense;
			}
			
			public function setArmor($armor){
				$db = Database::getInstance();
				$mysqli = $db->getConnection();

				/*
				*
				*/
				$query = "UPDATE user ";
				$query .= "SET curr_equip = (SELECT armor_id from armor WHERE armor_name ='".$armor."')";
				$query .= "WHERE user_id = '".$this->user->getUserId()."'";
				$result = $mysqli->query($query);
				/**
				*get the new armor id
				*/
				$setUserArmor = "SELECT armor_id from armor WHERE armor_name ='".$armor."'";
				$result2 = $mysqli->query($setUserArmor);
				$row = mysqli_fetch_assoc($result2);	
				$this->user->setArmor($row['armor_id']);
				$_SESSION['user'] = $this->user;
				return $setUserArmor;
			}
			

	
//last bracket		
	}