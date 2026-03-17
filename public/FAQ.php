
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
    <title>FAQ</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">

    <style>
        .faq-section{
            max-width:900px;
            margin:80px auto;
            padding:20px;
        }

        .faq-title{
            text-align:center;
            font-size:32px;
            margin-bottom:40px;
        }

        .faq-item{
            background:#ffffff;
            border-radius:10px;
            margin-bottom:15px;
            box-shadow:0 4px 10px rgba(0,0,0,0.05);
            overflow:hidden;
        }

        .faq-question{
            padding:18px;
            font-weight:bold;
            cursor:pointer;
            background:#f5f5f5;
        }

        .faq-answer{
            padding:18px;
            display:none;
            line-height:1.6;
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

            <li class="nav-item active">
                <a href="FAQ.php" class="nav-link">
                    <span class="icon">FAQ</span>
                </a>
            </li>

        </ul>

        <button class="btn-login">LOGIN</button>

    </div>
</nav>


<section class="faq-section">

    <h1 class="faq-title">Questions fréquentes</h1>

    <div class="faq-item">
        <div class="faq-question">Comment prendre rendez-vous ?</div>
        <div class="faq-answer">
            Vous pouvez prendre rendez-vous directement via la page "Prendre RDV".
            Choisissez un professionnel et sélectionnez la date disponible dans le calendrier.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Les consultations sont-elles gratuites ?</div>
        <div class="faq-answer">
            Certaines consultations sont gratuites pour les étudiants selon les établissements partenaires.
            Renseignez-vous auprès du professionnel lors de la prise de rendez-vous.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Les informations sont-elles confidentielles ?</div>
        <div class="faq-answer">
            Oui. Toutes les consultations respectent le secret professionnel et vos informations restent strictement confidentielles.
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Puis-je annuler un rendez-vous ?</div>
        <div class="faq-answer">
            Oui, vous pouvez annuler votre rendez-vous depuis votre espace personnel ou en contactant directement le professionnel.
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
                    <li><a href="#apropos">À propos</a></li>
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


<script>

    const questions = document.querySelectorAll(".faq-question");

    questions.forEach(q => {
        q.addEventListener("click", () => {

            const answer = q.nextElementSibling;

            if(answer.style.display === "block"){
                answer.style.display = "none";
            }else{
                answer.style.display = "block";
            }

        });
    });

</script>

</body>
</html>
