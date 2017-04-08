<?php

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\common_2_170212\base\BaseModule;
    use asb\yii2\common_2_170212\rbac\AuthHelper;
    use asb\yii2\common_2_170212\helpers\MenuBuilder;

    //use yii\bootstrap\Nav;
    use asb\yii2\common_2_170212\widgets\dropdownmultilevel\Menu as Nav;

    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;

    $routesType = 'admin';
    
    $moduleUsersUid = 'sys/users';

    //$tc = $this->context->tcModule;//?! 'app/sys/module' | 'app/sys/users/module'
    $tc = 'app/sys/module';

    $admUrlPrefix = Yii::$app->params['adminPath'];

    $hasRoleRoot = Yii::$app->authManager->getAssignment('roleRoot', Yii::$app->user->id);//var_dump($hasRoleRoot);
    $hasRoleAdmin = Yii::$app->authManager->getAssignment('roleAdmin', Yii::$app->user->id);//var_dump($hasRoleAdmin);exit;

    $configWidget = [
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [],
    ];

    if (Yii::$app->type != UniApplication::APP_TYPE_BACKEND) {
        $configWidget['items'][] = ['label' => Yii::t($tc, 'to site root'), 'url' => ['/']];
    }

    $itemsModules = [];
    if (!Yii::$app->user->isGuest) {
        if ($hasRoleRoot	//!! developers only
//            || $hasRoleAdmin	//   + admins
        ) {
           $label = Yii::t($tc, '(manager)');
           $actionUid = 'modmgr/admin/index';
           if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $itemsModules[] = ['label' => $label, 'url' => ['/' . $actionUid]];
           $actionUid = 'sys/modmgr/admin/index';
           if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $itemsModules[] = ['label' => $label, 'url' => ['/' . $actionUid]];
        }

        $itemsModules[] = '<li class="divider"></li>';

/*
        // move to first level
        $label = Yii::t($tc, 'users');
        $actionUid = 'sys/users/admin-users/index';
        if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $itemsModules[] = ['label' => $label, 'url' => ['/' . $actionUid]];
/**/
/*
        $moduleUid = 'contactform3backend';
        $actionUid = $moduleUid . '/admin/index';
        $start = BaseModule::startLink($moduleUid, $routesType);//var_dump($start);exit;
        if (!empty($start) && AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) {
            $itemsModules[] = ['label' => $start['label'],
                'url' => isset($start['route']) ? $start['route'] : $start['link']
            ];
        }
        // old version
        //$label = Yii::t($tc, 'Contact form 3');
        //if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $itemsModules[] = ['label' => $label, 'url' => ['/' . $actionUid]];

        $moduleUid = 'tests/news1b';
        $actionUid = $moduleUid . '/admin/index';
        $start = BaseModule::startLink($moduleUid, $routesType);//var_dump($start);exit;
        if (!empty($start) && AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) {
            $itemsModules[] = ['label' => $start['label'],
                'url' => isset($start['route']) ? $start['route'] : $start['link']
            ];
        }
/**/
    }//var_dump($itemsModules);

    // auto make menus for modules
    $itemsModules = ArrayHelper::merge($itemsModules, MenuBuilder::modulesMenuitems($routesType));//var_dump($itemsModules);

    if ($itemsModules) {
        $configWidget['items'][] = ['label' => Yii::t($tc, 'modules'),
            'items' => $itemsModules,
            'dropDownOptions' => ['class' => 'dropdown-menu'], //!! v.2.0.10
        ];
    }

    $label = Yii::t($tc, 'content');
    //$actionUid = 'sys/users/admin-users/index';
    $actionUid = 'sys/content/admin/index';
    if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $configWidget['items'][] = ['label' => $label, 'url' => ['/' . $actionUid]];

    $label = Yii::t($tc, 'users');
    //$actionUid = 'sys/users/admin-users/index';
    $actionUid = 'sys/users/admin/index';
    if (AuthHelper::canUserRunAction($actionUid, Yii::$app->user)) $configWidget['items'][] = ['label' => $label, 'url' => ['/' . $actionUid]];

    if (Yii::$app->user->isGuest) {
        //$configWidget['items'][] = ['label' => Yii::t($tc, 'login'), 'url' => ["/{$moduleUsersUid}/admin-users/login"]];
        $configWidget['items'][] = ['label' => Yii::t($tc, 'login'), 'url' => ["/{$moduleUsersUid}/admin/login"]];
    } else {
        if ($hasRoleRoot || $hasRoleAdmin)
        {
//            $configWidget['items'][] = [ 'label' => Yii::t($tc, '...'), 'url' => ["/..."] ];

/*
            $configWidget['items'][] = [ 'label' => Yii::t($tc, '...submenu...'), 'items' => [
                ['label' => Yii::t($tc, '...'), 'url' => ["/..."]],
                ['label' => Yii::t($tc, '...'), 'url' => ["/..."]],
                ['label' => 'RBAC-assignment', 'url' => ['/sys/user/rbac/assignment/index']],
                ['label' => 'RBAC-role',       'url' => ['/sys/user/rbac/role/index']],
                ['label' => 'RBAC-permission', 'url' => ['/sys/user/rbac/permission/index']],
                ['label' => 'RBAC-rule',       'url' => ['/sys/user/rbac/rule/index']],
            ]];
*/
/*
            $configWidget['items'][] = [ 'label' => Yii::t($tc, 'i18n'), 'items' => [
                [ 'label' => Yii::t($tc, 'languages'), 'url' => ["/{$admUrlPrefix}/lang"] ],
                [ 'label' => Yii::t($tc, 'show translations'), 'url' => ["/{$admUrlPrefix}/show-translations"] ],
            ]];
*/
            $configWidget['items'][] = [ 'label' => Yii::t($tc, 'service'), 'items' => [
                [ 'label' => Yii::t($tc, 'clean cache'), 'url' => ["/sys/admin/clean-cache"] ],
                [ 'label' => Yii::t($tc, 'show routes'), 'url' => ["/sys/admin/show-routes"] ],
                [ 'label' => Yii::t($tc, 'show translations'), 'url' => ["/sys/admin/show-translations"] ],
                [ 'label' => Yii::t($tc, 'show aliases'), 'url' => ["/sys/admin/show-aliases"] ],
            ]];
        }
        $configWidget['items'][] = [
            'label' => Yii::t($tc, 'logout') . ' (' . Yii::$app->user->identity->username . ')',
            //'url' => ["/{$moduleUsersUid}/admin-users/logout"],
            'url' => ["/{$moduleUsersUid}/admin/logout"],
            'linkOptions' => [
                'data' => [
                    'method' => 'post',
                    'confirm' => Yii::t($tc, 'Are you sure to logout?'),
                ]
            ],
        ];
    }//var_dump($configWidget);exit;

    echo Nav::widget($configWidget);
