<?php
$logoPath = Yii::getAlias('@webroot/uploads/logobigs.png');

function printOptions($options, $value)
{
    $html = '<div class="option-row">';
    foreach ($options as $key => $label) {
        $checked = ($key == $value) ? '☑' : '☐';
        $html .= '
            <span class="option">
                <span class="checkbox">'.$checked.'</span>
                <span class="label">'.$label.'</span>
            </span>
        ';
    }
    $html .= '</div>';
    return $html;
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 11px;
        color: #000;
    }

    .section-title {
        font-weight: bold;
        border-bottom: 1px solid #000;
        padding-bottom: 3px;
        margin: 12px 0 6px;
    }

    .sub-title {
        font-weight: bold;
        margin-bottom: 3px;
    }

    .box {
        border: 1px solid #000;
        padding: 5px;
        min-height: 16px;
    }

    .option-row {
        display: inline-block;
    }

    .option {
        margin-right: 15px;
        white-space: nowrap;
    }

    .header-table {
        width: 100%;
        border-collapse: collapse;
    }

    .header-table td {
        vertical-align: middle;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    .table td {
        border: 1px solid #000;
        padding: 5px;
        vertical-align: top;
    }
</style>

<!-- HEADER BARIS ATAS -->
<table class="header-table">
    <tr>
        <td width="25%" style="font-weight:bold;">
        </td>
        <td width="50%" align="center">
            <img src="<?= $logoPath ?>" height="60">
        </td>
        <td width="25%"></td>
    </tr>
</table>

<br>

<!-- HEADER BARIS BAWAH -->
<table class="header-table">
    <tr>
        <!-- kiri 60% -->
        <td width="60%" align="center">
            <div style="font-size:16px;font-weight:bold;">
                PENGKAJIAN KEPERAWATAN
            </div>
            <div style="font-size:16px;font-weight:bold;">
                POLIKLINIK KEBIDANAN
            </div>
        </td>

        <!-- kanan 40% -->
        <td width="40%" style="font-size:11px;">
            <strong>Nama Lengkap :</strong> <?= $registrasi->nama_pasien ?><br>
            <strong>Tanggal Lahir :</strong> <?= $registrasi->tanggal_lahir ?><br>
            <strong>No. Registrasi :</strong> <?= $registrasi->no_registrasi ?>
        </td>
    </tr>
</table>

<hr>

<?php
$tanggal = '-';
$jam = '-';

$waktu = null;

// Prioritas: update_time_at
if (!empty($model->update_time_at)) {
    $waktu = $model->update_time_at;
} elseif (!empty($model->create_time_at)) {
    $waktu = $model->create_time_at;
}

if ($waktu) {
    $tanggal = date('d-m-Y', strtotime($waktu));
    $jam = date('H:i', strtotime($waktu));
}
?>

<!-- IDENTITAS PENGKAJIAN -->
<table class="table" style="border:none;">
    <tr>
        <td width="30%" style="border:none;"><strong>Tanggal Pengkajian</strong></td>
        <td width="70%" style="border:none;">: <?= $tanggal ?></td>
    </tr>
    <tr>
        <td style="border:none;"><strong>Jam Pengkajian</strong></td>
        <td style="border:none;">: <?= $jam ?></td>
    </tr>
</table>


<!-- 1. Cara Masuk -->
<div class="section-title">1. Cara Masuk Pasien</div>
<?= printOptions([
    'Jalan'=>'Jalan tanpa bantuan',
    'Kursi'=>'Kursi roda tanpa bantuan',
    'Bed'=>'Tempat tidur dorong',
    'Lainnya'=>'Lainnya'
], $model->cara_masuk) ?>

<!-- 2. Anamnesis -->
<div class="section-title">2. Anamnesis</div>
<table class="table" style="border:none;">
    <tr>
        <td width="33%" style="border:none; vertical-align:top;">
            <div class="sub-title">Jenis Anamnesis</div>
            <?= printOptions([
                'Auto'=>'Autoanamnesis',
                'Allo'=>'Aloanamnesis'
            ], $model->jenis_anamnesis) ?>
        </td>
        <td width="33%" style="border:none; vertical-align:top;">
            <div class="sub-title">Diperoleh Dari</div>
            <div class="box">
                <?= $model->diperoleh_dari ?: '-' ?>
            </div>
        </td>
        <td width="34%" style="border:none; vertical-align:top;">
            <div class="sub-title">Hubungan</div>
            <div class="box">
                <?= $model->hubungan ?: '-' ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border:none; vertical-align:top;">
            <div class="sub-title">Alergi</div>
            <div class="box">
                <?= $model->alergi ?: '-' ?>
            </div>
        </td>
    </tr>
</table>

<!-- 3. Keluhan -->
<div class="section-title">3. Keluhan Utama</div>
<div class="box">
    <?= $model->keluhan ? nl2br($model->keluhan) : '-' ?>
</div>

<!-- 4. Pemeriksaan Fisik -->
<div class="section-title">4. Pemeriksaan Fisik</div>

<table class="table" style="border:none;">
    <tr>
        <td width="50%" style="border:none;">
            <div class="sub-title">a. Keadaan Umum</div>
            <?= printOptions([
                'Tidak tampak sakit'=>'Tidak tampak sakit',
                'Sakit ringan'=>'Sakit ringan',
                'Sedang'=>'Sedang',
                'Berat'=>'Berat'
            ], $model->keadaan_umum) ?>
        </td>
        <td width="50%" style="border:none;">
            <div class="sub-title">b. Warna Kulit</div>
            <?= printOptions([
                'Normal'=>'Normal',
                'Sianosis'=>'Sianosis',
                'Pucat'=>'Pucat',
                'Kemerahan'=>'Kemerahan'
            ], $model->warna_kulit) ?>
        </td>
    </tr>
</table>

<table class="table">
    <tr>
        <td width="25%">
            <div class="sub-title">Kesadaran</div>
            <?= printOptions([
                'Compos Mentis'=>'Compos Mentis',
                'Apatis'=>'Apatis',
                'Somnolen'=>'Somnolen',
                'Sopor'=>'Sopor',
                'Soporokoma'=>'Soporokoma',
                'Koma'=>'Koma'
            ], $model->kesadaran) ?>
        </td>
        <td width="25%">
            <div class="sub-title">Tanda Vital</div>
            TD: <?= $model->td ?: '-' ?><br>
            Nadi: <?= $model->nadi ?: '-' ?><br>
            RR: <?= $model->rr ?: '-' ?><br>
            Suhu: <?= $model->suhu ?: '-' ?>
        </td>
        <td width="25%">
            <div class="sub-title">Fungsional</div>
            Alat Bantu: <?= $model->alat_bantu ?: '-' ?><br>
            Prothesa: <?= $model->prothesa ?: '-' ?><br>
            Cacat: <?= $model->cacat_tubuh ?: '-' ?><br>
            ADL:
            <?= printOptions(['Mandiri'=>'Mandiri','Dibantu'=>'Dibantu'],$model->adl) ?>
            Riwayat Jatuh:
            <?= printOptions(['Ya'=>'Ya','Tidak'=>'Tidak'],$model->riwayat_jatuh) ?>
        </td>
        <td width="25%">
            <div class="sub-title">Antropometri</div>
            BB: <?= $model->bb ?: '-' ?> kg<br>
            TB: <?= $model->tb ?: '-' ?> cm<br>
            PB: <?= $model->pb ?: '-' ?> cm<br>
            LK: <?= $model->lk ?: '-' ?> cm
        </td>
    </tr>
</table>

<div class="section-title">c. Status Gizi</div>
<div class="box">
    <?= $model->status_gizi ?: ($model->getKategoriIMT() ?: '-') ?>
</div>

<!-- 4. Pemeriksaan Fisik -->
<div class="section-title">5. Riwayat Penyakit Sekarang</div>
<div class="box">
    <?= $model->riwayat_sekarang ? nl2br($model->riwayat_sekarang) : '-' ?>
</div>

<!-- 4. Pemeriksaan Fisik -->
<div class="section-title">6. Riwayat Penyakit Sebelumnya</div>
<?= printOptions([
        'DM'=>'DM',
        'Hipertensi'=>'Hipertensi',
        'Jantung'=>'Jantung',
        'Lain-lain'=>'Lain-lain'
    ], $model->riwayat_dahulu) ?>

<!-- 4. Pemeriksaan Fisik -->
<div class="section-title">7. Riwayat Penyakit</div>
<?= printOptions(['Tidak'=>'Tidak','Ya'=>'Ya'],$model->riwayat_penyakit) ?>

<!-- 4. Pemeriksaan Fisik -->
<div class="section-title">8. Riwayat Penyakit Keluarga</div>
<div class="box">
    <?= $model->riwayat_keluarga ?: '-' ?>
</div>

<!-- 4. Pemeriksaan Fisik -->
<div class="section-title">9. Riwayat Operasi</div>
<?= printOptions(['Tidak'=>'Tidak','Ya'=>'Ya'],$model->riwayat_operasi) ?>
<?php if($model->riwayat_operasi == 'Ya'): ?>
<div class="row" style="margin-top:5px;">
    <div class="col-6">
        <strong>Jenis Operasi:</strong><br>
        <?= $model->operasi_apa ?: '-' ?>
    </div>
    <div class="col-6">
        <strong>Tahun:</strong><br>
        <?= $model->operasi_kapan ?: '-' ?>
    </div>
</div>
<?php endif; ?>

<!-- 4. Pemeriksaan Fisik -->
<div class="section-title">10. Riwayat Rawat Inap</div>
<?= printOptions(['Tidak'=>'Tidak','Ya'=>'Ya'],$model->riwayat_rawat_inap) ?>
<?php if($model->riwayat_rawat_inap == 'Ya'): ?>
<div class="row" style="margin-top:5px;">
    <div class="col-6">
        <strong>Penyakit:</strong><br>
        <?= $model->rs_penyakit ?: '-' ?>
    </div>
    <div class="col-6">
        <strong>Tahun:</strong><br>
        <?= $model->rs_kapan ?: '-' ?>
    </div>
</div>
<?php endif; ?>

<!-- 11. Pengkajian Risiko Jatuh -->
<div class="section-title">
    11. Pengkajian Risiko Jatuh Pasien (Morse Fall Scale)
</div>

<table class="table">
    <tr>
        <td width="50%">
            <strong>1. Riwayat jatuh (3 bulan terakhir)</strong><br>
            <?= printOptions([
                25=>'Ya, terdapat riwayat jatuh dalam 3 bulan terakhir (25)',
                0=>'Tidak ada riwayat jatuh (0)'
            ], $model->rj_riwayat_jatuh) ?>
        </td>

        <td width="50%">
            <strong>2. Diagnosa medis sekunder (>1 diagnosa)</strong><br>
            <?= printOptions([
                15=>'Ya, memiliki lebih dari 1 diagnosa medis (15)',
                0=>'Tidak / hanya 1 diagnosa (0)'
            ], $model->rj_diagnosa_sekunder) ?>
        </td>
    </tr>

    <tr>
        <td>
            <strong>3. Alat bantu jalan</strong><br>
            <?= printOptions([
                0=>'Mandiri / Kursi roda / Dibantu perawat (0)',
                15=>'Menggunakan tongkat / walker (15)',
                30=>'Berpegangan pada furniture / benda sekitar (30)'
            ], $model->rj_alat_bantu) ?>
        </td>

        <td>
            <strong>4. Terpasang infus / akses IV</strong><br>
            <?= printOptions([
                20=>'Ya, terpasang infus / IV line / heparin lock (20)',
                0=>'Tidak terpasang infus (0)'
            ], $model->rj_iv) ?>
        </td>
    </tr>

    <tr>
        <td>
            <strong>5. Cara berjalan / berpindah</strong><br>
            <?= printOptions([
                0=>'Normal / tirah baring / imobilisasi (0)',
                10=>'Lemah (10)',
                20=>'Terganggu / perlu bantuan / tidak stabil (20)'
            ], $model->rj_cara_berjalan) ?>
        </td>

        <td>
            <strong>6. Status mental</strong><br>
            <?= printOptions([
                0=>'Orientasi baik terhadap kemampuan diri (0)',
                15=>'Lupa keterbatasan diri / overestimate kemampuan (15)'
            ], $model->rj_status_mental) ?>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <strong>Total Skor :</strong> <?= $model->rj_total ?: 0 ?><br>
            <strong>Kategori Risiko :</strong> <?= $model->rj_kategori ?: 'Risiko Rendah' ?>
        </td>
    </tr>
</table>

<!-- FOOTER -->
<br>
<div style="text-align:right;font-size:11px;">
    Pekanbaru, <?= date('d-m-Y') ?><br><br><br>
    <strong>Petugas Pemeriksa</strong>
</div>