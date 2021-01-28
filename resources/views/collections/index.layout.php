@extends('layout/app')



@section('content')
    <h2>collection - Liste</h2>


    <!--show + buttons-->

    <table>
    <caption>All the collections - <a href="./collections/add">New</a></caption>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Collection</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <?php foreach ($collections as $key => $value): ?>
        <tr>
            <td scope="col"><?= $key ?></td>
            <td scope="col"><?= $value->nom_collection ?></td>
            <td scope="col"><a href="./collections/<?=$value->id_collection?>/update">Update</a></td>
            <td scope="col"><a href="./collections/<?=$value->id_collection?>/delete">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </table>



@endsection
