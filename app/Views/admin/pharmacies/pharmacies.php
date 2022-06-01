<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row mb-5 px-4 px-lg-0">

    <div class="col-12 py-4 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Apotek</li>
            </ol>
        </nav>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="col-12 px-0">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-12 p-4 bg-body rounded shadow-sm my-2">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="d-flex flex-column flex-lg-row gap-4">
                    <?php if (count($pharmacies) > 0) : ?>
                        <div class="input-group" style="max-width: 300px">
                            <input type="search" class="form-control border-end-0" name="search" placeholder="Pencarian" aria-label="" aria-describedby="">
                            <span class="input-group-text bg-white" id="">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <div class="btn-group" r gap-4ole="group" aria-label="">
                            <button type="button" class="btn btn-secondary px-4 fw-bold text-uppercase btn__export" data-target="pdf">PDF</button>
                            <button type="button" class="btn btn-secondary px-4 fw-bold text-uppercase btn__export" data-target="excel">Excel</button>
                            <button type="button" class="btn btn-secondary px-4 fw-bold text-uppercase btn__export" data-target="print">Print</button>
                        </div>
                    <?php endif ?>

                    <a href="<?= route_to('adminPharmaciesCreate') ?>" class="btn btn-primary rounded px-4 fw-bold text-uppercase">Tambah Apotek</a>
                </div>
            </div>

            <div class="col-12">
                <table class="table table-hover table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Nama Apotek</th>
                            <th scope="col">Nama Apoteker</th>
                            <th scope="col">No. SIPA</th>
                            <th scope="col">No. SIA</th>
                            <th scope="col">Berakhir Izin</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($pharmacies as $pharmacy) : ?>
                            <tr>
                                <th><?= $no++; ?></th>
                                <td><?= $pharmacy['district_name']; ?></td>
                                <td><?= $pharmacy['name']; ?></td>
                                <td><?= $pharmacy['pharmacist_name']; ?></td>
                                <td><?= $pharmacy['pharmacist_sipa_number']; ?></td>
                                <td><?= $pharmacy['sia_number']; ?></td>
                                <td><?= $pharmacy['sia_expiration_date']; ?></td>
                                <td><?= $pharmacy['address']; ?></td>
                                <td><?= $pharmacy['longitude']; ?></td>
                                <td><?= $pharmacy['latitude']; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="">
                                        <a href="<?= route_to('adminPharmaciesUpdate', $pharmacy["id"]); ?>" class="btn btn-secondary d-inline-block me-2 rounded">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <form action="<?= route_to('adminPharmaciesDelete', $pharmacy["id"]); ?>" method="post" onclick="return confirm('Apa kamu yakin ingin menghapus data ini?')">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-secondary d-inline-block rounded">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>
<?= $this->section('script') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: 'Sukses!',
            text: " <?= session()->getFlashdata('success') ?>",
            icon: 'success',
            customClass: {
                confirmButton: 'btn btn-primary px-4 text-uppercase fw-bold',
            },
            buttonsStyling: false,
            confirmButtonText: 'Ok'
        })
    </script>
<?php endif; ?>
<script>
    $('#data-table').DataTable({
        language: window.dataTableId,
        pagingType: "simple",
        pageLength: 10,
        dom: `
        <'row mb-md-2'<'col-sm-12 d-none'lfB>>
        <'row no-gutters table-responsive'<'col-sm-12'rt>>
        <'row'<'col-sm-5 my-3 mb-md-0'i><'col-sm-7 mt-0 mt-md-3'p>>`,
        buttons: [{
                extend: 'pdfHtml5',
                text: 'Pdf',
                orientation: 'landscape',
                download: 'open',
                pageSize: 'Legal',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                },
                customize: function(doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                        .length +
                        1).join('*').split('');
                    doc.styles.title = {
                        alignment: 'left',
                        fontSize: 20
                    };
                    doc.defaultStyle.alignment = 'left';
                    doc.styles.tableHeader.alignment = 'left';
                }
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }, {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                },
            },
        ]
    });


    $(document).on('click', '.btn__export', function(e) {
        e.stopPropagation();
        let target = $(this).data('target');

        if (target === 'print') {
            $('.buttons-print').trigger('click');
        } else if (target === 'excel') {
            $('.buttons-excel').trigger('click');
        } else if (target === 'csv') {
            $('.buttons-csv').trigger('click');
        } else if (target === 'pdf') {
            $('.buttons-pdf').trigger('click');
        }
    });
</script>
<?= $this->endSection('script') ?>