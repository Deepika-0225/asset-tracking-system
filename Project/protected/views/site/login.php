<?php echo CHtml::beginForm(); ?>

<h1>Login Page</h1>

<!-- Display flash messages -->
<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-success" style="color: green; font-weight: bold;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error" style="color: red; font-weight: bold;">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo CHtml::activeLabel($model, 'username  :',array('style' => 'width: 80px;')); ?>
    <?php echo CHtml::activeTextField($model, 'username'); ?>
    <br><br>
</div>

<div style="display: flex; align-items: center; margin-bottom: 10px;">
    <?php echo CHtml::activeLabel($model, 'password  :',array('style' => 'width: 80px;')); ?>
    <?php echo CHtml::activePasswordField($model, 'password', ['id' => 'myInput']); ?>
    <?php echo CHtml::error($model, 'password'); ?>

    <br><br>
</div>

<div>
    <input type="checkbox" onclick="myFunction()"> Show Password
    &nbsp;&nbsp;
    <a href="<?php echo Yii::app()->createUrl('site/forgot'); ?>">Forgot Password?</a>
    <br><br>
</div>

<div>
    <?php echo CHtml::submitButton('Login'); ?>
</div>

<?php echo CHtml::endForm(); ?>

<script>
function myFunction() 
{
    var x = document.getElementById("myInput");
    x.type = (x.type === "password") ? "text" : "password";
}
</script>