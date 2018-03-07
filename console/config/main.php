<?php

use asb\yii2\common_2_170212\base\UniConsoleApplication;
$type = UniConsoleApplication::APP_TYPE_CONSOLE;

$basePath = dirname(__DIR__);
$rootDir = dirname(dirname(__DIR__));
$vendorDir = $rootDir . '/vendor';
$runtimePath = $rootDir . '/runtime/console';

Yii::setAlias('@vendor', $vendorDir);

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'appTemplate' => UniConsoleApplication::APP_TEMPLATE_ADVANCED,
    'type' => $type,

    'id' => 'app-console',
    'basePath' => $basePath,
    'runtimePath' => $runtimePath,
    
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
        'migrate-module-users' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => '{{%migration_module_users}}',
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];

/** Common default CMS config */
$configCms = include $rootDir . '/project/config/config-app.php'; //!! use var $config
//var_dump($config);
//var_dump($configCms);

$authManager = $configCms['components']['authManager'];
//$user = $configCms['components']['user'];

if (isset($configCms['components'])) unset($configCms['components']);
if (isset($configCms['modules']))    unset($configCms['modules']);
if (isset($configCms['bootstrap']))  unset($configCms['bootstrap']);//var_dump($configCms);exit;

$configCms['components']['authManager'] = $authManager; // need for RBAC-migrations
//$configCms['components']['user'] = $user; // need for RBAC-migrations

//$config = array_merge_recursive($configCms, $config);//var_dump($config);exit;
//return $config;
return $configCms;
