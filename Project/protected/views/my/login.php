<h2>Login Page</h2>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <p style="color: green;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </p>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <p style="color: red;">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </p>
<?php endif; ?>


<?php if (!empty($message)): ?>
    <p style="color: <?php echo ($message == 'Login Successful!') ? 'green' : 'red'; ?>">
        <?php echo $message; ?>
    </p>
<?php endif; ?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>

    <div style="position: relative; display: inline-block;">
        <label>Password:</label>
        <input type="password" name="password" id="myInput" /><br><br>
        <input type="checkbox" onclick="myFunction()">Show
        <div style="position: absolute; top: 40px; right: 0;">
            <a href="<?php echo Yii::app()->createUrl('my/forgot'); ?>">Forgot Password?</a>
        </div>
    </div>
    <br><br>
    <input type="submit" value="Login">
</form>
    
<script>
    
    function myFunction() 
    {
        var x = document.getElementById("myInput");
        var checkbox = event.target;

        if (checkbox.checked) 
        {
            x.type = "text";
        } 
        else 
        {
            x.type = "password";
        }
    }
    
</script>
