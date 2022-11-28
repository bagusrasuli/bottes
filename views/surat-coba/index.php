<?php

/* @var $this yii\web\View */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

$this->title = 'Template';
$this->params['breadcrumbs'][] = $this->title;

if ($getUser) {
    // $is_login = json_decode($getUser, true)['valid_ket'];
    $emp = json_decode($getUser['valid_ket'], true);
    $is_login = $emp['employee_name'] . ", " . $emp['salutation'];
    // $is_login = "Login";
} else {
    $is_login = "Belum Login";
}
?>
<div class="site-about">
    <h3><?= Html::encode($this->title) ?> <span style="font-size:small;">(<?= $is_login ?>)</span></h3>
    <button onclick="bukaUrl()" class="btn btn-primary darkmode-ignore">Was I Influential?</button>
    <!-- <form id="form-nyazz" method="post" enctype='multipart/form-data'>
        <div class="form-group">
            <input type="hidden" id="initData" name="initData">
            <label><b>Ini Input</b></label>
            <input class="form-control form-control-md darkmode-ignore" type="text" placeholder="Ini input" name="namanya">
            <label><b>Input Ini</b></label>
            <input class="form-control form-control-md darkmode-ignore" type="text" placeholder="Ini input" name="namanya">
            <label><b>Upload Ini</b></label>
            <input class="form-control form-control-md darkmode-ignore" type="file" id="formFile">
        </div>
    </form> -->
    <!-- <code><?= __FILE__ ?></code> -->
    <!-- <code><?= json_encode($getUser) ?></code> -->

    <!-- <div class="row">
        <div class="col-6">.col-6</div>
        <div class="col-6">.col-6</div>
    </div> -->

    <?php $form = ActiveForm::begin(['id' => 'form-nya',  'options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return false;"]]); ?>

    <input type="hidden" id="initData" name="initData">
    <?= $form->field($model, 'tanggal1')->widget(DatePicker::className(), [
        'options' => ['placeholder' => 'Tanggal'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ])->label('Tanggal Ini'); ?>

    <?= $form->field($model, 'tanggal2')->widget(DatePicker::className(), [
        'options' => ['placeholder' => 'Tanggal'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ])->label('Tanggal Itu'); ?>


    <?php ActiveForm::end(); ?>

</div>

<style>
    .show-grid>div {
        border: ridge;
    }

    body {
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background:black!important;
    }
</style>

<?php

// $jsnya0 = " var cid = '$cid'; ";
// $this->registerJs($jsnya0, View::POS_END);
$this->registerJs($this->render('index.js'), View::POS_END);
