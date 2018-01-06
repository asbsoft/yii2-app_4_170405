<?php
    // Original start page
    // Use together with layout Yii::$app->layout . '-startpage'

    use yii\helpers\Html;

    
    $tc = $this->context->tcModule;

    $this->title = Yii::t($tc, 'Original start page');

?>

<h1><?= Html::encode($this->title) ?></h1>

<!-- toDo -->
