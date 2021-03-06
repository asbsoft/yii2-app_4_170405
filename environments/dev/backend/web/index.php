<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

require_once(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/autoload.php');
require_once(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/base/UniApplication.php');
require_once(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/web/RequestHelper.php');

if (realpath($_SERVER['DOCUMENT_ROOT']) == __DIR__) {
    $adminUrlPrefixHtaccess = '';
} else {
    $adminUrlPrefixHtaccess = 'back';
}

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$app = new asb\yii2\common_2_170212\base\UniApplication($config);
$app->run();
