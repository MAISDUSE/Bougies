<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bougies</title>
</head>
<body>

    <h2>Afficher attributs bougie n°<?= $bougie->id_bougie ?> :</h2>

    <ul>
        <?php foreach ($bougie as $attr => $value): ?>
            <li><?= $attr ?> => <?= $value ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>