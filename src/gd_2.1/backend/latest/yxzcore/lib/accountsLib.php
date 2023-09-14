


<?php

// last update: 15:29 08.09.2023.

class AccountsLib{

	public $db;
	public $seclib;

	public function isActive($accountID){

		return $this->$seclib->baseGet("isActive", "accounts",
		"accountID", $accountID);

	}

	public function verifyPassword($accountID, $password){

		if($this->$seclib->getAttemptsFromIP() > 5) return 0;

		$get_password = $this->$seclib->baseGet("password", "accounts",
		"accountID", $accountID);

		if($password !== $get_password){

			$this->$seclib->addAttemptFromIP();

			return 0;

		}

		return 1;

	}

}

?>