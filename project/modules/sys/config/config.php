<?php

    use asb\yii2\common_2_170212\base\UniApplication;

    $type = empty(Yii::$app->type) ? false : Yii::$app->type;//var_dump($type);

    $config = [
/*
        // shared models
        'models' => [ // alias => class name or object array
            'UrlManager' => 'project\modules\sys\models\UrlManager', // move to yii2-common...
        ],
*/
        'bootstrap' => [],
        'modules' => [],
    ];

/*
    //?? can't work as submodule
    $nextModuleId = 'modmgr';
    $config['modules'][$nextModuleId] = [
        'class' => 'project\modules\sys\modules\modmgr\Module',
        'routesConfig' => [ // type => prefix|config
            'admin' => ($type != UniApplication::APP_TYPE_FRONTEND && isset(Yii::$app->params['adminPath']) && Yii::$app->params['adminPath'] !== false)
                       ? trim(Yii::$app->params['adminPath'] . '/modmgr', '/')
                       : false,
        ],
    ];
    //$config['bootstrap'][] = $nextModuleId;
    //$config['bootstrap'][] = 'project\modules\sys\modules\modmgr\Bootstrap'; // move to main config @project\config\config-app.php
/**/

    $nextModuleId = 'users';
    $config['modules'][$nextModuleId] = [
        'class' => 'project\modules\sys\modules\user\Module',
        'routesConfig' => [ // type => prefix|config
            'admin' => $type == UniApplication::APP_TYPE_FRONTEND ? false : 'usr',
            'main'  => $type == UniApplication::APP_TYPE_BACKEND  ? false : 'usr',
        ],
    ];
    $config['bootstrap'][] = $nextModuleId;

    $nextModuleId = 'content';
    $config['modules'][$nextModuleId] = [
        'class' => 'project\modules\sys\modules\content\Module',
        'routesConfig' => [ // type => prefix|config
            'admin' => [
                'urlPrefix' => $type == UniApplication::APP_TYPE_FRONTEND ? false : 'content',
            ],
          //'main'  => $type == UniApplication::APP_TYPE_BACKEND  ? false : '', //??
          //'main'  => $type == UniApplication::APP_TYPE_BACKEND  ? false : 'page',
        ],
    ];
    $config['bootstrap'][] = $nextModuleId;

    //var_dump($config['modules']);exit;
    return $config;
