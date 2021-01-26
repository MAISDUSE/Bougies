<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bougies</title>
</head>
<body>

    <h2>Toutes les bougies :</h2>

    <ul>
        <?php foreach ($bougies as $bougie): ?>
            <li><?= $bougie->id_bougie ?> : <?= $bougie->nom_bougie ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>