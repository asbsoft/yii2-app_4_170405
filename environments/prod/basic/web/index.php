<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

require(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/autoload.php');
require(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/base/UniApplication.php');
require(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/web/RequestHelper.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../config/web.php'),
    require(__DIR__ . '/../config/web-local.php')
);

$app = new asb\yii2\common_2_170212\base\UniApplication($config);
$app->run();
