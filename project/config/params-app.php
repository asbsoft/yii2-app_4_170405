<?php
/**
 * This is specific CMS parameters.
 * @var string $type application type
 */

use asb\yii2\common_2_170212\i18n\LangHelper;
use asb\yii2\common_2_170212\web\UserIdentity;
use asb\yii2\common_2_170212\behaviors\ParamsAccessBehaviour;

$version = '4:170405';

//$tc = 'app/sys/module';

return [
    'id-cms' => "yii2cms@asb.v{$version}",
    'owner' => 'ASB',
    'product' => 'YII2 Application',
    'version' => $version,
  //'titleAdmin' => Yii::t($tc, 'Adminer'),

     /** Subdir from web root to web-files (uploads mirror) */
  //'webfilesSubdir' => 'uploads', // deprecated
    'webfilesSubdir' => 'files', // default in base\CommonBootstrap

    /** Place in file system for uploads files (alias or abs path to root). Not in web root recommended!! */
    '@uploadspath' => dirname(dirname(__DIR__)) . '/uploads', // safe place
  //'@uploadspath' => '@webroot/files', // uploads at webroot - not safe!!

    /** If not define or false all uploads images will preprocessing before copy to web root */
  //'uploadsDirectCopy' => true, // uncomment if you trust to upload tiles

    /** Path to admin interface from baseUrl */
  //'adminPath'  => 'adm', // need only for BASIC Yii template - put it in local config

/* !! DEPRECATED (these parameters move to component Yii:$app->lang):
    LangHelper::className() => [
        'langsConfigFname' => __DIR__ . '/languages.php', // languages definition
        'cookieDefaultLanguage' => 'def-lang', // cookie name for save language, false to disable saving
        'appTypePrefix' => $type,
        'langCookieExpiredSec'  => 2678400, // 31days,  1day = 86400sec
      //'langCookieExpiredSec'  => 1, // 1sec - don't save lang in cookie
    ],
*/
    UserIdentity::className() => [
        'userModuleUniqueId' => 'sys/users',    // module uniqueId contains user identity
        'userManagerAlias'   => 'UserIdentity', // user identity model alias, see UniModule::model($alias)
    ],

    'behaviors' => [
        'params-access' => [
            'class' => ParamsAccessBehaviour::className(),
            'defaultRole' => 'roleAdmin',
            'readonlyParams' => [
                'adminPath',
                'webfilesSubdir',
                '@uploadspath',
                'uploadsDirectCopy',
            ],
        ],
    ],

];
