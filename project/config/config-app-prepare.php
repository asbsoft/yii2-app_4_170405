<?php
    /**
     * Some system tunes here depends on Yii2-application template (basic/advanced)
     */

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\common_2_170212\controllers\BaseController;
    use asb\yii2\common_2_170212\controllers\BaseAdminController;
    use asb\yii2\common_2_170212\i18n\LangHelper;

    $moduleSysUid   = 'sys';
    $moduleUsersUid = 'sys/users';

    $routeLoginFrontend = ["/{$moduleUsersUid}/main/login"];
    BaseController::setUrlLogin($routeLoginFrontend);
    $routeLoginBackend = ["/{$moduleUsersUid}/admin/login"];
    BaseAdminController::setUrlLogin($routeLoginBackend);

    $errorActionFrontend = BaseController::$errorActionUniqueId      = "{$moduleSysUid}/main/error";
    $errorActionBackend  = BaseAdminController::$errorActionUniqueId = "{$moduleSysUid}/admin/error";

    $type = empty($config['type']) ? false : $config['type'];
    $params = empty($config['params']) ? [] : $config['params'];
   
    $paramsCms = require_once __DIR__ . '/params-app.php'; // some defaults params

    if (!isset($params['adminPath']) || $params['adminPath'] === false) {
        $urlPrefixAdmin = null;
    } else if ($params['adminPath'] === '') {
        $urlPrefixAdmin = '';
    } else {
        $urlPrefixAdmin = $params['adminPath'] . '/';
    }

    //$loginUrl = 'site/login'; // default in Yii kernel
    if ($type == UniApplication::APP_TYPE_FRONTEND) {
        $loginUrl = $routeLoginFrontend;
        $errorAction = $errorActionFrontend;
        //BaseController::$layoutPath = '@asb/yii2/cms_3_170211/views/layouts';//??
    } elseif ($type == UniApplication::APP_TYPE_BACKEND) {
        $loginUrl = $routeLoginBackend;
        $errorAction = $errorActionBackend;
        $layoutPath = '@project/views/layouts/_backend';
    } elseif ($type == UniApplication::APP_TYPE_UNITED) {
        $loginUrl = null; // not set or dynamic
        $errorAction = $errorActionFrontend;
        //BaseController::$layoutPath = '@asb/yii2/cms_3_170211/views/layouts';//??
        BaseAdminController::$layoutPathBackend = '@project/views/layouts/_backend';
    } else { // console app
        $loginUrl = null; // not set or dynamic
        $errorAction = $errorActionFrontend;
    }

