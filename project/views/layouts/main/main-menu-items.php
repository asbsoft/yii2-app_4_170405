<?php

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\modules\content_2_170309\models\ContentMenuBuilder;

    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;

    $tc = 'layout/main';

    // link tostart page
    $menuItemRoot = [
        //['label' => Yii::t($tc, 'Index(orig)'), 'url' => '/site/index'],
    ];

    // items from content-module
    $menuItemsContent = ContentMenuBuilder::rootMenuItems();

    // additional items
    $menuItems = [
        //['label' => Yii::t($tc, 'News'), 'url' => ['/news-3b/main/index']],
        //['label' => Yii::t($tc, 'Contacts'), 'url' => ['/contactform3-frontend/main/index']],
    ];
    
    // auth items
    $authItems = include Yii::getAlias(__DIR__ . '/auth-menu-items.php');

    // all items together
    $menuItems = ArrayHelper::merge($menuItemRoot, $menuItemsContent, $menuItems, $authItems);

    // link to backend (basic application only)
    if (Yii::$app->type == UniApplication::APP_TYPE_UNITED && !empty(Yii::$app->params['adminPath']) ) {
        $menuItems[] = ['label' => Yii::t($tc, 'Backend'), 'url' => '/' . Yii::$app->params['adminPath']];
    }

    return $menuItems;