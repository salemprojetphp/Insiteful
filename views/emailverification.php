<?php 
    include_once 'header.php';
?>

<link rel="stylesheet" href="/public/css/emailverification.css">
<div class="email-verif-container">
    <h1>Verify your email</h1>
    <?php
        if (!isset($_GET["email"])) {
            header("Location: /auth");
            exit;
        }
        echo '<p>A code will be sent to this email ' . '<span class="email">'. $_GET["email"] .' </span> </p>';
    ?>

</div>
</main>
<?php
include_once 'footer.php';?>
</body>
</html>
