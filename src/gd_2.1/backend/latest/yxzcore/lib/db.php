


<?php

// last update: 19:28 07.09.2023.

function connect($host, $port, $dbname, $username,
$password){

    try {

        $conn = new PDO("mysql:host=$host;port=$port;
        dbname=$dbname", $username, $password, [
        PDO::ATTR_PERSISTENT => true
        ]);
    
        $conn->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

        return $conn;
    
    } catch(PDOException $e){

        echo "Connection failed: ".$e->getMessage();

        return 0;

    }
   
}

?>