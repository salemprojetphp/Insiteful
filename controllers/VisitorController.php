<?php
require_once 'Controller.php';

class VisitorController extends Controller {
    public function track() {
        header("Access-Control-Allow-Origin: *");

        header("Access-Control-Allow-Methods: POST");

        header("Access-Control-Allow-Headers: Content-Type");

        $id = $_POST['id'] ?? null;
        $referrer = $_POST['referrer'] ?? 'Direct';
        $screen = $_POST['screen'] ?? null;
        $website = $_POST['website'] ?? null;
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $browser = $_SERVER['HTTP_USER_AGENT'];
        // TODO:
        // - clean up user agent
        // - get country from ip
        // - get deivce
        // - save to db
        if ($id !== null ) {
            $logMessage = "Received data for ID: $id, Referrer: $referrer, Screen: $screen, Website: $website, Ip: $ip, Time: $time, Browser: $browser \n";
            
            file_put_contents("log.txt", $logMessage, FILE_APPEND | LOCK_EX);
        }
    }
}
?>
