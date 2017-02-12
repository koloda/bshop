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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'         => $model,
        'valueModels'   => $valueModels
    ]) ?>

</div>
