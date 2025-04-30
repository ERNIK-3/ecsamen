<?php

var_dump($_POST["message"]);
die();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"]);  
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);


    if (empty($name) || empty($email) || empty($message)) {
        $error = "Пожалуйста, заполните все поля.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Некорректный email.";
    } else {

        echo "<h2>Полученные данные:</h2>";
        echo "<p><strong>Имя:</strong> " . $name . "</p>";
        echo "<p><strong>Email:</strong> " . $email . "</p>";
        echo "<p><strong>Сообщение:</strong> " . $message . "</p>";

       
        $to = "007@gmail.com@gmail.com"; 
        $subject = "Сообщение с вашего сайта";
        $body = "Имя: " . $name . "\nEmail: " . $email . "\nСообщение:\n" . $message;
        $headers = "From: " . $email;
        mail($totoi, $subject, $body, $headers);
    }
}
?>
