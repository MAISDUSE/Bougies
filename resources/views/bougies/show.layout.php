@extends('layout/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title m-0">Détail d'une bougie</h3>
                </div>

                <div class="card-body">
                    <p>Nom : <?= htmlspecialchars($bougie->nom_bougie) ?></p>
                    <p>Livre : <?= htmlspecialchars($bougie->livre()->titre) ?></p>
                    <p>Collection : <?= htmlspecialchars($bougie->collection()->nom_collection) ?></p>
                    <p>Statut : <?= htmlspecialchars(ucfirst($bougie->statut_bougie)) ?></p>
                    <p>Recettes :</p>
                    <?php if (count($bougie->recettes()) != 0): ?>
                        <ul>
                            <?php foreach ($bougie->recettes() as $recette): ?>

                                <li>Quantité : <?= htmlspecialchars($recette->quantité) ?> - <a href="/recettes/<?= $recette->id_recette ?>">Voir</a></li>

                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Cette bougie n'a pas encore de recettes.</p>
                    <?php endif; ?>
                </div>

                <?php if(\core\Authentication::can("edit")): ?>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-sm" href="/bougies/<?= $bougie->id_bougie ?>/update">
                            <i class="fas fa-pencil-alt"></i>
                            Modifier
                        </a>

                        <?php if(\core\Authentication::can("delete")): ?>
                            <a class="btn btn-danger btn-sm" href="/bougies/<?= $bougie->id_bougie ?>/delete">
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
