<?php

use asb\yii2\common_2_170212\base\ModulesManager;
use asb\yii2\common_2_170212\web\RoutesInfo;

use yii\helpers\Html;

/**
    @var $this yii\web\View
    @var $moduleUid string
*/

    //var_dump(ModulesManager::appModulesList());
    
    $tc = $this->context->tcModule;//var_dump($tc);exit;

    $modulesList = ModulesManager::modulesNamesList();//var_dump($modulesList);
//$modulesList = [];//todo
    $result = RoutesInfo::showRoutes($moduleUid);//var_dump($result);

    if (empty($result)) $result = Yii::t($tc, '(no routes for module)');


?>
<h3>
    <?= Yii::t($tc, 'System routes') ?>
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
