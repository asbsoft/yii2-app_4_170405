<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use project\assets\MainSiteAsset as SiteAsset;  // original for layout

    use asb\yii2\common_2_170212\widgets\dropdownmultilevel\Menu as Nav; // use yii\bootstrap\Nav;
    use asb\yii2\common_2_170212\widgets\Alert;

    use yii\helpers\Html;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;


    require __DIR__ . '/__config.php';

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
            'brandLabel' => $siteName,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-default navbar-fixed-top',
            ],
        ]);
    ?>
    <?php
        $menuItems = include __DIR__ . '/_main-menu-items.php';
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);
    ?>
    <?php include __DIR__ . '/_lang_switcher.php' ?>
    <?php NavBar::end(); ?>

    <div class="container">
        <div class="content ptmh">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <noscript><h3 class="col-md-12 alert-danger text-center">
                <?= Yii::t($tc, 'Attention! Javascript is off! Part of functionality will be inaccessible!') ?>
            </h3></noscript>

            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/_footer.php' ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
