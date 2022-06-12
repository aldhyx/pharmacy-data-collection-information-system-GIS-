<?= $this->extend('layouts/admin') ?>

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

<?= $this->section('content') ?><div class="row mb-5 px-4 px-lg-0">
    <div class="col-12 py-5 bg-white rounded shadow-sm mb-3 ">
        <h1 class="fs-2 text-uppercase text-center">
            Sistem Informasi Geografis Pemetaan Apotek Kota Kupang
        </h1>
    </div>

    <div class="col-12 p-4 bg-body rounded shadow-sm align-self-end">

        <div class="row g-0">
            <div class="col-12">
                <p class="fw-bold fs-5 text-uppercase pb-3 mb-4 border-bottom">
                    Peta Tingkat Kepadatan Apotek di Kota Kupang
                </p>
            </div>

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
<script>
    $('.map-loading').show();

    setTimeout(function() {
        $('.map-loading').remove();
    }, 3000);

    let districtGeo = <?= json_encode($geojson)  ?>;

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
</script>
<?= $this->endSection('script') ?>