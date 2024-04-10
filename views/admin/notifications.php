<?php
    require_once 'models/notifications.php';
    $notificationModel = new Notification();
?>

<link rel="stylesheet" href="/public/css/notifications.css">
<link rel="stylesheet" href="/public/css/general.css">
<div class="dropdown__wrapper dropdown__wrapper--fade-in none hide">
    <h3>Notifications</h3>
    <div class="notification-container">
        <?php
            $notifications = $notificationModel->showNotifications();
        ?>
    </div>
</div>
<script src="/public/js/notifications.js" defer></script>