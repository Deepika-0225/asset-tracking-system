<h1>Asset Usage - End Date</h1>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'asset-usage-form',
        'enableClientValidation' => true,
)); ?>

    <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
            <?php echo $form->labelEx($model,'end_date', array('style' => 'width: 80px;')); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'end_date',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'dd-mm-yy',
                    'changeMonth'=>true,
                    'changeYear'=>true,
                    'minDate' => !empty($model->start_date)?$model->start_date : date('d-m-Y'),
                ),
                'htmlOptions'=>array(
                    'size'=>20,
                    'maxlength'=>20,
                ),
            ));
            ?>
            <?php echo $form->error($model,'end_date'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Save'); ?>
        </div>

<?php $this->endWidget(); ?>
</div>
