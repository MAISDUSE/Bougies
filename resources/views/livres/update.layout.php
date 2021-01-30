@extends('layout/app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de modification d'un livre</h3>
                </div>

                <form action="" method="post" class="form-horizontal">
                    <!-- .card-body -->
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nom du livre" value="<?= htmlspecialchars($livre->titre); ?>" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="id_auteur">Auteur :</label>
                            <select name="id_auteur" id="id_auteur" class="form-control" required>
                                <option value="<?= $livre->auteur()->id_auteur ?>" selected><?= htmlspecialchars($livre->auteur()->nom_auteur) ?></option>
                                <option value="" disabled> ------------- </option>
                                <?php foreach ($auteurs as $auteur): ?>
                                    <option value="<?= $auteur->id_auteur ?>"><?= htmlspecialchars($auteur->nom_auteur) ?></option>
                                <?php endforeach; ?>
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
