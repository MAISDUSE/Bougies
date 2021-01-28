@extends('layout/app')

@section('content')
    <h2><?= $param1 ?></h2>

    <h3>Ptite boucle :</h3>
    <ul>
        <?php foreach ($param2 as $key => $value): ?>
            <li><?= $key ?> =&gt; <?= $value ?></li>
        <?php endforeach; ?>
    </ul>
@endsection