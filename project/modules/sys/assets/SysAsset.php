<?php

namespace project\modules\sys\assets;

use yii\web\AssetBundle;
//use yii\web\View;

class SysAsset extends AssetBundle
{
    public $css = ['sys.css'];
    //public $js = [];
    //public $jsOptions = ['position' => View::POS_BEGIN];

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/sys';
    }

    public $depends = [
        'yii\bootstrap\BootstrapAsset', // need to move up 'bootstrap.css' in <head>s of render HTML-results
    ];
}
