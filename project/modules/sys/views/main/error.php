<?php

    /* @var $this yii\web\View */
    /* @var $name string */
    /* @var $message string */
    /* @var $exception Exception */

    use project\modules\sys\assets\SysAsset;

    use yii\helpers\Html;


    $tc = $this->context->tcModule;

    $title = Yii::t($tc, 'Something wrong');

    $this->title = $name;
    //$this->title = $this->context->action->defaultMessage . '-' . $name;

    $assets = SysAsset::register($this);

?>
<div class="site-error">

    <h1><?= Html::encode($title) ?></h1>
    
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
