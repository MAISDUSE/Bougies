@extends('layout/app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de modification d'une bougie</h3>
                </div>

                <form action="" method="post" class="form-horizontal">
                    <!-- .card-body -->
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nom de la bougie" value="<?= htmlspecialchars($bougie->nom_bougie); ?>" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="id_livre">Livre :</label>
                            <select name="id_livre" id="id_livre" class="form-control" required>
                                <option value="<?= $bougie->livre()->id_livre ?>" selected><?= htmlspecialchars($bougie->livre()->titre) ?></option>
                                <option value="" disabled> ------------- </option>
                                <?php foreach ($livres as $livre): ?>
                                    <option value="<?= $livre->id_livre ?>"><?= htmlspecialchars($livre->titre) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_collection">Collection :</label>
                            <select name="id_collection" id="id_collection" class="form-control" required>
                                <option value="<?= $bougie->collection()->id_collection ?>" selected><?= htmlspecialchars($bougie->collection()->nom_collection) ?></option>
                                <option value="" disabled> ------------- </option>
                                <?php foreach ($collections as $collection): ?>
                                    <option value="<?= $collection->id_collection ?>"><?= htmlspecialchars($collection->nom_collection) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="statut_bougie">Statut :</label>
                            <select name="statut_bougie" id="statut_bougie" class="form-control" required>
                                <option value="<?= $bougie->statut_bougie ?>" selected><?= htmlspecialchars(ucfirst($bougie->statut_bougie)) ?></option>
                                <option value="" disabled> ------------- </option>
                                <option value="validée">Validée</option>
                                <option value="neutre">Neutre</option>
                                <option value="rejetée">Rejetée</option>
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