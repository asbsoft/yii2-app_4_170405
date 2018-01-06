<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use asb\yii2\common_2_170212\widgets\Alert;

    use asb\yii2\common_2_170212\widgets\dropdownmultilevel\Menu as Nav; // use yii\bootstrap\Nav;

    use project\assets\MainSiteAsset as SiteAsset;

    use yii\helpers\Html;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;

    $tc = 'layout/main';

    if (empty($brandLabel)) $brandLabel = Yii::t($tc, 'My site - main layout');

    $assets = SiteAsset::register($this);

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
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => $brandLabel,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                //'class' => 'navbar-inverse navbar-fixed-top',
                //'class' => 'navbar-fixed-top',
            ],
        ]);
    ?>
    <div class="navbar-right"><?= Yii::$app->runAction('/sys/main/lang-switch', []) ?></div>
    <?php
        $items = include __DIR__ . '/main-menu-items.php';
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $items,
        ]);
        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="content">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
