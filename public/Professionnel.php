<!DOCTYPE html>
<?php
$pdo = new PDO(
        "mysql:host=localhost;dbname=consultation_db;charset=utf8",
        "root",
        "",
        [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
);

/* Récupération des professionnels actifs */
$sql = "
    SELECT 
        p.id_professionel,
        p.nom,
        p.prenom,
        p.specialiste,
        p.mode_consultation,
        p.statut
    FROM PROFESSIONEL p
    WHERE p.statut_site = 'actif'
    ORDER BY p.nom
";

$professionnels = $pdo->query($sql)->fetchAll();
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professionnels - Bien-être Étudiant</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Styles spécifiques pour la page professionnels */
        .professionnels-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .professionnels-header h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }

        .professionnels-header p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }

        .filtres-section {
            background-color: white;
            padding: 40px 20px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }

        .filtres-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .filtres-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filtre-group {
            display: flex;
            flex-direction: column;
        }

        .filtre-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .filtre-group select,
        .filtre-group input {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .filtre-group select:focus,
        .filtre-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn-filtres {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-filter {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            background-color: #6854D4;
            transform: translateY(-2px);
        }

        .btn-reset {
            background-color: var(--text-light);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-reset:hover {
            background-color: #4a5568;
            transform: translateY(-2px);
        }

        .professionnels-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .professionnels-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .professionnel-card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .professionnel-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .professionnel-header {
            background-color: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .professionnel-nom {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .professionnel-specialite {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .professionnel-content {
            padding: 25px;
            flex-grow: 1;
        }

        .professionnel-info {
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            color: var(--text-light);
        }

        .info-item i {
            color: var(--primary-color);
            width: 20px;
        }

        .professionnel-description {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .badges-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .badge {
            background-color: var(--bg-light);
            color: var(--text-dark);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .badge-mode {
            background-color: var(--secondary-color);
            color: white;
        }

        .badge-disponible {
            background-color: #4CAF50;
            color: white;
        }

        .professionnel-footer {
            padding: 0 25px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delai-reponse {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .btn-rdv {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-rdv:hover {
            background-color: #6854D4;
            transform: translateY(-2px);
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            grid-column: 1 / -1;
        }

        .no-results h3 {
            font-size: 1.8rem;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .no-results p {
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .results-count {
            text-align: center;
            color: var(--text-light);
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .results-count span {
            font-weight: bold;
            color: var(--primary-color);
        }

        .filtres-actifs {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .filtres-actifs p {
            margin: 0;
            color: var(--text-dark);
        }

        @media (max-width: 768px) {
            .filtres-form {
                grid-template-columns: 1fr;
            }

            .professionnels-list {
                grid-template-columns: 1fr;
            }

            .professionnel-footer {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .btn-filtres {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="../css/bien-être étudiant (1)_page-0001.jpg" alt="Bien-être Étudiant">
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="Page_Accueil.php" class="nav-link">Accueil</a>
            </li>
            <li class="nav-item active"><a href="Professionnel.php" class="nav-link">Professionnels</a></li>
            <li class="nav-item"><a href="RDV.php" class="nav-link">Prendre RDV</a></li>
            <li class="nav-item"><a href="FAQ.php" class="nav-link">FAQ</a></li>
        </ul>

        <button class="btn-login">LOGIN</button>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <h1>Nos professionnels de santé</h1>
        <p>Des spécialistes à votre écoute</p>
    </div>
</section>

<section class="professionnels">
    <div class="container">

        <?php if (empty($professionnels)) : ?>
            <p>Aucun professionnel disponible actuellement.</p>
        <?php endif; ?>

        <?php foreach ($professionnels as $pro) : ?>

            <table border="1" width="800" style="margin:30px auto; border-collapse:collapse;">

                <tr>
                    <th colspan="2">
                        <?= htmlspecialchars($pro['prenom'] . ' ' . $pro['nom']) ?>
                        <br>
                        <small><?= htmlspecialchars($pro['specialiste']) ?></small>
                    </th>
                </tr>

                <tr>
                    <td width="250" align="center">
                        <img src="../images/default-medecin.png"
                             alt="Photo médecin"
                             width="200">
                        <br><br>
                        <div><strong>Consultation :</strong></div>
                        <div><?= htmlspecialchars($pro['mode_consultation']) ?></div>
                        <br>
                        <div><strong>Statut :</strong> <?= htmlspecialchars($pro['statut']) ?></div>
                    </td>

                    <td>
                        <div><strong>Horaires</strong></div><br>

                        <div>Lundi : 09h00 - 17h00</div><br>
                        <div>Mardi : 09h00 - 17h00</div><br>
                        <div>Mercredi : 09h00 - 17h00</div><br>
                        <div>Jeudi : 09h00 - 17h00</div><br>
                        <div>Vendredi : 09h00 - 16h00</div><br>
                        <div>Samedi : Fermé</div><br>
                        <div>Dimanche : Fermé</div><br>

                        <br>
                        <a href="RDV.php?id_professionel=<?= $pro['id_professionel'] ?>">
                            ➜ Prendre rendez-vous
                        </a>
                    </td>
                </tr>

            </table>

        <?php endforeach; ?>

    </div>
</section>


<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Bien-être Étudiant</h4>
                <p>Votre santé mentale est notre priorité</p>
            </div>

            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="Page_Accueil.php">Accueil</a></li>
                    <li><a href="Professionnel.php">Professionnels</a></li>
                    <li><a href="RDV.php">Prendre RDV</a></li>
                    <li><a href="FAQ.php">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Urgences</h4>
                <ul>
                    <li>3114 - Numéro national</li>
                    <li>Nightline - Écoute étudiante</li>
                    <li>15 - SAMU</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Bien-être Étudiant. Tous droits réservés.</p>
        </div>
    </div>
</footer>

</body>
</html>