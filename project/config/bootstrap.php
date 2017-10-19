<?php

$vendorPath = dirname(dirname(__DIR__)) . '/vendor';
Yii::setAlias('@vendor', $vendorPath);

require __DIR__ . '/extensions-aliases.php';//var_dump(Yii::$aliases);exit;
