<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('bshop', 'Create Product');
?>

<div class="product-create">

    <div class="col-xs-12">
        <div class="panel" data-spy="affix" data-offset-top="0">
            <div class="panel-heading">
                <p><?= Html::encode($this->title) ?>

                <?= Html::submitButton('<i class="fa fa-floppy-o"></i> ' . Yii::t('bshop', 'Create'), ['class' => 'btn btn-success pull-right m_l-1em', 'form' => 'product-form']) ?>

                <?= Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('bshop', 'Back to list'), ['/product'], ['class' => 'btn btn-default pull-right']) ?>
                </p>
            </div>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
