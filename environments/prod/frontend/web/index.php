<?php
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

require(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/autoload.php');
require(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/base/UniApplication.php');
require(__DIR__ . '/../../vendor/asbsoft/yii2-common_2_170212/web/RequestHelper.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$app = new asb\yii2\common_2_170212\base\UniApplication($config);
$app->run();
