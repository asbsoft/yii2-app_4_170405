<?php

namespace project\modules\sys\models;

use Yii;

/**
 * Create frontend application but not run.
 * Useful for frontend routes manipulations inside backend application.
 */
class ApplicationModel
{
    protected static $savedApp = null;

    public static function initFrontendApplication()
    {
        Yii::$app->cache->flush();
        static::$savedApp = Yii::$app;
        static::saveStatic();

        Yii::$app = null;
        $appFront = require(__DIR__ . '/../app/frontend.php'); // load frontend application
        $appFront->trigger($appFront::EVENT_BEFORE_REQUEST); // add dynamic submodules by module manager

        // $appFront->request->baseUrl is not set here
        if (!empty($appFront->params['frontedBaseUrl'])) {
            $appFront->urlManager->baseUrl = $appFront->params['frontedBaseUrl'];  // set frontend base URL from app-params
        }

        return $appFront;
    }

    public static function restoreApplication()
    {
        if (static::$savedApp !== null) {
            Yii::$app = static::$savedApp;
            static::$savedApp = null;

            static::restoreStatic();
            static::$savedStatic = null;
        }
    }

    //protected static $listStatic = [
    //    'Yii::$aliases',
    //];
    protected static $savedStatic = null;

    protected static function saveStatic()
    {
        static::$savedStatic = [];

        static::$savedStatic['Yii::$aliases'] = Yii::$aliases;
        static::$savedStatic['Yii::$container'] = Yii::$container;
        //...

        //foreach (static::$listStatic as $name) {
        //    static::$savedStatic[$name] = ${$name};//??
        //}
    }

    protected static function restoreStatic()
    {
        //foreach (static::$listStatic as $name) {
        //    ${$name} = static::$savedStatic[$name];//??
        //}

        Yii::$container = static::$savedStatic['Yii::$container'];
        Yii::$aliases = static::$savedStatic['Yii::$aliases'];
        //...

        static::$savedStatic = null;
    }

}
