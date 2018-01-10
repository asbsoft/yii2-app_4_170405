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
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
    ];
}
