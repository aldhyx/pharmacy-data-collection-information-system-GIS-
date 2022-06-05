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
                <li class="breadcrumb-item active">Ubah Kecamatan</li>
            </ol>
        </nav>
    </div>

    <div class="col-12 p-4 bg-body rounded shadow-sm my-2">

        <p class="fw-bold fs-5 text-uppercase pb-3 mb-4 border-bottom">
            Ubah Data Kecamatan
        </p>

        <div class="row g-4">
            <div class="col-md-6">

                <form action="<?= route_to('adminDistrictsStore'); ?>" class="needs-validation" method="post" novalidate>
                    <input type="hidden" name="id" value="<?= $district["id"]; ?>">

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Nama Kecamatan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="" value="<?= $district['name']; ?>" required name="name">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-md-4 col-form-label">Total Populasi</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="" value="<?= $district['total_population']; ?>" name="total_population">
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
    let districtGeo = <?= $district['geojson'] ?>;

    let map = L.map('maps-container', {}).setView([-10.178757, 123.597603], 12);

    let tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    function onEachFeature(feature, layer) {
        var popupContent = '<p>Kecamatan ' + feature.properties.NAMOBJ + '</p>';
        layer.bindPopup(popupContent);
    }

    let geojson = L.geoJSON(districtGeo, {
        onEachFeature: onEachFeature,
        style: {
            color: "#0d6efd",
            "weight": 2,
            "opacity": 0.65
        },
    }).addTo(map);

    let geojsonCentered = geojson.getBounds().getCenter();
    if (geojsonCentered) map.panTo([geojsonCentered.lat, geojsonCentered.lng]);
</script>
<?= $this->endSection('script') ?>