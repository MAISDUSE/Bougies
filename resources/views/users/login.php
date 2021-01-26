<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Login</title>
    <link rel="stylesheet" href="/public/css/style.css">
  </head>
  <body>
    <section id="sectionLogin">


        <h2>Connexion - Log In</h2>
        <form method="post" class="infosconnexion" id="login">

          <div class="">
            <label for="login">Login: </label>
            <input type="text" name="login" id="login" placeholder="Votre login" required>
          </div>

          <div class="">
            <label for="lpassword">Mot de passe : </label>
            <input type="password" name="lpassword" id="lpassword" placeholder="Votre Mot de passe" required>
          </div>

          <div class="sbmit">
            <input type="submit" name="formlogin" id="formlogin" value="Se connecter">
            <!--<p><?= $etat ?></p>-->
          </div>

        </form>
  </body>
</html>
