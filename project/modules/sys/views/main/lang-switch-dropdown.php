<?php

    /* @var $list array languages list */

    use project\modules\sys\assets\SysAsset;
    use asb\yii2\common_2_170212\assets\FlagAsset;
    use asb\yii2\common_2_170212\i18n\LangHelper;

    use yii\bootstrap\Nav;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;


    SysAsset::register($this);
    FlagAsset::register($this);

    if (empty($name)) $name = 'lang-selector';

    $title = 'select language';
    $tc = $this->context->tcModule;

    $curLangCode2 = substr(Yii::$app->language, 0, 2);
    $curLangData = LangHelper::findLanguageByCode2('en');  // default if not found
    $langItems = [];
    foreach ($list as $langData) {
        if ($curLangCode2 == $langData['code2']) {
            $curLangData = $langData;
        }
        $langItems[] = [
            'label' => $langData['name_orig'],
            'url'   => $langData['link'],
            'linkOptions' => [
                'class' => "flag {$langData['country_code']} text-nowrap lang-sw-link",
                'title' => $langData['name_en'],
            ],
        ];
    }
    $langItems = [[  // current language - as root menu item
        'label' => $curLangData['name_orig'],
        'linkOptions' => [
            'class' => "flag {$curLangData['country_code']} text-nowrap lang-sw-link",
            'title' => Yii::t($tc, $title),
        ],
        'items' => $langItems,
    ]];

?>
<?php if (count($list) > 1): ?>
    <div class="lang-switch lang-switch-dropdown">
        <?php
            echo Nav::widget([
                'options' => [
                    'id' => $name,
                    'class' => 'lang-switch-dropdown navbar-nav 	f32'
                ],
                'items' => $langItems,
            ]);
        ?>
    </div>
<?php endif; ?>
