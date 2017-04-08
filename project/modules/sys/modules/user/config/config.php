<?php //echo __FILE__;
//var_dump(Yii::$app->layoutPath);

    $config = [
        //'layoutPath' => '@project/modules/sys/views/layouts',
        'models' => [ // alias => class name or object array
            'UserIdentity' => 'project\modules\sys\modules\user\models\UserIdentity',
        ],
    ];

    return $config;
