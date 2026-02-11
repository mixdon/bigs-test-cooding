<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Registrasi';
?>

<div class="card shadow-sm rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Detail Registrasi</h5>
            <small class="text-muted">Informasi identitas pasien</small>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-bordered custom-table'],
        'attributes' => [

            [
                'label'=>'No Registrasi',
                'value'=>$model->no_registrasi ?? '-'
            ],

            [
                'label'=>'No Rekam Medis',
                'value'=>$model->no_rekam_medis ?? '(not set)'
            ],

            [
                'label'=>'Nama Pasien',
                'value'=>$model->nama_pasien ?? '-'
            ],

            [
                'label'=>'Tanggal Lahir',
                'value'=>$model->tanggal_lahir
                    ? date('d M Y',strtotime($model->tanggal_lahir))
                    : '-'
            ],

            [
                'label'=>'NIK',
                'value'=>$model->nik ?? '(not set)'
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
            ['update','id_registrasi'=>$model->id_registrasi],
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