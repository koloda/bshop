<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::t('bshop', 'Update {modelClass}: ', [
    'modelClass' => 'Category',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('bshop', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('bshop', 'Update');
?>
<div class="category-update">

    <div class="col-xs-12">
        <div class="panel" data-spy="affix" data-offset-top="0">
            <div class="panel-heading">
                <p><?= Html::encode($this->title) ?>
                <?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i> ' . Yii::t('bshop', 'Back to list'), ['/category'], ['class' => 'btn btn-default pull-right']) ?>
                </p>
            </div>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
