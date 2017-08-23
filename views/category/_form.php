<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use sjaakp\illustrated\Uploader;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
<?php
$form = ActiveForm::begin([
            'options' => [
                'enctype'   => 'multipart/form-data',
                'id'        => 'category-form'
            ]
        ]);
?>

    <div class="col-sm-7 col-xs-12">
        <div class="panel">
            <div class="panel-body">
                <fieldset>
                    <legend>
                    <?= Yii::t('bshop', 'General info') ?>
                    </legend>
                    <?=
                        $form->field($model, 'parent_id')
                            ->widget(Select2::className(), [
                                'data'  => $model->selectList($model->id),
                                //@TODO: improve lang here
                                'language'  => 'en',
                                'options'   => [
                                    'placeholder'   => Yii::t('bshop', 'Select parent category')
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                    ?>

                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => true,
                        'placeholder' => Yii::t('bshop', 'Please type category title, it\'s required')
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
                                    'prepend' => ['content' => '<i class="glyphicon glyphicon-globe"></i> http://sitename.com/category/']
                                ]
                            ])
                            ->widget(
                                    \modernkernel\slugify\Slugify::className(), ['source' => '#category-title']
                            )
                    ?>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-xs-12">
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
<?=form_csrf()?>
<?php ActiveForm::end(); ?>

</div>
