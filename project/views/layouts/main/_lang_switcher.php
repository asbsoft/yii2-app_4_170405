<?php
    $langSwitchType = isset($langSwitchType) ? $langSwitchType : ''; // default value if not set
?>
    <div class="navbar-right site-lang-switch">
        <?= Yii::$app->runAction('/sys/main/lang-switch', [
                'type' => $langSwitchType,
            ]) ?>
    </div>
