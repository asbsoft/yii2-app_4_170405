<?php
/**
 * Yii Application Initialization Tool Configs Searcher
 *
 * @author ASB <ab2014box@gmail.com>
 */

$configs = [];

$handle = opendir(__DIR__);
while (($name = readdir($handle)) !== false) {
    if ($name === '.git' || $name === '.svn' || $name === '.' || $name === '..') {
        continue;
    }
    $path = __DIR__ . '/' . $name;
    if (!is_dir($path)) {
        continue;
    }
    $configFile = "{$path}.php";
    if (!is_file($configFile)) {
        continue;
    }
    $config = include($configFile);

    $keys = array_keys($config);
    if (array_key_exists($keys[0], $configs)) {
        die("*** Error: Configuration '{$keys[0]}' already exists. File '{$configFile}'.");
    }
    $configs = array_merge($configs, $config);
}
closedir($handle);
return $configs;
