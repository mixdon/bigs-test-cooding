<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Pengkajian Keperawatan';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Detail Pengkajian Keperawatan</h4>
                <small class="text-muted">
                    Informasi hasil pemeriksaan pasien
                </small>
            </div>

            <?= Html::a(
                '<i class="bi bi-printer"></i> Print / PDF',
                ['download-pdf','id'=>$model->id_form_data],
                [
                    'class'=>'btn btn-success',
                    'target'=>'_blank'
                ]
            ) ?>
        </div>


        <!-- INFORMASI PASIEN -->
        <div class="section-title mb-2">Informasi Pasien</div>

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered custom-table'],
            'attributes' => [

                [
                    'label'=>'Nama Pasien',
                    'value'=>$model->registrasi->nama_pasien ?? '-'
                ],
                [
                    'label'=>'No Registrasi',
                    'value'=>$model->registrasi->no_registrasi ?? '-'
                ],

                'cara_masuk',
                'jenis_anamnesis',
                'diperoleh_dari',
                'hubungan',
                'alergi',

                [
                    'label'=>'Keluhan Utama',
                    'format'=>'ntext',
                    'value'=>$model->keluhan ?? '-'
                ],
            ],
        ]) ?>


        <!-- PEMERIKSAAN FISIK -->
        <div class="section-title mt-4 mb-2">Pemeriksaan Fisik</div>

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered custom-table'],
            'attributes' => [

                'keadaan_umum',
                'warna_kulit',
                'kesadaran',

                [
                    'label'=>'Tekanan Darah',
                    'value'=>$model->td ?? '-'
                ],
                'nadi',
                'rr',
                'suhu',

                'alat_bantu',
                'prothesa',
                'cacat_tubuh',
                'adl',
                'riwayat_jatuh',

                [
                    'label'=>'Berat Badan',
                    'value'=>$model->bb ? $model->bb.' kg' : '-'
                ],
                [
                    'label'=>'Tinggi Badan',
                    'value'=>$model->tb ? $model->tb.' cm' : '-'
                ],
                [
                    'label'=>'IMT',
                    'value'=>$model->hitungIMT() ?? '-'
                ],
                [
                    'label'=>'Status Gizi',
                    'value'=>$model->status_gizi ?? '-'
                ],
            ],
        ]) ?>


        <!-- RIWAYAT PENYAKIT -->
        <div class="section-title mt-4 mb-2">Riwayat Penyakit</div>

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered custom-table'],
            'attributes' => [

                'riwayat_sekarang',

                [
                    'label'=>'Riwayat Dahulu',
                    'value'=>$model->riwayat_dahulu ?? '-'
                ],

                [
                    'label'=>'Riwayat Penyakit',
                    'value'=>$model->riwayat_penyakit ?? '-'
                ],

                'riwayat_keluarga',

                'riwayat_operasi',
                'operasi_apa',
                'operasi_kapan',

                'riwayat_rawat_inap',
                'rs_penyakit',
                'rs_kapan',
            ],
        ]) ?>


        <!-- MORSE FALL SCALE -->
        <div class="section-title mt-4 mb-3">
            Pengkajian Risiko Jatuh (Morse Fall Scale)
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="morse-summary-box text-center">
                    <div class="morse-total-display">
                        <?= $model->rj_total ?? 0 ?>
                    </div>
                    <div class="morse-label">Total Skor</div>

                    <?php
                        $kategori = $model->rj_kategori ?? 'Risiko Rendah';
                        $class = 'morse-low';
                        if($kategori == 'Risiko Sedang') $class = 'morse-medium';
                        if($kategori == 'Risiko Tinggi') $class = 'morse-high';
                    ?>

                    <div class="morse-kategori-display <?= $class ?>">
                        <?= $kategori ?>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <?= DetailView::widget([
                    'model'=>$model,
                    'options'=>['class'=>'table table-bordered custom-table'],
                    'attributes'=>[
                        'rj_riwayat_jatuh',
                        'rj_diagnosa_sekunder',
                        'rj_alat_bantu',
                        'rj_iv',
                        'rj_cara_berjalan',
                        'rj_status_mental',
                    ]
                ]) ?>
            </div>
        </div>


        <!-- BUTTON -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <?= Html::a(
                '<i class="bi bi-arrow-left"></i> Kembali',
                ['index'],
                ['class'=>'btn btn-outline-secondary']
            ) ?>

            <?= Html::a(
                '<i class="bi bi-pencil"></i> Edit',
                ['update','id'=>$model->id_form_data],
                ['class'=>'btn btn-primary']
            ) ?>
        </div>

    </div>
</div>

<?php
$this->registerCss("
.section-title {
    font-weight:600;
    font-size:15px;
    color:#495057;
    border-left:4px solid #0d6efd;
    padding-left:8px;
}

.custom-table th {
    background:#f8f9fa;
    font-weight:600;
    width:260px;
}

.morse-summary-box {
    background:#f8f9fa;
    border-radius:14px;
    padding:20px;
    border:1px solid #e9ecef;
}

.morse-total-display {
    font-size:36px;
    font-weight:700;
    color:#0d6efd;
}

.morse-low { color:#198754; }
.morse-medium { color:#fd7e14; }
.morse-high { color:#dc3545; }
");
?>