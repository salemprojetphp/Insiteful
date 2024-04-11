<?php 
    include_once 'header.php';
?>

<link rel="stylesheet" href="/public/css/pwdRecovery.css">
<body>
    <div class="pwd-container">
    <form method="post" action="/forgotPassword/action">
            <?php
                if(isset($_GET['error'])) {
                    echo "<h3>" . $_GET['error'] . "</h3>";
                }
                ?>
            <?php
                $email = $_GET['email'] ?? '';
                
                if (!empty($email)) {
                    echo "Reset link was sent to your email: $email";
                }
                else{
                    echo '  <label id="input_label">Email: </label> 
                            <input type="text" id="input_email" placeholder="email" required name="email">
                            <br> 
                            <button type="submit" id="submit_password" class=" button">Submit </button>';
                    
                }
            ?>
    </form>
</div>
    
</body>
<?php
include_once 'footer.php';?>
</html>
