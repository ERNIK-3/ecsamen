<?php
echo 'Привет '. htmlspecialchars($_POST["name"]) . '!';
echo 'Вы ищите ' . htmlspecialchars($_POST["mess"]) . '!';
echo 'Вы выбрали ' . htmlspecialchars($_POST["file"]) . '!';
echo htmlspecialchars($_POST["email"]);
$to =  "007@gmail.com";
$subject = "Сообщение с вашего сайта";
$email = $_POST["email"];
$body = "Имя: " - $name . "\nEmail: " . $email . "\nСообщение: \n" . $mess;
$headers = "From: " . $email;
mail($to, $subject, $body, $headers);