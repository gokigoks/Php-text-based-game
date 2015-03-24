<?php


	class battle{

		$monster = array('monsterName'=>'','monsterHp'=>null,'monsterMoves'=>array(),'monsterRndDrop'=array());
		$monsterId;

		protected function __construct($monsterId){
			$this->monsterId=$monsterId;
			$monster = getMonster($monsterId);



		}

	}