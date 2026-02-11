<?php

use yii\helpers\Html;

$this->title = 'Update Registrasi';
?>

<div class="card shadow-sm rounded-4 p-4">

    <div class="mb-4">
        <h5 class="fw-bold mb-1">Update Registrasi</h5>
        <small class="text-muted">Edit data pasien</small>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>