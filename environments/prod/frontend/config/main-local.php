<?php
return [
    'components' => [
        'request' => array_merge(require(__DIR__ . '/cookie-key.php'), [
            //...
        ]),
    ],
];
