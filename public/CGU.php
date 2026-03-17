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
    <title>Conditions Globales D'utilisation</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">
    <style>
        h1{
            text-align: center;
            font-size: 25px;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }
        h2{
            text-align: left;
            font-size: 20px;
            font-family: Arial, sans-serif;
        }
        p{
            font-size: 15px;
            font-family: Arial, sans-serif;
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
<h1> CONDITIONS GÉNÉRALES D’UTILISATION</h1><br><br>

**Dernière mise à jour : [date]**<br><br>

<h2>1. Objet</h2><br><br>

<p>Les présentes CGU ont pour objet de définir les modalités et conditions d’utilisation du site **[Nom du site]**, plateforme de mise en relation entre étudiants et professionnels de santé mentale.<br><br>

    L’accès et l’utilisation du site impliquent l’acceptation pleine et entière des présentes CGU.</p><br><br>

<h2>2. Définitions</h2><br><br>

<p>**Utilisateur** : toute personne utilisant le site (étudiant ou professionnel de santé).<br>
    **Compte** : espace personnel créé sur la plateforme.<br>
    **Professionnel** : médecin ou praticien inscrit sur la plateforme.<br>
    **Service** : ensemble des fonctionnalités de mise en relation et de prise de rendez-vous.</p><br><br>

<h2>3. Accès au service</h2><br><br>

<p>Le site est accessible :<br><br>

    * 24h/24 et 7j/7 (sauf maintenance)<br>
    * Sous réserve de disponibilité technique<br><br>

    L’éditeur se réserve le droit de suspendre l’accès temporairement pour maintenance ou mise à jour.</p><br><br>

<h2>4. Inscription et compte utilisateur</h2><br><br>

<p>Certaines fonctionnalités nécessitent la création d’un compte.<br><br>

    L’utilisateur s’engage à :<br><br>

    * Fournir des informations exactes<br>
    * Maintenir ses données à jour<br>
    * Conserver la confidentialité de ses identifiants<br>
    * Ne pas partager son compte<br><br>

    L’éditeur peut suspendre ou supprimer un compte en cas de non-respect des CGU.</p><br><br>

<h2>5. Rôle de la plateforme</h2><br><br>

<p>La plateforme agit uniquement comme **intermédiaire technique de mise en relation**.<br><br>

    Elle ne :<br><br>

    * Ne fournit pas de diagnostic médical<br>
    * Ne remplace pas une consultation<br>
    * N’exerce pas d’activité médicale<br><br>

    Les consultations sont réalisées sous la seule responsabilité des professionnels de santé.</p><br><br>

<h2>6. Responsabilité des utilisateurs</h2><br><br>

<p>Chaque utilisateur est responsable :<br><br>

    * Des informations qu’il publie<br>
    * De son comportement sur la plateforme<br>
    * Du respect des lois en vigueur<br><br>

    Tout contenu illégal, diffamatoire ou contraire aux bonnes mœurs pourra être supprimé sans préavis.</p><br><br>

<h2>7. Données de santé</h2><br><br>

<p>Les données de santé éventuellement transmises :<br><br>

    * Sont traitées conformément au RGPD<br>
    * Nécessitent un **consentement explicite**<br>
    * Sont strictement limitées au nécessaire<br><br>

    L’utilisateur peut retirer son consentement à tout moment.</p><br><br>

<h2>8. Comportement interdit</h2><br><br>

<p>Il est strictement interdit de :<br><br>

    * Usurper l’identité d’un tiers<br>
    * Publier des contenus offensants ou discriminatoires<br>
    * Tenter d’accéder frauduleusement au système<br>
    * Utiliser la plateforme à des fins illégales<br>
    * Extraire massivement des données (scraping)</p><br><br>

<h2>9. Disponibilité et sécurité</h2><br><br>

<p>L’éditeur met en œuvre des mesures raisonnables pour assurer :<br><br>

    * La sécurité des données<br><br>
    * La protection contre les accès non autorisés<br><br>

    Cependant, aucun système informatique ne peut garantir une sécurité absolue.</p><br><br>

<h2>10. Propriété intellectuelle</h2><br><br>

<p>Tous les éléments du site sont protégés par le droit de la propriété intellectuelle.<br><br>

    Toute reproduction sans autorisation est interdite.</p><br><br>

<h2>11. Modification des CGU</h2><br><br>

<p>Les CGU peuvent être modifiées à tout moment.<br>
    La version applicable est celle publiée sur le site à la date d’utilisation.</p><br><br>

<h2>12. Suspension / Résiliation</h2><br><br>

<p>L’éditeur peut suspendre ou supprimer un compte en cas :<br><br>

    * De non-respect des CGU<br>
    * De comportement frauduleux<br>
    * De risque pour la sécurité du service<br><br>

    L’utilisateur peut supprimer son compte à tout moment.</p><br><br>

<h2>13. Limitation de responsabilité</h2><br><br>

<p>Dans la limite autorisée par la loi :<br><br>

    * L’éditeur ne saurait être responsable des décisions médicales prises<br>
    * La responsabilité médicale incombe aux professionnels<br>
    * L’éditeur ne garantit pas l’obtention d’un rendez-vous</p><br><br>

<h2>14. Droit applicable et litiges</h2><br><br>

<p>Les présentes CGU sont régies par le droit français.<br><br>

    En cas de litige :<br><br>

    * Recherche d’une solution amiable prioritaire<br>
    * À défaut, compétence des tribunaux du siège social de l’éditeur
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