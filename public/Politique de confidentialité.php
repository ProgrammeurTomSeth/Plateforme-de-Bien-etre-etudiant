<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html >
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
<p> Politique de Confidentialité <br><br>
    **Dernière mise à jour : [date] **<br><br>
    1. Identité du responsable du traitement <br><br>

    Le site ** [Nom du site]** est édité par :<br>
    **[Nom de l’entreprise / association]**<br>
    Statut juridique : [SAS, association, etc .] <br>
    Adresse : [adresse complète]<br>
    Email de contact : [email] <br>
    Délégué à la protection des données(si applicable) : [contact] <br><br>

    2. Données collectées <br><br>

    Dans le cadre de la mise en relation entre étudiants et professionnels de santé mentale, nous pouvons collecter les données suivantes : <br><br>

    Données d’identification <br><br>

    * Nom et prénom <br>
    * Adresse email <br>
    * Numéro de téléphone(si nécessaire)<br>
    * Date de naissance (pour vérifier l’âge minimum)<br><br>

    Données de profil <br><br>

    * Statut(étudiant, médecin, etc.) <br>
    * Université / établissement(facultatif) <br>
    * Spécialité médicale <br>
    * Disponibilités <br><br>

    Données de santé (catégorie sensible – uniquement si nécessaire)<br><br>

    Les informations relatives à la santé mentale sont des ** données sensibles ** au sens du RGPD.<br>
    Elles sont traitées uniquement :<br><br>

    * avec le ** consentement explicite ** de l’utilisateur,<br>
    * ou lorsque cela est nécessaire pour la mise en relation avec un professionnel de santé.<br><br>

    Données techniques <br><br>

    * Adresse IP <br>
    * Cookies <br>
    * Données de navigation <br>
    * Logs de connexion <br><br>

    3. Finalités du traitement <br><br>

    Les données sont utilisées pour :<br><br>

    Créer et gérer les comptes utilisateurs <br>
    Mettre en relation étudiants et médecins <br>
    Permettre la prise de rendez-vous <br>
    Assurer la sécurité de la plateforme <br>
    Améliorer le service <br>
    Respecter nos obligations légales <br><br>

    4. Base légale du traitement <br><br>

    Conformément au RGPD, les traitements reposent sur : <br><br>

    Le ** consentement ** de l’utilisateur <br>
    L’ ** exécution d’un contrat ** (mise en relation)<br>
    Une ** obligation légale **<br>
    L’ ** intérêt légitime ** (sécurité du service)<br><br>

    Pour les données de santé :<br>
    **Consentement explicite obligatoire **.<br><br>

    5. Destinataires des données <br><br>

    Les données peuvent être accessibles :<br><br>

    * Aux médecins partenaires (dans le cadre de la mise en relation)<br>
    * Aux prestataires techniques (hébergement, maintenance) <br>
    * Aux autorités si la loi l’exige <br>

    Nous ne vendons jamais les données personnelles.<br><br>

    6. Hébergement des données <br><br>

    Les données sont hébergées par :<br>
    [Nom de l’hébergeur]<br>
    Localisation des serveurs : [UE / préciser le pays].<br><br>

    Si les données sont transférées hors UE, des garanties appropriées sont mises en place (clauses contractuelles types, etc .).<br><br>

    7. Durée de conservation <br><br>

    Les données sont conservées :<br><br>

    * Pendant la durée d’utilisation du compte <br>
    * Puis supprimées après [X mois / années] d’inactivité <br>
    * Ou selon les obligations légales applicables <br><br>

    Les données de santé sont conservées uniquement le temps strictement nécessaire.<br><br>

    8. Sécurité des données <br><br>

    Nous mettons en place des mesures techniques et organisationnelles :<br><br>

    * Chiffrement des données <br>
    * Accès sécurisé <br>
    * Authentification forte <br>
    * Journalisation des accès <br>
    * Sauvegardes sécurisées <br><br>

    9. Droits des utilisateurs <br><br>

    Conformément au RGPD, vous disposez des droits suivants :<br><br>

    * Droit d’accès <br>
    * Droit de rectification <br>
    * Droit d’effacement <br>
    * Droit d’opposition <br>
    * Droit à la portabilité <br>
    * Droit à la limitation du traitement <br><br>

    Pour exercer vos droits :<br>
    [email de contact RGPD]<br><br>

    Vous pouvez également introduire une réclamation auprès de l’autorité de contrôle :<br>
    En France : **CNIL **.<br><br>

    10. Mineurs <br><br>

    Si le service est accessible aux mineurs :<br><br>

    * Le consentement des titulaires de l’autorité parentale peut être requis selon l’âge applicable.<br>
    * Nous mettons en place des mesures adaptées pour la protection des mineurs.<br><br>

    11. Modification de la politique <br><br>

    Nous pouvons modifier cette politique à tout moment.<br>
    La version mise à jour sera publiée sur cette page.<br></p>
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