<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->title = Yii::t('bshop', 'Update {modelClass}: ', [
    'modelClass' => 'Brand',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('bshop', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('bshop', 'Update');
?>
<div class="brand-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
