<?php
require_once 'config.php';

header('Content-Type: application/json');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if(!isset($_GET['cours_id']) || !isset($_GET['date']) || !isset($_GET['heure'])) {
    echo json_encode([]);
    exit;
}

$cours_id = intval($_GET['cours_id']);
$date = trim($_GET['date']);
$heure = trim($_GET['heure']);

error_log("get_reservation - cours_id=$cours_id, date=$date, heure=$heure");

try {
    // Formater l'heure
    if(preg_match('/^\d{2}:\d{2}$/', $heure)) {
        $heure = $heure . ':00';
    }

    $stmt = $pdo->prepare("
        SELECT * FROM reservations 
        WHERE cours_id = ? AND date_cours = ? AND heure_debut = ? AND statut = 'confirmé'
    ");
    $stmt->execute([$cours_id, $date, $heure]);
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$reservation) {
        // Essayer sans les secondes
        $heure_sans_secondes = substr($heure, 0, 5);
        $stmt = $pdo->prepare("
            SELECT * FROM reservations 
            WHERE cours_id = ? AND date_cours = ? AND heure_debut LIKE ?
        ");
        $stmt->execute([$cours_id, $date, $heure_sans_secondes . '%']);
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    echo json_encode($reservation ?: []);

} catch(PDOException $e) {
    error_log("Erreur get_reservation: " . $e->getMessage());
    echo json_encode(['error' => $e->getMessage()]);
}
?>