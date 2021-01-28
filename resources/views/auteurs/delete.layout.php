@extends('layout/app')



@section('content')
    <h2>Auteur - Delete</h2>


    <!--editForm-->


    <form method="post" class="auteur" id="auteurDelete">
      @csrf

      <div class="">
        <label for="id"><?=$auteur->nom_auteur?></label>
        <input type="hidden" name="id" id="id" value=<?=$auteur->id_auteur?> disabled>
      </div>

      <div class="sbmit">
        <input type="submit" name="formsend" id="formsend" value="Delete">
      </div>

    </form>


@endsection
