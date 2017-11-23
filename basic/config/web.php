<?php

use asb\yii2\common_2_170212\base\UniApplication;

$appTemplate = UniApplication::APP_TEMPLATE_BASIC;
$type = UniApplication::APP_TYPE_UNITED;

$rootDir = dirname(__DIR__);
$vendorPath = dirname($rootDir) . '/vendor';
$runtimePath = dirname($rootDir) . '/runtime/basic';

Yii::setAlias('@vendor', $vendorPath);

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => $appTemplate,

    'appTemplate' => $appTemplate,
    'type' => $type,

    'basePath' => dirname(__DIR__),
    'vendorPath' => $vendorPath,
    'runtimePath' => $runtimePath,

    'bootstrap' => ['log'],
    'params' => $params,

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-' . $type,
        ],
        'session' => [
            // this is the name of the session cookie used for login
            'name' => $appTemplate . '-' . $type,
        ],
    ],
];

$configResult = include dirname($rootDir) . '/project/config/config-app.php'; // use var $config with keys 'type', 'params', etc.
//var_dump($configResult);exit;
return $configResult;
