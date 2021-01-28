@extends('layout/app')



@section('content')
    <h2>collection - Add new</h2>
    <form method="post" class="collection" id="collectionAdd">
      @csrf

      <div class="">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" placeholder="Le nom de la nouvelle collection" required>
      </div>

      <div class="sbmit">
        <input type="submit" name="formsend" id="formsend" value="Ajouter la collection">
      </div>

    </form>


@endsection
