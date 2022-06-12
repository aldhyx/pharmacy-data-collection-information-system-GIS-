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
    <link href="<?= base_url() ?>/assets/datatables/datatables.min.css" rel="stylesheet">
    <link href="/assets/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css" />

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
                        <a class="nav-link active" aria-current="page" href="<?= route_to('adminHome') ?>">Home</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link active" href="<?= route_to('adminProfile') ?>">Admin</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link active" href="<?= route_to('adminDistricts') ?>">Kecamatan</a>
                    </li>
                    <li class="nav-item p-3">
                        <a class="nav-link active" href="<?= route_to('adminPharmacies') ?>">Apotek</a>
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
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Formulir belum lengkap!',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary px-4 text-uppercase fw-bold',
                                },
                                buttonsStyling: false,
                                confirmButtonText: 'Ok'
                            })
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();

        window.dataTableId = {
            emptyTable: "Tidak ada data yang tersedia pada tabel ini",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
            lengthMenu: "Tampilkan _MENU_ entri",
            loadingRecords: "Sedang memuat...",
            processing: "Sedang memproses...",
            search: "Cari:",
            zeroRecords: "Tidak ditemukan data yang sesuai",
            thousands: "'",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya",
            },
            aria: {
                sortAscending: ": aktifkan untuk mengurutkan kolom ke atas",
                sortDescending: ": aktifkan untuk mengurutkan kolom menurun",
            },
            autoFill: {
                cancel: "Batalkan",
                fill: "Isi semua sel dengan <i>%d</i>",
                fillHorizontal: "Isi sel secara horizontal",
                fillVertical: "Isi sel secara vertikal",
            },
            buttons: {
                collection: "Kumpulan <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'/>",
                colvis: "Visibilitas Kolom",
                colvisRestore: "Kembalikan visibilitas",
                copy: "Salin",
                copySuccess: {
                    1: "1 baris disalin ke papan klip",
                    _: "%d baris disalin ke papan klip",
                },
                copyTitle: "Salin ke Papan klip",
                csv: "CSV",
                excel: "Excel",
                pageLength: {
                    "-1": "Tampilkan semua baris",
                    _: "Tampilkan %d baris",
                },
                pdf: "PDF",
                print: "Cetak",
                copyKeys: "Tekan ctrl atau u2318 + C untuk menyalin tabel ke papan klip.<br /><br />Untuk membatalkan, klik pesan ini atau tekan esc.",
            },
            searchBuilder: {
                add: "Tambah Kondisi",
                button: {
                    0: "Cari Builder",
                    _: "Cari Builder (%d)",
                },
                clearAll: "Bersihkan Semua",
                condition: "Kondisi",
                data: "Data",
                deleteTitle: "Hapus filter",
                leftTitle: "Ke Kiri",
                logicAnd: "Dan",
                logicOr: "Atau",
                rightTitle: "Ke Kanan",
                title: {
                    0: "Cari Builder",
                    _: "Cari Builder (%d)",
                },
                value: "Nilai",
                conditions: {
                    date: {
                        after: "Setelah",
                        before: "Sebelum",
                        between: "Diantara",
                        empty: "Kosong",
                        equals: "Sama dengan",
                        not: "Tidak sama",
                        notBetween: "Tidak diantara",
                        notEmpty: "Tidak kosong",
                    },
                    number: {
                        between: "Diantara",
                        empty: "Kosong",
                        equals: "Sama dengan",
                        gt: "Lebih besar dari",
                        gte: "Lebih besar atau sama dengan",
                        lt: "Lebih kecil dari",
                        lte: "Lebih kecil atau sama dengan",
                        not: "Tidak sama",
                        notBetween: "Tidak diantara",
                        notEmpty: "Tidak kosong",
                    },
                    string: {
                        contains: "Berisi",
                        empty: "Kosong",
                        endsWith: "Diakhiri dengan",
                        equals: "Sama Dengan",
                        not: "Tidak sama",
                        notEmpty: "Tidak kosong",
                        startsWith: "Diawali dengan",
                    },
                    array: {
                        equals: "Sama dengan",
                        empty: "Kosong",
                        contains: "Berisi",
                        not: "Tidak",
                        notEmpty: "Tidak kosong",
                        without: "Tanpa",
                    },
                },
            },
            searchPanes: {
                clearMessage: "Bersihkan Semua",
                count: "{total}",
                countFiltered: "{shown} ({total})",
                title: "Filter Aktif - %d",
                collapse: {
                    0: "Panel Pencarian",
                    _: "Panel Pencarian (%d)",
                },
                emptyPanes: "Tidak Ada Panel Pencarian",
                loadMessage: "Memuat Panel Pencarian",
            },
            infoThousands: ",",
            select: {
                cells: {
                    1: "1 sel terpilih",
                    _: "%d sel terpilih",
                },
                columns: {
                    1: "1 kolom terpilih",
                    _: "%d kolom terpilih",
                },
            },
            datetime: {
                previous: "Sebelumnya",
                next: "Selanjutnya",
                hours: "Jam",
                minutes: "Menit",
                seconds: "Detik",
                unknown: "-",
                amPm: ["am", "pm"],
                weekdays: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                months: [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember",
                ],
            },
            editor: {
                close: "Tutup",
                create: {
                    button: "Tambah",
                    submit: "Tambah",
                    title: "Tambah inputan baru",
                },
                remove: {
                    button: "Hapus",
                    submit: "Hapus",
                    confirm: {
                        _: "Apakah Anda yakin untuk menghapus %d baris?",
                        1: "Apakah Anda yakin untuk menghapus 1 baris?",
                    },
                    title: "Hapus inputan",
                },
                multi: {
                    title: "Beberapa Nilai",
                    info: "Item yang dipilih berisi nilai yang berbeda untuk input ini. Untuk mengedit dan mengatur semua item untuk input ini ke nilai yang sama, klik atau tekan di sini, jika tidak maka akan mempertahankan nilai masing-masing.",
                    restore: "Batalkan Perubahan",
                    noMulti: "Masukan ini dapat diubah satu per satu, tetapi bukan bagian dari grup.",
                },
                edit: {
                    title: "Edit inputan",
                    submit: "Edit",
                    button: "Edit",
                },
                error: {
                    system: 'Terjadi kesalahan pada system. (<a target="\\" rel="\\ nofollow" href="\\">Informasi Selebihnya</a>).',
                },
            },
        }
    </script>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
    <?= $this->renderSection('script') ?>
</body>

</html>