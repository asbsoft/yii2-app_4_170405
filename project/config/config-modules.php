<?php
// Additionalmodules config

use yii\rest\UrlRule as YiiRestUrlRule;

use asb\yii2\modules\contactform_3_170124\helpers\RestUrlRule;


$configModules = [];

/* 
    // uncomment to use module
    $nextModuleId = 'news-ext';
    //$sublink = 'news'; // change if need (or use different sublinks for front/backend/rest)
    $sublink = 'events';
    $configModules['modules'][$nextModuleId] = [
        'class' => 'project\modules\news\Module',
        'params' => [
            'label' => 'News module included at project config',
        ],
        'routesConfig' => [ // type => prefix|config
            'admin' => [
                'urlPrefix' => (isset($params['adminPath']) && $params['adminPath'] !== false) ? "{$params['adminPath']}/{$sublink}" : false,
            ],
            'main' => [
                'urlPrefix' => (isset($params['adminPath']) && $params['adminPath'] !== '') ? $sublink : false,
            ],
            'rest' => [
                 'class' => YiiRestUrlRule::className(),
                 'urlPrefix'  => 'api',
                 'sublink' => $sublink,
            ],
        ],
    ];
    $configModules['bootstrap'][] = $nextModuleId;
/**/

//* 
    // uncomment to use module
    $nextModuleId = 'contacts-ext';
    $sublink = 'contact-us'; // change if need (or use different sublinks for front/backend)
    $configModules['modules'][$nextModuleId] = [
        'class' => 'project\modules\contacts\Module',
        'params' => [
            'label' => 'Contact form module included at project config',
        ],
        'routesConfig' => [ // type => prefix|config
            'admin' => [
                'urlPrefix' => (isset($params['adminPath']) && $params['adminPath'] !== false) ? "{$params['adminPath']}/{$sublink}" : false,
            ],
            'main' => [
                'urlPrefix' => (isset($params['adminPath']) && $params['adminPath'] !== '') ? $sublink : false,
            ],
            'rest' => [
                'class' => RestUrlRule::className(),
                'urlPrefix' => 'contacts-api',
                'sublink'   => $sublink,
                'startLink' => [
                    'label'  => 'Contacts API',
                    'action' => 'rest/index',
                ],
            ],
        ],
    ];
    $configModules['bootstrap'][] = $nextModuleId;
/**/

return $configModules;
