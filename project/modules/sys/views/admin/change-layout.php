<?php
    /* @var $this yii\web\View */
    /* @var $model project\modules\sys\models\LayoutModel */
    /* @var $form yii\widgets\ActiveForm */

    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm; // use yii\widgets\ActiveForm;


    $tc = $this->context->tcModule;

    $title = Yii::t($tc, 'Change layout');
    $this->title = Yii::t($tc, 'Adminer') . ' - ' . $title;

    $langLists = [Yii::$app->language, substr(Yii::$app->language, 0, 2), 'en', 'en-US', 'en-GB'];
    $rawList = $model::layoutsList();
    $layoutsList = [];
    foreach ($rawList as $alias => $name) {
        if (is_string($name)) {
            $layoutsList[$alias] = $name;
        } elseif (is_array($name)) { // multilingual name
            foreach ($langLists as $lang) {
                if (!empty($name[$lang])) {
                    $layoutsList[$alias] = $name[$lang];
                    break;
                }
            }

        }
    }

?>
<div class="change-layout-form">

    <h1><?= Html::encode($title) ?></h1>

    <p>
        <?= Yii::t($tc, "Show layouts from '{layoutPath}'", ['layoutPath' => $model::$layoutPath]) ?>
    </p>
    
    <?php $form = ActiveForm::begin([
              'id' => 'form-admin',
              'enableClientValidation' => false, // disable JS-validation
          ]); ?>

        <div class="form-group">
            <?= $form->field($model, 'alias')->radioList($layoutsList, [
                    'id' => 'layouts-list',
                    'class' => 'layouts-group',
                ])->label(false)
            ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t($tc, 'Change'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
