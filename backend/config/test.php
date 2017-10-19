<?php

use asb\yii2\common_2_170212\base\UniApplication;

$rootDir = dirname(dirname(__DIR__));
$runtimePath = $rootDir . '/runtime/backend-test';

return [
    'id' => 'app-backend-tests',
    'type' => UniApplication::APP_TYPE_BACKEND,
    'appTemplate' => UniApplication::APP_TEMPLATE_ADVANCED,

    'runtimePath' => $runtimePath,

    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
    ],
];
