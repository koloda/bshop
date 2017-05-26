<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bshop', 'Products');
?>

<div class="product-index col-xs-12">
    <div class="panel">
        <div class="panel-heading">
            <p><?= Html::encode($this->title) ?>
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('bshop', 'Create Product'), ['/product/create'], ['class' => 'btn btn-success pull-right']) ?>
            </p>
        </div>
    </div>

    <div class="panel">
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'bordered'  => false,
                'layout' => '{items}{summary}{pager}',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,

                'columns' => [
                    [
                        'attribute' => 'title',
                        'content' => function ($model) {
                            $text = $model->title . ' <i class="glyphicon glyphicon-pencil"></i>';
                            return Html::a($text, ['/product/update', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'categoryTitle',
                        'label'    => Yii::t('bshop', 'Category'),
                    ],
                    [
                        'attribute' => 'brandTitle',
                        'label'    => Yii::t('bshop', 'Brand'),
                    ],
                    [
                        'options'   => ['class' => 'col-sm-1'],
                        'class' => \dosamigos\grid\EditableColumn::className(),
                        'attribute' => 'price',
                        'url' => ['editable'],
                        'type' => 'number',
                        'editableOptions' => [
                            'mode' => 'inline',
                        ]
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template' => '{delete}'
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
