<?php
function timeSince($date) {
    $seconds = time() - strtotime($date)-3600;
    
    if ($seconds < 60) {
        return "Just Now";
    } elseif ($seconds < 3600) {
        $minutes = floor($seconds / 60);
        return $minutes . " minute" . ($minutes == 1 ? "" : "s") . " ago";
    } elseif ($seconds < 86400) {
        $hours = floor($seconds / 3600);
        return $hours . " hour" . ($hours == 1 ? "" : "s") . " ago";
    } elseif ($seconds < 2592000) {
        $days = floor($seconds / 86400);
        return $days . " day" . ($days == 1 ? "" : "s") . " ago";
    } elseif ($seconds < 31536000) {
        $months = floor($seconds / 2592000);
        return $months . " month" . ($months == 1 ? "" : "s") . " ago";
    } else {
        $years = floor($seconds / 31536000);
        return $years . " year" . ($years == 1 ? "" : "s") . " ago";
    }
}



?>