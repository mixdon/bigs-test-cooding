<?php

use yii\helpers\Html;

$this->title = 'Registrasi Baru';
?>

<div class="registrasi-create">
    <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
