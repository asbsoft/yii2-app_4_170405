<?php

/** @var $list array languages list */

    use project\modules\sys\assets\SysAsset;
    use asb\yii2\common_2_170212\assets\FlagAsset;

    SysAsset::register($this);
    FlagAsset::register($this);

?>

<?php if (count($list) > 1): ?>
    <div class="lang-switch">
    <ul class="flag f16">
    <?php foreach ($list as $lang): ?>
        <li class="
          <?php if ($lang['current']): ?>
            current
          <?php endif; ?>
        ">
    <span class="flag <?= $lang['country_code'] ?>"></span>

            <a href="<?= $lang['link'] ?>"
               title="<?= $lang['name_en'] ?>"
            ><?= $lang['name_orig'] ?></a>
        </li>
    <?php endforeach; ?>
    </ul>
    </div>
<?php endif; ?>
