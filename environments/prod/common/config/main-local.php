<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
          //'dsn' => 'mysql:host=localhost;dbname=yii2_uni2', // problem in cygwin mysql_connect()
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2_uni2',
            'username' => 'root', //
            'password' => '???',  // todo: correct
            'charset' => 'utf8',
            'tablePrefix' => 'y2app_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
          //'class' => 'yii\caching\DummyCache',
        ],
    ],
];
