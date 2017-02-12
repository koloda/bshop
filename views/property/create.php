<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Property */

$this->title = Yii::t('bshop', 'Create Property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('bshop', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'         => $model,
        'valueModels'   => $valueModels
    ]) ?>

</div>
