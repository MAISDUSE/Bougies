@extends('layout/app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Suppression d'une collection</h3>
                </div>

                <div class="card-body">
                    Voulez vous vraiment supprimer cette collection ?
                </div>

                <form action="" method="post" class="form-horizontal">
                    <!-- .card-body -->
                    @csrf
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
