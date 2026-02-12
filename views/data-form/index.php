<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Pemeriksaan';
?>

<div class="card shadow-sm rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Data Pemeriksaan</h5>
            <small class="text-muted">Daftar data form pemeriksaan pasien</small>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-hover align-middle text-center custom-table'
        ],
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Nama Pasien',
                'value' => function($m){
                    return $m->registrasi->nama_pasien ?? '-';
                }
            ],

            [
                'label' => 'Tinggi (cm)',
                'value' => function($m){
                    return $m->tb ? $m->tb.' cm' : '-';
                }
            ],

            [
                'label' => 'Berat (kg)',
                'value' => function($m){
                    return $m->bb ? $m->bb.' kg' : '-';
                }
            ],

            [
                'label' => 'IMT',
                'value' => function($m){
                    // Pastikan method hitungIMT() ada di model DataForm
                    return method_exists($m, 'hitungIMT') ? $m->hitungIMT() : '-';
                }
            ],

            [
                'label' => 'Kategori',
                'value' => function($m){
                    // Pastikan method getKategoriIMT() ada di model DataForm
                    return method_exists($m, 'getKategoriIMT') ? $m->getKategoriIMT() : '-';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Aksi',
                'template' => '{view} {update} {print}',
                'buttons' => [

                    'view' => function ($url, $m) {
                        return Html::a(
                            '<i class="bi bi-eye"></i>',
                            ['view', 'id' => $m->id_form_data],
                            ['class' => 'btn btn-info btn-sm']
                        );
                    },

                    'update' => function ($url, $m) {
                        return Html::a(
                            '<i class="bi bi-pencil"></i>',
                            ['update', 'id' => $m->id_form_data],
                            ['class' => 'btn btn-warning btn-sm']
                        );
                    },

                    'print' => function ($url, $m) {
                        return Html::a(
                            '<i class="bi bi-printer"></i>',
                            ['data-form/download-pdf', 'id' => $m->id_form_data],
                            [
                                'class' => 'btn btn-secondary btn-sm',
                                'target' => '_blank'
                            ]
                        );
                    },

                ]
            ],
        ],
    ]) ?>

</div>

<?php
$this->registerCss("
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