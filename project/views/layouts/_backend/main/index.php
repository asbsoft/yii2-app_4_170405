<?php

/* @var $this \yii\web\View */
/* @var $content string */

    use project\assets\MainSiteAsset;

    use asb\yii2\common_2_170212\widgets\Alert;

    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use yii\web\YiiAsset;

    $assets = MainSiteAsset::register($this); // contain YiiAsset::register($this); // need yii.js for js-confirm in menu

    //$tc = $this->context->tcModule; //!! illegal: use current controller context
    $tc = 'app/sys/module';

    $adminUrl = Yii::$app->homeUrl . Yii::$app->params['adminPath'];


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => Yii::t($tc, 'Adminer'),
        'brandUrl' => $adminUrl,
        'options' => [
//          'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar-admin',
        ],
    ]);

    require __DIR__ . '/menu-admin.php';

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget(); ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <br />
    <div class="container">
        <p class="pull-left">
            &copy; <?= date('Y') ?>
            <?= Yii::$app->params['owner'] ?>
            <?= Yii::$app->params['product'] ?>
            <?= Yii::$app->params['version'] ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
