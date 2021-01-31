@extends('layout/app')

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Liste des recettes
                <?php if(\core\Authentication::can("add")): ?>
                    <a class="btn btn-success btn-sm ml-3" href="/recettes/add">
                        <i class="fas fa-plus-circle"></i>
                        Ajouter
                    </a>
                <?php endif; ?>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0" style="display: block;">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 25%">
                        Bougie
                    </th>
                    <th style="width: 25%">
                        Odeur
                    </th>
                    <th style="width: 25%">
                        Quantité
                    </th>
                    <th class="text-right" style="width: 20%">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($recettes as $recette): ?>
                    <tr>
                        <td>
                            <?= $recette->id_recette ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($recette->bougie()->nom_bougie) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($recette->odeur()->nom_odeur) ?>
                        </td>
                        <td>
                            <?= $recette->quantité ?>
                        </td>

                        <td class="project-actions text-right">

                            <a class="btn btn-info btn-sm" href="/recettes/<?= $recette->id_recette ?>">
                                <i class="fas fa-search"></i>
                                Détails
                            </a>

                            <?php if(\core\Authentication::can("edit")): ?>
                                <a class="btn btn-primary btn-sm" href="/recettes/<?= $recette->id_recette ?>/update">
                                    <i class="fas fa-pencil-alt"></i>
                                    Modifier
                                </a>
                            <?php endif; ?>

                            <?php if(\core\Authentication::can("delete")): ?>
                                <a class="btn btn-danger btn-sm" href="/recettes/<?= $recette->id_recette ?>/delete">
                                    <i class="fas fa-trash"></i>
                                    Supprimer
                                </a>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection
