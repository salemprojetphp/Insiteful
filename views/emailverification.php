<?php 
    include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/images/insiteful.png">
    <link rel="stylesheet" href="/public/css/emailverification.css">
    <title>Password Recovery</title>
</head>
<body>
    <div class="container">
        <h1>Verify your email</h1>
        <?php
            if (!isset($_GET["email"])) {
                header("Location: /auth");
                exit;
            }
            echo '<p>A code will be sent to this email ' . '<span class="email">'. $_GET["email"] .' </span> </p>';
        ?>

    </div>
</body>
</html>
<?php
include_once 'footer.php';?>