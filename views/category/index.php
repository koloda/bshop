<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\services\CategoryService as CS;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bshop', 'Categories');
?>
<div class="category-index col-xs-12">
    <div class="panel" data-spy="affix" data-offset-top="0">
        <div class="panel-heading">
            <p><?= Html::encode($this->title) ?>
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('bshop', 'Create Category'), ['/category/create'], ['class' => 'btn btn-success pull-right']) ?>
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
                        $text = $model->title . ' <i class="fa fa-pencil"></i>';
                        return Html::a($text, ['/category/update', 'id' => $model->id], ['class' => 'text-underlined']);
                    },
                    'filterInputOptions'    => [
                        'type'  => 'search',
                        'class' => 'form-control'
                    ]
                ],
                [
                    'attribute' => 'parentTitle',
                    'value' => function ($model) { return $model->getParentTitle(); },
                    'label' => Yii::t('bshop', 'Parent category'),
                    'filterInputOptions'    => [
                        'type'  => 'search',
                        'class' => 'form-control'
                    ]
                ],
                [
                    'attribute' => 'slug',
                    'value' => function ($model) {
                        return strlen($model->slug)? '/'.$model->slug : '';
                    },
                    'filterInputOptions'    => [
                        'type'  => 'search',
                        'class' => 'form-control'
                    ]
                ],
                [
                    'attribute' => 'active',
                    'class' => '\dixonstarter\togglecolumn\ToggleColumn',
                    'options' => ['class' => 'col-sm-1'],
                    'linkTemplateOff' => '<a class="toggle-column btn btn-warning btn-xs btn-block" data-pjax="1" href="{url}"><i  class="fa fa-remove"></i> {label}</a>',
                    'linkTemplateOn' => '<a class="toggle-column btn btn-primary btn-xs btn-block" data-pjax="1" href="{url}"><i  class="fa fa-check"></i> {label}</a>'
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