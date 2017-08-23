<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bshop', 'Properties');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index col-xs-12">
    <div class="panel" data-spy="affix" data-offset-top="0">
        <div class="panel-heading">
            <p><?= Html::encode($this->title) ?>
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('bshop', 'Create Property'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
            </p>
        </div>
    </div>

    <div class="panel">
        <div class="panel-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'bordered'  => false,
        'layout' => '{items}{summary}{pager}',
        'columns' => [

            [
                'attribute' => 'title',
                'content' => function ($model) {
                    $text = $model->title . ' <i class="fa fa-pencil"></i>';
                    return Html::a($text, ['/property/update', 'id' => $model->id], ['class' => 'text-underlined']);
                },
                'filterInputOptions'    => [
                    'type'  => 'search',
                    'class' => 'form-control'
                ]
            ],
            [
                'header'    => Yii::t('bshop', 'Property values'),
                'content' => function ($model) {
                    $text = '';
                    foreach ($model->propertyValues as $v) {
                        $text .= "<span class=\"badge\">{$v->value}</span> ";
                    }

                    return $text;
                }
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
<?php Pjax::end(); ?></div>
    </div>
</div>