<?php

namespace project\modules\sys\modules\user;

//use asb\yii2\modules\users_0_170112\Module as ParentModule;
use asb\yii2\modules\users_1_180221\Module as ParentModule;

use Yii;
use yii\helpers\ArrayHelper;

class Module extends ParentModule
{
    public function bootstrap($app)
    {
        Yii::$app->request->parsers = ArrayHelper::merge(
            Yii::$app->request->parsers,
            ['application/json' => 'yii\web\JsonParser']
        );

        parent::bootstrap($app);
    }

}
