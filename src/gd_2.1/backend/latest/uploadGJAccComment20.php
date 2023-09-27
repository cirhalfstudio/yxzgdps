


<?php

// last update: 10:36 27.09.2023.

if(empty($_POST["accountID"]) ||
empty($_POST["gjp"]) ||
empty($_POST["userName"]) ||
empty($_POST["comment"])) exit("-1");

require_once __DIR__."/yxzcore/
config/security.php";
require_once __DIR__."/yxzcore/
lib/securityLib.php";
require_once __DIR__."/yxzcore/
lib/accountsLib.php";
require_once __DIR__."/yxzcore/
lib/filter.php";
require_once __DIR__."/yxzcore/
lib/XORCipher.php";
//@TODO
//require_once __DIR__."/yxzcore/
//lib/commandsHandler.php";
require_once __DIR__."/yxzcore/
config/connection.php";
require_once __DIR__."/yxzcore/
lib/db.php";

$db = connect($host, $port, $dbname, $username, $password);
$filter = new Filter();
$seclib = new SecurityLib($db, $filter);
$xor = new XORCipher();
$acclib = new AccountsLib($seclib, $xor)
//@TODO
//$cmds = new CommandsHandler($seclib);

if($filter->containsString($accountID) ||
$filter->containsSpecial($userName)) exit("-1");

$accountID = $_POST["accountID"];
$gjp = $_POST["gjp"];
$userName = $_POST["userName"];
$comment = base64_decode($_POST["comment"]);

if(!$seclib->GJPcheck($accountID, $gjp)) exit("-1");

$userID = $acclib->getUserID($accountID, $userName);

//@TODO
//if($cmds->executeProfileCommand($accountID,
//$comment)) exit("-1");

$query = $db->prepare("INSERT INTO acccomments
(userID, userName, comment, time)
VALUES (:userID, :userName, :comment, :time)");
$query->execute([":userID"=>$userID,
":userName"=>$userName, ":comment"=>$comment,
":time"=>$time]);

?>