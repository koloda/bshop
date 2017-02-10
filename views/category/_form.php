<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category;

use sjaakp\illustrated\Uploader;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form col-md-8 col-md-offset-2 col-sm-12">
    <?php $form = ActiveForm::begin([
        'options'   => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
    <?= $form->field($model, 'parent_id')
        ->dropdownList(Category::selectList($model->id), ['prompt' => Yii::t('bshop', 'Select parent category')]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'picture')->widget(Uploader::className()) ?>

    <?= $form->field($model, 'seoTitle')->textInput(); ?>
    <?= $form->field($model, 'seoKeywords')->textInput(); ?>
    <?= $form->field($model, 'seoDescription')->textarea(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('bshop', 'Create') : Yii::t('bshop', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
