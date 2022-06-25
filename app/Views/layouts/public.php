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

        .nav-link.active {
            color: #fff !important;
            background: #2880ca;
            border-radius: 5px;
        }
    </style>

    <link href="<?= base_url() ?>/assets/css/offcanvas.css" rel="stylesheet">
    <link href="/assets/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />

    <?= $this->renderSection('style') ?>
    <style>
        .form-control.is-valid,
        .was-validated .form-control:valid {
            border-color: #ced4da;
            padding-right: .75rem;
            background-image: none;
        }

        .form-select.is-valid:not([multiple]):not([size]),
        .form-select.is-valid:not([multiple])[size="1"],
        .was-validated .form-select:valid:not([multiple]):not([size]),
        .was-validated .form-select:valid:not([multiple])[size="1"] {
            padding-right: .75rem;
            background-image: none;
        }

        .form-select.is-valid,
        .was-validated .form-select:valid {
            border-color: #ced4da;
        }

        .form-select.is-valid:focus,
        .was-validated .form-select:valid:focus,
        .form-control.is-valid:focus,
        .was-validated .form-control:valid:focus,
        .form-control:focus,
        .form-select:focus {
            border-color: #ced4da;
            box-shadow: none;
        }
    </style>
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
                        <a class="nav-link <?= $page == 'maps' ? 'active' : ''; ?>" href="<?= route_to('maps') ?>">Peta</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link <?= $page == 'pharmacies' ? 'active' : ''; ?>" href="<?= route_to('pharmacies') ?>">Apotek</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link <?= $page == 'login' ? 'active' : ''; ?>" href="<?= route_to('login') ?>">Login</a>
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
    <script src="<?= base_url() ?>/assets/datatables/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();
    </script>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <?= $this->renderSection('script') ?>
</body>

</html>