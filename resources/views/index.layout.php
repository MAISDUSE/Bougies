@extends('layout/app')


@section('head')
<link rel="stylesheet" href="/css/dist/Chart.min.css">
@endsection


@section('content')
<!-- Small boxes (Stat box) -->
<h2 class="mb-5 ml-3">Accueil - Statistiques</h2>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $nbBougies ?></h3>

                    <p>Bougies</p>
                </div>
                <div class="icon">
                    <i class="fas fa-candle-holder"></i>
                </div>

                <a href="/bougies" class="small-box-footer">Liste des bougies <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $nbAuteurs ?></h3>

                    <p>Auteurs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="/auteurs" class="small-box-footer">Liste des auteurs <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $nbLivres ?></h3>

                    <p>Livres</p>
                </div>
                <div class="icon">
                    <i class="fad fa-book"></i>
                </div>
                <a href="/livres" class="small-box-footer">Liste des livres <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?= $nbEvents ?></h3>

                    <p>Évènements</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <a href="/events" class="small-box-footer">Liste des évènements <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-6">
            <!-- DONUT CHART -->
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Taux d'acceptation des bougies</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChartBougies"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="/js/dist/Chart.min.js"></script>

<script>

    let config = {
        type: 'doughnut',
        data: {
            labels: ["Validées", "Neutres", "Refusées"],
            datasets: [
                {
                    backgroundColor: ["#28a745", "#6c757d","#dc3545"],
                    data: [<?= $taux['validée'] ?>, <?= $taux['neutre'] ?>, <?= $taux['rejetée'] ?>]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: "Taux d'acceptation des bougies"
            }
        }
    };

    let myChart = new Chart(document.getElementById("donutChartBougies"), config);

</script>
@endsection
