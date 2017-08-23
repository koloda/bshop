<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Property */

$this->title = Yii::t('bshop', 'Update {modelClass}: ', [
    'modelClass' => 'Property',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('bshop', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('bshop', 'Update');
?>
<div class="property-update">

    <div class="col-xs-12">
    <div class="panel" data-spy="affix" data-offset-top="0">
        <div class="panel-heading">
            <p>
                <?= Html::encode($this->title) ?>
                <?= Html::submitButton('<i class="fa fa-floppy-o"></i> ' . Yii::t('bshop', 'Update'), [
                    'class' => 'btn btn-info pull-right m_l-1em',
                    'form'  => 'property-form'
                    ]) ?>
                <?= Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('bshop', 'Back to list'), ['/property'], ['class' => 'btn btn-default pull-right']) ?>
            </p>
        </div>
    </div>
    </div>

    <?= $this->render('_form', [
        'model'         => $model,
        'valueModels'   => $valueModels
    ]) ?>

</div>
