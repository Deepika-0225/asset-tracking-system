<h1>Student Registration Form</h1>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php endif; ?>

<?php $form = $this->beginWidget('CActiveForm'); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
        <br><br>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
        <br><br>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'age'); ?>
        <?php echo $form->textField($model, 'age'); ?>
        <?php echo $form->error($model, 'age'); ?>
        <br><br>
    </div>
    
    <div class="row rememberMe">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
    </div>
    <br>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

<?php $this->endWidget(); ?>
