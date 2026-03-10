<?php
require_once 'config.php';

// Interface simple pour gérer les cours
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des cours</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f8f9fa;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 2px;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-success {
            background: #28a745;
            color: white;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        form {
            max-width: 500px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🎓 Administration des cours</h1>
        <a href="index.php" style="color: white;">← Voir le calendrier</a>
    </div>

    <div class="section">
        <h2>Ajouter un cours</h2>
        <form method="POST" action="ajouter_cours.php">
            <div class="form-group">
                <label>Professeur</label>
                <select name="professeur_id" required>
                    <?php
                    $profs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
                    foreach($profs as $p) {
                        echo "<option value='{$p['id']}'>{$p['nom']} - {$p['specialite']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Titre du cours</label>
                <input type="text" name="titre" value="Arabe avec Youssef" required>
            </div>

            <div class="form-group">
                <label>Jour</label>
                <select name="jour_semaine" required>
                    <option value="0">Lundi</option>
                    <option value="1">Mardi</option>
                    <option value="2">Mercredi</option>
                    <option value="3">Jeudi</option>
                    <option value="4">Vendredi</option>
                    <option value="5">Samedi</option>
                    <option value="6">Dimanche</option>
                </select>
            </div>

            <div class="form-group">
                <label>Heure de début</label>
                <input type="time" name="heure_debut" step="1800" value="07:00" min="07:00" max="20:00" required>
            </div>

            <div class="form-group">
                <label>Durée (minutes)</label>
                <input type="number" name="duree_minutes" value="25" required>
            </div>

            <button type="submit" class="btn btn-success">Ajouter le cours</button>
        </form>
    </div>

    <div class="section">
        <h2>Cours existants</h2>
        <table>
            <thead>
            <tr>
                <th>Professeur</th>
                <th>Titre</th>
                <th>Jour</th>
                <th>Horaire</th>
                <th>Durée</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $cours = $pdo->query("
                        SELECT c.*, p.nom as prof_nom 
                        FROM cours_hebdomadaires c
                        JOIN professeurs p ON c.professeur_id = p.id
                        ORDER BY c.jour_semaine, c.heure_debut
                    ")->fetchAll();

            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

            foreach($cours as $c):
                ?>
                <tr>
                    <td><?= htmlspecialchars($c['prof_nom']) ?></td>
                    <td><?= htmlspecialchars($c['titre']) ?></td>
                    <td><?= $jours[$c['jour_semaine']] ?></td>
                    <td><?= substr($c['heure_debut'], 0, 5) ?></td>
                    <td><?= $c['duree_minutes'] ?> min</td>
                    <td>
                        <a href="supprimer_cours.php?id=<?= $c['id'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer ce cours ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>