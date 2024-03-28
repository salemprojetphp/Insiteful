<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/images/insiteful.png">
    <link rel="stylesheet" href="/public/css/pwdRecovery.css">
    <title>Password Recovery</title>
</head>
<body>
    <h2>
        <a href="Blog.php" class="logo"><img src="/public/images/insiteful.png" alt="logo"></a>
    </h2>
    <form method="post" action="/passwordchange/action">
        <div class="container">
            <?php 
                if(!isset($_GET['message']) || $_GET['message'] == "Wrong code"){
                    echo 
                    '
                    <h1>Please type the code</h1>
                        <label>Code: </label>
                        <input type="number" placeholder="Code" required name="code"><br>
                        <input type="submit" value="Submit" class="button">';
                }
                elseif($_GET['message'] == "Correct code"){
                    echo 
                    '
                        <h1>Change your password</h1>
                        <label>New Password : </label>
                        <input type="password" placeholder="Password" required name="password"><br>
                        <label>Confirm new Password : </label>
                        <input type="password" placeholder="Password" required name="cpassword"><br>
                        <input type="submit" value="Submit" class="button">';
                }
                elseif($_GET['message'] == "Wrong code"){
                    echo 
                    '
                        <h1>Verifypassword</h1>
                        <label>New Password : </label>
                        <input type="password" placeholder="Password" required name="password"><br>
                        <label>Confirm new Password : </label>
                        <input type="password" placeholder="Password" required name="cpassword"><br>
                        <input type="submit" value="Submit" class="button">';
                }
            ?>
        </div>
    </form>
</body>
</html>