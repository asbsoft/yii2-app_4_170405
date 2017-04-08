<?php

    //var_dump(Yii::$app->user->identity);
    $tc = $this->context->tcModule;//var_dump($tc);

?>
<div class="sys-admin-index">
    <h1><?= Yii::t($tc, 'Admin startpage') ?></h1>

<!-- -->    
    <p>
        Action: <?= $this->context->action->uniqueId ?>
    </p>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        Bootstrap-icons examples:
        <span class="glyphicon glyphicon-ok" style="color:green"></span>
        <span class="glyphicon glyphicon-trash"></span>
        <span class="glyphicon glyphicon-eye-open"></span>
    </p>
<!-- -->    

</div>
