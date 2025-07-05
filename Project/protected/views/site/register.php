<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div style="color: green;"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div style="color: red;"><?php echo Yii::app()->user->getFlash('error'); ?></div>
<?php endif; ?>


    
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-register-form',
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,

)); ?>

    
<p class="note">Fields with <span class="required">*</span> are required.</p>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo $form->labelEx($model, 'name  :', array('style' => 'width: 80px;')); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo $form->labelEx($model, 'age  :', array('style' => 'width: 80px;')); ?>
    <?php echo $form->textField($model, 'age'); ?>
    <?php echo $form->error($model, 'age'); ?>
</div>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo $form->labelEx($model, 'username  :', array('style' => 'width: 80px;')); ?>
    <?php echo $form->textField($model, 'username'); ?>
    <?php echo $form->error($model, 'username'); ?>
</div>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo $form->labelEx($model, 'password  :', array('style' => 'width: 80px;')); ?>
    <?php echo $form->passwordField($model, 'password'); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo $form->labelEx($model, 'email  :', array('style' => 'width: 80px;')); ?>
    <?php echo $form->textField($model, 'email'); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo $form->labelEx($model, 'location  :', array('style' => 'width: 80px;')); ?>
    <?php echo $form->textField($model, 'location'); ?>
    <?php echo $form->error($model, 'location'); ?>
</div>

<div>
    <?php echo CHtml::submitButton('Register'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



<script type="text/javascript">
$(document).ready(function () 
{
    $('#User_email').on('blur', function ()   // blur --> left the field – not clicked inside.
    {
        var email = $(this).val().trim();  
        var submitBtn = $('#submit-button');

        $('#email-error').remove();  // Remove  previous error

        if (email !== '') 
        {
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl("site/checkEmail"); ?>',
                data: { email: email },
                success: function (response) 
                {
                    if (response === 'exists') 
                    {
                        $('#User_email').after('<div id="email-error" class="errorMessage">Email already exists.</div>');
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
        else
        {
            $('#email-error').remove();
            submitBtn.prop('disabled', false);
        }
    });
});
</script>

