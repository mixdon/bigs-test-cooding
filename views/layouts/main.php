<?php

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <?php $this->head() ?>

<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#f4f6f9;
    color:#212529;
}

/* ===== LAYOUT ===== */
.sidebar{
    width:230px;
    height:100vh;
    position:fixed;
    background:#0b1f3a;
    padding-top:25px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 25px;
    color:#fff;
    text-decoration:none;
    font-weight:500;
}

.sidebar a:hover{
    background:rgba(255,193,7,.15);
    color:#ffc107;
}

.sidebar a.active{
    background:#ffc107;
    color:#0b1f3a;
    font-weight:600;
}

.sidebar-logo{
    text-align:center;
    margin-bottom:25px;
    color:#fff;
    font-weight:700;
}

.main-wrapper{
    margin-left:230px;
    min-height:100vh;
    display:flex;
    flex-direction:column;
}

.main-content{
    flex:1;
    padding:30px;
}

/* ===== UI SYSTEM ===== */
.page-title{
    font-size:22px;
    font-weight:700;
}

.page-subtitle{
    font-size:13px;
    color:#6c757d;
}

.card-clean{
    background:#fff;
    border-radius:16px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.table thead th{
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.6px;
    background:#f8f9fa;
    color:#6c757d;
}

.badge-soft-success{
    background:rgba(25,135,84,.12);
    color:#198754;
    padding:6px 10px;
    border-radius:8px;
    font-weight:600;
}

.badge-soft-danger{
    background:rgba(220,53,69,.12);
    color:#dc3545;
    padding:6px 10px;
    border-radius:8px;
    font-weight:600;
}

.footer{
    background:#fff;
    padding:12px;
    text-align:center;
    font-size:13px;
    border-top:3px solid #ffc107;
}
</style>
</head>

<body>
<?php $this->beginBody() ?>

<div class="sidebar">
    <div class="sidebar-logo">BIGS APP</div>

    <a href="<?= Url::to(['/site/index']) ?>" class="<?= Yii::$app->controller->id=='site'?'active':'' ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="<?= Url::to(['/registrasi/index']) ?>" class="<?= Yii::$app->controller->id=='registrasi'?'active':'' ?>">
        <i class="bi bi-person-lines-fill"></i> Registrasi
    </a>

    <a href="<?= Url::to(['/data-form/index']) ?>" class="<?= Yii::$app->controller->id=='data-form'?'active':'' ?>">
        <i class="bi bi-clipboard-check"></i> Pemeriksaan
    </a>
</div>

<div class="main-wrapper">
    <div class="main-content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <div class="footer">
        © <?= date('Y') ?> <b>BIGS APP by donkur</b>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>