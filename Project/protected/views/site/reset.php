<h2>Reset Password</h2>
<?php if (!empty($message)): ?>
    <p><?php echo CHtml::encode($message); ?></p>
<?php endif; ?>

<form method="post">
    <label for="password">New Password : </label>
    <input type="password" name="password" required /><br><br>
    <label for="confirm_password">Confirm Password : </label>
    <input type="password" name="confirm_password" required /><br><br>
    <input type="submit" value="Reset Password" />
</form>
<p><?php echo $message; ?></p>
