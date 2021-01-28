@extends('layout/app')



@section('content')
    <h2>Auteur - Edit</h2>


    <!--editForm-->


    <form method="post" class="auteur" id="auteurEdit">
      @csrf

      <div class="">
        <label for="newName">Auteur :</label>
        <input type="text" name="newName" id="newName" value=<?=$auteur->nom_auteur?> required>
        <input type="hidden" name="id" id="id" value=<?=$auteur->id_auteur?> disabled>
      </div>

      <div class="sbmit">
        <input type="submit" name="formsend" id="formsend" value="Enregistrer les modifications">
      </div>

    </form>


@endsection
