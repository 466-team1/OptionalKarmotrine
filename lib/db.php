<?php

$config = parse_ini_file("../config/config.ini");
$username = $config['MYSQL_USER'];
$password = $config['MYSQL_PASSWORD'];
$dbname = $config['MYSQL_DATABASE'];

try 
{
    $dsn = "mysql:host=courses; dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(PDOException $e)
{ 
    echo "Connection to database failed: " . $e->getMessage();
}

?>