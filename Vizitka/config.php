<?php
$user = 'root'; 
$password = ''; 
$db = 'vcard'; 
$host = 'localhost'; 
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
