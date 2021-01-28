@extends('layout/app')



@section('content')
    <h2>Collection - Update</h2>


    <!--editForm-->


    <form method="post" class="collection" id="collectionUpdate">
      @csrf

      <div class="">
        <label for="newName">collection :</label>
        <input type="text" name="newName" id="newName" value=<?=$collection->nom_collection?> required>
        <input type="hidden" name="id" id="id" value=<?=$collection->id_collection?> disabled>
      </div>

      <div class="sbmit">
        <input type="submit" name="formsend" id="formsend" value="Enregistrer les modifications">
      </div>

    </form>


@endsection
