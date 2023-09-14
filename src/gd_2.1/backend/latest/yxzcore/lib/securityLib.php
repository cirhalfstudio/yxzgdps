


<?php

// last update: 15:29 08.09.2023.

class SecurityLib{

	public $db;
	//public $filter = null;

	public function baseGet($condition, $table,
	$parameter, $value){

		$query = $this->$db->prepare("SELECT $condition FROM
		$table WHERE $parameter = :$parameter");
		$query->execute([":$parameter"=>$value]);

		if(!$query->rowCount()){
			return 0;
		}

		$get = $query->fetchColumn();

		return $get;

	}

	public function log($value, $attr){

		$query = $this->$db->prepare("INSERT INTO logs
		VALUES (:value, :attr, :time)");
		$query->execute([":value"=>$value, ":attr"=>$attr,
		":time"=>time()])

	}

	public function getAttemptsFromIP(){

		$ip = $_SERVER["REMOTE_ADDR"];

		$attempts = $this->baseGet("value", "logs",
		"attr", $ip);

		if(!$attempts){

			$this->log("0", $ip);
			return 0;

		}
	
		return $attempts;

	}

	public function addAttemptFromIP(){

		$ip = $_SERVER["REMOTE_ADDR"];

		$query = $this->$db->prepare("UPDATE logs SET value = :value
		WHERE attr = :attr");
		$query->execute([":value"=>"{$attempts+1}", ":attr"=>$ip]);

	}

}

?>