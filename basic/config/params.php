<?php
// Default parameters

use yii\helpers\ArrayHelper;

$defParams = [
    'adminPath'  => 'admin', // need only for BASIC Yii template

    'adminEmail' => 'admin@example.com',
];

$localParams = [];

$localParamsFile = __DIR__ . '/params-local.php';
if (is_file($localParamsFile)) {
    $localParams = include($localParamsFile);
}

return ArrayHelper::merge($defParams, $localParams);
