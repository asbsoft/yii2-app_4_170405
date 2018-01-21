<?php

    /* @var $list array languages list */

    use project\modules\sys\assets\SysAsset;
    use asb\yii2\common_2_170212\assets\FlagAsset;

    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;


    SysAsset::register($this);
    FlagAsset::register($this);

    $title = 'select language';
    $tc = $this->context->tcModule;

    $name = 'lang-selector';

    $items = ArrayHelper::map($list, 'link', 'name_orig');
    $tagsOptions = [];
    foreach ($list as $langInfo) {
        $tagsOptions[$langInfo['link']] = [
            'class' => "flag {$langInfo['country_code']}",
            'style' => "display: block; padding-left: 36px", // redefine style "display: inline-block" from world-flags-sprite
            'title' => $langInfo['name_en'],
        ];
    }

    $langs = ArrayHelper::map($list, 'code2', 'link');
    $curLang = substr(Yii::$app->language, 0, 2);
    $selection = $langs[$curLang];

    $options = [
        'id' => $name,
        'class' => "lang-select form-control flag f32",
        'title' => Yii::t($tc, $title) . " ({$title})",
        'options' => $tagsOptions,
    ];

?>
<?php if (count($list) > 1): ?>
    <div class="lang-switch lang-switch-select">
        <?= Html::dropDownList($name, $selection, $items, $options) ?>
    </div>

    <?php
        $this->registerJs("
            jQuery('#lang-selector').bind('change', function() {
                var link = jQuery(this).val();
                window.location.href = link;
            });
        ");
    ?>

<?php endif; ?>
