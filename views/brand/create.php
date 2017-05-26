<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->title = Yii::t('bshop', 'Create Brand');
?>

<div class="brand-create">

    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <p><?= Html::encode($this->title) ?>
                <?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i> ' . Yii::t('bshop', 'Back to list'), ['/brand'], ['class' => 'btn btn-default pull-right']) ?>
                </p>
            </div>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
