<?php

    /* @var $tc */

    use asb\yii2\common_2_170212\base\UniApplication;

    use yii\helpers\Html;


    if (!empty($tc)) { // save parents vars
        $tc0 = $tc;
    }

    $tc = 'app/sys/module';

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
                     'method' => 'post',  // can't work without JS
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
                     'method' => 'post',  // can't work without JS
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

    // link to backend (basic application only)
    if (!empty($showLinkToBackend) && Yii::$app->type == UniApplication::APP_TYPE_UNITED && !empty(Yii::$app->params['adminPath']) ) {
        $_menuItems[] = ['label' => Yii::t($tc, 'Backend'), 'url' => '/' . Yii::$app->params['adminPath']];
    }

    if (!empty($tc0)) { // restore parents vars
        $tc = $tc0;
    }

    return $_menuItems;
