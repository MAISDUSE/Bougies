<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Register</title>
    <link rel="stylesheet" href="/css/temp.css">
  </head>
  <body>
    <section id="sectionRegister">


      <h2>Inscription - Sign In</h2>
      <form method="post" class="infosconnexion" id="signin">
        @csrf @csrf @csrf

        <div class="">
          <label for="login">Login :</label>
          <input type="text" name="login" id="login" placeholder="Votre Login" required>
        </div>

        <div class="">
          <label for="password">Mot de passe : </label>
          <input type="password" name="password" id="password" placeholder="Votre Mot de passe" required>
        </div>

        <div class="">
          <label for="cpassword">Confirmer mot de passe : </label>
          <input type="password" name="cpassword" id="cpassword" placeholder="Confirmez Mot de passe" required>
        </div>

        <div class="sbmit">
          <input type="submit" name="formsend" id="formsend" value="S'inscrire">
        </div>

    </form>
  </body>
</html>
