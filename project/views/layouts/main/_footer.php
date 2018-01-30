<?php

    use asb\yii2\modules\content_2_170309\models\ContentMenuBuilder;

    use yii\bootstrap\Nav;
    use yii\helpers\Html;


    $menuItems = ContentMenuBuilder::submenuItems('/menus/bottom-menu');

?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?>, <?= Html::encode($brandLabel) ?>
            <?php
                echo Nav::widget([
                    'id' => 'bottom-menu',
                    'options' => ['class' => 'navbar-nav'],
                    'items' => $menuItems,
                ]);
            ?>
        </p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
