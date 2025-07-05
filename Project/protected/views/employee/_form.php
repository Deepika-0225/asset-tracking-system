<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'name', array('style' => 'width: 80px;')); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model, 'email', array('style' => 'width: 80px;')); ?>
                <?php echo $form->textField($model, 'email', array('size' => 40, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'email'); ?>
	</div>

	<div style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'is_active', array('style' => 'width: 80px;')); ?>
		<?php echo $form->checkBox($model,'is_active',['style' => 'width: 20px; height: 20px;']); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'submit-button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form -->



<script type="text/javascript">
$(document).ready(function () 
{
    $('#Employee_email').on('blur', function () 
    {
        var email = $(this).val().trim();  
        var submitBtn = $('#submit-button');

        //$('#email-error').remove();  

        if (email !== '') 
        {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->createUrl("employee/checkEmail"); ?>',
                data: { email: email },
                success: function (response) 
                {
                    if (response === 'exists') 
                    {
                        $('#Employee_email').after('<div id="email-error" class="errorMessage">Email already exists.</div>');
                        submitBtn.prop('disabled', true);
                    } 
                    else 
                    {
                        $('#email-error').remove();
                        submitBtn.prop('disabled', false); 
                    } 
                }
            });
        }
    });
});
</script>










    
    