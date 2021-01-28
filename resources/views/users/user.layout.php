@extends('layout/app')

@section('content')
<?php
if(isset($_SESSION['login']) && isset($_SESSION['role']) && isset($_SESSION['id']) ){
    ?>
    <h2>Bienvenue sur votre profil</h2>
    <p>Votre Login : <?=$_SESSION['login'];?></p>
    <p>Votre Role : <?=$_SESSION['role'];?></p>
    <p>Votre ID : <?=$_SESSION['id'];?></p>

    <?php
}
?>
@endsection