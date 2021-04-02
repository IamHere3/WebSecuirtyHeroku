<?php

$host = "ec2-3-211-37-117.compute-1.amazonaws.com";
$user = "xdirfqqbivnlvo";
$password = "d2a96e5fc52efc75c15678f4e581aa9783481cf9af49083248ca25834b559a1a";
$dbname = "d81l6hfqatknea";
$port = "5432";

try{
  //Set DSN data source name
    $dsn = "pgsql:host=" . $host . ";port=" . $port .";dbname=" . $dbname . ";user=" . $user . ";password=" . $password . ";";


  //create a pdo instance
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}
  ?>