<?php
// frontend application initialization without run

$rootDir = __DIR__ . '/../../../..';
$frontendDir = $rootDir . '/frontend';

$config = yii\helpers\ArrayHelper::merge(
    require($rootDir . '/common/config/main.php'),
    require($rootDir . '/common/config/main-local.php'),
    require($frontendDir . '/config/main.php'),
    require($frontendDir . '/config/main-local.php')
);

return new asb\yii2\common_2_170212\base\UniApplication($config);
