<?php
	require_once 'Database.php';
	require_once 'User.php';
	require_once 'Character.php';


	class inventory{
		protected $user_id;
		public function __construct(){
			$user =  unserialize($_SESSION['user']);
			$this->user_id = $user->getUserId();
			$query =

		}


	}