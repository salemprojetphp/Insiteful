<?php
    include_once 'header.php';

    session_start();
    if (!isset($_SESSION['user_id']))
        $_SESSION['user_id'] = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSITEFUL</title>
    <link rel="icon" href="../public/images/insiteful.png">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
</head>

<body>
    <section>
        <div class="content">
            <div class="info">
                <h2>INSITEFUL<br>
                    <span>Simple Web Analytics</span></h2>
                <p>INSITEFUL helps you track and understand your website's activity effortlessly. With detailed statistics and customizable graphs, you can easily monitor your site's performance over time. Save and share your insights with PDF exports, and engage with our community through our interactive blog. Join INSITEFUL today to take control of your website's success.</p>
                <a href="#" class="info-btn">More Info</a>
            </div>
        </div>

    </section>
    <?php
include_once 'footer.php';?>
</body>

</html>
