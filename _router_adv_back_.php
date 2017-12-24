<?php

require_once __DIR__ . '/vendor/asbsoft/yii2-common_2_170212/web/RequestHelper.php';

use asb\yii2\common_2_170212\web\RequestHelper;


$adminUrlPrefixHtaccess = ''; // !!

$webRootDir = __DIR__ . '/backend/web';
$starter = realpath($webRootDir . '/index.php');

$requestUri = RequestHelper::resolveRequestUri();

$parts = parse_url($requestUri);
$requestUri = $parts['path'];

$file = $webRootDir . '/' . $requestUri;
if (is_file($file)) {
    return false;
} else {
    return require($starter);
}
