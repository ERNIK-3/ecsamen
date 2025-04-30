<?php
var_dump($_POST);
include 'config.php';
include 'add_table_users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
try{
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $password, $email])) {
        echo "Регистрация выполнена!";
    } else {
        echo "Ошибка регистрации! : " . implode(", ", $stmt->errorInfo());
    }
    } catch (PDOException $e){
        echo "Ошибка базы данных: " . $e->getMessage();
    }
}
?>