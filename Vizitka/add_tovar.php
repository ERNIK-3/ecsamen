<?php
include 'config.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $qual = $_POST['qual'];

    $stmt = "INSERT INTO tovar (category, type, size, qual) VALUES (?,?,?,?)";
    $stmt = $pdo->prepare($stmt);
    $rowsNumber = $stmt->execute(array($category, $type, $size, $qual));
    if ($rowsNumber) {
        header('Location: /');
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
 }