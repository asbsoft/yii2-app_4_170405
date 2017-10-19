<?php
// config for codeception tests

use asb\yii2\common_2_170212\base\UniApplication;

use yii\helpers\ArrayHelper;

$IS_BASIC = true;

$rootPath = dirname(dirname(__DIR__));

$vendorPath = $rootPath . '/vendor';
Yii::setAlias('@vendor', $vendorPath);

/* move to /project/config/bootstrap.php:
require __DIR__ . '/extensions-aliases.php';//var_dump(Yii::$aliases);exit;
*/

$runtimePath = $rootPath . '/runtime/test';

$testConfig = [
    'class' => UniApplication::className(), // for codeception

    'id' => 'test-app',
    'appTemplate' => ($IS_BASIC ? UniApplication::APP_TEMPLATE_BASIC : UniApplication::APP_TEMPLATE_ADVANCED),

    //'type' => UniApplication::APP_TYPE_UNITED, //?? RequestHelper::resolveRequestUri() say 'Unable to determine the request URI'
    'type' => UniApplication::APP_TYPE_CONSOLE,

    'basePath' => $rootPath . '/basic',
    'vendorPath' => $vendorPath,
    'runtimePath' => $runtimePath,

    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'csrfParam' => '_csrf-test',
            'enableCsrfValidation' => false,
        ],        
    ],        
];//echo __FILE__;var_dump($config);exit;

// local configs (db, etc):
if ($testConfig['appTemplate'] == UniApplication::APP_TEMPLATE_ADVANCED) {
    $config = ArrayHelper::merge($testConfig, require(__DIR__ . '/../../common/config/test-local.php'));
//*??:
    $_SERVER['REQUEST_URI'] = '/';
    //$_SERVER['PHP_SELF'] = '/frontend/web/index-test.php';
    //$_SERVER['PHP_SELF'] = $rootPath . '/advanced/web/index-test.php';
/**/
} elseif ($testConfig['appTemplate'] == UniApplication::APP_TEMPLATE_BASIC) {
    $config = ArrayHelper::merge($testConfig, require(__DIR__ . '/../../basic/config/test.php'));
//*??:
    $_SERVER['REQUEST_URI'] = '/';
    //$_SERVER['PHP_SELF'] = $rootPath . '/basic/web/index-test.php';
/**/
} else {
    throw new \Exception('Shortage config');
}

$configResult = require(__DIR__ . '/test-app.php'); // use var $config with keys 'type', 'params', etc.
//var_dump($configResult);exit;
return $configResult;
