<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bshop', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('bshop', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $dataProvider,

        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'title',
            'parent_id',
            'description:ntext',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
