@extends('layout/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title m-0">Détail d'une Odeur</h3>
                </div>

                <div class="card-body">
                    <p>Nom : <?= htmlspecialchars($odeur->nom_odeur) ?></p>
                    <p>Statut : <?= htmlspecialchars($odeur->statut_odeur) ?></p>
                    <p>Recettes :</p>
                    <?php if (count($odeur->recettes()) != 0): ?>
                        <ul>
                            <?php foreach ($odeur->recettes() as $recette): ?>

                                <li>Quantité : <?= htmlspecialchars($recette->quantité) ?> - <a href="/recettes/<?= $recette->id_recette ?>">Voir</a></li>

                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Cette odeur n'a pas encore de recettes.</p>
                    <?php endif; ?>
                </div>

                <?php if(\core\Authentication::can("edit")): ?>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-sm" href="/odeurs/<?= $odeur->id_odeur ?>/update">
                            <i class="fas fa-pencil-alt"></i>
                            Modifier
                        </a>

                        <?php if(\core\Authentication::can("delete")): ?>
                            <a class="btn btn-danger btn-sm" href="/odeurs/<?= $odeur->id_odeur ?>/delete">
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
