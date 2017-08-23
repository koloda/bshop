<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Property */

$this->title = Yii::t('bshop', 'Create Property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('bshop', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-create">

    <div class="col-xs-12">
    <div class="panel" data-spy="affix" data-offset-top="0">
        <div class="panel-heading">
            <p>
                <?= Html::encode($this->title) ?>
                <?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i> ' . Yii::t('bshop', 'Back to list'), ['/property'], ['class' => 'btn btn-default pull-right']) ?>
            </p>
        </div>
    </div>
    </div>

    <?= $this->render('_form', [
        'model'         => $model,
        'valueModels'   => $valueModels
    ]) ?>

</div>
