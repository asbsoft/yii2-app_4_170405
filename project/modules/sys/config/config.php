<?php

    use asb\yii2\common_2_170212\base\UniApplication;


    $type = empty(Yii::$app->type) ? false : Yii::$app->type;//var_dump($type);

    $config = [
        'models' => [  // shared models: alias => class name or object array
            'LayoutModel' => 'project\modules\sys\models\LayoutModel',
            'ApplicationModel' => 'project\modules\sys\models\ApplicationModel',
        ],
        'bootstrap' => [],
        'modules' => [],
    ];

    $nextModuleId = 'users';
    $config['modules'][$nextModuleId] = [
        'class' => 'project\modules\sys\modules\user\Module',
        'routesConfig' => [ // type => prefix|config
            'admin' => [
                'urlPrefix' =>
                    $type == UniApplication::APP_TYPE_FRONTEND ? false : 'usr',
            ],
            'main'  => [
                'urlPrefix' =>
                    $type == UniApplication::APP_TYPE_BACKEND  ? false : 'usr',
            ],
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
        ],
    ];
    $config['bootstrap'][] = $nextModuleId;

    return $config;
