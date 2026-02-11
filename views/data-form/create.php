<?php

use yii\helpers\Html;

$this->title = 'Input Data Pemeriksaan';
?>

<div class="data-form-create">

    <?= $this->render('_form', [
        'model' => $model,
        'registrasi' => $registrasi,
    ]) ?>

</div>
