
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chat Privé avec Modérateur</title>
</head>
<body>
<h1>Chat Privé d'Aide</h1>
<p>Vous discutez avec un modérateur. Seuls vous et le modérateur pouvez voir ces messages.</p>

<div class="chat">
    <?php foreach ($messages as $msg): ?>
        <div class="message <?php echo $msg['sender']; ?>">
            <strong><?php echo ucfirst($msg['sender']); ?>:</strong> <?php echo $msg['message']; ?>
            <small>(<?php echo $msg['timestamp']; ?>)</small>
        </div>
    <?php endforeach; ?>
</div>

<form method="POST">
    <textarea name="message" placeholder="Tapez votre message..." required></textarea><br>
    <button type="submit">Envoyer</button>
</form>

<p><a href="logout.php">Se déconnecter</a></p>
</body>
</html>