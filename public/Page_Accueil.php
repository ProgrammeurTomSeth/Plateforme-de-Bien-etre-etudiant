<?php
$pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bien-être Étudiant - Accueil</title>
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
            <p class="hero-subtitle">Une réponse en moins de 24h pour votre bien-être</p>
            <div class="hero-buttons">
                <button class="btn btn-primary">Trouver un professionnel</button>
                <button class="btn btn-secondary">En savoir plus</button>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <h2 class="section-title">Nos Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <h3>Messagerie</h3>
                    </div>
                    <p>Échangez par écrit avec un professionnel qualifié</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <h3>Visioconférence</h3>
                    </div>
                    <p>Consultations en ligne depuis chez vous</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <h3>Rendez-vous physique</h3>
                    </div>
                    <p>Rencontrez un professionnel près de chez vous</p>
                </div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Professionnels</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><24h</div>
                    <div class="stat-label">Temps de réponse</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Satisfaction</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Disponibilité</div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">Comment ça marche ?</h2>
            <div class="steps-grid">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Inscrivez-vous</h3>
                    <p>Créez votre compte en quelques minutes</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Trouvez votre professionnel</h3>
                    <p>Parcourez notre répertoire et choisissez</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Prenez rendez-vous</h3>
                    <p>Sélectionnez un créneau qui vous convient</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Recevez de l'aide</h3>
                    <p>Bénéficiez d'un accompagnement personnalisé</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Ils témoignent</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"J'ai trouvé une aide rapide et bienveillante. Le fait de pouvoir échanger par message m'a vraiment aidé."</p>
                    <div class="testimonial-author">- Étudiant en Master, 23 ans</div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"La réponse en moins de 24h, c'est ce qui a fait la différence pour moi dans un moment difficile."</p>
                    <div class="testimonial-author">- Étudiante en Licence, 20 ans</div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Interface simple et professionnels à l'écoute. Je recommande vivement cette plateforme."</p>
                    <div class="testimonial-author">- Étudiant en BTS, 19 ans</div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2>Prêt à prendre soin de vous ?</h2>
            <p>Rejoignez des milliers d'étudiants qui ont fait le premier pas</p>
            <button class="btn btn-primary btn-large">Créer mon compte gratuitement</button>
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