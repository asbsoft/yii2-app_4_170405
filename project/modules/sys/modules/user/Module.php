<?php

namespace project\modules\sys\modules\user;

use asb\yii2\modules\users_0_170112\Module as ParentModule;

use Yii;
use yii\helpers\ArrayHelper;

class Module extends ParentModule
{
    public function bootstrap($app)
    {//echo __METHOD__.'<br>';exit;

        Yii::$app->request->parsers = ArrayHelper::merge(
            Yii::$app->request->parsers,
            ['application/json' => 'yii\web\JsonParser']
        );//var_dump(Yii::$app->request->parsers);

        parent::bootstrap($app);//var_dump(array_keys(Yii::$app->i18n->translations));exit;
    }

}
