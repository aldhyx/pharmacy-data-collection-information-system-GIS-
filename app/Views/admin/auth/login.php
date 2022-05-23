<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-4 bg-body rounded shadow-sm my-3 px-4 py-5">
        <form action="<?= route_to('postLogin') ?>" method="post">
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control" id="username" placeholder="username" name="username" autocomplete="new" required autofocus>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" placeholder="password" name="password" required>
                <label for="password">Password</label>
            </div>

            <div class="mb-4">
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>
            </div>

            <button class="w-100 fw-bold btn btn-lg btn-success" type="submit">
                <span>MASUK</span>
                <i class="fa-solid fa-right-to-bracket ms-2"></i>
            </button>
        </form>
    </div>
</div>
<?= $this->endSection('content') ?>