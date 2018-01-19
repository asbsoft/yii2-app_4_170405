<?php
    /* @var $this yii\web\View */
    /* @var $moduleUid string */

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\common_2_170212\base\ModulesManager;
    use asb\yii2\common_2_170212\web\RoutesInfo;
    use asb\yii2\common_2_170212\helpers\ConfigsBuilder;

    use yii\helpers\Html;


    $tc = $this->context->tcModule;

    $title = Yii::t($tc, 'System routes');
    $this->title = Yii::t($tc, 'Adminer') . ' - ' . $title; 

    $modulesList = ModulesManager::modulesNamesList();

    $result = RoutesInfo::showRoutes($moduleUid);

    if (Yii::$app->appTemplate == UniApplication::APP_TEMPLATE_BASIC) {
        $resultTitle = Yii::t($tc, 'frontend and backend routes');
    } elseif (Yii::$app->appTemplate == UniApplication::APP_TEMPLATE_ADVANCED) { 
        $resultTitle = Yii::t($tc, 'backend routes');
        $resultFrontTitle = Yii::t($tc, 'frontend routes');

        $savedApp = Yii::$app;
        Yii::$app->cache->flush();
        Yii::$app = null;
        $appFront = require(__DIR__ . '/../../app/frontend.php'); // load frontend application
        $appFront->trigger($appFront::EVENT_BEFORE_REQUEST); // add dynamic submodules by module manager
        $resultFront = RoutesInfo::showRoutes($moduleUid, $appFront);
        Yii::$app = $savedApp;
    }

    if (empty($result) && empty($resultFront)) {
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

<?php if (!empty($resultFront)): ?>
    <h4><?= Html::encode($resultFrontTitle) ?></h4>
    <pre><?= $resultFront ?></pre>
<?php endif; ?>

<h4><?= Html::encode($resultTitle) ?></h4>
<pre><?= $result ?></pre>
