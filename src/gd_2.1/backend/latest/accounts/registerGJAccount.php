


<?php

// last update: 15:29 08.09.2023.

if(empty($_POST["userName"]) || empty($_POST["password"]) ||
empty($_POST["email"])) exit("-1");
	
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

$userName = $_POST["userName"];
$password = $_POST["password"];
$email = $_POST["email"];

$filter = new Filter();

if($filter->containsSpecial($userName)
|| $filter->containsSpecial($password)
|| $filter->containsSpecial($email, "@.") exit("-1");

if(strlen($userName) > 20) exit("-4");

$db = connect($host, $port, $dbname, $username, $password);

$seclib = new SecurityLib($db);
$acclib = new AccountsLib($db, $seclib);

if($acclib) exit("-2");

$encryptor = new Encryptor($encryptionKey);
$encrypted_password = $encryptor->encrypt($password);

$query = $db->prepare("INSERT INTO accounts (userName,
password, email, time)
VALUES (:userName, :password, :email, :time)");
$query->execute([":userName"=>$userName, ":password"=>
$password, ":email"=>$email, ":time"=>time()]);

echo "1";

?>