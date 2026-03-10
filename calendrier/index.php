<?php
require_once 'config.php';

// Récupérer le mode d'affichage (mois ou semaine)
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'mois';

// Récupérer le mois et l'année depuis l'URL, ou utiliser la date actuelle
$mois = isset($_GET['mois']) ? intval($_GET['mois']) : intval(date('n'));
$annee = isset($_GET['annee']) ? intval($_GET['annee']) : intval(date('Y'));

// Date actuelle pour le contexte
$date_actuelle = new DateTime();
$jour_actuel = intval($date_actuelle->format('d'));
$mois_actuel = intval($date_actuelle->format('n'));
$annee_actuelle = intval($date_actuelle->format('Y'));
$aujourdhui = $date_actuelle->format('Y-m-d');

// Créer un objet DateTime pour le premier jour du mois
$date = new DateTime();
$date->setDate($annee, $mois, 1);
$premier_jour = clone $date;

// Nom du mois en français
$mois_noms = [
        1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
        5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
        9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
];

// Navigation mois précédent/suivant
$mois_precedent = $mois - 1;
$annee_precedente = $annee;
if ($mois_precedent < 1) {
    $mois_precedent = 12;
    $annee_precedente--;
}

$mois_suivant = $mois + 1;
$annee_suivante = $annee;
if ($mois_suivant > 12) {
    $mois_suivant = 1;
    $annee_suivante++;
}

// Navigation par semaine
$semaine_offset = isset($_GET['semaine']) ? intval($_GET['semaine']) : 0;

// Calculer la date du début de semaine actuelle (lundi)
$date_debut_semaine = new DateTime();
$date_debut_semaine->setISODate($annee_actuelle, date('W') + $semaine_offset, 1);

$semaine_precedente = $semaine_offset - 1;
$semaine_suivante = $semaine_offset + 1;

// Calculer les dates de la semaine à afficher
$dates_semaine = [];
for ($i = 0; $i < 7; $i++) {
    $date_jour = clone $date_debut_semaine;
    $date_jour->modify("+$i days");
    $dates_semaine[] = [
            'date' => $date_jour->format('Y-m-d'),
            'jour_num' => $date_jour->format('d'),
            'mois' => $date_jour->format('n'),
            'annee' => $date_jour->format('Y'),
            'jour_semaine' => $i,
            'jour_nom' => getJourFrancais($i)
    ];
}

// Construction des URLs
function buildUrl($params) {
    return '?' . http_build_query(array_merge($_GET, $params));
}

// URLs pour le mode mois
$url_mois = buildUrl(['mode' => 'mois', 'semaine' => null]);
$url_mois_precedent = buildUrl(['mode' => 'mois', 'mois' => $mois_precedent, 'annee' => $annee_precedente, 'semaine' => null]);
$url_mois_suivant = buildUrl(['mode' => 'mois', 'mois' => $mois_suivant, 'annee' => $annee_suivante, 'semaine' => null]);
$url_mois_actuel = buildUrl(['mode' => 'mois', 'mois' => date('n'), 'annee' => date('Y'), 'semaine' => null]);

// URLs pour le mode semaine
$url_semaine = buildUrl(['mode' => 'semaine']);
$url_semaine_precedente = buildUrl(['mode' => 'semaine', 'semaine' => $semaine_precedente]);
$url_semaine_suivante = buildUrl(['mode' => 'semaine', 'semaine' => $semaine_suivante]);
$url_semaine_actuelle = buildUrl(['mode' => 'semaine', 'semaine' => 0]);

// Calculer le nombre de jours dans le mois (pour le mode mois)
$nb_jours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);

// Premier jour de la semaine (0 = dimanche, 1 = lundi, etc.)
$premier_jour_semaine = (int)$date->format('w');
// Ajuster pour que lundi = 0
$premier_jour_semaine = ($premier_jour_semaine == 0) ? 6 : $premier_jour_semaine - 1;

// Récupérer tous les professeurs
$professeurs = $pdo->query("SELECT * FROM professeurs ORDER BY nom")->fetchAll();

// Récupérer tous les cours hebdomadaires
$cours = $pdo->query("
    SELECT c.*, p.nom as prof_nom, p.specialite 
    FROM cours_hebdomadaires c
    JOIN professeurs p ON c.professeur_id = p.id
    WHERE c.actif = 1
    ORDER BY c.jour_semaine, c.heure_debut
")->fetchAll();

// Organiser les cours par jour et heure
$planning = [];
foreach($cours as $c) {
    $jour = $c['jour_semaine'];
    $heure = substr($c['heure_debut'], 0, 5);
    if(!isset($planning[$jour][$heure])) {
        $planning[$jour][$heure] = [];
    }
    $planning[$jour][$heure][] = $c;
}

// Récupérer les réservations pour la période affichée
if ($mode == 'semaine') {
    $debut_periode = $dates_semaine[0]['date'];
    $fin_periode = $dates_semaine[6]['date'];
} else {
    $debut_periode = $annee . '-' . str_pad($mois, 2, '0', STR_PAD_LEFT) . '-01';
    $fin_periode = $annee . '-' . str_pad($mois, 2, '0', STR_PAD_LEFT) . '-' . $nb_jours;
}

$reservations = [];
$stmt = $pdo->prepare("
    SELECT * FROM reservations 
    WHERE date_cours BETWEEN ? AND ?
    AND statut = 'confirmé'
");
$stmt->execute([$debut_periode, $fin_periode]);
$all_reservations = $stmt->fetchAll();

foreach($all_reservations as $r) {
    $reservations[$r['date_cours']][$r['heure_debut']] = $r;
}

// Créneaux horaires de 7h à 20h
$heures = [];
for ($h = 7; $h <= 19; $h++) {
    $heures[] = sprintf('%02d:00', $h);
    $heures[] = sprintf('%02d:30', $h);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours hebdomadaires - Calendrier</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
        }

        .date-actuelle {
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .navigation {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .mode-selector {
            display: flex;
            gap: 10px;
            background: #f8f9fa;
            padding: 5px;
            border-radius: 10px;
        }

        .mode-btn {
            padding: 8px 16px;
            border: none;
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            color: #495057;
        }

        .mode-btn.active {
            background: #667eea;
            color: white;
        }

        .periode-info {
            font-size: 1.5rem;
            font-weight: 600;
            color: #495057;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-btn {
            padding: 8px 16px;
            border: 1px solid #dee2e6;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            color: #495057;
        }

        .nav-btn:hover {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .nav-btn.actuel {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .planning-container {
            background: white;
            padding: 20px;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        .planning-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        .planning-table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .planning-table th.aujourdhui {
            background: #e3f2fd;
            border-bottom: 2px solid #2196f3;
        }

        .planning-table th.aujourdhui .date {
            background: #2196f3;
            color: white;
            padding: 4px 8px;
            border-radius: 20px;
            display: inline-block;
        }

        .planning-table th .jour {
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .planning-table th .date {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: normal;
        }

        .planning-table td {
            border: 1px solid #e9ecef;
            padding: 4px;
            vertical-align: top;
            height: 60px;
            position: relative;
            transition: background-color 0.2s;
        }

        .planning-table td.passe {
            background-color: #f8f9fa;
            opacity: 0.7;
        }

        .planning-table td.aujourdhui-cell {
            background-color: #fff3e0;
        }

        .cours-item {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 4px;
            margin: 2px 0;
            border-radius: 4px;
            font-size: 0.7rem;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            z-index: 1;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .cours-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 2;
        }

        .cours-item.reserve {
            background: #c8e6c9;
            border-left-color: #4caf50;
        }

        .cours-item.passe {
            background: #f5f5f5;
            border-left-color: #9e9e9e;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .cours-item .prof-nom {
            font-weight: 600;
            color: #1976d2;
            font-size: 0.75rem;
        }

        .cours-item.reserve .prof-nom {
            color: #2e7d32;
        }

        .cours-item .duree {
            font-size: 0.6rem;
            color: #6c757d;
        }

        .jour-hors-mois {
            background-color: #f8f9fa;
            opacity: 0.5;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            animation: modalAppear 0.3s;
        }

        @keyframes modalAppear {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-content h2 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .detail-item {
            margin: 15px 0;
        }

        .detail-item label {
            font-weight: 600;
            color: #495057;
            display: block;
            margin-bottom: 5px;
        }

        .detail-item .value {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .detail-item input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .detail-item input:focus {
            border-color: #667eea;
            outline: none;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
            margin-right: 10px;
        }

        .btn-primary {
            background: #28a745;
            color: white;
        }

        .btn-primary:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
        }

        .message {
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            margin-bottom: 10px;
            animation: slideIn 0.3s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 400px;
        }

        .message.success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .message.error {
            background: linear-gradient(135deg, #dc3545 0%, #f56565 100%);
        }

        .message.info {
            background: linear-gradient(135deg, #2196f3 0%, #667eea 100%);
        }

        .message.warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        }

        .message-close {
            margin-left: auto;
            cursor: pointer;
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .message-close:hover {
            opacity: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 16px 16px;
        }

        .politique-annulation {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-reservation {
            display: flex;
            gap: 5px;
            margin-bottom: 2px;
            font-size: 0.65rem;
            color: #6c757d;
        }

        .legende {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            flex-wrap: wrap;
        }

        .legende-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .legende-couleur {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .legende-couleur.disponible {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
        }

        .legende-couleur.reserve {
            background: #c8e6c9;
            border-left: 4px solid #4caf50;
        }

        .legende-couleur.passe {
            background: #f5f5f5;
            border-left: 4px solid #9e9e9e;
        }

        .info-gratuit {
            color: #28a745;
            font-weight: 600;
            font-size: 0.7rem;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.6rem;
            font-weight: 600;
            margin-left: 5px;
        }

        .badge-success {
            background: #28a745;
            color: white;
        }

        .badge-warning {
            background: #ffc107;
            color: #333;
        }

        .delai-info {
            font-size: 0.8rem;
            color: #856404;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>📚 Cours hebdomadaires</h1>
            <p>Réservez vos cours gratuitement - Disponibles de 7h à 20h</p>
        </div>
        <div class="date-actuelle">
            <?= $date_actuelle->format('l d F Y') ?>
        </div>
    </div>

    <div class="navigation">
        <div class="mode-selector">
            <a href="<?= $url_mois ?>" class="mode-btn <?= $mode == 'mois' ? 'active' : '' ?>">Mois</a>
            <a href="<?= $url_semaine ?>" class="mode-btn <?= $mode == 'semaine' ? 'active' : '' ?>">Semaine</a>
        </div>

        <div class="periode-info">
            <?php if($mode == 'semaine'): ?>
                Semaine du <?= $dates_semaine[0]['jour_num'] ?> <?= $mois_noms[$dates_semaine[0]['mois']] ?>
                au <?= $dates_semaine[6]['jour_num'] ?> <?= $mois_noms[$dates_semaine[6]['mois']] ?> <?= $annee ?>
            <?php else: ?>
                <?= $mois_noms[$mois] ?> <?= $annee ?>
                <?php if($mois == $mois_actuel && $annee == $annee_actuelle): ?>
                    <span class="badge badge-success">Mois en cours</span>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="nav-buttons">
            <?php if($mode == 'semaine'): ?>
                <a href="<?= $url_semaine_precedente ?>" class="nav-btn" title="Semaine précédente">← Semaine précédente</a>
                <a href="<?= $url_semaine_actuelle ?>" class="nav-btn <?= $semaine_offset == 0 ? 'actuel' : '' ?>">Semaine actuelle</a>
                <a href="<?= $url_semaine_suivante ?>" class="nav-btn" title="Semaine suivante">Semaine suivante →</a>
            <?php else: ?>
                <a href="<?= $url_mois_precedent ?>" class="nav-btn" title="Mois précédent">← Mois précédent</a>
                <a href="<?= $url_mois_actuel ?>" class="nav-btn <?= ($mois == $mois_actuel && $annee == $annee_actuelle) ? 'actuel' : '' ?>">Mois actuel</a>
                <a href="<?= $url_mois_suivant ?>" class="nav-btn" title="Mois suivant">Mois suivant →</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="planning-container">
        <div class="legende">
            <div class="legende-item">
                <div class="legende-couleur disponible"></div>
                <span>Cours disponible</span>
            </div>
            <div class="legende-item">
                <div class="legende-couleur reserve"></div>
                <span>Cours réservé</span>
            </div>
            <div class="legende-item">
                <div class="legende-couleur passe"></div>
                <span>Cours passé</span>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="planning-table">
                <thead>
                <tr>
                    <th>Horaire</th>
                    <?php if($mode == 'semaine'): ?>
                        <?php foreach($dates_semaine as $jour_data):
                            $est_aujourdhui = ($jour_data['date'] == $aujourdhui);
                            ?>
                            <th class="<?= $est_aujourdhui ? 'aujourdhui' : '' ?>">
                                <div class="jour"><?= $jour_data['jour_nom'] ?></div>
                                <div class="date">
                                    <?php if($est_aujourdhui): ?>
                                        <span class="badge badge-success">Aujourd'hui</span>
                                    <?php else: ?>
                                        <?= $jour_data['jour_num'] ?> <?= $mois_noms[$jour_data['mois']] ?>
                                    <?php endif; ?>
                                </div>
                            </th>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php for($i = 0; $i < 7; $i++):
                            $jour_num = $i + 1 - $premier_jour_semaine;
                            $date_jour = new DateTime();
                            $date_jour->setDate($annee, $mois, $jour_num);
                            $est_dans_mois = ($jour_num >= 1 && $jour_num <= $nb_jours);
                            $jour_semaine = $date_jour->format('w');
                            $jour_semaine = ($jour_semaine == 0) ? 6 : $jour_semaine - 1;
                            $jour_nom = getJourFrancais($jour_semaine);
                            $est_aujourdhui = ($est_dans_mois && $jour_num == $jour_actuel && $mois == $mois_actuel && $annee == $annee_actuelle);
                            ?>
                            <th class="<?= !$est_dans_mois ? 'jour-hors-mois' : '' ?> <?= $est_aujourdhui ? 'aujourdhui' : '' ?>">
                                <div class="jour"><?= $jour_nom ?></div>
                                <div class="date">
                                    <?php if($est_dans_mois): ?>
                                        <?php if($est_aujourdhui): ?>
                                            <span class="badge badge-success">Aujourd'hui</span>
                                        <?php else: ?>
                                            <?= $jour_num ?> <?= $mois_noms[$mois] ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </th>
                        <?php endfor; ?>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach($heures as $heure): ?>
                    <tr>
                        <td style="background: #f8f9fa; font-weight: 600; width: 80px; text-align: center;">
                            <?= $heure ?>
                        </td>
                        <?php if($mode == 'semaine'): ?>
                            <?php foreach($dates_semaine as $jour_data):
                                $date = $jour_data['date'];
                                $jour_semaine = $jour_data['jour_semaine'];
                                $est_passe = ($date < $aujourdhui);
                                $est_aujourdhui = ($date == $aujourdhui);

                                $est_reserve = isset($reservations[$date][$heure . ':00']);
                                $cell_class = '';
                                if($est_passe) $cell_class = 'passe';
                                if($est_aujourdhui) $cell_class .= ' aujourdhui-cell';
                                ?>
                                <td class="<?= $cell_class ?>">
                                    <?php if(isset($planning[$jour_semaine][$heure])): ?>
                                        <?php foreach($planning[$jour_semaine][$heure] as $cours):
                                            $cours_reserve = $est_reserve &&
                                                    $reservations[$date][$heure . ':00']['cours_id'] == $cours['id'];
                                            $cours_passe = $est_passe && !$cours_reserve;
                                            ?>
                                            <div class="cours-item <?= $cours_reserve ? 'reserve' : '' ?> <?= $cours_passe ? 'passe' : '' ?>"
                                                 onclick="<?= !$cours_passe ? 'ouvrirReservation(' . $cours['id'] . ', \'' . $date . '\', \'' . $heure . '\', ' . ($cours_reserve ? 'true' : 'false') . ')' : '' ?>">
                                                <div class="prof-nom"><?= htmlspecialchars($cours['prof_nom']) ?></div>
                                                <div><?= htmlspecialchars($cours['titre']) ?></div>
                                                <div class="info-reservation">
                                                    <span class="duree"><?= $cours['duree_minutes'] ?> min</span>
                                                    <?php if(!$cours_passe && !$cours_reserve): ?>
                                                        <span class="info-gratuit">Gratuit</span>
                                                    <?php elseif($cours_reserve): ?>
                                                        <span class="badge badge-success">Réservé</span>
                                                    <?php elseif($cours_passe): ?>
                                                        <span class="badge badge-warning">Passé</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php for($i = 0; $i < 7; $i++):
                                $jour_num = $i + 1 - $premier_jour_semaine;
                                $date = sprintf('%04d-%02d-%02d', $annee, $mois, $jour_num);
                                $est_dans_mois = ($jour_num >= 1 && $jour_num <= $nb_jours);
                                $jour_semaine = $i;
                                $est_passe = ($date < $aujourdhui);
                                $est_aujourdhui = ($date == $aujourdhui);

                                if(!$est_dans_mois):
                                    ?>
                                    <td class="jour-hors-mois"></td>
                                <?php else:
                                    $est_reserve = isset($reservations[$date][$heure . ':00']);
                                    $cell_class = '';
                                    if($est_passe) $cell_class = 'passe';
                                    if($est_aujourdhui) $cell_class .= ' aujourdhui-cell';
                                    ?>
                                    <td class="<?= $cell_class ?>">
                                        <?php if(isset($planning[$jour_semaine][$heure])): ?>
                                            <?php foreach($planning[$jour_semaine][$heure] as $cours):
                                                $cours_reserve = $est_reserve &&
                                                        $reservations[$date][$heure . ':00']['cours_id'] == $cours['id'];
                                                $cours_passe = $est_passe && !$cours_reserve;
                                                ?>
                                                <div class="cours-item <?= $cours_reserve ? 'reserve' : '' ?> <?= $cours_passe ? 'passe' : '' ?>"
                                                     onclick="<?= !$cours_passe ? 'ouvrirReservation(' . $cours['id'] . ', \'' . $date . '\', \'' . $heure . '\', ' . ($cours_reserve ? 'true' : 'false') . ')' : '' ?>">
                                                    <div class="prof-nom"><?= htmlspecialchars($cours['prof_nom']) ?></div>
                                                    <div><?= htmlspecialchars($cours['titre']) ?></div>
                                                    <div class="info-reservation">
                                                        <span class="duree"><?= $cours['duree_minutes'] ?> min</span>
                                                        <?php if(!$cours_passe && !$cours_reserve): ?>
                                                            <span class="info-gratuit">Gratuit</span>
                                                        <?php elseif($cours_reserve): ?>
                                                            <span class="badge badge-success">Réservé</span>
                                                        <?php elseif($cours_passe): ?>
                                                            <span class="badge badge-warning">Passé</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <div class="politique-annulation">
            <i>⏰</i>
            <div>
                <strong>📅 Politique d'annulation :</strong> Annulez ou reprogrammez gratuitement jusqu'à 12 heures avant le début du cours.<br>
                Cours disponibles de 7h à 20h, 7j/7. Tous les cours sont gratuits.
            </div>
        </div>
    </div>
</div>

<!-- Modal de réservation -->
<div class="modal" id="reservationModal">
    <div class="modal-content">
        <h2 id="modalTitre">Réserver un cours</h2>

        <div class="detail-item">
            <label>Professeur</label>
            <div class="value" id="modalProfesseur"></div>
        </div>

        <div class="detail-item">
            <label>Date</label>
            <div class="value" id="modalDate"></div>
        </div>

        <div class="detail-item">
            <label>Horaire</label>
            <div class="value" id="modalHoraire"></div>
        </div>

        <div class="detail-item">
            <label>Durée</label>
            <div class="value" id="modalDuree">25 minutes</div>
        </div>

        <div class="detail-item">
            <label>Prix</label>
            <div class="value" id="modalPrix" style="font-size: 1.2rem; font-weight: 600; color: #28a745;">Gratuit</div>
        </div>

        <div class="detail-item" id="delaiInfoContainer" style="display: none;">
            <div class="delai-info" id="delaiInfo"></div>
        </div>

        <div class="detail-item" id="nomField">
            <label>Votre nom</label>
            <input type="text" id="eleveNom" placeholder="Entrez votre nom" required>
        </div>

        <div class="detail-item" id="emailField">
            <label>Votre email</label>
            <input type="email" id="eleveEmail" placeholder="Entrez votre email" required>
        </div>

        <div style="margin-top: 25px; text-align: right;">
            <button class="btn btn-secondary" onclick="fermerModal()">Fermer</button>
            <button class="btn btn-primary" id="modalActionBtn" onclick="confirmerReservation()">Confirmer la réservation</button>
            <button class="btn btn-danger" id="modalAnnulerBtn" style="display: none;" onclick="ouvrirConfirmModal()">Annuler ce cours</button>
        </div>
    </div>
</div>

<!-- Modal de confirmation d'annulation -->
<div class="modal" id="confirmModal">
    <div class="modal-content" style="max-width: 400px;">
        <h2 style="color: #dc3545; border-bottom-color: #dc3545;">⚠️ Confirmation d'annulation</h2>

        <div class="detail-item">
            <p style="font-size: 1.1rem; margin: 20px 0; text-align: center;">
                Êtes-vous sûr de vouloir annuler ce cours ?<br>
                <small style="color: #6c757d; display: block; margin-top: 10px;">Cette action est irréversible.</small>
            </p>
        </div>

        <div style="margin-top: 25px; text-align: center;">
            <button class="btn btn-secondary" onclick="fermerConfirmModal()" style="margin-right: 10px;">Non, conserver</button>
            <button class="btn btn-danger" onclick="confirmerAnnulation()">Oui, annuler le cours</button>
        </div>
    </div>
</div>

<!-- Conteneur pour les messages -->
<div class="message-container" id="messageContainer"></div>

<script>
    let coursActuel = null;
    let dateActuelle = null;
    let heureActuelle = null;
    let estReserveActuel = false;
    let reservationActuelle = null;

    function ouvrirReservation(coursId, date, heure, estReserve) {
        coursActuel = coursId;
        dateActuelle = date;
        heureActuelle = heure;
        estReserveActuel = estReserve;

        fetch('get_cours_details.php?id=' + coursId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalProfesseur').textContent = data.prof_nom + ' - ' + data.specialite;
                document.getElementById('modalTitre').textContent = data.titre;

                const dateObj = new Date(date + 'T12:00:00');
                document.getElementById('modalDate').textContent = dateObj.toLocaleDateString('fr-FR', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                document.getElementById('modalHoraire').textContent = heure;
                document.getElementById('modalDuree').textContent = data.duree_minutes + ' minutes';
                document.getElementById('modalPrix').textContent = 'Gratuit';

                const maintenant = new Date();
                const coursDateTime = new Date(date + 'T' + heure + ':00');
                const estPasse = coursDateTime < maintenant;

                if(estPasse && !estReserve) {
                    afficherMessage('info', '⏰ Ce cours est déjà passé', 'Impossible de réserver un cours passé');
                    fermerModal();
                    return;
                }

                if(estReserve) {
                    document.getElementById('modalActionBtn').style.display = 'none';
                    document.getElementById('modalAnnulerBtn').style.display = 'inline-block';
                    document.getElementById('nomField').style.display = 'block';
                    document.getElementById('emailField').style.display = 'block';

                    fetch('get_reservation.php?cours_id=' + coursId + '&date=' + date + '&heure=' + heure)
                        .then(response => response.json())
                        .then(reservation => {
                            if(reservation && !reservation.error) {
                                reservationActuelle = reservation;
                                document.getElementById('eleveNom').value = reservation.eleve_nom || '';
                                document.getElementById('eleveEmail').value = reservation.eleve_email || '';

                                const heuresRestantes = (coursDateTime - maintenant) / (1000 * 60 * 60);
                                document.getElementById('delaiInfoContainer').style.display = 'block';

                                if(heuresRestantes < 0) {
                                    document.getElementById('delaiInfo').innerHTML = '⚠️ Ce cours est déjà passé, impossible de l\'annuler';
                                    document.getElementById('modalAnnulerBtn').disabled = true;
                                } else if(heuresRestantes < 12) {
                                    document.getElementById('delaiInfo').innerHTML = `⚠️ Délai d'annulation dépassé (moins de 12h, il reste ${heuresRestantes.toFixed(1)}h)`;
                                    document.getElementById('modalAnnulerBtn').disabled = true;
                                } else {
                                    document.getElementById('delaiInfo').innerHTML = `✓ Annulation possible (${heuresRestantes.toFixed(1)}h restantes)`;
                                    document.getElementById('modalAnnulerBtn').disabled = false;
                                }
                            }
                        });
                } else {
                    document.getElementById('modalActionBtn').style.display = 'inline-block';
                    document.getElementById('modalAnnulerBtn').style.display = 'none';
                    document.getElementById('nomField').style.display = 'block';
                    document.getElementById('emailField').style.display = 'block';
                    document.getElementById('delaiInfoContainer').style.display = 'none';
                    document.getElementById('eleveNom').value = '';
                    document.getElementById('eleveEmail').value = '';
                    document.getElementById('modalActionBtn').disabled = false;
                    document.getElementById('modalActionBtn').textContent = 'Confirmer la réservation';
                }

                document.getElementById('reservationModal').classList.add('active');
            })
            .catch(error => {
                afficherMessage('error', '❌ Erreur', 'Erreur lors du chargement des données');
            });
    }

    function fermerModal() {
        document.getElementById('reservationModal').classList.remove('active');
    }

    function confirmerReservation() {
        const nom = document.getElementById('eleveNom').value.trim();
        const email = document.getElementById('eleveEmail').value.trim();

        if(!nom || !email) {
            afficherMessage('error', '❌ Erreur', 'Veuillez remplir tous les champs');
            return;
        }

        if(!email.includes('@') || !email.includes('.')) {
            afficherMessage('error', '❌ Erreur', 'Veuillez entrer un email valide');
            return;
        }

        const btn = document.getElementById('modalActionBtn');
        btn.disabled = true;
        btn.textContent = 'Réservation en cours...';

        const formData = new FormData();
        formData.append('cours_id', coursActuel);
        formData.append('date', dateActuelle);
        formData.append('heure', heureActuelle);
        formData.append('nom', nom);
        formData.append('email', email);

        fetch('reserver_cours.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    afficherMessage('success', '✅ Succès !', 'Cours réservé avec succès !');
                    fermerModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    afficherMessage('error', '❌ Erreur', data.message);
                    btn.disabled = false;
                    btn.textContent = 'Confirmer la réservation';
                }
            })
            .catch(error => {
                afficherMessage('error', '❌ Erreur', 'Erreur de connexion');
                btn.disabled = false;
                btn.textContent = 'Confirmer la réservation';
            });
    }

    function ouvrirConfirmModal() {
        fermerModal();
        document.getElementById('confirmModal').classList.add('active');
    }

    function fermerConfirmModal() {
        document.getElementById('confirmModal').classList.remove('active');
        document.getElementById('reservationModal').classList.add('active');
    }

    function confirmerAnnulation() {
        fermerConfirmModal();

        const btn = document.getElementById('modalAnnulerBtn');
        btn.disabled = true;
        btn.textContent = 'Annulation en cours...';

        const formData = new FormData();
        formData.append('cours_id', coursActuel);
        formData.append('date', dateActuelle);
        formData.append('heure', heureActuelle);

        fetch('annuler_cours.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    afficherMessage('success', '✅ Annulation confirmée !', 'Votre cours a été annulé avec succès.');
                    fermerModal();
                    setTimeout(() => location.reload(), 2000);
                } else {
                    afficherMessage('error', '❌ Annulation impossible', data.message);
                    btn.disabled = false;
                    btn.textContent = 'Annuler ce cours';
                    document.getElementById('reservationModal').classList.add('active');
                }
            })
            .catch(error => {
                afficherMessage('error', '❌ Erreur', 'Erreur de connexion');
                btn.disabled = false;
                btn.textContent = 'Annuler ce cours';
                document.getElementById('reservationModal').classList.add('active');
            });
    }

    function afficherMessage(type, titre, contenu) {
        const container = document.getElementById('messageContainer');

        const msg = document.createElement('div');
        msg.className = 'message ' + type;

        const icon = type === 'success' ? '✅' : type === 'error' ? '❌' : type === 'warning' ? '⚠️' : 'ℹ️';

        msg.innerHTML = `
            <div style="font-size: 1.2rem;">${icon}</div>
            <div style="flex: 1;">
                <div style="font-weight: 700; margin-bottom: 5px;">${titre}</div>
                <div style="font-size: 0.9rem; opacity: 0.9;">${contenu}</div>
            </div>
            <div class="message-close" onclick="this.parentElement.remove()">×</div>
        `;

        container.appendChild(msg);

        setTimeout(() => {
            if(msg.parentElement) {
                msg.style.animation = 'slideOut 0.3s';
                setTimeout(() => msg.remove(), 300);
            }
        }, 5000);
    }

    window.onclick = function(event) {
        const modal = document.getElementById('reservationModal');
        const confirmModal = document.getElementById('confirmModal');
        if(event.target == modal) {
            fermerModal();
        }
        if(event.target == confirmModal) {
            fermerConfirmModal();
        }
    }

    window.onload = function() {
        const aujourdhui = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateStr = aujourdhui.toLocaleDateString('fr-FR', options);

        setTimeout(() => {
            afficherMessage('info', '📅 ' + dateStr, 'Bienvenue sur le calendrier des cours. Réservez vos créneaux gratuitement !');
        }, 500);
    }
</script>
</body>
</html>