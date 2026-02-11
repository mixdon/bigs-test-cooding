<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Pemeriksaan';
?>

<div class="card shadow-sm rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Detail Pemeriksaan</h5>
            <small class="text-muted">Informasi hasil pemeriksaan pasien</small>
        </div>

        <?= Html::a(
            '<i class="bi bi-printer"></i> Print / PDF',
            ['download-pdf','id'=>$model->id_form_data],
            [
                'class'=>'btn btn-success btn-action',
                'target'=>'_blank'
            ]
        ) ?>

    </div>

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

            [
                'label'=>'Tinggi Badan',
                'value'=>$model->tinggi_badan ? $model->tinggi_badan.' cm' : '-'
            ],

            [
                'label'=>'Berat Badan',
                'value'=>$model->berat_badan ? $model->berat_badan.' kg' : '-'
            ],

            [
                'label'=>'IMT',
                'value'=>$model->hitungIMT() ?? '-'
            ],

            [
                'label'=>'Kategori IMT',
                'value'=>$model->getKategoriIMT() ?? '-'
            ],

            [
                'label'=>'Keluhan',
                'format'=>'ntext',
                'value'=>$model->keluhan ?? '-'
            ],

            [
                'label'=>'Riwayat Penyakit',
                'value'=>$model->riwayat_penyakit ? 'Ya' : 'Tidak'
            ],

            [
                'label'=>'Keterangan Riwayat',
                'format'=>'ntext',
                'value'=>$model->keterangan_riwayat ?? '-'
            ],
        ],
    ]) ?>

    <div class="d-flex justify-content-end gap-2 mt-3">
        <?= Html::a(
            '<i class="bi bi-arrow-left"></i> Kembali',
            ['index'],
            ['class'=>'btn btn-secondary btn-action']
        ) ?>

        <?= Html::a(
            '<i class="bi bi-pencil"></i> Edit',
            ['update','id'=>$model->id_form_data],
            ['class'=>'btn btn-primary btn-action']
        ) ?>
    </div>

</div>

<?php
$this->registerCss("
.btn-action {
    height:38px;
    font-size:14px;
    padding:0 18px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:6px;
}

.custom-table {
    border:1px solid #dee2e6;
    border-collapse:separate;
    border-spacing:0;
}

.custom-table th {
    background:#f8f9fa;
    font-weight:600;
    border-bottom:2px solid #dee2e6;
    color:#495057;
    padding:12px;
    width:260px;
}

.custom-table td {
    border-bottom:1px solid #dee2e6;
    padding:12px;
    color:#495057;
}

.custom-table tbody tr:hover {
    background:#eef3f7;
}
");
?>