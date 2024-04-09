<?php
require_once 'Controller.php';

class NotificationController extends Controller
{
    public function index()
    {
        require_once 'views/admin/notifications.php';
    }
}