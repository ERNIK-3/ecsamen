<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        header("Location: index.php?error=invalid_id");
        exit();
    }
    
    $id = (int)$_POST['id'];
    
    try {
        if (isset($_POST['update']) && isset($_POST['new_quantity'])) {
            $new_quantity = (int)$_POST['new_quantity'];
            
            $stmt = $pdo->prepare("UPDATE product SET quantity = ? WHERE id = ?");
            $stmt->execute([$new_quantity, $id]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: index.php?success=product_quantity_updated");
            } else {
                header("Location: index.php?error=update_failed".$id);
            }
            exit();
        }

        elseif (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM product WHERE id = ?");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: index.php?success=product_deleted");
            } else {
                header("Location: index.php?error=delete_failed".$id);
            }
            exit();
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        header("Location: index.php?error=db_error".urlencode($e->getMessage()));
        exit();
    }
}

header("Location: index.php?error=invalid_request");
exit();
?>