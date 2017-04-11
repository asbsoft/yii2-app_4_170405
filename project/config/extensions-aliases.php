<?php
    Yii::setAlias('@project', dirname(dirname(__DIR__)) . '/project');
    
    // use for autoload (instead of composer's attempts)
    Yii::setAlias('@asb/yii2/common_2_170212', '@vendor/asbsoft/yii2-common_2_170212');
    Yii::setAlias('@asb/yii2/modules',         '@vendor/asbsoft/yii2module');

    Yii::setAlias('@yii/jui', '@vendor/yiisoft/yii2-jui');

    Yii::setAlias('@kartik/base',  '@vendor/kartik-v/yii2-krajee-base');
    Yii::setAlias('@kartik/date',  '@vendor/kartik-v/yii2-widget-datepicker');
    Yii::setAlias('@kartik/field', '@vendor/kartik-v/yii2-field-range');

    Yii::setAlias('@lafeber/world-flags-sprite', '@vendor/lafeber/world-flags-sprite');

    Yii::setAlias('@mihaildev/ckeditor', '@vendor/mihaildev/yii2-ckeditor');
    Yii::setAlias('@mihaildev/elfinder', '@vendor/mihaildev/yii2-elfinder');

    //echo __METHOD__;var_dump(Yii::$aliases);exit;
