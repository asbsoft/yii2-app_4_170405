<?php
// common config for all tests

/* @var $config array real application config (basic, advanced, console, etc) */

use yii\helpers\ArrayHelper;

$commonConfig = ArrayHelper::merge(
    require(__DIR__ . '/config-app.php'), // use var $config
    [
//...
    ]
);//echo __FILE__;var_dump($commonConfig);exit;
return $commonConfig;
