<?php

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/test-local.php'),
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(__DIR__ . '/test.php'),
    [
//...
    ]
);

$configResult = include $rootDir . '/project/config/test-app.php'; // use var $config with keys 'type', 'params', etc.
//var_dump($configResult);exit;
return $configResult;
