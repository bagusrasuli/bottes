<?php

/* @var $this yii\web\View */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login Pegawai';
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
    <h3><?= Html::encode($this->title) ?><span class="darkmode-ignore">&nbsp;🔐</span> <br><span style="font-size:small;"><?= $is_login ?></span></h3>
    <!-- <br> -->
    <!-- <button onclick="bukaUrl()" class="btn btn-primary darkmode-ignore">Login?</button> -->
    <!-- <code><?= __FILE__ ?></code> -->
    <!-- <code><?= json_encode($getUser) ?></code> -->


    <?php $form = ActiveForm::begin(['id' => 'form-nya',  'options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return false;"]]); ?>
    <!-- <br> -->
    <input type="hidden" id="initData" name="initData">
    <?= $form->field($model, 'string1')->textInput(['placeholder' => "Input NIK Karyawan"])->label('NIK Karyawan'); ?>
    <?= $form->field($model, 'string2')->passwordInput(['placeholder' => "Input Password"])->label('Password'); ?>


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
    }
</style>

<?php

// $jsnya0 = " var cid = '$cid'; ";
// $this->registerJs($jsnya0, View::POS_END);
$this->registerJs($this->render('index.js'), View::POS_END);
