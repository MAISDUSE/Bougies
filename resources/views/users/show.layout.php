@extends('layout/app')

@section('content')
<h2 class="mb-5 ml-3">Mon profil</h2>

<div class="card card-primary card-outline col-md-4 offset-md-4">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="https://i.pravatar.cc/?u=<?= htmlspecialchars($user->login) ?>" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center"><?= htmlspecialchars($user->login) ?></h3>

        <p class="text-muted text-center">Actions possibles :</p>

        <ul class="list-group list-group-unbordered mb-3">
            <?php foreach (\core\Authentication::PERMISSIONS as $perm => $rank): ?>

                <?php if (\core\Authentication::can($rank, $user->id)): ?>
                    <li class="list-group-item">
                        <?= \core\Authentication::PERM_DESC[$perm] ?>
                    </li>
                <?php endif; ?>

            <?php endforeach; ?>
        </ul>
    </div>
    <!-- /.card-body -->
</div>
@endsection