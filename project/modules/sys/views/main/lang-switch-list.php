<?php

    // This is default template. Will render if another not found.

    /* @var $list array languages list */

    use project\modules\sys\assets\SysAsset;
    use asb\yii2\common_2_170212\assets\FlagAsset;

    use yii\helpers\Html;


    SysAsset::register($this);
    FlagAsset::register($this);

    $linkOptions = [
        'class' => 'lang-sw-link',
    ];

?>
<?php if (count($list) > 1): ?>
    <div class="lang-switch lang-switch-list">
        <ul class="flag f16">
        <?php foreach ($list as $lang): ?>
            <li class="
              <?php if ($lang['current']): ?>
                current
              <?php endif; ?>
            ">
                <span class="flag <?= $lang['country_code'] ?>"></span>

                <?php
                    $linkOptions['title'] = $lang['name_en'];
                ?>
                <?= Html::a($lang['name_orig'], $lang['link'], $linkOptions) ?>
                
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
