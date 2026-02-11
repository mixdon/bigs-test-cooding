<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Registrasi';
?>

<div class="card shadow-sm rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Data Registrasi</h5>
            <small class="text-muted">Daftar registrasi pasien</small>
        </div>

        <?= Html::a(
            '<i class="bi bi-plus-lg"></i> Tambah Registrasi',
            ['create'],
            ['class'=>'btn btn-primary btn-action']
        ) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-hover align-middle text-center custom-table'
        ],
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'No Registrasi',
                'value' => fn($m) => $m->no_registrasi ?? '-'
            ],

            [
                'label' => 'No Rekam Medis',
                'value' => fn($m) => $m->no_rekam_medis ?? '(not set)'
            ],

            [
                'label' => 'Nama Pasien',
                'value' => fn($m) => $m->nama_pasien ?? '-'
            ],

            [
                'label' => 'Tanggal Lahir',
                'value' => fn($m) => $m->tanggal_lahir ? date('d M Y', strtotime($m->tanggal_lahir)) : '-'
            ],

            [
                'label' => 'NIK',
                'value' => fn($m) => $m->nik ?? '(not set)'
            ],

            [
                'label' => 'Status Pemeriksaan',
                'format' => 'raw',
                'value' => fn($m) =>
                    $m->dataForm
                        ? '<span class="badge bg-success">Sudah Input</span>'
                        : '<span class="badge bg-secondary">Belum Input</span>'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Aksi',
                'template' => '{form} {view} {edit} {delete}',
                'buttons' => [

                    'form' => function ($url,$m) {

                        if ($m->dataForm) {
                            return Html::a(
                                '<i class="bi bi-clipboard2-pulse"></i> Pemeriksaan',
                                ['/data-form/view','id'=>$m->dataForm->id_form_data],
                                ['class'=>'btn btn-success btn-sm']
                            );
                        }

                        return Html::a(
                            '<i class="bi bi-plus-circle"></i> Pemeriksaan',
                            ['/data-form/create','id_registrasi'=>$m->id_registrasi],
                            ['class'=>'btn btn-primary btn-sm']
                        );
                    },

                    'view' => function ($url,$m) {
                        return Html::a(
                            '<i class="bi bi-eye"></i>',
                            ['view','id_registrasi'=>$m->id_registrasi],
                            ['class'=>'btn btn-info btn-sm']
                        );
                    },

                    'edit' => function ($url,$m) {
                        return Html::a(
                            '<i class="bi bi-pencil"></i>',
                            ['update','id_registrasi'=>$m->id_registrasi],
                            ['class'=>'btn btn-warning btn-sm']
                        );
                    },

                    'delete' => function ($url,$m) {
                        return Html::a(
                            '<i class="bi bi-trash"></i>',
                            ['delete','id_registrasi'=>$m->id_registrasi],
                            [
                                'class'=>'btn btn-danger btn-sm',
                                'data-confirm'=>'Hapus data?',
                                'data-method'=>'post'
                            ]
                        );
                    },
                ]
            ]
        ],
    ]) ?>

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

.custom-table th {
    background:#f8f9fa;
    font-weight:600;
    border-bottom:2px solid #dee2e6;
    color:#495057;
    padding:12px;
}

.custom-table td {
    border-bottom:1px solid #dee2e6;
    padding:12px;
}

.custom-table tbody tr:hover {
    background:#eef3f7;
}
");
?>