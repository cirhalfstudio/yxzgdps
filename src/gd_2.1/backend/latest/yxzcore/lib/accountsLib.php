


<?php

// last update: 10:36 27.09.2023.

class AccountsLib{

	public $seclib;
	public $xor = null;

	public function IDexists($accountID){
		return $this->$seclib->baseGet("accountID", "accounts",
		"accountID", $accountID);
	}

	public function isActive($accountID){
		return $this->$seclib->baseGet("isActive", "accounts",
		"accountID", $accountID);
	}

	public function getUserID($accountID, $userName){

		$userID = $this->$seclib->baseGet("userID", "users",
		"accountID", $accountID);
		
		if($userID) return $userID;

		$isRegistered = $this->$seclib->$filter->
		containsString($userID) ? 1 : 0;

		$query = $this->$seclib->$db->prepare("INSERT INTO
		users (accountID, userName, isRegistered)
		VALUES (:accountID, :userName, :isRegistered)")
		$query->execute([":accountID"=>$accountID,
		":userName"=>$userName, ":isRegistered"=>$isRegistered]);

		return $this->$seclib->$db->lastInsertId();

	}

	public function verifyPassword($accountID, $password){

		if(!$this->IDexists($accountID)) return 0;
		if($this->$seclib->getAttemptsFromIP() > 5) return 0;

		$get_password = $this->$seclib->baseGet("password", "accounts",
		"accountID", $accountID);

		if($password !== $get_password){

			$this->$seclib->addAttemptFromIP();

			return 0;

		}

		return 1;

	}

	public function GJPcheck($accountID, $gjp){

		if(!$this->isActive($accountID)) return 0;
		if($this->getAttemptsFromIP() > 5) return 0;

		$decoded_gjp = $this->$xor->cipher(
		base64_decode(
		str_replace("-", "+",
		str_replace("_", "/", $gjp))), 37526)

		$password = $this->$seclib->baseGet("password", "accounts",
		"accountID", $accountID);

		if($decoded_gjp !== $password){

			$this->$seclib->addAttemptFromIP();

			return 0;

		}

		return 1;

	}

}

?>