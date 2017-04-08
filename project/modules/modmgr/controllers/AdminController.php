<?php

namespace project\modules\modmgr\controllers;

use asb\yii2\modules\modmgr_1_161205\controllers\AdminController as BaseAdminController;

use yii\filters\AccessControl;

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
        $behaviors = parent::behaviors();//var_dump($behaviors);
        $behaviors['access'] = [ // redefine, not add
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => [],
                    'allow' => true,
                    'roles' => ['roleRoot'], //!! developers only
                    //'roles' => ['roleRoot','roleAdmin'], // developers + admins
                ],
            ],
        ];//var_dump($behaviors);exit;
        return $behaviors;
    }
}
