<?php

    // Original layout (only) for start page

    use project\assets\MainSiteAsset as SiteAsset;  // original for layout

    use asb\yii2\common_2_170212\widgets\dropdownmultilevel\Menu as Nav; // use yii\bootstrap\Nav;

    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\NavBar;

    
    require __DIR__ . '/__config.php';

    $assets = SiteAsset::register($this);

    $mainLang = substr(Yii::$app->language, 0, 2);

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
<body id="page-top" data-target=".navbar">
<?php $this->beginBody() ?>

<div class="wrap">

    <a href="#page-top" class="go-to-top" title="<?= Yii::t($tc, 'Move to top') ?>">
        <span class="glyphicon glyphicon-arrow-up"></span>
    </a>

    <?php
        NavBar::begin([
            'brandLabel' => $siteName,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-op navbar-fixed-top navbar-default',
            ],
        ]);
    ?>
    <?php
        $menuItems = [
            ['url' => '#welcome',  'label' => Yii::t($tc, 'Welcome')],
            ['url' => '#features', 'label' => Yii::t($tc, 'Features')],
            ['url' => '#news',     'label' => Yii::t($tc, 'Events')],
            ['url' => '#contacts', 'label' => Yii::t($tc, 'Contacts')],
            ['url' => '/intro',    'label' => Yii::t($tc, 'More'),
                'linkOptions' => ['class' => 'ext-link']
            ],
        ];
        $authItems = include Yii::getAlias(__DIR__ . '/_auth-menu-items.php');
        $menuItems = ArrayHelper::merge($menuItems, $authItems);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);
    ?>
    <?php include __DIR__ . '/_lang_switcher.php' ?>
    <?php NavBar::end(); ?>

    <div class="container">
        <? echo Alert::widget() ?>

        <div id="welcome" class="ptmh">
            <div class="container">
              <?php include __DIR__ . '/_block_welcome.php' ?>
            </div>
        </div>
        <div id="features" class="ptmh">
            <div class="container">
              <?php include __DIR__ . '/_block_features.php' ?>
            </div>
        </div>
        <div id="news" class="ptmh">
            <div class="container">
              <?php include __DIR__ . '/_block_news.php' ?>
            </div>
        </div>
        <div id="contacts" class="ptmh">
            <div class="container">
              <?php include __DIR__ . '/_block_contacts.php' ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/_footer.php' ?>

<?php
    $this->registerJs("
        jQuery(function(){  // animated scroll to anchor
            jQuery('.navbar-op ul li a, .navbar-op a.navbar-brand, a.go-to-top').on('click', function(event) {    
                event.preventDefault();
                var t = jQuery(this);
                if (t.hasClass('ext-link') || t.hasClass('lang-sw-link') || t.hasClass('navbar-brand')) {
                    window.location.href = this.href;  // no scroll - go to external link
                } else {
                    var hash = this.hash;
                    jQuery('html, body').animate({
                        scrollTop: jQuery(hash).offset().top
                    }, 1000, function(){
                        window.location.hash = hash;
                    });
                }
            });
        });
    ");
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
