<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TP PHP - Bougies <?= $title ?? "" ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="/css/dist/fontawesome/all.min.css">
    <link rel="stylesheet" href="/css/dist/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/css/dist/adminlte.css">

    <link rel="stylesheet" href="/css/dist/toastr.min.css">

    <link rel="stylesheet" href="/css/custom.css">

    @yield('head')
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="/" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Accueil</a>
            </li>

            <?php if (\core\Authentication::can("admin")): ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/admin" class="nav-link">Admin</a>
                </li>
            <?php endif; ?>
        </ul>

        <ul class="navbar-nav ml-auto pr-3">
            <?php if (isset($_SESSION['login'])): ?>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/user" class="nav-link">Profil</a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/logout" class="nav-link">Déconnexion</a>
                </li>

            <?php else: ?>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/login" class="nav-link">Connexion</a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/register" class="nav-link">Inscription</a>
                </li>

            <?php endif; ?>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <i class="fas fa-lg fa-fire mr-1" style="margin-left: .7em;"></i>
            <span class="brand-text font-weight-light">Bougies</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <?php if (isset($_SESSION['login'])): ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/img/avatar4.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="/user" class="d-block"><?= $_SESSION['login'] ?></a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-header">TABLEAU DE BORD</li>

                    <?php if (\core\Authentication::can("admin")): ?>
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    Panel admin
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Statistiques
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-compass"></i>
                            <p>
                                Actions rapides
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/auteurs/add" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Ajouter un auteur</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/bougies/add" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Ajouter une bougie</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/collections/add" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Ajouter une collection</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/auteurs/add" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Ajouter un évènement</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/livres/add" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Ajouter un livre</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/odeurs/add" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Ajouter une odeur</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/recettes/add" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Ajouter une recette</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <!-- end treeview -->


                    <li class="nav-header">AUTEURS</li>

                    <!-- link -->
                    <li class="nav-item">
                        <a href="/auteurs" class="nav-link">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Liste des auteurs
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="/auteurs/add" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Ajouter un auteur
                            </p>
                        </a>
                    </li>

                    <?php endif; ?>
                    <!-- end link -->



                    <li class="nav-header">BOUGIES</li>

                    <!-- link -->
                    <li class="nav-item">
                        <a href="/bougies" class="nav-link">
                            <i class="nav-icon fas fa-candle-holder"></i>
                            <p>
                                Liste des bougies
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="/bougies/add" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Ajouter une bougie
                            </p>
                        </a>
                    </li>

                    <?php endif; ?>
                    <!-- end link -->



                    <li class="nav-header">COLLECTIONS</li>

                    <!-- link -->
                    <li class="nav-item">
                        <a href="/collections" class="nav-link">
                            <i class="nav-icon fas fa-books"></i>
                            <p>
                                Liste des collections
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="/collections/add" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Ajouter une collection
                            </p>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- end link -->


                    <li class="nav-header">EVÈNEMENTS</li>

                    <!-- link -->
                    <li class="nav-item">
                        <a href="/auteurs" class="nav-link">
                            <i class="nav-icon fas fa-calendar-day"></i>
                            <p>
                                Liste des évènements
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="/auteurs/add" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Ajouter un évènement
                            </p>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- end link -->



                    <li class="nav-header">LIVRES</li>

                    <!-- link -->
                    <li class="nav-item">
                        <a href="/livres" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Liste des livres
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="/livres/add" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Ajouter un livre
                            </p>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- end link -->


                    <li class="nav-header">ODEURS</li>

                    <!-- link -->
                    <li class="nav-item">
                        <a href="/odeurs" class="nav-link">
                            <i class="nav-icon fas fa-humidity"></i>
                            <p>
                                Liste des odeurs
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="/odeurs/add" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Ajouter une odeur
                            </p>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- end link -->


                    <li class="nav-header">RECETTES</li>

                    <!-- link -->
                    <li class="nav-item">
                        <a href="/recettes" class="nav-link">
                            <i class="nav-icon fas fa-hat-chef"></i>
                            <p>
                                Liste des recettes
                            </p>
                        </a>
                    </li>

                    <?php if (\core\Authentication::can("add")): ?>
                    <li class="nav-item">
                        <a href="/recettes/add" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Ajouter une recette
                            </p>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- end link -->

                    <li class="nav-header"></li> <!-- vide pour rajouter une marge constante en bas de la barre de nav -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content pt-5">

            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            TP PHP Bougies
        </div>
        ©Copyright | 2021 | Auteurs : Mathieu DUSÉ - Hugo PONTACQ | <a href="https://github.com/MAISDUSE/Bougies" target="_blank">Github</a>
    </footer>

</div>
<!-- ./wrapper -->

<script src="/js/dist/jquery.min.js"></script>
<script src="/js/dist/bootstrap.bundle.min.js"></script>
<script src="/js/dist/jquery.overlayScrollbars.min.js"></script>
<script src="/js/dist/adminlte.min.js"></script>
<script src="/js/dist/toastr.min.js"></script>

@flashdata

@yield('scripts')

</body>

</html>
