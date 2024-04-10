<?php
    include_once 'header.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id']))
        $_SESSION['user_id'] = null;
?>

<link rel="stylesheet" href="../public/css/style.css">
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
        require_once 'views/footer.php';
    ?>
</body>

</html>
