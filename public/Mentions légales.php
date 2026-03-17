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
<h1>MENTIONS LÉGALES</h1> <br><br>

**Dernière mise à jour : [date]**<br><br>

<h2>1. Éditeur du site</h2><br><br>

<p>Le présent site **[Nom du site]** est édité par :<br><br>
    **[Nom de la société / association]**<br>
    Forme juridique : [SAS, SARL, Association, etc.]<br>
    Capital social : [si applicable]<br>
    Adresse du siège social : [adresse complète]<br>
    Numéro SIREN / SIRET : [numéro]<br>
    RCS : [ville d’immatriculation, si société commerciale]<br>
    Email : [email de contact]<br>
    Téléphone : [si applicable]<br>

    Directeur de la publication : **[Nom et prénom]**</p><br><br>

<h2>2. Hébergeur</h2><br><br>

<p>Le site est hébergé par :<br><br>

    **[Nom de l’hébergeur]**<br>
    Adresse : [adresse complète]<br>
    Téléphone : [numéro]<br>
    Site web : [URL]</p><br><br>

<h2>3. Objet du site</h2><br><br>

<p>Le site a pour objet de **mettre en relation des étudiants et des professionnels de santé mentale**, et de faciliter la prise de rendez-vous et l’accès à l’information.<br><br>

    Les informations disponibles sur le site ne remplacent pas une consultation médicale.</p><br><br>

<h2>4. Propriété intellectuelle</h2><br><br>

<p>L’ensemble des éléments présents sur le site (textes, images, logos, graphismes, structure, base de données, etc.) sont protégés par le droit de la propriété intellectuelle.<br><br>

    Toute reproduction, représentation, modification ou exploitation, totale ou partielle, sans autorisation préalable écrite, est interdite.</p><br><br>

<h2>5. Responsabilité</h2><br><br>

<p>L’éditeur s’efforce d’assurer l’exactitude des informations diffusées.<br>
    Cependant, il ne peut garantir l’absence d’erreurs ou d’omissions.<br><br>

    Le site ne peut être tenu responsable :<br><br>

    * Des dommages directs ou indirects liés à l’utilisation du service<br>
    * Des contenus publiés par les utilisateurs<br>
    * Des décisions prises par les utilisateurs suite aux informations disponibles<br><br>

    Les professionnels de santé sont seuls responsables de leurs actes dans le cadre de leur pratique.</p><br><br>

<h2>6. Données personnelles</h2><br><br>

<p>Le traitement des données personnelles est détaillé dans la **Politique de Confidentialité**, accessible à l’adresse :[URL de la politique].<br><br>

    Conformément au RGPD et à la loi Informatique et Libertés, les utilisateurs disposent de droits d’accès, de rectification et de suppression de leurs données.<br><br>

    Contact : [email RGPD]</p><br><br>

<h2>7. Droit applicable</h2><br><br>

<p>Les présentes mentions légales sont régies par le droit français.<br>
    En cas de litige, et à défaut de résolution amiable, les tribunaux compétents seront ceux du ressort du siège social de l’éditeur.</p>
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