<?php 
    include_once 'header.php';
?>


<link rel="stylesheet" href="/public/css/pwdRecovery.css">
<form method="post" action="/setPassword/action">
    <div class="pwd-container">
        <label>Password: </label> <input type="password" placeholder="password" required name="password"><br> <input type="submit" value="Submit" class="button">
        <?php echo "<input type='text' hidden name='token' value=". $_GET['token']."> "; ?>
        <?php echo "<input type='text' hidden name='email' value=". $_GET['email']."> "; ?>
    </div>
</form>
<?php
include_once 'footer.php';?>
</body>
</html>