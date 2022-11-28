<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
// rmrevin\yii\fontawesome\AssetBundle::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- <link rel="stylesheet" href="<?= Url::base(true) ?>\fontawesome-free\css\fontawesome.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">

        <div class="container" style="padding: 1px 20px 20px">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<script src="<?= Url::base(true) ?>/js/darkmode-js.min.js"></script>
<script>
    if (true) { // is implement programmatically dark mode?
        if (window.Telegram.WebApp.colorScheme == 'dark') {
            var options = {
                bottom: '64px', // default: '32px'
                right: 'unset', // default: '32px'
                left: '32px', // default: 'unset'
                time: '0.5s', // default: '0.3s'
                mixColor: '#fff', // default: '#fff'
                // backgroundColor: '#fff', // default: '#fff'
                backgroundColor: invertColor(window.Telegram.WebApp.backgroundColor), // default: '#fff'
                buttonColorDark: '#100f2c', // default: '#100f2c'
                buttonColorLight: '#fff', // default: '#fff'
                saveInCookies: false, // default: true,
                label: '' // default: ''
            }
            const darkmode = new Darkmode(options);
            if (darkmode.isActivated() == false) {
                darkmode.toggle()
                $(".row").children('div').children('div').children('label').css('color', 'white')
            }
        }
        // if (type darkmode == "undefined")
        if (typeof darkmode !== 'undefined') {
            // isolation
            darkmode.showWidget();
        }
    }


    function invertColor(hexTripletColor) {
        var color = hexTripletColor;
        color = color.substring(1); // remove #
        color = parseInt(color, 16); // convert to integer
        color = 0xFFFFFF ^ color; // invert three bytes
        color = color.toString(16); // convert to hex
        color = ("000000" + color).slice(-6); // pad with leading zeros
        color = "#" + color; // prepend #
        return color;
    }

    // warnalabel = $("label").css("color");
    // $("label").css("color", invertColor(warnalabel))
    $("input").css("isolation", 'isolate')
</script>
<?php $this->endPage() ?>