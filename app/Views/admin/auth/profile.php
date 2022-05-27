<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row mb-5 px-4 px-lg-0">
    <div class="col-12 py-4 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Admin</li>
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

    <div class="col-lg-4 bg-body rounded shadow-sm my-2 p-4">
        <div class="d-flex flex-column justify-content-center align-items-center py-5">
            <img src="<?= base_url() ?>/assets/images/user.png" alt="" class="img-fluid mb-3" width="150">
            <p class="mb-0">
                <span>
                    <?= $admin['name']; ?>
                </span>
                |
                <span class="fst-italic">
                    @s<?= $admin['username']; ?>
                </span>
            </p>
        </div>
    </div>

    <div class="col-lg  ms-lg-4">
        <div class="row">
            <div class="col-12 bg-body rounded shadow-sm my-2 mb-3 p-4">
                <p class="fw-bold fs-5 text-uppercase pb-3 mb-4 border-bottom">
                    Ubah Data Admin
                </p>

                <form action="<?= route_to('adminProfileUpdate'); ?>" method="post">
                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $admin['name']; ?>" name="name">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Username</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $admin['username']; ?>" required name="username">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label d-none d-md-block"></label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary rounded px-4 fw-bold text-uppercase">simpan</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="col-12 bg-body rounded shadow-sm my-2 p-4">
                <p class="fw-bold fs-5 text-uppercase pb-3 mb-4 border-bottom">
                    Ubah Password Admin
                </p>

                <form action="<?= route_to('adminProfileUpdatePassword'); ?>" method="post">

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Password Baru</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="" value="" required name="password">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Konfimasi Password Baru</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="" value="" required name="password_confirmation">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label d-none d-md-block"></label>
                        <div class="col-md-8">

                            <?php if (session()->getFlashdata('fail-password')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Gagal!</strong> <?= session()->getFlashdata('fail-password') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary rounded px-4 fw-bold text-uppercase">simpan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?= $this->endSection('content') ?>