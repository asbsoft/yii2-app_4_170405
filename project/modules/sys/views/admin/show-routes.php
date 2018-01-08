<?php
    /* @var $this yii\web\View */
    /* @var $moduleUid string */

    use asb\yii2\common_2_170212\base\ModulesManager;
    use asb\yii2\common_2_170212\web\RoutesInfo;

    use yii\helpers\Html;


    $tc = $this->context->tcModule;

    $title = Yii::t($tc, 'System routes');
    $this->title = Yii::t($tc, 'Adminer') . ' - ' . $title; 

    $modulesList = ModulesManager::modulesNamesList();//var_dump($modulesList);

    $result = RoutesInfo::showRoutes($moduleUid);//var_dump($result);

    if (empty($result)) {
        $result = Yii::t($tc, '(no routes for module)');
    }

?>
<h3>
    <?= Html::encode($title) ?>
    <?php if (!empty($moduleUid)): ?>
        <?= Yii::t($tc, 'for module') ?> <?= $moduleUid ?>
    <?php endif; ?>
</h3>

<div>
    <?= Html::beginForm([''], 'get') ?>

    <?= Html::dropDownList('moduleUid', $moduleUid, $modulesList, [
            'id' => 'module-uid',
            'prompt' => '- ' . Yii::t($tc, 'application') . ' -',
            'class' => 'form-control select-module-uid',
            'onchange' => "this.form.submit()",
         ]) ?>
    <?= Html::endForm() ?>
</div>

<br />

<pre>
<?= $result ?>
</pre>
