@extends('layout/app')

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Liste des utilisateurs

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
                        Login
                    </th>
                    <th style="width: 25%">
                        Role
                    </th>
                    <th class="text-right" style="width: 20%">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?= $user->id ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($user->login) ?>
                        </td>
                        <td class="project-state">
                            <?php if($user->role == 1): ?>
                                <span class="badge badge-success">Add</span>
                            <?php elseif($user->role == 2): ?>
                                <span class="badge badge-primary">Edit</span>
                            <?php elseif($user->role == 3): ?>
                                <span class="badge badge-danger">Delete</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Admin</span>
                            <?php endif; ?>
                        </td>
                        <td class="project-actions text-right">

                            <a class="btn btn-info btn-sm" href="/users/<?= $user->id ?>">
                                <i class="fas fa-search"></i>
                                Détails
                            </a>

                            <?php if(\core\Authentication::can("admin")): ?>
                                <a class="btn btn-primary btn-sm" href="/admin/<?= $user->id ?>/update">
                                    <i class="fas fa-pencil-alt"></i>
                                    Modifier
                                </a>
                            <?php endif; ?>

                            <?php if(\core\Authentication::can("admin")): ?>
                                <a class="btn btn-danger btn-sm" href="/admin/<?= $user->id ?>/delete">
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
