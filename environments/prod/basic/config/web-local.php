<?php

$config = [
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'request' => array_merge(require(__DIR__ . '/cookie-key.php'), [
            //'baseUrl' => '/basic/web', //!! uncomment/correct if this site run from subdir, not from root
        ]),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
