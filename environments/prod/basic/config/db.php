<?php

return [
    'class' => 'yii\db\Connection',
  //'dsn' => 'mysql:host=localhost;dbname=yii2_uni2', // problem in cygwin mysql_connect()
    'dsn' => 'mysql:host=127.0.0.1;dbname=yii2_uni2',
    'username' => 'root', //
    'password' => '???',  // todo: correct
    'charset' => 'utf8',
    'tablePrefix' => 'y2app_',
];
