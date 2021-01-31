@extends('layout/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title m-0">Détail d'un livre</h3>
                </div>

                <div class="card-body">
                    <p>Nom : <?= htmlspecialchars($livre->titre) ?></p>
                    <p>Auteur : <?= htmlspecialchars($livre->auteur()->nom_auteur) ?></p>
                    <p>Bougies :</p>
                    <?php if (count($livre->bougies()) != 0): ?>
                        <ul>
                            <?php foreach ($livre->bougies() as $bougie): ?>

                                <li><?= htmlspecialchars($bougie->nom_bougie) ?> - <a href="/bougies/<?= $bougie->id_bougie ?>">Voir</a></li>

                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Ce livre n'a pas encore de bougies.</p>
                    <?php endif; ?>

                </div>

                <?php if(\core\Authentication::can("edit")): ?>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-sm" href="/livres/<?= $livre->id_livre ?>/update">
                            <i class="fas fa-pencil-alt"></i>
                            Modifier
                        </a>

                        <?php if(\core\Authentication::can("delete")): ?>
                            <a class="btn btn-danger btn-sm" href="/livres/<?= $livre->id_livre ?>/delete">
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
