<?php
require_once 'config.php';

if(!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID manquant']);
    exit;
}

$stmt = $pdo->prepare("
    SELECT c.*, p.nom as prof_nom, p.specialite 
    FROM cours_hebdomadaires c
    JOIN professeurs p ON c.professeur_id = p.id
    WHERE c.id = ?
");
$stmt->execute([$_GET['id']]);
$cours = $stmt->fetch();

if($cours) {
    echo json_encode($cours);
} else {
    echo json_encode(['error' => 'Cours non trouvé']);
}
?>