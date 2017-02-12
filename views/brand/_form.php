<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use sjaakp\illustrated\Uploader;

/* @var $this yii\web\View */
/* @var $model app\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php
    $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
    ]);
    ?>
    <div class="col-md-8 col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <fieldset>
                    <legend>
                    <?= Yii::t('bshop', 'General info') ?>
                    </legend>
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => true,
                        'placeholder' => Yii::t('bshop', 'Please type brand\'s name, it\'s required')
                    ]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                </fieldset>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <fieldset>
                    <legend><?= Yii::t('bshop', 'SEO') ?></legend>
                    <?= $form->field($model, 'seoTitle')->textInput(); ?>

                    <?= $form->field($model, 'seoKeywords')->textInput(); ?>

                    <?= $form->field($model, 'seoDescription')->textarea(); ?>
                </fieldset>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <fieldset>
                    <legend><?= Yii::t('bshop', 'Human-readable URL') ?></legend>
                    <?=
                            $form->field($model, 'slug', [
                                'addon' => [
                                    'prepend' => ['content' => '<i class="glyphicon glyphicon-globe"></i> http://sitename.com/brand/']
                                ]
                            ])
                            ->widget(
                                    \modernkernel\slugify\Slugify::className(), ['source' => '#brand-title']
                            )
                    ?>
                </fieldset>
            </div>
        </div>

    </div>


    <div class="col-md-4 col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <?= $form->field($model, 'active')->widget(SwitchInput::className()) ?>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <?= $form->field($model, 'picture')->widget(Uploader::className(), [
                    'stylefileOptions'  => [
                        'btnText'   => Yii::t('bshop', 'Browse picture')
                    ],
                    'cropperOptions'    => [
                        'diagonal'  => 320,
                        'minSize'   => 220,
                        'margin'   => 10,
                    ]
                ]) ?>
            </div>
        </div>
    </div>

    <div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('bshop', 'Create') : Yii::t('bshop', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
