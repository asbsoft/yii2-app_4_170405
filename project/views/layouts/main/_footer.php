<?php

    use yii\helpers\Html;

?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?>, <?= Html::encode($brandLabel) ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
