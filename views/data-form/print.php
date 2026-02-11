<?php
use yii\helpers\Html;

$data = $model->data ? json_decode($model->data, true) : [];
$registrasi = $model->registrasi;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Hasil Pemeriksaan Pasien</title>
<style>
body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 20px;
    color: #000;
}
.header {
    text-align: center;
    margin-bottom: 10px;
}
.header img {
    width: 80px;
    margin-bottom: 5px;
}
.header h2 {
    margin: 0;
    font-size: 18px;
}
.header small {
    display: block;
    font-size: 12px;
    color: #555;
}
.line {
    border-bottom: 2px solid #000;
    margin: 10px 0 20px;
}
.info-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}
.info-left, .info-right {
    width: 48%;
}
.info-left table, .info-right table {
    width: 100%;
    border-collapse: collapse;
}
.info-left td, .info-right td {
    padding: 4px 0;
}
.label {
    font-weight: bold;
    width: 40%;
}
.table-data {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.table-data td, .table-data th {
    border: 1px solid #000;
    padding: 6px 8px;
}
.table-data th {
    background: #f0f0f0;
    text-align: left;
}
</style>
</head>
<body>

<div class="header">
    <img src="<?= Yii::getAlias('@web') ?>/uploads/logobigs.png" alt="Logo">
    <h2>HASIL PEMERIKSAAN PASIEN</h2>
    <small>Rumah Sakit Coding Test</small>
</div>

<div class="line"></div>

<div class="info-container">
    <div class="info-left">
        <table>
            <tr>
                <td class="label">Tanggal Input</td>
                <td>: <?= $model->create_time_at ? date('d M Y', strtotime($model->create_time_at)) : '-' ?></td>
            </tr>
            <tr>
                <td class="label">Jam</td>
                <td>: <?= $model->create_time_at ? date('H:i', strtotime($model->create_time_at)) : '-' ?></td>
            </tr>
        </table>
    </div>

    <div class="info-right">
        <table>
            <tr>
                <td class="label">Nama Pasien</td>
                <td>: <?= Html::encode($registrasi->nama_pasien ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td>: <?= $registrasi && $registrasi->tanggal_lahir ? date('d M Y', strtotime($registrasi->tanggal_lahir)) : '-' ?></td>
            </tr>
            <tr>
                <td class="label">No Registrasi</td>
                <td>: <?= Html::encode($registrasi->no_registrasi ?? '-') ?></td>
            </tr>
        </table>
    </div>
</div>

<table class="table-data">
    <tr>
        <th>Nama Pasien</th>
        <th>Tinggi Badan (cm)</th>
        <th>Berat Badan (kg)</th>
        <th>Keluhan</th>
    </tr>
    <tr>
        <td><?= Html::encode($registrasi->nama_pasien ?? '-') ?></td>
        <td><?= Html::encode($data['tinggi_badan'] ?? '-') ?></td>
        <td><?= Html::encode($data['berat_badan'] ?? '-') ?></td>
        <td><?= Html::encode($data['keluhan'] ?? '-') ?></td>
    </tr>
</table>

</body>
</html>