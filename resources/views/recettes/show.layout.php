@extends('layout/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title m-0">Détail d'une recette</h3>
                </div>

                <div class="card-body">
                    <p>Bougie : <?= htmlspecialchars($recette->bougie()->nom_bougie) ?></p>
                    <p>Odeur : <?= htmlspecialchars($recette->odeur()->nom_odeur) ?></p>
                    <p>Quantité : <?= htmlspecialchars($recette->quantité) ?></p>
                </div>

                <?php if(\core\Authentication::can("edit")): ?>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-sm" href="/recettes/<?= $recette->id_recette ?>/update">
                            <i class="fas fa-pencil-alt"></i>
                            Modifier
                        </a>

                        <?php if(\core\Authentication::can("delete")): ?>
                            <a class="btn btn-danger btn-sm" href="/recettes/<?= $recette->id_recette ?>/delete">
                                <i class="fas fa-trash"></i>
                                Supprimer
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
@endsection
