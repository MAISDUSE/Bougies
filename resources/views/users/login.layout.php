@extends('layout/app')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3 col-12">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Formulaire de connexion</h3>
            </div>

            <form action="" method="post" class="form-horizontal">
                <!-- .card-body -->
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="login" class="col-form-label">Identifiant</label>
                        <input type="text" name="login" class="form-control" id="login" placeholder="Votre identifiant">
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe">
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Connexion</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
@endsection