<?php 
    include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/images/insiteful.png">
    <link rel="stylesheet" href="/public/css/pwdRecovery.css">
    <title>Password Change</title>
</head>
<body>
    <h2>
        <a href="Blog.php" class="logo"><img src="/public/images/insiteful.png" alt="logo"></a>
    </h2>
    <form method="post" action="/setPassword/action">
        <div class="container">
            <label>Password: </label> <input type="password" placeholder="password" required name="password"><br> <input type="submit" value="Submit" class="button">
            <?php echo "<input type='text' hidden name='token' value=". $_GET['token']."> "; ?>
            <?php echo "<input type='text' hidden name='email' value=". $_GET['email']."> "; ?>
        </div>
    </form>
</body>
</html>