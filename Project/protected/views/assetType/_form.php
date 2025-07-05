<?php
/* @var $this AssetTypeController */
/* @var $model AssetType */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asset-type-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class=row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'types' , array('style' => 'width: 50px;')); ?>
		<?php echo $form->textField($model,'types',array('size'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'types'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->