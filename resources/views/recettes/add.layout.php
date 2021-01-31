@extends('layout/app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de création d'une recette</h3>
                </div>

                <form action="" method="post" class="form-horizontal">
                    <!-- .card-body -->
                    <div class="card-body">
                        @csrf

                        <div class="form-group">
                            <label for="id_bougie">Bougie :</label>
                            <select name="id_bougie" id="id_bougie" class="form-control" required autofocus>
                                <option value="" disabled selected>Selectionnez une bougie...</option>
                                <?php foreach ($bougies as $bougie): ?>
                                    <option value="<?= $bougie->id_bougie ?>"><?= htmlspecialchars($bougie->nom_bougie) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_odeur">Odeur :</label>
                            <select name="id_odeur" id="id_odeur" class="form-control" required>
                                <option value="" disabled selected>Selectionnez une odeur...</option>
                                <?php foreach ($odeurs as $odeur): ?>
                                    <option value="<?= $odeur->id_odeur ?>"><?= htmlspecialchars($odeur->nom_odeur) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantite" class="col-form-label">Quantité</label>
                            <input type="text" name="quantite" class="form-control" id="quantite" placeholder="Quantité" value="<?php if(isset($quantite)) echo htmlspecialchars($quantite); ?>" required>
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
