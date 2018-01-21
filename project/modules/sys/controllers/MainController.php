<?php

namespace project\modules\sys\controllers;

use asb\yii2\common_2_170212\controllers\BaseController;
use asb\yii2\common_2_170212\i18n\LangHelper;

use Yii;
use yii\web\ErrorAction;
use yii\base\ViewNotFoundException;

/**
 * @author ASB <ab2014box@gmail.com>
 */
class MainController extends BaseController
{
    public static $defaultLangSwitchType = 'list';
    
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
                'view' => 'error',
            ],
        ];
    }

    /**
     * Render language switcher for current URL by changing language prefixes
     * @param string $type define original view name
     */
    public function actionLangSwitch($type = null)
    {
        if (empty($type)) $type = static::$defaultLangSwitchType;
        if (LangHelper::countActiveLanguages() <= 1) return ''; // no switch for one language

        $savedStrictParsing = Yii::$app->urlManager->enableStrictParsing;
        Yii::$app->urlManager->enableStrictParsing = false;
      //Yii::$app->urlManager->enableStrictParsing = true; // will skip URLs looks like routes such as /site/contact

        $result = Yii::$app->getUrlManager()->parseRequest(Yii::$app->request);
        if (is_array($result)) {
            list ($route, $routeParams) = $result;
        } else {
            $route = Yii::$app->defaultRoute;
            $routeParams = [];
            $msg = '?? lang switch for URL: ' . Yii::$app->request->getUrl();
            if (YII_DEBUG) Yii::info($msg);
        }
        Yii::$app->urlManager->enableStrictParsing = $savedStrictParsing;

        $currentLang = Yii::$app->language;
        $list = [];
        $routeParams[0] = $route;
        $languages = LangHelper::activeLanguages();
        foreach ($languages as $lang)
        {
            $routeParams['lang'] = $lang->code2;
            $link = Yii::$app->urlManager->createUrl($routeParams);
            $list[] = [
                'code2'        => $lang->code2,
                'country_code' => $lang->country_code,
                'name_orig'    => $lang->name_orig,
                'name_en'      => $lang->name_en,
                'link'         => $link,
                'current'      => ($currentLang == $lang->code2 || $currentLang == $lang->code_full) ? true : false,
            ];
        }

        $view = 'lang-switch-' . $type;
        try {
            return $this->renderPartial($view, ['list' => $list]);
        } catch (ViewNotFoundException $ex) {
            $msg = "Language switch view '{$view}' not found: " . $ex->getMessage();
            Yii::error($msg);

            $view = 'lang-switch-' . static::$defaultLangSwitchType; // default always exists
            return $this->renderPartial($view, ['list' => $list]);
        }
    }

    /**
     * Render original start page with original layout
     */
    public function actionStartPage()
    {
        $layout = $this->layout;
        $this->layout = '//' . Yii::$app->layout . '/startpage';
        $result = $this->render('start-page');
        $this->layout = $layout;
        return $result;
    }

}
