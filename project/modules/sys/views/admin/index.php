<?php

    use yii\helpers\Html;


    $tc = $this->context->tcModule;

    $title = Yii::t($tc, 'Admin startpage');
    $this->title = Yii::t($tc, 'Adminer') . ' - ' . $title;

?>
<div class="sys-admin-index">
    <h1><?= Html::encode($title) ?></h1>

    <p>
        <?= Yii::t($tc, "Current layout template is '{layout}'", ['layout' => Yii::$app->layout]) ?>
    </p>

    <p>
        ToDo: Something useful here: statistic, etc...
    </p>

</div>
