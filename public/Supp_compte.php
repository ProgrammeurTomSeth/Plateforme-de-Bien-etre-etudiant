<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Utilisateur non connecté");
}

if (isset($_POST['confirm_delete'])) {
    ?>
    <p>⚠️ Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>

    <form method="POST">
        <button type="submit" name="delete">Oui, supprimer</button>
        <button type="submit" name="cancel">Annuler</button>
    </form>

    <?php
    exit;
}

// Suppression du compte
if (isset($_POST['delete'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'user', 'password');

    $stmt = $pdo->prepare("DELETE FROM nom_table WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);

    session_destroy();

    // Redirection après suppression
    header("Location: goodbye.php"); // page de confirmation ou accueil
    exit;
}

// Annulation
if (isset($_POST['cancel'])) {
    // Redirection après annulation
    header("Page_Acceuil.php"); // ou dashboard
    exit;
}
?>