<?php

	require 'Object.php';

	interface battle {
		
		public function attack(Object $obj);
		public function calculateDefense();
		public function getDefense();
		public function getCurrentHp();
		public function getMaxHp();
		public function getMessage();
		public function calculateAttack();
			
	}