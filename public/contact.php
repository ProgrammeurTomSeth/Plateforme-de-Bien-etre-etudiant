
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">

    <style>

        .contact-section{
            max-width:900px;
            margin:80px auto;
            padding:20px;
        }

        .contact-title{
            text-align:center;
            font-size:32px;
            margin-bottom:40px;
        }

        .contact-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:30px;
        }

        .contact-card{
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 4px 10px rgba(0,0,0,0.05);
        }

        .contact-card h3{
            margin-bottom:15px;
        }

        .contact-card p{
            margin-bottom:10px;
            line-height:1.6;
        }

        @media (max-width:768px){
            .contact-grid{
                grid-template-columns:1fr;
            }
        }

    </style>

</head>

<body>

<nav class="navbar">
    <div class="nav-container">

        <div class="logo">
            <img src="../css/bien-être%20étudiant%20(1)_page-0001.jpg" alt="Bien-être Étudiant">
        </div>

        <ul class="nav-menu">

            <li class="nav-item">
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
                <a href="../calendrier/index.php" class="nav-link">
                    <span class="icon">Prendre RDV</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="FAQ.php" class="nav-link">
                    <span class="icon">FAQ</span>
                </a>
            </li>

            <li class="nav-item active">
                <a href="contact.php" class="nav-link">
                    <span class="icon">Contact</span>
                </a>
            </li>

        </ul>

        <button class="btn-login">LOGIN</button>

    </div>
</nav>


<section class="contact-section">

    <h1 class="contact-title">Nous contacter</h1>

    <div class="contact-grid">

        <div class="contact-card">
            <h3>Adresse</h3>
            <p>Bien-être Étudiant</p>
            <p>24 Avenue de la Santé</p>
            <p>75013 Paris</p>
            <p>France</p>
        </div>

        <div class="contact-card">
            <h3>Téléphone</h3>
            <p>Accueil : 01 45 67 89 00</p>
            <p>Support étudiants : 01 45 67 89 10</p>
            <p>Professionnels partenaires : 01 45 67 89 20</p>
        </div>

        <div class="contact-card">
            <h3>Email</h3>
            <p>contact@bienetre-etudiant.fr</p>

        </div>

        <div class="contact-card">
            <h3>Horaires</h3>
            <p>Lundi : 9h00 - 18h00</p>
            <p>Mardi : 9h00 - 18h00</p>
            <p>Mercredi : 9h00 - 18h00</p>
            <p>Jeudi : 9h00 - 18h00</p>
            <p>Vendredi : 9h00 - 17h00</p>
            <p>Week-end : fermé</p>
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

