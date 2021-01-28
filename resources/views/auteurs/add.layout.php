@extends('layout/app')



@section('content')
    <h2>Auteur - Add new</h2>
    <form method="post" class="auteur" id="auteurAdd">
      @csrf

      <div class="">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" placeholder="Le nom du nouvel auteur" required>
      </div>

      <div class="sbmit">
        <input type="submit" name="formsend" id="formsend" value="Ajouter l'auteur">
      </div>

    </form>


@endsection
