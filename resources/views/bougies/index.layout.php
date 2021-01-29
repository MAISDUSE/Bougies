@extends('layout/app')

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Liste des bougies
                <a class="btn btn-success btn-sm ml-3" href="/bougies/add">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter
                </a>
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
                        Livre
                    </th>
                    <th style="width: 25%">
                        Collection
                    </th>
                    <th style="width: 4%">
                        Etat
                    </th>
                    <th class="text-right" style="width: 20%">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bougies as $bougie): ?>
                    <tr>
                        <td>
                            <?= $bougie->id_bougie ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($bougie->nom_bougie) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars(\app\models\Livre::find($bougie->id_livre)->titre) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars(\app\models\Collection::find($bougie->id_collection)->nom_collection) ?>
                        </td>
                        <td class="project-state">
                            <?php if($bougie->statut_bougie == "validée"): ?>
                                <span class="badge badge-success">Validée</span>
                            <?php elseif($bougie->statut_bougie == "neutre"): ?>
                                <span class="badge badge-secondary">Neutre</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Rejetée</span>
                            <?php endif; ?>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="/bougies/<?= $bougie->id_bougie ?>">
                                <i class="fas fa-search"></i>
                                Détails
                            </a>
                            <a class="btn btn-primary btn-sm" href="/bougies/<?= $bougie->id_bougie ?>/update">
                                <i class="fas fa-pencil-alt"></i>
                                Modifier
                            </a>
                            <a class="btn btn-danger btn-sm" href="/bougies/<?= $bougie->id_bougie ?>/delete">
                                <i class="fas fa-trash"></i>
                                Supprimer
                            </a>
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