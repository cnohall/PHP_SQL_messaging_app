<?php
$db_user = "root";
$db_pass = "";
$db_name = "mysql";
try {
    $connect = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    }
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>