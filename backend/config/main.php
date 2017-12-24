<?php

use asb\yii2\common_2_170212\base\UniApplication;
//use asb\yii2\common_2_170212\web\RequestHelper;

/** !!
 * Webroot shift parameter from /.haccess.
 * String not start and end with '/'.
 * Comment it if you not use /.haccess for shifting webroot.
 */

if (!isset($adminUrlPrefixHtaccess)) {
    $adminUrlPrefixHtaccess = 'back';
  //$adminUrlPrefixHtaccess = ''; // if no shift by .haccess
}

$appTemplate = UniApplication::APP_TEMPLATE_ADVANCED;
$type = UniApplication::APP_TYPE_BACKEND;

$rootDir = dirname(dirname(__DIR__));
$vendorDir = $rootDir . '/vendor';
$runtimePath = $rootDir . '/runtime/backend';

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

    'controllerNamespace' => 'backend\controllers',

    'bootstrap' => ['log'],
    'modules' => [],

    'homeUrl' => "/{$adminUrlPrefixHtaccess}", //!! use together with /.haccess in root of Yii2-advanced framework
    
    'params' => $params,

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-' . $type,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => $appTemplate . '-' . $type,
        ],
    ],

];

$configResult = include $rootDir . '/project/config/config-app.php'; // use var $config with keys 'type', 'params', etc.
//var_dump($configResult);exit;
return $configResult;
