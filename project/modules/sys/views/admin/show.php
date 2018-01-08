<?php
/*  @var $this yii\web\View */
/*  @var $header string */
/*  @var $result string */

    use yii\helpers\Html;

    $tc = $this->context->tcModule;
    $this->title = Yii::t($tc, 'Adminer') . ' - ' . $header; 

?>

<h3><?= Html::encode($header) ?></h3>

<pre>
<?= $result ?>
</pre>
