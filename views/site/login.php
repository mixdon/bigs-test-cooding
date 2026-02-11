<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /* BODY dan container */
    body {
        background-color: #f5f5f5;
        /* Light gray */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .site-login {
        max-width: 400px;
        margin: 80px auto;
        padding: 40px;
        background-color: #ffffff;
        /* White card */
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    /* Judul */
    .site-login h1 {
        color: #0b1f3a;
        /* Dark blue */
        text-align: center;
        margin-bottom: 25px;
        font-weight: 700;
    }

    /* Form Fields */
    .form-control {
        border-radius: 6px;
        border: 1px solid #ccc;
        background-color: #fafafa;
        color: #333;
        padding: 10px 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #0b1f3a;
        box-shadow: 0 0 6px rgba(11, 31, 58, 0.2);
        background-color: #fff;
    }

    /* Checkbox */
    .custom-control-label::before,
    .custom-control-label::after {
        border-radius: 4px;
    }

    .custom-control-input:checked~.custom-control-label::before {
        background-color: #0b1f3a;
        border-color: #0b1f3a;
    }

    /* Submit Button */
    .btn-primary {
        width: 100%;
        background-color: #0b1f3a;
        /* Dark Blue */
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #132c52;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Info text */
    .site-login .info-text {
        color: #555;
        font-size: 0.875rem;
        margin-top: 20px;
        text-align: center;
    }
</style>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'mt-4'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-label'],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Enter your username']) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter your password']) ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"custom-control custom-checkbox mb-3\">{input} {label}</div>\n{error}",
        'labelOptions' => ['class' => 'custom-control-label'],
        'inputOptions' => ['class' => 'custom-control-input'],
    ]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="info-text">
        Welcome! Please enter your username and password to access the dashboard.
    </div>
</div>