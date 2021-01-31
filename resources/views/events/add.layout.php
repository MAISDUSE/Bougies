@extends('layout/app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de création d'un event</h3>
                </div>

                <form action="" method="post" class="form-horizontal">
                    <!-- .card-body -->
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nom de l'event" value="<?php if(isset($name)) echo htmlspecialchars($name); ?>" required autofocus>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Créer</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
