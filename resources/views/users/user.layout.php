<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Index</title>
    <link rel="stylesheet" href="/public/css/style.css">
  </head>
  <body>
    <section id="Me">


     <?php
     if(isset($_SESSION['login']) && isset($_SESSION['role']) && isset($_SESSION['id']) ){
       ?>
       <h2>Bienvenue sur votre profil</h2>
       <p>Votre Login : <?=$_SESSION['login'];?></p>
       <p>Votre Role : <?=$_SESSION['role'];?></p>
       <p>Votre ID : <?=$_SESSION['id'];?></p>
       <form method="post" action="/logout" class="infosconnexion">
         <input type="hidden" value="<?= $csrf ?>" name="csrf">
         <input type="submit" name="deconnexion" id="deconnexion" value="Se deconnecter">
       </form>

       <?php
     }
     ?>
  </body>
</html>
