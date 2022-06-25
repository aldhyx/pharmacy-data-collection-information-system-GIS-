<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row mb-5 px-4 px-lg-0">

    <div class="col-12 py-4 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Kecamatan</li>
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

            <div class="col-12">
                <table class="table table-hover table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Kecamatan</th>
                            <th scope="col">Total Populasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($districts as $district) : ?>
                            <tr>
                                <th><?= $no++; ?></th>
                                <td><?= $district['name']; ?></td>
                                <td><?= $district['total_population'] ?? '-'; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="">
                                        <a href="<?= route_to('adminDistrictsUpdate', $district["id"]); ?>" class="btn btn-secondary d-inline-block me-2 rounded">
                                            <i class="fa fa-pen"></i>
                                        </a>
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