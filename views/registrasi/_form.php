<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="card shadow-sm rounded-4 p-4">

    <div class="mb-4">
        <h5 class="fw-bold">
            <?= $model->isNewRecord ? 'Registrasi Pasien Baru' : 'Edit Registrasi' ?>
        </h5>
        <small class="text-muted">Lengkapi data pasien</small>
    </div>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'row g-3'],
        'enableClientValidation'=>true,
    ]); ?>

    <!-- NO REG -->
    <div class="col-md-6">
        <?= $form->field($model, 'no_registrasi')
            ->textInput([
                'readonly'=>true,
                'class'=>'form-control bg-light'
            ]) ?>
    </div>

    <!-- NO RM -->
    <div class="col-md-6">
        <?= $form->field($model, 'no_rekam_medis')
            ->textInput([
                'type'=>'number',
                'placeholder'=>'Nomor RM'
            ]) ?>
    </div>

    <!-- NAMA -->
    <div class="col-md-6">
        <?= $form->field($model, 'nama_pasien')
            ->textInput([
                'required'=>true,
                'placeholder'=>'Nama lengkap pasien'
            ]) ?>
    </div>

    <!-- TGL -->
    <div class="col-md-6">
        <?= $form->field($model, 'tanggal_lahir')
            ->input('date',['required'=>true]) ?>
    </div>

    <!-- NIK -->
    <div class="col-md-6">
        <?= $form->field($model, 'nik')
            ->textInput([
                'type'=>'number',
                'placeholder'=>'NIK'
            ]) ?>
    </div>

    <!-- BUTTON AREA -->
    <div class="col-12 mt-4">
        <div class="d-flex justify-content-end gap-2">
            <?= Html::a(
                'Kembali',
                ['index'], // arahkan ke halaman index
                ['class'=>'btn btn-outline-secondary px-4']
            ) ?>

            <?= Html::submitButton(
                $model->isNewRecord ? 'Simpan' : 'Update',
                ['class'=>'btn btn-primary px-4']
            ) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>