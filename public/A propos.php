<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang = "en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialité</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="../css/bien-être%20étudiant%20(1)_page-0001.jpg" alt="Bien-être Étudiant">
        </div>
        <ul class="nav-menu">
            <li class="nav-item active">
                <a href="Page_Accueil.php" class="nav-link">
                    <span class="icon">Accueil</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="Professionnel.php" class="nav-link">
                    <span class="icon">Professionnels</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="RDV.php" class="nav-link">
                    <span class="icon">Prendre RDV</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="FAQ.php" class="nav-link">
                    <span class="icon">FAQ</span>
                </a>
            </li>
        </ul>
        <button class="btn-login">LOGIN</button>
    </div>
</nav>
<p>À propos: <br><br>

De nous: <br>

    Nous sommes des programmeurs juniors qui ont décidé de créer ce site pour mettre en relation des étudiants avec des professionnels de santé mentale.<br><br>

Du site : <br>

    Ce site a été créé pour mettre en relation des étudiants avec des professionnels de santé mentale avec lesquels ils pourront prendre rendez-vous les jours et heures fournis par les professionnels qui mettent leurs horaires à jours d'eux-mêmes.
</p>
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
                <h4>Informations</h4>
                <ul>
                    <li><a href="A propos.php">À propos</a></li>
                    <li><a href="Politique de confidentialité.php">Confidentialité</a></li>
                    <li><a href="Mentions légales.php">Mentions légales</a></li>
                    <li><a href="contact.php">Contact</a></li>
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
