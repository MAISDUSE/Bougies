@extends('layout/app')



@section('content')
    <h2>collection - Delete</h2>


    <!--editForm-->


    <form method="post" class="auteur" id="collectionDelete">
      @csrf

      <div class="">
        <label for="id"><?=$collection->nom_collection?></label>
        <input type="hidden" name="id" id="id" value=<?=$collection->id_collection?> disabled>
      </div>

      <div class="sbmit">
        <input type="submit" name="formsend" id="formsend" value="Delete">
      </div>

    </form>


@endsection
