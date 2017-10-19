<?php

/**
 * This is common default CMS config.
 * It's elements can be overwrite by $config elements.
 * @var $config array real application config (basic, advanced, console, etc)
 * @var $params application parameters
 * @return array corrected $config
 *
 * Note.
 * - $params['adminPath'] - admin URL prefix - can have values:
 *   - non-empty string (f.e. 'adm') - for basic Yii2-application template
 *   - empty string '' - for advanced-backend Yii2-application template
 *   - false - for advanced-frontend Yii2-application template
 */

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\common_2_170212\web\RequestHelper;

    use yii\rbac\DbManager as AuthManager;
    use yii\helpers\ArrayHelper;

    /* Prepare some aliases need for autoload */
    require __DIR__ . '/extensions-aliases.php';//var_dump(Yii::$aliases);exit;

    /* Prepare some variables here:
        $type, $params, $paramsCms,
        $loginUrl, $errorAction, $layoutPath
     */
    require __DIR__ . '/config-app-prepare.php';

    $baseUrl = null;
    if ($type !== UniApplication::APP_TYPE_CONSOLE) {
        require_once Yii::getAlias('@asb/yii2/common_2_170212/web/RequestHelper.php');
        $requestUri = RequestHelper::resolveRequestUri();//var_dump($requestUri);
        //$baseUrl = $requestUri; // for run site from subdir
        $baseUrl = ''; // '' if not use shift webroot from / to /.../web/ by mod_rewrite in /.haccess
        if (!empty($adminUrlPrefixHtaccess)) {
            $prefix = "/{$adminUrlPrefixHtaccess}";
            if (strpos($requestUri, $prefix) === 0) {
                $baseUrl = $prefix;
            }
        }
    }//var_dump($baseUrl);exit;

    /* Basic system config */
    $configCms = [
        'params' => $paramsCms,

        'layoutPath' => '@project/views/layouts',

        // Defauld language will get from LangHelper::defaultLanguage()
        // For turn off saving and getting default language from cookie,
        // set in params file params-app.php: 'asb\yii2\common_2_170212\i18n\LangHelper' => ['langCookieExpiredSec' => 1]
        //'language' => 'en-US', //!! Do not set default language here.

        // Application default route
        //'defaultRoute' => 'site', // default in yii\web\Application - 'site/index'
        //'defaultRoute' => 'site/about',
        //'defaultRoute' => ['sys/content/main/view', 'id' => 0], //error: must be string
        //'defaultRoute' => 'sys/content/main/view', //!! not here - move to sys/content-module bootstrap
           //!! if module sys/content is off on '404 not found' error will be recursive exceptions

        'components' => [
            'view' => [
                'class' => 'asb\yii2\common_2_170212\web\UniView', // need for work views inheritance
            ],
            'request' => [
                'csrfParam' => '_csrf-' . $config['type'],
                'baseUrl' => $baseUrl,
            ],
            'session' => [
                // this is the name of the session cookie used for login on the backend
                'name' => $config['appTemplate'] . '-' . $config['type'],
            ],
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
            'urlManager' => [
                //'class' => 'yii\web\UrlManager', // default
                //'class' => 'asb\yii2\common_2_170212\web\UrlManager', 'sitetreeModuleUniqueId' => 'sys', 'sitetreeManagerAlias' => 'UrlManager',
                'class' => 'asb\yii2\common_2_170212\web\UrlManagerMultilang',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                //'rules' => [],
//*
                'normalizer' => [
                    'class' => 'yii\web\UrlNormalizer',
                    'normalizeTrailingSlash' => true,
                ],
/**/
            ],
            'user' => [
                'class' => 'yii\web\User', // require for run migrations in console app
                'identityClass' => 'asb\yii2\common_2_170212\web\UserIdentity', //!! common + add param(s) in ./params-cms.php:
                   // Yii::$app->params['asb\yii2\common_2_170212\web\UserIdentity'] = ['userModuleUniqueId' => 'sys/users', ... // moduleUid
                'enableAutoLogin' => true,
                'loginUrl' => $loginUrl,
                'identityCookie' => ['name' => '_identity-' . $config['type'], 'httpOnly' => true],
            ],
            'authManager' => [
                'class' => AuthManager::className(),
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@project/views/mail',
//*
                'useFileTransport' => true, // if true send all mails to files by default
                'fileTransportPath' => '@runtime/mail',
/**/
/*
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'localhost',
                    'username' => 'username',
                    'password' => 'password',
                    'port' => '587',
                    'encryption' => 'tls',
                ],
/**/
            ],
//*
            'errorHandler' => [
                'class' => 'asb\yii2\common_2_170212\web\UniErrorHandler',
                'errorAction' => $errorAction,
                'errorActionBackend' => $errorActionBackend,
            ],
/**/
            'log' => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => 'yii\log\FileTarget',
                        'logFile' => '@runtime/logs/' . date('ymd') . 'yii.log',
                      //'levels' => ['error', 'warning'],
                        'levels' => YII_DEBUG ? ['error', 'warning', 'trace', 'info'] : ['error', 'warning'],
                    ],
                ],
            ],
           'i18n' => [
               'translations' => [
                   'common' => [
                       'class' => 'asb\yii2\common_2_170212\i18n\UniPhpMessageSource',                    
                       'basePath' => '@asb/yii2/common_2_170212/messages',
                       'sourceLanguage' => 'en',
                       'on missingTranslation' => ['asb\yii2\common_2_170212\i18n\TranslationEventHandler', 'handleMissingTranslation'],
                   ],
               ],
           ],
        ],

        'bootstrap' => [
            'asb\yii2\common_2_170212\base\CommonBootstrap', // common for all system
            'project\modules\modmgr\Bootstrap', // module manager's bootstrap
          //'project\modules\sys\modules\modmgr\Bootstrap', //?? can't work as submodule
        ],
        'modules' => [
//*
            'modmgr' => [
                'class' => 'project\modules\modmgr\Module',
                'routesConfig' => [ // type => prefix|config
                    'admin' => ($type != UniApplication::APP_TYPE_FRONTEND && isset($params['adminPath']) && $params['adminPath'] !== false)
                               ? $params['adminPath'] . '/modmgr'
                               : false,
                ],
            ],
/**/
        ],

    ];

    if (!empty($layoutPath)) $configCms['layoutPath'] = $layoutPath;

    // additional modules
    $nextModuleId = 'sys'; // root system module - must
    $configCms['modules'][$nextModuleId] = [
        'class' => 'project\modules\sys\Module',
        'routesConfig' => [ // type => prefix|config
            'admin' => (isset($params['adminPath']) && $params['adminPath'] !== false) ? $params['adminPath'] : false,
            'main'  => (isset($params['adminPath']) && $params['adminPath'] !== '') ? false : '',
        ],
    ];
    $configCms['bootstrap'][] = $nextModuleId;

    $configResult = ArrayHelper::merge($configCms, $config);//var_dump($configResult);exit;
    return $configResult;
