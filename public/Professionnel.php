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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Professionnels</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Page_Accueil.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="../css/bien-être%20étudiant%20(1)_page-0001.jpg" alt="Bien-être Étudiant">
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="Page_Accueil.php" class="nav-link">Accueil</a></li>
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