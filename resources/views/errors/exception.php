<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $name ?></title>
</head>
<body>
    <h1><?= $name ?></h1>

        <?php if(is_array($error)): ?>
            <pre><?= print_r($error); ?></pre>
        <?php else: ?>
            <pre><?= $error ?></pre>
        <?php endif; ?>
</body>
</html>