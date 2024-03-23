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

    <form method="post" action="login.php">
        <label for="email">Email :</label>
        <input name="email" type="email" placeholder="Email" required><br>
        <label for="password">Password : </label>
        <input name="password" type="password" placeholder="Password" required><br>
        <input type="submit" value="Submit"><br>
    </form>
    <p>Not a member ?</p>
    <a href="Signup/signupform.php">Sign up</a>
</body>
</html>
