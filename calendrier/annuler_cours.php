<?php
require_once 'config.php';

header('Content-Type: application/json');

// Configuration
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Vérifier la méthode
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

// Récupérer les données
$cours_id = isset($_POST['cours_id']) ? intval($_POST['cours_id']) : 0;
$date = isset($_POST['date']) ? trim($_POST['date']) : '';
$heure = isset($_POST['heure']) ? trim($_POST['heure']) : '';

// Valider les données
if(!$cours_id || !$date || !$heure) {
    echo json_encode(['success' => false, 'message' => 'Paramètres invalides ou manquants']);
    exit;
}

// Valider le format de la date
if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    echo json_encode(['success' => false, 'message' => 'Format de date invalide']);
    exit;
}

try {
    // Normaliser l'heure
    $heure = trim($heure);
    if(preg_match('/^\d{1,2}:\d{2}$/', $heure)) {
        $heure = $heure . ':00';
    }

    // Vérifier que le cours existe
    $stmt = $pdo->prepare("SELECT id FROM cours_hebdomadaires WHERE id = ?");
    $stmt->execute([$cours_id]);
    if(!$stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Cours non trouvé']);
        exit;
    }

    // Chercher la réservation
    $stmt = $pdo->prepare("
        SELECT * FROM reservations 
        WHERE cours_id = ? 
        AND date_cours = ? 
        AND (heure_debut = ? OR heure_debut LIKE ?)
        AND statut = 'confirmé'
    ");
    $heure_pattern = substr($heure, 0, 5) . '%';
    $stmt->execute([$cours_id, $date, $heure, $heure_pattern]);
    $reservation = $stmt->fetch();

    if(!$reservation) {
        echo json_encode(['success' => false, 'message' => 'Aucune réservation active trouvée pour ce créneau']);
        exit;
    }

    // Vérifier le délai d'annulation
    $cours_timestamp = strtotime($date . ' ' . $heure);
    $maintenant = time();

    if($cours_timestamp < $maintenant) {
        echo json_encode(['success' => false, 'message' => 'Impossible d\'annuler un cours déjà passé']);
        exit;
    }

    $heures_restantes = ($cours_timestamp - $maintenant) / 3600;

    if($heures_restantes < 12) {
        $heures_formatees = number_format($heures_restantes, 1);
        echo json_encode([
            'success' => false,
            'message' => "Annulation impossible moins de 12h avant le cours (il reste $heures_formatees heures)"
        ]);
        exit;
    }

    // Procéder à l'annulation
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("UPDATE reservations SET statut = 'annulé' WHERE id = ?");
    $stmt->execute([$reservation['id']]);

    if($stmt->rowCount() > 0) {
        $pdo->commit();
        echo json_encode([
            'success' => true,
            'message' => '✅ Cours annulé avec succès !'
        ]);
    } else {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Aucune modification effectuée']);
    }

} catch(PDOException $e) {
    if(isset($pdo)) {
        $pdo->rollBack();
    }
    echo json_encode(['success' => false, 'message' => 'Erreur technique lors de l\'annulation']);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'annulation']);
}
?>