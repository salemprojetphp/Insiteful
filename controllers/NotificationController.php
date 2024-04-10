<?php
require_once 'Controller.php';
require_once 'models/notifications.php';

class NotificationController extends Controller
{
    public function markAsSeen(){
        $notificationModel = new Notification();
        echo $_GET['id'];
        $notificationModel->seenNotification($_GET['id']);
    }
}