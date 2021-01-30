@extends('layout/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title m-0">Détail d'un auteur</h3>
                </div>

                <div class="card-body">
                    <p>Nom : <?= htmlspecialchars($auteur->nom_auteur) ?></p>
                    <p>Livres de cet auteur :</p>
                    <?php if (count($auteur->livres()) != 0): ?>
                        <ul>
                            <?php foreach ($auteur->livres() as $livre): ?>

                                <li><?= htmlspecialchars($livre->titre) ?> - <a href="/livres/<?= $livre->id_livre ?>">Voir</a></li>

                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Cet auteur n'a pas encore publié de livres.</p>
                    <?php endif; ?>
                </div>

                <?php if(\core\Authentication::can("edit")): ?>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-sm" href="/auteurs/<?= $auteur->id_auteur ?>/update">
                            <i class="fas fa-pencil-alt"></i>
                            Modifier
                        </a>

                        <?php if(\core\Authentication::can("delete")): ?>
                            <a class="btn btn-danger btn-sm" href="/auteurs/<?= $auteur->id_auteur ?>/delete">
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