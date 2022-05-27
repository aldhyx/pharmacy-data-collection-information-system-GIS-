<?= $this->extend('layouts/admin') ?>

<?= $this->section('style') ?>
<style>
    #maps-container {
        height: 100%;
        min-height: 400px;
    }
</style>
<?= $this->endSection('style') ?>

<?= $this->section('content') ?>
<div class="row mb-5 px-4 px-lg-0">

    <div class="col-12 py-4 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Apotek</li>
                <li class="breadcrumb-item active">Ubah Apotek</li>
            </ol>
        </nav>
    </div>

    <div class="col-12 p-4 bg-body rounded shadow-sm my-2">

        <p class="fw-bold fs-5 text-uppercase pb-3 mb-4 border-bottom">
            Tambah Data Apotek
        </p>

        <div class="row g-4">
            <div class="col-md-6">

                <form action="<?= route_to('adminPharmaciesStore'); ?>" class="needs-validation" method="post" novalidate>
                    <input type="hidden" name="id" value="<?= $pharmacy["id"]; ?>">
                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Nama Kecamatan</label>
                        <div class="col-md-8">
                            <select name="district_id" class="form-select" id="" required>
                                <option value="" selected hidden></option>
                                <?php
                                foreach ($districts as $district) : ?>
                                    <option value="<?= $district['id']; ?>" <?php if ($pharmacy['id_districts'] == $district['id']) : ?> selected="selected" <?php endif; ?>><?= $district['name']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Nama Apotek</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $pharmacy['name']; ?>" required name="pharmacy_name">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Nama Apoteker</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $pharmacy['pharmacist_name']; ?>" required name="pharmacist_name">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">No. SIPA</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $pharmacy['pharmacist_sipa_number']; ?>" required name="pharmacist_sipa_number">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">No. SIA</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $pharmacy['sia_number']; ?>" required name="sia_number">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Berakhir Izin - SIA</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="" value="<?= $pharmacy['sia_expiration_date']; ?>" required name="sia_expiration_date">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea name="address" class="form-control" id="" cols="30" rows="10"><?= $pharmacy['address']; ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Longitude</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $pharmacy['longitude']; ?>" name="longitude" required name="longitude">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Latitude</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $pharmacy['latitude']; ?>" required name="latitude">
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
            <div class="col-md-6">
                <div id="maps-container" class="">
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>
<?= $this->section('script') ?>
<script>
    const initLat = <?= $pharmacy['latitude']; ?>;
    const initLng = <?= $pharmacy['longitude']; ?>;

    // to check valid lat
    const isLatitude = num => isFinite(num) && Math.abs(num) <= 90;
    // to check valid lng 
    const isLongitude = num => isFinite(num) && Math.abs(num) <= 180;

    let map = L.map('maps-container').setView([-10.178757, 123.597603], 13);

    let tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);


    let marker = null;

    let tempLatLng = {
        lat: null,
        lng: null
    };

    if (initLat && initLng && isLatitude(initLat) && isLongitude(initLng)) {
        marker = L.marker([initLat, initLng]).addTo(map);
        tempLatLng.lat = initLat;
        tempLatLng.lng = initLng
        map.panTo([initLat, initLng]);
    }

    map.on('click', function(ev) {
        if (marker) marker.remove();

        const latlng = ev.latlng;
        tempLatLng.lat = latlng.lat;
        tempLatLng.lng = latlng.lng;

        console.log("🚀 ~ file: pharmacies_create.php ~ line 126 ~ map.on ~ latlng", latlng);
        marker = L.marker([latlng.lat, latlng.lng]).addTo(map);

        $('input[name="latitude"]').val(latlng.lat);
        $('input[name="longitude"]').val(latlng.lng);

        map.panTo([latlng.lat, latlng.lng]);
    });

    $('input[name="latitude" ]').on('change', function(e) {
        let value = e.target.value;
        value = Number(value);

        if (!value || !Boolean(value)) {
            if (tempLatLng.lat) {
                $(this).val(tempLatLng.lat)
            } else {
                $(this).val('')
            }
            return Swal.fire({
                title: 'Gagal!',
                text: 'Latitude tidak benar!',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary px-4 text-uppercase fw-bold',
                },
                buttonsStyling: false,
                confirmButtonText: 'Ok'
            })
        }

        if (!isLatitude(value)) {
            if (tempLatLng.lat) {
                $(this).val(tempLatLng.lat)
            } else {
                $(this).val('')
            }
            return Swal.fire({
                title: 'Gagal!',
                text: 'Latitude tidak benar!',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary px-4 text-uppercase fw-bold',
                },
                buttonsStyling: false,
                confirmButtonText: 'Ok'
            })
        }

        if (marker) marker.remove();
        marker = L.marker([value, tempLatLng.lng]).addTo(map);
        map.panTo([value, tempLatLng.lng]);
    });
    $('input[name="longitude" ]').on('change', function(e) {
        let value = e.target.value;
        value = Number(value);

        if (!value || !Boolean(value)) {
            if (tempLatLng.lng) {
                $(this).val(tempLatLng.lng)
            } else {
                $(this).val('')
            }
            return Swal.fire({
                title: 'Gagal!',
                text: 'Longitude tidak benar!',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary px-4 text-uppercase fw-bold',
                },
                buttonsStyling: false,
                confirmButtonText: 'Ok'
            })
        }

        if (!isLongitude(value)) {
            if (tempLatLng.lng) {
                $(this).val(tempLatLng.lng)
            } else {
                $(this).val('')
            }
            return Swal.fire({
                title: 'Gagal!',
                text: 'Longitude tidak benar!',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary px-4 text-uppercase fw-bold',
                },
                buttonsStyling: false,
                confirmButtonText: 'Ok'
            })
        }

        if (marker) marker.remove();
        marker = L.marker([tempLatLng.lat, value]).addTo(map);
        map.panTo([tempLatLng.lat, value]);
    });
</script>
<?= $this->endSection('script') ?>