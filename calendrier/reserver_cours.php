<?php
require_once 'config.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

$cours_id = isset($_POST['cours_id']) ? intval($_POST['cours_id']) : 0;
$date = isset($_POST['date']) ? trim($_POST['date']) : '';
$heure = isset($_POST['heure']) ? trim($_POST['heure']) : '';
$nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

if(empty($cours_id) || empty($date) || empty($heure) || empty($nom) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis']);
    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email invalide']);
    exit;
}

try {
    // Formater l'heure
    if(preg_match('/^\d{2}:\d{2}$/', $heure)) {
        $heure = $heure . ':00';
    }

    // Vérifier que l'heure est entre 7h et 20h
    $heure_num = intval(substr($heure, 0, 2));
    if($heure_num < 7 || $heure_num >= 20) {
        echo json_encode(['success' => false, 'message' => 'Les cours sont disponibles uniquement entre 7h et 20h']);
        exit;
    }

    // Vérifier que la date n'est pas dans le passé
    $aujourdhui = date('Y-m-d');
    if($date < $aujourdhui) {
        echo json_encode(['success' => false, 'message' => 'Impossible de réserver un cours dans le passé']);
        exit;
    }

    // Vérifier que la date n'est pas trop loin (max 2 mois)
    $date_reservation = strtotime($date);
    $date_max = strtotime('+2 months');

    if($date_reservation > $date_max) {
        echo json_encode(['success' => false, 'message' => 'Réservation possible uniquement dans les 2 prochains mois']);
        exit;
    }

    // Vérifier le cours
    $stmt = $pdo->prepare("
        SELECT c.*, p.nom as prof_nom, p.specialite 
        FROM cours_hebdomadaires c
        JOIN professeurs p ON c.professeur_id = p.id
        WHERE c.id = ?
    ");
    $stmt->execute([$cours_id]);
    $cours = $stmt->fetch();

    if(!$cours) {
        echo json_encode(['success' => false, 'message' => 'Cours non trouvé']);
        exit;
    }

    // Vérifier si déjà réservé
    $stmt = $pdo->prepare("
        SELECT * FROM reservations 
        WHERE cours_id = ? AND date_cours = ? AND heure_debut = ? AND statut = 'confirmé'
    ");
    $stmt->execute([$cours_id, $date, $heure]);

    if($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Ce créneau est déjà réservé']);
        exit;
    }

    // Calculer heure de fin
    $heure_debut_obj = DateTime::createFromFormat('H:i:s', $heure);
    if(!$heure_debut_obj) {
        $heure_debut_obj = DateTime::createFromFormat('H:i', $heure);
    }

    if(!$heure_debut_obj) {
        echo json_encode(['success' => false, 'message' => "Format d'heure invalide"]);
        exit;
    }

    $heure_fin_obj = clone $heure_debut_obj;
    $heure_fin_obj->modify('+' . $cours['duree_minutes'] . ' minutes');
    $heure_fin = $heure_fin_obj->format('H:i:s');

    // Insérer la réservation
    $stmt = $pdo->prepare("
        INSERT INTO reservations (cours_id, eleve_nom, eleve_email, date_cours, heure_debut, heure_fin, statut)
        VALUES (?, ?, ?, ?, ?, ?, 'confirmé')
    ");

    $result = $stmt->execute([$cours_id, $nom, $email, $date, $heure, $heure_fin]);

    if($result) {
        // Préparer les détails pour le message
        $details = [
            'professeur' => $cours['prof_nom'],
            'date' => date('d/m/Y', strtotime($date)),
            'heure' => substr($heure, 0, 5),
            'duree' => $cours['duree_minutes'],
            'email' => $email
        ];

        echo json_encode([
            'success' => true,
            'message' => 'Réservation effectuée avec succès ! Un email de confirmation a été envoyé.',
            'details' => $details
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'insertion']);
    }

} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur base de données']);
}
?>