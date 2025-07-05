<?php
/* @var $this AssetController */
/* @var $model Asset */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asset-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class=row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'asset_type_id' , array('style' => 'width: 120px;')); ?>
		<?php echo $form->dropDownList($model,'asset_type_id', 
                        CHtml::listData(AssetType::model()->findAll(), 'id', 'types'),
                        array('prompt' => 'Select Asset')); ?>
                    
		<?php echo $form->error($model,'asset_type_id'); ?>
	</div>
        <div class=row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'asset_type' , array('style' => 'width: 120px;')); ?>
		<?php echo $form->textField($model,'asset_type',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'asset_type'); ?>
	</div>

	

	<div class=row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'serial_number1' , array('style' => 'width: 120px;')); ?>
		<?php echo $form->textField($model,'serial_number1',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'serial_number1'); ?>
	</div>

	<div class=row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'serial_number2' , array('style' => 'width: 120px;')); ?>
		<?php echo $form->textField($model,'serial_number2',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'serial_number2'); ?>
	</div>
        
        <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model, 'status', array('style' => 'width: 120px;')); ?>
		<?php echo $form->dropDownList($model, 'status', [
			'active' => 'Active',
			'malfunctioning' => 'Malfunctioning',
			'lost' => 'Lost',
			'destroyed' => 'Destroyed',
		], array('prompt' => 'Select Status')); ?>
		<?php echo $form->error($model, 'status'); ?>
        </div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->