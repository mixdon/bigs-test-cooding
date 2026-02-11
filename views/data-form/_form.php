<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model app\models\DataForm */
/* @var $registrasi app\models\Registrasi */

?>

<div class="card-modern">

    <!-- HEADER -->
    <div class="mb-4">
        <h5 class="fw-semibold mb-1">Input Data Pemeriksaan</h5>
        <small class="text-muted">
            Pasien: <?= Html::encode($registrasi->nama_pasien) ?> (No Registrasi: <?= $registrasi->no_registrasi ?>)
        </small>
    </div>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'row g-4'],
    ]); ?>

    <!-- Hidden ID Registrasi -->
    <?= $form->field($model, 'id_registrasi')
        ->hiddenInput(['value' => $registrasi->id_registrasi])
        ->label(false) ?>

    <!-- Tinggi & Berat Badan -->
    <div class="col-md-6">
        <?= $form->field($model, 'tinggi_badan')
            ->input('number', [
                'placeholder' => 'cm',
                'min' => 0,
                'step' => '0.1',
            ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'berat_badan')
            ->input('number', [
                'placeholder' => 'kg',
                'min' => 0,
                'step' => '0.1',
            ]) ?>
    </div>

    <!-- Keluhan -->
    <div class="col-md-12">
        <?= $form->field($model, 'keluhan')
            ->textarea(['rows' => 3, 'placeholder' => 'Tuliskan keluhan pasien']) ?>
    </div>

    <!-- Riwayat Penyakit Checkbox -->
    <div class="col-md-6">
        <?= $form->field($model, 'riwayat_penyakit')->checkbox([
            'id' => 'riwayatCheckbox'
        ]) ?>
    </div>

    <!-- Keterangan Riwayat -->
    <div class="col-md-12" id="riwayatField">
        <?= $form->field($model, 'keterangan_riwayat')
            ->textarea(['rows' => 3, 'placeholder' => 'Tuliskan keterangan riwayat penyakit jika ada']) ?>
    </div>

    <!-- Submit -->
    <div class="col-12 mt-2">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Simpan Data' : 'Update Data',
            ['class' => 'btn btn-primary px-4']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// JS untuk toggle keterangan riwayat
$this->registerJs(<<<JS
function toggleRiwayat() {
    $('#riwayatField').toggle($('#riwayatCheckbox').is(':checked'));
}
toggleRiwayat();
$('#riwayatCheckbox').on('change', toggleRiwayat);
JS);
?>