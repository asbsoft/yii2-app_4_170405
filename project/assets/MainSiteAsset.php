<?php

namespace project\assets;

use yii\web\AssetBundle;
use yii\web\View;

class MainSiteAsset extends AssetBundle
{
    public $css = [
        'site.css',
    ];
    //public $js = [];
    //public $jsOptions = ['position' => View::POS_BEGIN];

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/main';
    }

    public $depends = [
        'asb\yii2\common_2_170212\assets\BootstrapCssAsset', //!! need to move up 'bootstrap.css' in <head>s of render HTML-results
        'yii\web\YiiAsset',
    ];
}
