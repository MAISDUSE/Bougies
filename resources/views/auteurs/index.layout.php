@extends('layout/app')



@section('content')
    <h2>Auteur - Liste</h2>


    <!--show + buttons-->

    <table>
    <caption>All the autors - <a href="./auteurs/add">New</a></caption>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Auteur</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <?php foreach ($auteurs as $key => $value): ?>
        <tr>
            <td scope="col"><?= $key ?></td>
            <td scope="col"><?= $value->nom_auteur ?></td>
            <td scope="col"><a href="./auteurs/<?=$value->id_auteur?>/update">Update</a></td>
            <td scope="col"><a href="./auteurs/<?=$value->id_auteur?>/delete">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </table>



@endsection
