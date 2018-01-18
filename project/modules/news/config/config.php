<?php
// Example of redefine parameters of inheritance module

use asb\yii2\common_2_170212\base\UniApplication;

use yii\rest\UrlRule as RestUrlRule;

//$sublink_front = 'news'; // default
$sublink_front = 'events'; // changed
$sublink_back = 'news'; // default

$adminUrlPrefix = empty(Yii::$app->params['adminPath']) ? '' : Yii::$app->params['adminPath'] . '/';

$type = empty(Yii::$app->type) ? false : Yii::$app->type;

return [
    'routesConfig' => [ // default: type => prefix|[config]
        'main'  => $type == UniApplication::APP_TYPE_BACKEND  ? false : [
            'urlPrefix' => $sublink_front,
            'startLinkLabel' => 'News', // use default link ''
        ],
        'admin' => $type == UniApplication::APP_TYPE_FRONTEND ? false : [
            'urlPrefix' => $adminUrlPrefix . $sublink_back,
            'startLink' => [
                'label' => 'News manager', //!! no translate here, it will translate using 'MODULE_UID/module' tr-category
              //'link'  => '', // default
                'action' => 'admin/index',
            ],
        ],
        'rest'  => [
             'class' => RestUrlRule::className(),
             'urlPrefix'  => 'api-news',
             'sublink' => 'events-rest',
        ],
    ],
];
