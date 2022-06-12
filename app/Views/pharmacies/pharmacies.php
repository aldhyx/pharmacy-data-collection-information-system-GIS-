<?= $this->extend('layouts/public') ?>

<?= $this->section('style') ?>
<style>
</style>
<?= $this->endSection('style') ?>

<?= $this->section('content') ?>
<div class="row mb-5 px-0">
    <div class="col-12 p-4 mt-3 bg-body rounded shadow-sm align-self-end">

        <div class="row g-0">
            <div class="col-12">
                <p class="fw-bold fs-5 text-uppercase pb-3 mb-4 border-bottom">
                    Apotek
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="search" autocomplete="new" class="form-control" placeholder="Cari apotek" aria-label="" aria-describedby="" name="keywords" value="<?= $keywords; ?>">
                        <button type="submit" class="input-group-text" id="basic-addon1">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <?php if ($keywords && !count($pharmacies)) : ?>
                    <p class="">Menampilkan hasil pencarian untuk "<strong><?= $keywords; ?></strong>"</p>

                    <div class="alert alert-secondary" role="alert">
                        Apotek yang dicari tidak ditemukan.
                    </div>
                <?php endif; ?>

                <?php if ($keywords && count($pharmacies) > 0) : ?>
                    <p class="">Menampilkan hasil pencarian untuk "<strong><?= $keywords; ?></strong>"</p>

                    <?php
                    $no = 1;
                    foreach ($pharmacies as $pharmacy) : ?>

                        <div class="accordion" id="pid<?= $pharmacy['id']; ?>">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-pid<?= $pharmacy['id']; ?>">
                                    <button class="accordion-button collapsed fw-bold text-capitalize " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-pid<?= $pharmacy['id']; ?>" aria-expanded="true" aria-controls="collapse-pid<?= $pharmacy['id']; ?>">
                                        <?= $pharmacy['name']; ?>
                                    </button>
                                </h2>
                                <div id="collapse-pid<?= $pharmacy['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading-pid<?= $pharmacy['id']; ?>" data-bs-parent="#pid<?= $pharmacy['id']; ?>">
                                    <div class="accordion-body">

                                        <p>
                                            Alamat: <?= $pharmacy['address']; ?>
                                        </p>

                                        <p>
                                            Kecamatan: <?= $pharmacy['district_name']; ?>
                                        </p>

                                        <p>
                                            Nama Apoteker: <?= $pharmacy['pharmacist_name']; ?>
                                        </p>

                                        <p>
                                            SIPA: <?= $pharmacy['pharmacist_sipa_number']; ?>
                                        </p>

                                        <p>
                                            No. SIA: <?= $pharmacy['sia_number']; ?>
                                        </p>

                                        <p>
                                            Masa Izin: <?= $pharmacy['sia_expiration_date']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?= $this->endSection('content') ?>