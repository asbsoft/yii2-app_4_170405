<?php

namespace project\modules\sys\controllers;

use project\modules\sys\models\ApplicationModel;

use asb\yii2\common_2_170212\base\UniModule;
use asb\yii2\common_2_170212\base\ModulesManager;
use asb\yii2\common_2_170212\controllers\BaseAdminController;

use Yii;
use yii\web\ErrorAction;

/**
 * @author ASB <ab2014box@gmail.com>
 */
class AdminController extends BaseAdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors(); // only admins permissions
        $behaviors['access']['rules'][] = [
            'actions' => ['error'], // error (usually Forbidden #403) can see every logined user
            'allow' => true,
            'roles' => ['@'], // logined
        ];//var_dump($behaviors['access']['rules']);exit;
        return $behaviors;
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
                'view' => 'error',
            ],
        ];
    }

    /** Backend startpage */
    public function goHome()
    {
        $url = Yii::$app->getHomeUrl() . Yii::$app->params['adminPath'];//echo __METHOD__;var_dump($url);exit;
        return Yii::$app->getResponse()->redirect($url);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShowRoutes($moduleUid = '')
    {
        return $this->render('show-routes', [
            'moduleUid' => $moduleUid,
        ]);
    }

    public function actionCleanCache()
    {
        Yii::$app->cache->flush(); // advanced-backend or basic

        $appFront = ApplicationModel::initFrontendApplication();
        $appFront->cache->flush(); // advanced-frontend
        ApplicationModel::restoreApplication();
        
        Yii::$app->session->setFlash('success', Yii::t($this->tcModule, 'All site cache has been flushed'));
        return $this->redirect(['index']);
    }

    public function actionShowTranslations()
    {
        ModulesManager::initSubmodules(Yii::$app);
        //$result = var_export(Yii::$app->i18n->translations, true);
//*
        // better show:
        ob_start();
        ob_implicit_flush(false);
        var_dump(Yii::$app->i18n->translations);
        $result = ob_get_clean();
/**/
        return $this->render('show', [
            'header' => Yii::t($this->tcModule, 'System translations'),
            'result' => $result,
        ]);
    }

    public function actionShowAliases()
    {
        $result = var_export(Yii::$aliases, true);
/*
        // better show:
        ob_start();
        ob_implicit_flush(false);
        var_dump(Yii::$aliases);
        $result = ob_get_clean();
/**/
        return $this->render('show', [
            'header' => Yii::t($this->tcModule, 'System aliases'),
            'result' => $result,
        ]);
    }

    public function actionChangeLayout()
    {
        $oldLayout = Yii::$app->layout;
        $model = $this->module->model('LayoutModel');
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save()) {
            if ($oldLayout != $model->alias) {
                Yii::$app->session->setFlash('success', Yii::t($this->tcModule
                  , "Layout has been changed form '{old}' to '{new}'"
                  , ['old' => $oldLayout, 'new' => $model->alias]));
            }
            return $this->redirect(['index']);
        } else {
            if (empty($model->alias)) {
                $model->alias = $oldLayout;
            }
            return $this->render('change-layout', [
                'model' => $model,
            ]);
        }
    }

}
