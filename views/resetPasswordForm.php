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
    <title>Password Recovery</title>
</head>
<body>
    <form method="post" action="/forgotPassword/action">
        <div class="container">
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
                    echo '<label id="input_label">Email: </label> <input type="text" id="input_email" placeholder="email" required name="email"><br> <input type="submit" value="Submit" id="submit_password" class=" button">';
                    
                }
            ?>
        </div>
        <script>
                var submitButton = document.getElementById('submit_password');
                submitButton.addEventListener('click', function(event) {
                event.preventDefault();
                // make input hidden and say instead email sent
                var inputField= document.getElementById('input_email');
                inputField.style.display = 'none';
                var inputField= document.getElementById('input_label');
                inputField.style.display = 'none';

                // add email sent message inside form
                var form = document.querySelector('.container');
                form.innerHTML = 'Reset link was sent to your email' ;
                form.appendChild(emailSentMessage);
                
                form.submit();
            });
        </script>
    </form>

</body>
</html>