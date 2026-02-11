<?php
use yii\helpers\Html;
$this->title = 'Dashboard';
?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <small class="text-muted">Ringkasan aktivitas sistem</small>
        </div>
        <span class="badge bg-primary px-3 py-2"><?= date('d M Y') ?></span>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-4 mb-4">
        <?php $cards = [
            ['label' => 'Total Registrasi', 'value' => $totalRegistrasi, 'icon' => 'bi-people-fill', 'bg' => 'bg-primary'],
            ['label' => 'Form Terinput', 'value' => $totalForm, 'icon' => 'bi-clipboard-check-fill', 'bg' => 'bg-success'],
            ['label' => 'Belum Input', 'value' => $belumInput, 'icon' => 'bi-exclamation-triangle-fill', 'bg' => 'bg-danger'],
        ]; ?>
        <?php foreach($cards as $c): ?>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="icon <?= $c['bg'] ?> text-white rounded-circle me-3">
                        <i class="bi <?= $c['icon'] ?>"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1"><?= $c['label'] ?></h6>
                        <h3 class="fw-bold mb-0"><?= $c['value'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- GRAFIK -->
    <div class="row g-4 mb-4">
        <?php $chartHeight = "350px"; ?>
        <?php $charts = [
            ['id'=>'chartIMT', 'title'=>'IMT Pasien', 'bg'=>'rgba(54, 162, 235, 0.6)', 'border'=>'rgba(54, 162, 235, 1)'],
            ['id'=>'chartUsia', 'title'=>'Usia Pasien', 'bg'=>'rgba(255, 206, 86, 0.6)', 'border'=>'rgba(255, 206, 86, 1)'],
            ['id'=>'chartKeluhan', 'title'=>'Keluhan Pasien'],
        ]; ?>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex flex-column justify-content-center" style="height: <?= $chartHeight ?>; padding:20px;">
                    <h6 class="fw-bold mb-3 text-center">IMT Pasien</h6>
                    <canvas id="chartIMT" style="flex:1; width:100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex flex-column justify-content-center" style="height: <?= $chartHeight ?>; padding:20px;">
                    <h6 class="fw-bold mb-3 text-center">Usia Pasien</h6>
                    <canvas id="chartUsia" style="flex:1; width:100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: <?= $chartHeight ?>; padding:20px;">
                    <h6 class="fw-bold mb-3 text-center">Keluhan Pasien</h6>
                    <canvas id="chartKeluhan" style="flex:1; width:100%; max-width:100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
// Chart.js
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => \yii\web\View::POS_END]);

$js = <<<JS
document.addEventListener('DOMContentLoaded', function() {
    const imtData = JSON.parse('{$imtsJson}');
    const usiaData = JSON.parse('{$usiaJson}');
    const keluhanKeys = JSON.parse('{$keluhanKeysJson}');
    const keluhanValues = JSON.parse('{$keluhanValuesJson}');

    // IMT
    new Chart(document.getElementById('chartIMT').getContext('2d'), {
        type: 'bar',
        data: {
            labels: imtData.map((_, i) => 'User ' + (i+1)),
            datasets: [{
                label: 'IMT',
                data: imtData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
    });

    // Usia
    new Chart(document.getElementById('chartUsia').getContext('2d'), {
        type: 'bar',
        data: {
            labels: usiaData.map((_, i) => 'User ' + (i+1)),
            datasets: [{
                label: 'Usia (tahun)',
                data: usiaData,
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
    });

    // Keluhan
    new Chart(document.getElementById('chartKeluhan').getContext('2d'), {
        type: 'pie',
        data: {
            labels: keluhanKeys,
            datasets: [{
                data: keluhanValues,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
});
JS;

$this->registerJs($js, \yii\web\View::POS_END);
?>

<style>
.icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.card-body canvas {
    display: block;
    margin: 0 auto;
}
</style>