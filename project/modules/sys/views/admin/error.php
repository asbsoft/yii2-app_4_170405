<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

$tc = $this->context->tc;//var_dump($tc);

?>
<div class="admin-error">

    <h1><?= Yii::t($tc, 'Admin page')  ?> <?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
