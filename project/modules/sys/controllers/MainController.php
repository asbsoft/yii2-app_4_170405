<?php

namespace project\modules\sys\controllers;

use asb\yii2\common_2_170212\controllers\BaseController;
use asb\yii2\common_2_170212\i18n\LangHelper;

use Yii;
use yii\web\ErrorAction;

/**
 * @author ASB <ab2014box@gmail.com>
 */
class MainController extends BaseController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
                'view' => 'error',
            ],
        ];
    }

    /** Render language switcher for current URL by changing language prefixes */
    public function actionLangSwitch()
    {
        if (LangHelper::countActiveLanguages() <= 1) return '';

        $savedStrictParsing = Yii::$app->urlManager->enableStrictParsing;
        Yii::$app->urlManager->enableStrictParsing = false;
      //Yii::$app->urlManager->enableStrictParsing = true; // will skip URLs looks like routes such as /site/contact

        $result = Yii::$app->getUrlManager()->parseRequest(Yii::$app->request);//echo __METHOD__;var_dump($result);
        if (is_array($result)) {
            list ($route, $routeParams) = $result;
        } else {
            $route = Yii::$app->defaultRoute;
            $routeParams = [];
            $msg = '?? lang switch for URL: ' . Yii::$app->request->getUrl();//echo __METHOD__;var_dump($msg);
            if (YII_DEBUG) Yii::info($msg);
        }//echo __METHOD__;var_dump($route);var_dump($routeParams);
        Yii::$app->urlManager->enableStrictParsing = $savedStrictParsing;

        $currentLang = Yii::$app->language;//var_dump($currentLang);
        $list = [];
        $routeParams[0] = $route;
        $languages = LangHelper::activeLanguages();//var_dump($languages);
        foreach ($languages as $lang)
        {
            $routeParams['lang'] = $lang->code2;//var_dump($routeParams);
            $link = Yii::$app->urlManager->createUrl($routeParams);//var_dump($link);
            $list[] = [
                'code2'        => $lang->code2,
                'country_code' => $lang->country_code,
                'name_orig'    => $lang->name_orig,
                'name_en'      => $lang->name_en,
                'link'         => $link,
                'current'      => ($currentLang == $lang->code2 || $currentLang == $lang->code_full) ? true : false,
            ];
        }

        return $this->renderPartial('lang-switch', ['list' => $list]);
    }

    /** Original start page */
    public function actionStartPage()
    {
        $layout = Yii::$app->layout;
        Yii::$app->layout = Yii::$app->layout . '-startpage';
        $result = $this->render('start-page');
        Yii::$app->layout = $layout;
        return $result;
    }

}
