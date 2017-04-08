<?php

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\modules\content_2_170309\models\ContentMenuBuilder;

    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;

    $tc = 'app'; //todo

    $menuItemRoot = [
        //['label' => Yii::t($tc, 'Index(orig)'), 'url' => '/site/index'],
    ];

    $menuItemsContent = ContentMenuBuilder::rootMenuItems();

    $menuItems = [
        //['label' => Yii::t($tc, 'About'), 'url' => ['/site/about']],
        //['label' => Yii::t($tc, 'News'), 'url' => ['/tests/news1b/main/index']],
        //['label' => Yii::t($tc, 'Contact') . '-v3', 'url' => ['/contactform3frontend/main/index']],
    ];
    
    $authItems = include Yii::getAlias('@project/views/layouts/auth-menu-items.php');//var_dump($authItems);

    $menuItems = ArrayHelper::merge($menuItemRoot, $menuItemsContent, $menuItems, $authItems);//var_dump($menuItems);exit;

    if (Yii::$app->type == UniApplication::APP_TYPE_UNITED && !empty(Yii::$app->params['adminPath']) ) {
        //$menuItems[] = ['label' => Yii::t($tc, 'Backend'), 'url' => ['//' . Yii::$app->params['adminPath']]];
        $menuItems[] = ['label' => Yii::t($tc, 'Backend'), 'url' => '/' . Yii::$app->params['adminPath']];
    }

    //var_dump($menuItems);exit;
    return $menuItems;