<h2>Forgot Password</h2>

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

<form method="post">
    <label for="email">Enter your email : </label>
    <input type="email" name="email" required /><br><br>
    <input type="submit" value="Send Reset Link" />
</form>

