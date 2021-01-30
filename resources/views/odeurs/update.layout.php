@extends('layout/app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de modification d'une odeur</h3>
                </div>

                <form action="" method="post" class="form-horizontal">
                    <!-- .card-body -->
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nom de l'odeur" value="<?= htmlspecialchars($odeur->nom_odeur); ?>" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="statut_odeur">Statut :</label>
                            <select name="statut_odeur" id="statut_odeur" class="form-control" required>
                                <option value="<?= $odeur->statut_odeur ?>" selected><?= htmlspecialchars(ucfirst($odeur->statut_odeur)) ?></option>
                                <option value="" disabled> ------------- </option>
                                <option value="possess">Possess</option>
                                <option value="wish">Wish</option>
                                <option value="idea">idea</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
