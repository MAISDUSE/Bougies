@extends('layout/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title m-0">Association de bougies à un évènement</h3>
                </div>

                <div class="card-body">
                    <p>Nom : <?= htmlspecialchars($event->name) ?></p>
                    <p>Bougies associées : <a href="#" id="addBougie" class="text-success"><i class="fas fa-lg fa-plus-circle"></i></a></p>

                    <?php if(count($assocBougies) != 0): ?>

                        <ul>

                            <?php foreach ($assocBougies as $bougie): ?>

                                <li>
                                    <?php if(\core\Authentication::can("delete")): ?>
                                        <a href="/events/<?= $event->id ?>/assocbougie/<?= $bougie->id_bougie ?>/delete" class="text-danger">
                                            <i class="fas fa-lg fa-minus-circle"></i>
                                        </a>
                                        -
                                    <?php endif; ?>

                                    <?= htmlspecialchars($bougie->nom_bougie) ?> - <a href="/bougies/<?= $bougie->id_bougie ?>">Voir</a>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                    <?php else: ?>

                        <p>Aucune bougie n'est encore associée à cet évènement.</p>

                    <?php endif; ?>
                </div>

                <div id="addBougieForm" class="card-footer" style="display: none;">
                    <form action="" method="post" class="form-horizontal">

                        @csrf

                        <div class="form-group">

                            <label for="id_bougie">Bougies :</label>

                            <select name="id_bougie" id="id_bougie" class="form-control" required>

                                <option value="" disabled selected>Selectionnez une bougie...</option>

                                <?php foreach ($bougies as $bougie): ?>

                                    <option value="<?= $bougie->id_bougie ?>"><?= htmlspecialchars($bougie->nom_bougie) ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <button type="submit" class="btn btn-success">Ajouter</button>
                        <a href="#" id="cancelAdd" class="btn btn-defautl">Annuler</a>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let form = $('#addBougieForm');

    document.getElementById('addBougie').addEventListener('click', (event) => {
        event.preventDefault();
        form.show('fast');
    });

    document.getElementById('cancelAdd').addEventListener('click', (event) => {
        event.preventDefault();
        form.hide('fast');
    });
</script>
@endsection