<!DOCTYPE html>
<html lang="ru"  id = "html">
<link rel="stylesheet" href="styles.css">
<a href="index.php">На главную</a>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <link rel="" href="index.html">
        <title>Circle - Free HTML Template</title>
    </head>
<body>
<h1>Введите ваши данные</h1>
    <form action="send.php" method="POST">
        <label for="name">Имя:</label><br>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="age">Возраст:</label><br>
        <input type="number" name="age" id="age" required><br><br>
        
        <label for="phone">Телефон:</label><br>
        <input type="tel" name="phone" id="phone" required><br><br>
        
        <input type="hidden" name="upper" value ="">
        
        <input type="submit" value="Отправить">
    </form>
</body>