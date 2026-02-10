<?php
// Connexion à la base de données
$pdo = new PDO(
    "mysql:host=localhost;dbname=hopital;charset=utf8",
    "root",
    "",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// Suppression du rendez-vous
if (isset($_POST['supprimer_id'])) {
    $stmt = $pdo->prepare("DELETE FROM rendez_vous WHERE id = ?");
    $stmt->execute([$_POST['supprimer_id']]);
}

// Récupération des rendez-vous
$rdvs = $pdo->query("SELECT * FROM rendez_vous");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rendez-vous médicaux</title>
</head>
<body>

<h2>Liste des rendez-vous</h2>

<?php foreach ($rdvs as $rdv) { ?>

    <table border="1" width="800" style="margin-bottom:20px;">
        <tr>
            <th colspan="2">
                <?= htmlspecialchars($rdv['medecin']) ?>
            </th>
        </tr>
        <tr>
            <td width="200" align="center">
                <img src="photo_medecin.jpg" width="150" alt="Photo médecin">
            </td>
            <td>
                <div><strong>Horaires</strong></div>

                <div>Lundi : <?= isset($rdv['lundi']) ? $rdv['lundi'] : '-' ?></div><br>
                <div>Mardi : <?= isset($rdv['mardi']) ? $rdv['mardi'] : '-' ?></div><br>
                <div>Mercredi : <?= isset($rdv['mercredi']) ? $rdv['mercredi'] : '-' ?></div><br>
                <div>Jeudi : <?= isset($rdv['jeudi']) ? $rdv['jeudi'] : '-' ?></div><br>
                <div>Vendredi : <?= isset($rdv['vendredi']) ? $rdv['vendredi'] : '-' ?></div><br>
                <div>Samedi : <?= isset($rdv['samedi']) ? $rdv['samedi'] : '-' ?></div><br>
                <div>Dimanche : <?= isset($rdv['dimanche']) ? $rdv['dimanche'] : '-' ?></div><br>

                <form method="POST" onsubmit="return confirm('Supprimer ce rendez-vous ?');">
                    <input type="hidden" name="supprimer_id" value="<?= $rdv['id'] ?>">
                    <button type="submit">🗑 Supprimer le rendez-vous</button>
                </form>
            </td>
        </tr>
    </table>

<?php }
?>
</body>
</html>