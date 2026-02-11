<?php

$this->title = 'Update Data Pemeriksaan';

echo $this->render('_form', [
    'model' => $model,
    'registrasi' => $model->registrasi
]);
