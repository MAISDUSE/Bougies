<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Login</title>
    <link rel="stylesheet" href="/css/temp.css">
  </head>
  <body>
    <section id="sectionLogin">


        <h2>Connexion - Log In</h2>
        <form action="" method="post" class="infosconnexion" id="loginForm">
            @csrf
          <div class="">
            <label for="login">Login: </label>
            <input type="text" name="login" id="login" placeholder="Votre login" required>
          </div>



          <div class="">
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" id="password" placeholder="Votre Mot de passe" required>
          </div>

          <div class="sbmit">
            <input type="submit" name="formlogin" id="formlogin" value="Se connecter">
          </div>

        </form>
  </body>
</html>
