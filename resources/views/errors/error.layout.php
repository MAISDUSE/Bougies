@extends('layout/app')

@section('content')
<section class="content">
    <div class="error-page d-flex justify-content-center align-items-center">
        <h2 class="headline text-danger mb-3 mr-5" style="float: none"> <?= $code ?></h2>

        <div class="error-content m-0">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> <?= $title ?></h3>

            <p>
                <?= $text ?> <a href="/">Revenir à l'accueil</a>
            </p>

        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
@endsection