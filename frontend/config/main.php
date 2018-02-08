<?php

use asb\yii2\common_2_170212\base\UniApplication;

$appTemplate = UniApplication::APP_TEMPLATE_ADVANCED;
$type = UniApplication::APP_TYPE_FRONTEND;

$rootDir = dirname(dirname(__DIR__));
$vendorDir = $rootDir . '/vendor';
$runtimePath = $rootDir . '/runtime/frontend';

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

Yii::setAlias('@vendor', $vendorDir);

$config = [
    'appTemplate' => $appTemplate,
    'type' => $type,
    'id' => 'app-' . $type,

    'basePath' => dirname(__DIR__),
    'runtimePath' => $runtimePath,

    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',

    'homeUrl' => '/', //!! + /.haccess

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-' . $type,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => $appTemplate . '-' . $type,
        ],
    ],
    'params' => $params,
];

/** Common default CMS config */
$configResult = include $rootDir . '/project/config/config-app.php'; // use var $config with keys 'type', 'params', etc.
//var_dump($configResult);exit;
return $configResult;
