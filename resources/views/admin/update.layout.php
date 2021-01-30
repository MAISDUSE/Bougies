@extends('layout/app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de modification d'un utilisateur</h3>
                </div>

                <form action="" method="post" class="form-horizontal">
                    <!-- .card-body -->
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Login</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Login de l'utilisateur" value="<?= htmlspecialchars($user->login); ?>" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="statut_bougie">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="<?= $user->role ?>" selected><?php if($user->role == 1){echo("Add");}elseif($user->role == 2){echo("Edit");}elseif($user->role == 3){echo("Delete");}else{echo("Admin");}  ?></option>
                                <option value="" disabled> ------------- </option>
                                <option value=1>Add</option>
                                <option value=2>Edit</option>
                                <option value=3>Delete</option>
                                <option value=10>Admin</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
