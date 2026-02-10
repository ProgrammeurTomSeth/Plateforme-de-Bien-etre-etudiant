<?php
// Connexion BDD
$pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// Suppression d’un rendez-vous
if (isset($_POST['supprimer_id'])) {
    $stmt = $pdo->prepare("DELETE FROM RENDEZ_VOUS WHERE id_rendez_vous = ?");
    $stmt->execute(array($_POST['supprimer_id']));
}

// Récupération des rendez-vous
$sql = "
SELECT 
    r.id_rendez_vous,
    r.date_rdv,
    r.mode_consultation,
    r.status_rdv,
    CONCAT(e.prenom, ' ', e.nom) AS etudiant,
    CONCAT(p.prenom, ' ', p.nom) AS professionnel,
    p.specialiste
FROM RENDEZ_VOUS r
JOIN ETUDIANT e ON r.id_etudiant = e.id_etudiant
JOIN PROFESSIONEL p ON r.id_professionel = p.id_professionel
ORDER BY r.date_rdv
";

$rdvs = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rendez-vous</title>
</head>
<body>

<h2>Rendez-vous médicaux</h2>

<?php foreach ($rdvs as $rdv) { ?>

    <table border="1" width="800" style="margin-bottom:20px;">
        <tr>
            <th colspan="2">
                <?= htmlspecialchars($rdv['professionnel']) ?>
                (<?= htmlspecialchars($rdv['specialiste']) ?>)
            </th>
        </tr>

        <tr>
            <td width="200" align="center">
                Photo
            </td>
            <td>
                <div><strong>Informations</strong></div><br>

                <div>Étudiant : <?= htmlspecialchars($rdv['etudiant']) ?></div><br>
                <div>Date : <?= date('d/m/Y H:i', strtotime($rdv['date_rdv'])) ?></div><br>
                <div>Mode : <?= htmlspecialchars($rdv['mode_consultation']) ?></div><br>
                <div>Statut : <?= htmlspecialchars($rdv['status_rdv']) ?></div><br>

                <form method="POST" onsubmit="return confirm('Supprimer ce rendez-vous ?');">
                    <input type="hidden" name="supprimer_id" value="<?= $rdv['id_rendez_vous'] ?>">
                    <button type="submit">🗑 Supprimer le rendez-vous</button>
                </form>
            </td>
        </tr>
    </table>

<?php } ?>

</body>
</html>