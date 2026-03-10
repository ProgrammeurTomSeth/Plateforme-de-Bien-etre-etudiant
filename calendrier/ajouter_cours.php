<?php
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        INSERT INTO cours_hebdomadaires (professeur_id, titre, jour_semaine, heure_debut, duree_minutes)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST['professeur_id'],
        $_POST['titre'],
        $_POST['jour_semaine'],
        $_POST['heure_debut'] . ':00',
        $_POST['duree_minutes']
    ]);
}

header('Location: admin.php');
exit;
?>