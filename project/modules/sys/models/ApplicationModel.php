<?php

namespace project\modules\sys\models;

use Yii;

/**
 * Use for create frontend application inside backend application.
 * Useful for frontend routes manipulations.
 */
class ApplicationModel
{
    public static $savedApp = null;

    public static function initFrontendApplication()
    {
        Yii::$app->cache->flush();
        static::$savedApp = Yii::$app;
        Yii::$app = null;
        $appFront = require(__DIR__ . '/../app/frontend.php'); // load frontend application
        $appFront->trigger($appFront::EVENT_BEFORE_REQUEST); // add dynamic submodules by module manager
        return $appFront;
    }

    public static function restoreApplication()
    {
        Yii::$app = static::$savedApp;
    }

}
