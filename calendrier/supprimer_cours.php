<?php
require_once 'config.php';

if(isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM cours_hebdomadaires WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header('Location: admin.php');
exit;
?>
