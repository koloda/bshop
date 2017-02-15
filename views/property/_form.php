<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\SwitchInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\jui\JuiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Property */
/* @var $form yii\widgets\ActiveForm */
/* @var $a */
?>

<div class="property-forma">
    <?php
    $form = ActiveForm::begin([
                'options' => ['id' => 'property-form']
            ]);
    ?>

    <div class="col-sm-8 col-xs-12">
        <div class="panel">
            <div class="panel-body">
                <fieldset>
                    <legend>
                        <?= Yii::t('bshop', 'General info') ?>
                    </legend>
                </fieldset>

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <fieldset>
                    <legend>
                    <?=Yii::t('bshop', 'Property values')?>
                    </legend>
                <?php
                    DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper',
                        'widgetBody' => '.form-options-body',
                        'widgetItem' => '.form-options-item',
                        'min' => 0,
                        'insertButton' => '.add-item',
                        'deleteButton' => '.delete-item',
                        'model' => $valueModels[0],
                        'formId' => 'property-form',
                        'formFields' => [
                            'value',
                        ],
                    ]);
                    ?>

                    <table class="table margin-b-none" id="property-values-table">
                        <thead>
                            <tr>
                                <th style="width: 90px; text-align: center"><?=Yii::t('bshop', 'Order')?></th>
                                <th class="required text-center"><?=Yii::t('bshop', 'Property value')?></th>
                                <th style="width: 90px; text-align: center"><?=Yii::t('bshop', 'Remove')?></th>
                            </tr>
                        </thead>
                        <tbody class="form-options-body">
                        <?php foreach ($valueModels as $index => $pv): ?>
                                <tr class="form-options-item">
                                    <td class="sortable-handle text-center vcenter" style="cursor: move;">
                                        <i class="glyphicon glyphicon-resize-vertical" style="font-size: 24px;"></i>
                                    </td>
                                    <td class="vcenter">
                                        <?= $form->field($pv, "[{$index}]value")->label(false)->textInput(['maxlength' => 128]); ?>
                                        <input type="hidden" name="PropertyValue[<?= $index ?>][property_id]" value="<?= $model->id ?>">
                                        <input type="hidden" name="PropertyValue[<?= $index ?>][id]" value="<?=$pv->id?>">
                                    </td>
                                    <td class="text-center vcenter">
                                        <button type="button" class="delete-item btn btn-danger btn-sm" tabindex="-1"><i class="glyphicon glyphicon-minus"></i></button>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-center vcenter">
                                    <button type="button" class="add-item btn btn-success btn-sm">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                <?php DynamicFormWidget::end(); ?>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="panel">
            <div class="panel-body">
            <?= $form->field($model, 'active')->widget(SwitchInput::className()) ?>
            </div>
        </div>
    </div>

    <div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('bshop', 'Create') : Yii::t('bshop', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= form_csrf() ?>
<?php ActiveForm::end(); ?>
</div>


<?php
$js = <<<'EOD'
var fixHelperSortable = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(".form-options-body").sortable({
    items: "tr",
    cursor: "move",
    opacity: 0.9,
    axis: "y",
    handle: ".sortable-handle",
    helper: fixHelperSortable,
    update: function(ev){
        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");
    }
}).disableSelection();

EOD;

JuiAsset::register($this);
$this->registerJs($js);
