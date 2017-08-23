<?php

use yii\helpers\Html;
use app\models\Category;
use app\models\Brand;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use sjaakp\illustrated\Uploader;
use kartik\widgets\Select2;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php
        $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'id'    => 'product-form'
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
                        $form->field($model, 'category_id')
                            ->widget(Select2::className(), [
                            'data' => Category::selectList(),
                            //@TODO: improve lang here
                            'language' => 'en',
                            'options' => [
                                'placeholder' => Yii::t('bshop', 'Select category')
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]);
                    ?>

                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => true,
                        'placeholder' => Yii::t('bshop', 'Please type product title, it\'s required')
                        ]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                </fieldset>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <fieldset>
                    <legend>
                    <?= Yii::t('bshop', 'Commercial info') ?>
                    </legend>
                </fieldset>

                <div class="col-md-6 col-xs-12">
                <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-6 col-xs-12">
                    <?=
                            $form->field($model, 'price', [
                                'addon' => [
                                    //@TODO: improve currency symbol
                                    'prepend' => ['content' => '$']
                                ]
                            ])
                            ->input('number', [
                                'min' => 0,
                                'step' => 0.01
                            ])
                    ?>
                </div>
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
                                    'prepend' => ['content' => '<i class="fa fa-globe"></i> http://sitename.com/product/']
                                ]
                            ])
                            ->widget(
                                    \modernkernel\slugify\Slugify::className(), ['source' => '#product-title']
                            )
                    ?>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-xs-12">
        <div class="panel">
            <div class="panel-body">
                <div class="col-xs-6">
                    <?= $form->field($model, 'active')->widget(SwitchInput::className()) ?>
                </div>

                <div class="col-xs-6">
                    <?= $form->field($model, 'available')->widget(SwitchInput::className()) ?>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
            <?=
                $form->field($model, 'brand_id')
                ->widget(Select2::className(), [
                    'data' => Brand::selectList(),
                    //@TODO: improve lang here
                    'language' => 'en',
                    'options' => [
                        'placeholder' => Yii::t('bshop', 'Select brand')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
            ]);
            ?>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <?= $form->field($model, 'picture')->widget(Uploader::className(), [
                    'stylefileOptions'  => [
                        'btnText'   => Yii::t('bshop', 'Browse picture')
                    ],
                    'cropperOptions'    => [
                        'diagonal'  => 440,
                        'minSize'   => 220,
                        'margin'   => 10,
                    ]
                ]) ?>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <label class="control-label">
                <?= Html::activeLabel($model, 'gallery_id')?>
                </label>

                <?php
                if ($model->isNewRecord) {
                    echo Yii::t('bshop', 'Can not upload images for new record');
                } else {
                    echo GalleryManager::widget(
                        [
                            'model' => $model,
                            'behaviorName' => 'galleryBehavior',
                            'apiRoute' => 'product/galleryApi'
                        ]
                    );
                }
                ?>
            </div>
        </div>
    </div>

    <?= form_csrf() ?>
<?php ActiveForm::end(); ?>

</div>
