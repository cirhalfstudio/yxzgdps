


<?php

// last update: 13:56 08.09.2023.

if(empty($_POST["userName"]) || empty($_POST["password"])
|| empty($_POST["udid"])) exit("-1");

require_once dirname(__FILE__)."/../yxzcore/
config/security.php";
require_once dirname(__FILE__)."/../yxzcore/
lib/securityLib.php";
require_once dirname(__FILE__)."/../yxzcore/
lib/encryptor.php";
require_once dirname(__FILE__)."/../yxzcore/
lib/filter.php";
require_once dirname(__FILE__)."/../yxzcore/
config/connection.php";
require_once dirname(__FILE__)."/../yxzcore/
lib/db.php";
require_once dirname(__FILE__)."/../yxzcore/
lib/accountsLib.php";

$filter = new Filter();

$userName = $filter->clearSpecial($_POST["userName"]);
$password = $filter->clearSpecial($_POST["password"]);
$udid = $filter->clearSpecial($_POST["udid"]);

$db = connect($host, $port, $dbname, $username, $password);

$seclib = new SecurityLib($db);
$acclib = new AccountsLib($db, $seclib);

$accountID = $acclib->baseGet("accountID", "accounts",
"userName", $userName);
if(!accountID) exit("-1");

if(!acclib->isActive($accountID)) exit("-2");

if(!$acclib->verifyPassword($accountID, $password)) exit("-12");

$userID = $acclib->baseGet("userID", "users",
"accountID", $accountID);

if(!userID){

	$query = $db->prepare("INSERT INTO users (accountID,
	userName) VALUES (:accountID, :userName)");
	$query->execute([":accountID"=>$accountID,
	":userName"=>$userName]);
	
	$userID = $db->lastInsertId();

}

$result = "$accountID,$userID";
echo $result;

$seclib->log($result, $userName);

if(!is_numeric($udid)){

	$userID2 = $seclib->baseGet("userID", "users",
	"accountID", $udid);

	$query = $db->prepare("UPDATE levels SET userID = :userID2,
	accountID = :accountID WHERE userID = :userID");
	$query->execute([":userID2"=>$userID2, ":accountID"=>$accountID,
	":userID"=>$userID]);

}

?>