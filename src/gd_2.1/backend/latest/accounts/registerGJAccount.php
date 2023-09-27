


<?php

// last update: 10:36 27.09.2023.

if(empty($_POST["userName"]) ||
empty($_POST["password"]) ||
empty($_POST["email"])) exit("-1");
	
require_once __DIR__."/../yxzcore/
config/security.php";
require_once __DIR__."/../yxzcore/
lib/securityLib.php";
require_once __DIR__."/../yxzcore/
lib/encryptor.php";
require_once __DIR__."/../yxzcore/
lib/filter.php";
require_once __DIR__."/../yxzcore/
config/connection.php";
require_once __DIR__."/../yxzcore/
lib/db.php";

$db = connect($host, $port, $dbname, $username, $password);
$seclib = new SecurityLib($db);
$acclib = new AccountsLib($seclib);
$filter = new Filter();
$encryptor = new Encryptor($encryptionKey);

$userName = $_POST["userName"];
$password = $_POST["password"];
$email = $_POST["email"];

if($filter->containsSpecial($userName)
|| $filter->containsSpecial($password)
|| $filter->containsSpecial($email, "@.-_") exit("-1");

if(strlen($userName) > 20) exit("-4");

if($seclib->baseGet("userName", "accounts",
"userName", $userName)) exit("-2");

$encrypted_password = $encryptor->encrypt($password);

$query = $db->prepare("INSERT INTO accounts (userName,
password, email, time)
VALUES (:userName, :password, :email, :time)");
$query->execute([":userName"=>$userName, ":password"=>
$password, ":email"=>$email, ":time"=>time()]);

echo "1";

?>