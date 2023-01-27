<?php

$username = 'z1951125';
$password = '2000Mar30';

try 
{
    $dsn = "mysql:host=courses; dbname=z1951125";
    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(PDOException $e)
{ 
    echo "Connection to database failed: " . $e->getMessage();
}

?>