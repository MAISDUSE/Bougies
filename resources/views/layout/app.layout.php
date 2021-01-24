<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Document</title>

    @section('head')


</head>
<body>


        @section('main')

        @foreach($var as $key => $value)


        @endforeach




          <h1><?=$param1?></h1>

          <?php
          foreach($param2 as $key => $value){?>

              <h2><?=$value?></h2>

          <?php
          }
          ?>

        <h2>Syntaxe raccourcie : </h2>
    <?php foreach ($param2 as $key => $value): ?>

        <h3><?=$value?></h3>

    <?php endforeach; ?>

</body>
</html>
