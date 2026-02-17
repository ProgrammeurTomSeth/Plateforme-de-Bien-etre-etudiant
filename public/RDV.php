<?php
$pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// Date sélectionnée par l'utilisateur
$date = isset($_GET['date']) ? $_GET['date'] : null;

$profs = [];
if($date) {
    $stmt = $pdo->prepare("
        SELECT p.id_professionel, CONCAT(p.prenom, ' ', p.nom) AS nom_professionel, p.specialiste, r.date_rdv, r.status_rdv
        FROM PROFESSIONEL p
        LEFT JOIN RENDEZ_VOUS r 
            ON p.id_professionel = r.id_professionel 
            AND DATE(r.date_rdv) = :date
            AND r.status_rdv NOT IN ('annule')
        WHERE p.statut_site = 'actif'
        ORDER BY p.nom, r.date_rdv
    ");
    $stmt->execute(['date' => $date]);
    $rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Regrouper par professionnel
    foreach($rdvs as $r) {
        $profs[$r['id_professionel']]['nom'] = $r['nom_professionel'];
        $profs[$r['id_professionel']]['specialiste'] = $r['specialiste'];
        $profs[$r['id_professionel']]['rdvs'][] = $r['date_rdv'];
    }
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bien-être Étudiant</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">
    <style>
        body { font-family: Arial, sans-serif; margin:0; padding:0; }
        nav { background:#2a9d8f; padding:10px; color:white; }
        nav a { color:white; margin-right:15px; text-decoration:none; }
        .container { padding:20px; }
        h2 { color:#264653; }
        ul { list-style:none; padding-left:0; }
        li { margin-bottom:5px; }
        .calendar-section { margin-bottom:20px; }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="../css/bien-être%20étudiant%20(1)_page-0001.jpg" alt="Bien-être Étudiant" width="150">
        </div>
        <a href="#">Accueil</a>
        <a href="Professionnel.php">Professionnels</a>
        <a href="RDV.php">Prendre RDV</a>
        <a href="FAQ.php">FAQ</a>
    </div>
</nav>

<div class="container">
    <h1>Bienvenue sur Bien-être Étudiant</h1>
    <p>Choisissez un jour pour voir les disponibilités des professionnels :</p>

    <div class="calendar-section">
        <input type="date" id="date-picker" min="<?= date('Y-m-d') ?>" value="<?= $date ?? '' ?>">
        <button id="voir-disponibilites">Voir Disponibilités</button>
    </div>

    <?php if($date): ?>
        <h2>Disponibilités pour le <?= date('d/m/Y', strtotime($date)) ?></h2>
        <?php if(!empty($profs)): ?>
            <?php foreach($profs as $id => $p): ?>
                <h3><?= $p['nom'] ?> (<?= $p['specialiste'] ?>)</h3>
                <ul>
                    <?php
                    for($h=9; $h<=18; $h++) {
                        $heure = sprintf("%02d:00:00", $h);
                        $rdvPris = false;
                        if(!empty($p['rdvs'])) {
                            foreach($p['rdvs'] as $r) {
                                if(substr($r, 11, 8) == $heure) {
                                    $rdvPris = true;
                                    break;
                                }
                            }
                        }
                        if($rdvPris) {
                            echo "<li>$heure - Occupé</li>";
                        } else {
                            echo "<li>$heure - <a href='PrendreRDV.php?id_pro={$id}&date={$date}&heure={$heure}'>Disponible</a></li>";
                        }
                    }
                    ?>
                </ul>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun professionnel actif trouvé pour cette date.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    document.getElementById('voir-disponibilites').addEventListener('click', function() {
        const date = document.getElementById('date-picker').value;
        if(date) {
            window.location.href = `?date=${date}`;
        } else {
            alert('Veuillez sélectionner une date.');
        }
    });
</script>

<footer class="footer" style="background:#264653; color:white; padding:20px; text-align:center;">
    &copy; 2025 Bien-être Étudiant
</footer>
</body>
</html>