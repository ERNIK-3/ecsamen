<link rel="stylesheet" href="styles.css">
<a href="index.php">На главную</a>
<form action="for-registered.php" method="POST">
    <label for="username">Имя:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <button type="submit">Зарегистрироваться</button>
</form>
