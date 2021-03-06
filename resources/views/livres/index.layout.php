@extends('layout/app')

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Liste des livres
                <?php if(\core\Authentication::can("add")): ?>
                    <a class="btn btn-success btn-sm ml-3" href="/livres/add">
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
                        Nom
                    </th>
                    <th style="width: 25%">
                        Auteur
                    </th>
                    <th class="text-right" style="width: 20%">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td>
                            <?= $livre->id_livre ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($livre->titre) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($livre->auteur()->nom_auteur) ?>
                        </td>

                        <td class="project-actions text-right">

                            <a class="btn btn-info btn-sm" href="/livres/<?= $livre->id_livre ?>">
                                <i class="fas fa-search"></i>
                                Détails
                            </a>

                            <?php if(\core\Authentication::can("edit")): ?>
                                <a class="btn btn-primary btn-sm" href="/livres/<?= $livre->id_livre ?>/update">
                                    <i class="fas fa-pencil-alt"></i>
                                    Modifier
                                </a>
                            <?php endif; ?>

                            <?php if(\core\Authentication::can("delete")): ?>
                                <a class="btn btn-danger btn-sm" href="/livres/<?= $livre->id_livre ?>/delete">
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
