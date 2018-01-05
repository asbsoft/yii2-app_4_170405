<?php

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\common_2_170212\base\BaseModule;
    use asb\yii2\common_2_170212\rbac\AuthHelper;
    use asb\yii2\common_2_170212\helpers\MenuBuilder;

    use asb\yii2\common_2_170212\widgets\dropdownmultilevel\Menu as Nav;
    //use yii\bootstrap\Nav;

    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;

    $routesType = 'admin';
    
    $moduleUsersUid = 'sys/users';

    //$tc = $this->context->tcModule; //!! illegal: use current controller context
    $tc = 'app/sys/module';

    $admUrlPrefix = Yii::$app->params['adminPath'];

    $hasRoleRoot = Yii::$app->authManager->getAssignment('roleRoot', Yii::$app->user->id);
    $hasRoleAdmin = Yii::$app->authManager->getAssignment('roleAdmin', Yii::$app->user->id);

    $configWidget = [
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [],
    ];

    if (Yii::$app->type != UniApplication::APP_TYPE_BACKEND) {
        $configWidget['items'][] = ['label' => Yii::t($tc, 'to site root'), 'url' => ['/']];
    }

    $itemsModules = [];
    if (!Yii::$app->user->isGuest) {
        if ($hasRoleRoot	//!! modules management: developers only
//            || $hasRoleAdmin	//   + admins
        ) {
           $label = Yii::t($tc, '(manager)');
           $actionUid = 'modmgr/admin/index'; // try #1
           if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $itemsModules[] = ['label' => $label, 'url' => ['/' . $actionUid]];
           $actionUid = 'sys/modmgr/admin/index'; // try #2
           if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $itemsModules[] = ['label' => $label, 'url' => ['/' . $actionUid]];

           $itemsModules[] = '<li class="divider"></li>';
        }
    }

    // auto make menus for modules
    $itemsModules = ArrayHelper::merge($itemsModules, MenuBuilder::modulesMenuitems($routesType));

    if ($itemsModules) {
        $configWidget['items'][] = ['label' => Yii::t($tc, 'modules'),
            'items' => $itemsModules,
            'dropDownOptions' => ['class' => 'dropdown-menu'], //!! v.2.0.10
        ];
    }

    $label = Yii::t($tc, 'content');
    $actionUid = 'sys/content/admin/index';
    if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $configWidget['items'][] = ['label' => $label, 'url' => ['/' . $actionUid]];

    $label = Yii::t($tc, 'users');
    $actionUid = 'sys/users/admin/index';
    if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $configWidget['items'][] = ['label' => $label, 'url' => ['/' . $actionUid]];

    if (Yii::$app->user->isGuest) {
        //$configWidget['items'][] = ['label' => Yii::t($tc, 'login'), 'url' => ["/{$moduleUsersUid}/admin-users/login"]];
        $configWidget['items'][] = ['label' => Yii::t($tc, 'login'), 'url' => ["/{$moduleUsersUid}/admin/login"]];
    } else {
        if ($hasRoleRoot || $hasRoleAdmin) {
            $configWidget['items'][] = [ 'label' => Yii::t($tc, 'service'), 'items' => [
                [ 'label' => Yii::t($tc, 'clean cache'), 'url' => ["/sys/admin/clean-cache"] ],
                [ 'label' => Yii::t($tc, 'show routes'), 'url' => ["/sys/admin/show-routes"] ],
                [ 'label' => Yii::t($tc, 'show translations'), 'url' => ["/sys/admin/show-translations"] ],
                [ 'label' => Yii::t($tc, 'show aliases'), 'url' => ["/sys/admin/show-aliases"] ],
            ]];
        }
/*
        // CSS - OK, but you can't logout without javascript in browser or on javascript error, can't auto-testing
        $configWidget['items'][] = [
            'label' => Yii::t($tc, 'logout') . ' (' . Yii::$app->user->identity->username . ')',
            'url' => ["/{$moduleUsersUid}/admin/logout"],
            'linkOptions' => [
                'data' => [
                    'method' => 'post',
                    'confirm' => Yii::t($tc, 'Are you sure to logout?'),
                ]
            ],
        ];
/**/
//*
        // original version: work always, but CSS-problem on link hover
        $configWidget['items'][] = '<li>'
            . Html::beginForm(["/{$moduleUsersUid}/admin/logout"], 'post')
            . Html::submitButton(Yii::t($tc, 'logout') . ' (' . Yii::$app->user->identity->username . ')', [
                  'class' => 'btn btn-link logout',
                  'data' => [
                      'confirm' => Yii::t($tc, 'Are you sure to logout?'),
                  ],
              ])
            . Html::endForm()
            . '</li>';
/**/
    }

    echo Nav::widget($configWidget);
