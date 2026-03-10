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

    <style>

        /* Fond gris seulement pour la page FAQ */
        .faq-page{
            background-color:#f2f2f2;
        }

        /* Structure FAQ */
        .faq-section{
            padding:60px;
        }

        .faq-container{
            display:flex;
            gap:60px;
        }

        /* Partie gauche (questions) */
        .faq-left{
            width:65%;
        }

        .faq-item{
            margin-bottom:25px;
        }

        /* Partie droite (contact) */
        .faq-right{
            width:35%;
            background:white;
            padding:25px;
            border-radius:10px;
        }

    </style>

</head>

<body class="faq-page">

<nav class="navbar">
    <div class="nav-container">

        <div class="logo">
            <img src="../css/bien-être%20étudiant%20(1)_page-0001.jpg" alt="Bien-être Étudiant">
        </div>

        <ul class="nav-menu">

            <li class="nav-item">
                <a href="Page_Accueil.php" class="nav-link">Accueil</a>
            </li>

            <li class="nav-item">
                <a href="Professionnel.php" class="nav-link">Professionnels</a>
            </li>

            <li class="nav-item">
                <a href="RDV.php" class="nav-link">Prendre RDV</a>
            </li>

            <li class="nav-item active">
                <a href="FAQ.php" class="nav-link">FAQ</a>
            </li>

        </ul>

        <button class="btn-login">LOGIN</button>

    </div>
</nav>


<section class="faq-section">

    <div class="faq-container">

        <div class="faq-left">

            <h1>Foire aux Questions</h1>

            <div class="faq-item">
                <h3>Comment prendre rendez-vous ?</h3>
                <p>Vous pouvez prendre rendez-vous directement depuis la page "Prendre RDV" du site.</p>
            </div>

            <div class="faq-item">
                <h3>Les consultations sont-elles gratuites ?</h3>
                <p>Certaines consultations peuvent être prises en charge pour les étudiants.</p>
            </div>

            <div class="faq-item">
                <h3>Comment choisir un professionnel ?</h3>
                <p>Vous pouvez consulter la page "Professionnels" pour voir les spécialistes disponibles.</p>
            </div>

            <div class="faq-item">
                <h3>Mes informations sont-elles confidentielles ?</h3>
                <p>Oui, toutes les informations partagées lors des consultations sont strictement confidentielles.</p>
            </div>

            <div class="faq-item">
                <h3>Que faire en cas d'urgence ?</h3>
                <p>Contactez le 3114 ou le 15 (SAMU) en cas d'urgence.</p>
            </div>

        </div>


        <div class="faq-right">

            <h2>Nous contacter</h2>

            <p>Email : contact@bienetre-etudiant.fr</p>
            <p>Téléphone : 01 23 45 67 89</p>
            <p>Adresse : Paris, France</p>

            <br>

            <p>Si vous avez des questions supplémentaires, vous pouvez nous contacter directement.</p>

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
                    <li><a href="Page_Accueil.php">Accueil</a></li>
                    <li><a href="Professionnel.php">Professionnels</a></li>
                    <li><a href="RDV.php">Prendre RDV</a></li>
                    <li><a href="FAQ.php">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Informations</h4>
                <ul>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Contact</a></li>
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
