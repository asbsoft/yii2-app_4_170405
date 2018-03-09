<?php

namespace project\modules\sys\models;

use Yii;

/**
 * Create frontend application but not run.
 * Useful for frontend routes manipulations inside backend application.
 *
 * For correct work need application parameter:
 * ```php
 *     'frontendBaseUrl' => 'http://www.mysite.com',
 * ```
 * from /common/config/params-local.php (/environments/ENVNAME/common/config/params-local.php)
 *
 * @author ASB <ab2014box@gmail.com>
 */
class ApplicationModel
{
    /**
     * Save current application Yii::$app and init new frontend application, not run.
     * @return Application
     */
    public static function initFrontendApplication()
    {
        Yii::$app->cache->flush();
        static::saveStatic();

        Yii::$app = null;
        $appFront = require(__DIR__ . '/../app/frontend.php'); // load frontend application
        $appFront->trigger($appFront::EVENT_BEFORE_REQUEST); // add dynamic submodules by module manager

        // $appFront->request->baseUrl is not set here
        if (!empty($appFront->params['frontendBaseUrl'])) {
            $appFront->urlManager->baseUrl = $appFront->params['frontendBaseUrl'];  // set frontend base URL from app-params
        }

        return $appFront;
    }

    /**
     * Restore saved application Yii::$app.
     */
    public static function restoreApplication()
    {
        Yii::$app->cache->flush();
        static::restoreStatic();
    }

    /** List of static variables (include current application) to save */
    protected static $listStatic = [
        ['Yii', 'app'], // current application
        ['Yii', 'aliases'],
        ['Yii', 'container'],
    ];

    protected static $savedStatic = null;

    protected static function saveStatic()
    {
        static::$savedStatic = [];

        foreach (static::$listStatic as $next) {
            list($className, $varName) = $next;
            static::$savedStatic["{$className}::{$varName}"] = $className::${$varName};
        }
    }

    protected static function restoreStatic()
    {
        foreach (static::$listStatic as $next) {
            list($className, $varName) = $next;
            $className::${$varName} = static::$savedStatic["{$className}::{$varName}"];
        }

        static::$savedStatic = null;
    }

}
