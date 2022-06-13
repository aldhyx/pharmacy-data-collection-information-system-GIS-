<?= $this->extend('layouts/public') ?>

<?= $this->section('style') ?>
<style>
    #maps-container {
        height: 100%;
        min-height: 600px;
    }

    .box {
        display: inline-block;
        width: 10px;
        height: 10px;
        opacity: 0.65;
    }

    .box.green {
        background-color: #42c150;
    }


    .box.red {
        background-color: #c14242;
    }

    .map-loading {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #fff;
        top: 0;
        left: 0;
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<?= $this->endSection('style') ?>

<?= $this->section('content') ?>
<div class="row mb-5 px-0">
    <div class="col-12 p-4 mt-3 bg-body rounded shadow-sm align-self-end">

        <div class="row g-0">
            <div class="col-12">
                <p class="fw-bold fs-5 text-uppercase pb-3 mb-4 border-bottom">
                    Peta Persebaran Apotek di Kota Kupang
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <select name="districts" id="districts" class="form-select" disabled>
                    <option value="all" <?php if (!$did) : ?> selected="selected" <?php endif; ?>>Semua Kecamatan</option>
                    <?php
                    foreach ($districts as $district) : ?>
                        <option value="<?= $district['id']; ?>" <?php if ($did && $did == $district['id']) : ?> selected="selected" <?php endif; ?>>
                            Kecamatan <?= $district['name']; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>


            <div class="col-12 mb-3">
                <div id="maps-container">
                    <div class="map-loading" style="display: none;">
                        <div class="spinner-border text-body" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="m-0 text-body ms-2 fs-5">Sedang memuat data geojson</p>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <p class="mb-1">Keterangan:</p>
                <ul class="list-unstyled mb-0">
                    <li>
                        <span class="box green"></span>
                        <span>
                            : Jumlah apotek sesuai standar
                        </span>
                    </li>
                    <li>
                        <span class="box red"></span>
                        <span>: Jumlah apotek tidak sesuai standar</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection('content') ?>
<?= $this->section('script') ?>
<script type="text/javascript">
    $('.map-loading').show();

    setTimeout(function() {
        $('.map-loading').remove();
        $('#districts').removeAttr('disabled');
    }, 3000);

    let districtGeo = <?= json_encode($geojson)  ?>;
    let pharmaciesData = <?= json_encode($pharmacies)  ?>;


    let map = L.map('maps-container', {}).setView([-10.178757, 123.597603], 12);

    let tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    function onEachFeature(feature, layer) {
        let totalPharmacies = feature.properties.totalPharmacies;
        let totalPopulation = feature.properties.totalPopulation;

        var popupContent = '<p>Kecamatan ' + feature.properties.NAMOBJ + '</p> <p>Total Apotek: ' + totalPharmacies + '</p> <p>Total Populasi Penduduk: ' + totalPopulation + '</p>';
        layer.bindPopup(popupContent);
    }

    function getColor(totalPopulation, totalPharmacies) {
        const green = '#42c150';
        const red = '#c14242';
        const black = '#000000';

        if (!totalPopulation || !totalPharmacies) return red;

        // 1 apotek layani maksimal 8300 jiwa
        const standard = 8300;
        // hasil perbadingan
        const result = Math.floor(totalPopulation / totalPharmacies);

        // jika hasil nya lebih besar dari standar maka return merah karena kurang apotik
        // atau 1 apotek melayani lebih dari standar
        if (result > standard) return red;
        return green;
    }

    if (pharmaciesData && Array.isArray(pharmaciesData) && pharmaciesData.length) {
        for (let index in pharmaciesData) {
            const latitude = pharmaciesData[index].latitude;
            const longitude = pharmaciesData[index].longitude;
            const name = pharmaciesData[index].name;
            L.marker([latitude, longitude], {
                title: name,
                alt: name,
            }).addTo(map).bindPopup("Apotek <span>" + name + "</span>");
        }
    }

    if (districtGeo && Array.isArray(districtGeo) && districtGeo.length) {
        for (let index in districtGeo) {
            // console.log(districtGeo[index]);

            const geojson = JSON.parse(districtGeo[index].geojson);
            const totalPopulation = districtGeo[index].total_population || 0;
            const totalPharmacies = districtGeo[index].total_pharmacies || 0;

            geojson.properties.totalPopulation = totalPopulation;
            geojson.properties.totalPharmacies = totalPharmacies;

            const color = getColor(totalPopulation, totalPharmacies);

            L.geoJSON(geojson, {
                onEachFeature: onEachFeature,
                style: {
                    color: color,
                    "weight": 1,
                    "opacity": 0.65
                },
            }).addTo(map);
        }
    }

    $('#districts').on('change', function(e) {
        const val = e.target.value;

        if (val !== 'all' && Number(val)) {
            window.location.href = window.location.origin + window.location.pathname + '?did=' + val;
        } else {
            window.location.href = window.location.origin + window.location.pathname;

        }
    });
</script>
<?= $this->endSection('script') ?>