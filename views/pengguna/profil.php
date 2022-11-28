<?php

/* @var $this yii\web\View */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

$this->title = 'Profil Pegawai';
$this->params['breadcrumbs'][] = $this->title;

if ($getUser) {
    // $is_login = json_decode($getUser, true)['valid_ket'];
    $emp = json_decode($getUser['valid_ket'], true);
    $getUser = "" . $emp['employee_name'] . ", " . $emp['salutation'] . "";
    // $getUser = "Login";
} else {
    // $getUser = "(Belum Login)";
    $getUser = "";
}
?>
<div class="site-about">
    <br>
    <h4> <?= $getUser ?> <span class="darkmode-ignore">&nbsp;👩‍💼 👨‍💼</span>
        <br>
        <i style="font-size:medium;">(<?= Html::encode($this->title) ?>)</i>
    </h4>
    <!-- DOKTOR -->
    <!-- 👩‍⚕️ 👨‍⚕️ 🧑‍⚕️ ; -->
    <!-- <br> -->
    <!-- <button onclick="bukaUrl()" class="btn btn-primary darkmode-ignore">Login?</button> -->
    <!-- <code><?= __FILE__ ?></code> -->
    <!-- <code><?= json_encode($getUser) ?></code> -->

    <?php $form = ActiveForm::begin(['id' => 'form-nya',  'options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return false;"]]); ?>
    <!-- <br> -->
    <input type="hidden" id="initData" name="initData">
    <?= $form->field($model, 'string1')->textInput(["readOnly" => true])->label('Nama'); ?>
    <!-- <?= $form->field($model, 'string2')->textInput(["readOnly" => true])->label('Employee Id'); ?> -->
    <?= $form->field($model, 'string3')->textInput(["readOnly" => true])->label('NIK'); ?>
    <?= $form->field($model, 'string4')->textInput(["readOnly" => true])->label('No. Pegawai'); ?>


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
$this->registerJs($this->render('profil.js'), View::POS_END);
