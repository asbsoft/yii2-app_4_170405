<?php

    use asb\yii2\modules\content_2_170309\models\ContentMenuBuilder;

    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;


    // link to start page
    $menuItemRoot = [
        ['label' => Yii::t($tc, 'Startpage'), 'url' => '/'],
    ];

    // items from content-module
    $menuItemsContent = ContentMenuBuilder::rootMenuItems();

    // additional items
    $menuItems = [
        //['label' => Yii::t($tc, 'News'), 'url' => ['/news-3b/main/index']],
        //['label' => Yii::t($tc, 'Contacts'), 'url' => ['/contacts/main/index']],
    ];
    
    // auth items
    $authItems = include Yii::getAlias(__DIR__ . '/_auth-menu-items.php');

    // all items together
    $menuItems = ArrayHelper::merge($menuItemRoot, $menuItemsContent, $menuItems, $authItems);

    return $menuItems;
