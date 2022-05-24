<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SIG · Sistem Informasi Geografis</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link href="<?= base_url() ?>/assets/css/offcanvas.css" rel="stylesheet">
    <link href="/assets/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg fixed-top navbar-light shadow-sm bg-white" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="#">SIG</a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item p-3">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link active" href="<?= route_to('adminProfile') ?>">Admin</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link active" href="#">Apotek</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link active" href="<?= route_to('logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main class="container mt-lg-5">
        <?= $this->renderSection('content') ?>
    </main>


    <script src="<?= base_url() ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>/assets/js/offcanvas.js"></script>
</body>

</html>