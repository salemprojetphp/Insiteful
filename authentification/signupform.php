<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insiteful</title>
</head>
<body>
    <?php
        if(isset($_GET['error'])) {
            echo "<h1>" . $_GET['error'] . "</h1>";
        }
    ?>
    <form method="post" action="signup.php">
        <label>Name :</label>
        <input type="text" name="username"><br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password"><br>
        <label for="cpassword">Confirm Password :</label>
        <input type="password" name="cpassword" id="cpassword"><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>