<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

use app\services\ProductService as PS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bshop', 'Products');
?>

<div class="product-index col-xs-12">
    <div class="panel" data-spy="affix" data-offset-top="0">
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
                        'content'   => function ($model) {
                            $img = Html::img($model->getImgSrc('picture', 60));
                            $a = Html::a($img, ['/product/update', 'id' => $model->id]);
                            return "<div class=\"text-center\">{$a}</img>";
                        },
                    ],
                    [
                        'attribute' => 'title',
                        'content' => function ($model) {
                            $text = $model->title . ' <i class="glyphicon glyphicon-pencil"></i>';
                            $a = Html::a($text, ['/product/update', 'id' => $model->id], ['class' => 'text-underlined']);
                            $sku = Yii::t('bshop', 'Sku') .': ';
                            $sku .= strlen($model->sku) ? $model->sku : '---';
                            $slug = Yii::t('bshop', 'Slug') .': ';
                            $slug .= strlen($model->slug) ? '/'. $model->slug : '---';
                            $skuClass = strlen($model->sku) ? '' : 'text-ligth text-italic';
                            $slugClass = strlen($model->slug) ? '' : 'text-ligth text-italic';
                            return "{$a}<br/><small class=\"{$skuClass}\">{$sku}</small>"
                                ."<br/><small class=\"{$slugClass}\">{$slug}</small>";
                        },
                        'filterInputOptions'    => [
                            'type'  => 'search',
                            'class' => 'form-control'
                        ]
                    ],
                    [
                        'attribute' => 'categoryTitle',
                        'value'   => function ($model) {
                            return PS::getCategoryTitle($model);
                        },
                        'label'     => Yii::t('bshop', 'Category'),
                        'filterInputOptions'    => [
                            'type'  => 'search',
                            'class' => 'form-control'
                        ]
                    ],
                    [
                        'attribute' => 'brandTitle',
                        'value'   => function ($model) {
                            return PS::getBrandTitle($model);
                        },
                        'label'    => Yii::t('bshop', 'Brand'),
                        'filterInputOptions'    => [
                            'type'  => 'search',
                            'class' => 'form-control'
                        ]
                    ],
                    [
                        'options'   => ['class' => 'col-sm-1'],
                        'class' => \dosamigos\grid\EditableColumn::className(),
                        'attribute' => 'price',
                        'url' => ['editable'],
                        'type' => 'number',
                        'editableOptions' => [
                            // 'mode' => 'inline',
                        ],
                        'filterInputOptions'    => [
                            'type'  => 'search',
                            'class' => 'form-control'
                        ]
                    ],
                    [
                        'attribute' => 'active',
                        'class' => '\dixonstarter\togglecolumn\ToggleColumn',
                        'options' => ['class' => 'col-sm-1'],
                        'linkTemplateOff' => '<a class="toggle-column btn btn-warning btn-xs btn-block" data-pjax="0" href="{url}"><i  class="glyphicon glyphicon-remove"></i> {label}</a>'
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
