<?php

/* @var $this yii\web\View */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

$this->title = 'Surat Pengajuan Cuti';
$this->params['breadcrumbs'][] = $this->title;

if ($getUser) {
    // $is_login = json_decode($getUser, true)['valid_ket'];
    $emp = json_decode($getUser['valid_ket'], true);
    $is_login = "(" . $emp['employee_name'] . ", " . $emp['salutation'] . ")";
    // $is_login = "Login";
} else {
    // $is_login = "(Belum Login)";
    $is_login = "";
}
?>
<div class="site-about">
    <br>
    <h3><?= Html::encode($this->title) ?><span class="darkmode-ignore">&nbsp;✈️ </span> <br><span style="font-size:small;"><?= $is_login ?></span></h3>
    <!-- <br> -->
    <!-- <button onclick="bukaUrl()" class="btn btn-primary darkmode-ignore">Login?</button> -->
    <!-- <code><?= __FILE__ ?></code> -->
    <!-- <code><?= json_encode($getUser) ?></code> -->


    <?php $form = ActiveForm::begin(['id' => 'form-nya',  'options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return false;"]]); ?>
    <!-- <br> -->
    <input type="hidden" id="initData" name="initData">
    <!-- <?= $form->field($model, 'periode')->textInput(['placeholder' => true]); ?> -->
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'periode')->textInput(['placeholder' => true]); ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'sisa_cuti')->textInput(['placeholder' => true]); ?>
        </div>
    </div>




    <?php ActiveForm::end(); ?>

</div>

<style>
    /* .row>div>div>label{
        color:green;
    } */
    .show-grid>div {
        border: ridge;
    }

    body {
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* form-control-sm */
    /* .form-control {
        height: calc(1.5em + 0.5rem + 2px) !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
        border-radius: 0.2rem !important;
    } */

    .row {
        padding-right: 5px;
        padding-left: 5px;
    }

    .row>div {
        padding-right: 5px;
        padding-left: 5px;
    }
</style>

<?php

// $jsnya0 = " var cid = '$cid'; ";
// $this->registerJs($jsnya0, View::POS_END);
$this->registerJs($this->render('index.js'), View::POS_END);
