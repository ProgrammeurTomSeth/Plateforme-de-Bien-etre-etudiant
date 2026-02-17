<?php
$pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
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

<section class="hero">
    <div class="hero-content">
        <div class="hero-buttons">
        </div>
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
                    <li><a href="#accueil">Accueil</a></li>
                    <li><a href="#professionnels">Professionnels</a></li>
                    <li><a href="#rdv">Prendre RDV</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Informations</h4>
                <ul>
                    <li><a href="#apropos">À propos</a></li>
                    <li><a href="#confidentialite">Confidentialité</a></li>
                    <li><a href="#mentions">Mentions légales</a></li>
                    <li><a href="#contact">Contact</a></li>
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