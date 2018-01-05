<?php

    /* @var $tc */
    /* @var $menuItems */

    use yii\helpers\Html;

    if (!empty($tc)) { // save parents vars
        $tc0 = $tc;
        $menuItems0 = $menuItems;
    }

    $tc = 'app/sys/module';//$trlist = array_keys(Yii::$app->i18n->translations);$modlist = array_keys(Yii::$app->loadedModules);xdebug_break();

    $moduleUsersUid = 'sys/users';
    //$moduleUsersUid = 'users';

    $_menuItems = [];

    if (Yii::$app->user->isGuest) {
        $_menuItems[] = ['label' => Yii::t($tc, 'Login'), 'url' => ["/{$moduleUsersUid}/main/login"]];
        //$_menuItems[] = ['label' => Yii::t($tc, 'Signup'), 'url' => ["/{$moduleUsersUid}/main/signup"]];
        $_menuItems[] = [
            'label' => Yii::t($tc, 'Signup'),
            'url' => ["/{$moduleUsersUid}/main/signup"],
            'linkOptions' => [
                 'class' => 'btn btn-link',
                 'data' => [
                     'method' => 'post', //!! can't work without JS
                 ],
            ],
        ];
    } else {
        //$_menuItems[] = ['label' => Yii::t($tc, 'Profile'), 'url' => ["/{$moduleUsersUid}/main/profile"]];
        $_menuItems[] = [
            'label' => Yii::t($tc, 'Profile') . ' (' . Yii::$app->user->identity->username . ')',
            'url' => ["/{$moduleUsersUid}/main/profile"],
            'linkOptions' => [
                 'class' => 'btn btn-link',
                 'data' => [
                     'method' => 'post', //!! can't work without JS
                 ],
            ],
        ];

//*
        // original version: work always, but CSS-problem on link hover
        $_menuItems[] = '<li>'
            . Html::beginForm(["/{$moduleUsersUid}/main/logout"], 'post')
            . Html::submitButton(Yii::t($tc, 'Logout') . ' (' . Yii::$app->user->identity->username . ')', [
                  'class' => 'btn btn-link logout',
                  'data' => [
                      'confirm' => Yii::t($tc, 'Are you sure to logout?'),
                  ],
              ])
            . Html::endForm()
            . '</li>';
/**/
/*
        // CSS - OK, but you can't logout without javascript in browser or on javascript error, can't auto-testing
        $_menuItems[] = [
            'label' => Yii::t($tc, 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
            'url' => ["/{$moduleUsersUid}/main/logout"],
            'linkOptions' => [
                 //'class' => 'btn btn-link logout',
                 'class' => 'logout',
                 'data' => [
                     'method' => 'post', //!! can't work without JS
                     'confirm' => Yii::t($tc, 'Are you sure to logout?'),
                 ],
            ],
        ];
/**/
    }

    if (!empty($tc0)) { // restore parents vars
        $tc = $tc0;
        $menuItems = $menuItems0;
    }

    return $_menuItems;
