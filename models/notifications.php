<?php
require_once 'models/Model.php';
require_once 'models/Post.php';
require_once 'models/User.php';


class Notification extends Model
{ 
    public $db;

    public function showNotifications(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $query = "SELECT * FROM notifications WHERE admin_id = :admin_id";
        $fetchQuery = $this->db->prepare($query);
        $fetchQuery->bindParam(':admin_id',$_SESSION['user_id']);
        $fetchQuery->execute();
        $notifications = $fetchQuery->fetchAll(PDO::FETCH_ASSOC);
        $html='';
        foreach($notifications as $notification){
            $html .= '<div class="notification ';
            if($notification['seen']==False){
                $html .= 'notif-active';
            }
            $html .= '" id="'.$notification['id'].'" data-post-id="'.$notification['post_id'].'"';
            $html .= '>';
            $userModel = new User();
            $username = ($userModel->getUserById($notification['user_id'])) -> Username;
            $html .= '<h4>'.ucfirst($username). ' '.$notification['message'].'</h4>';
            $postModel = new Post();
            $post = $postModel->getPostById($notification['post_id']);
            $html .= '<p>'.$post['title'].'</p>';
            $html .= '</div>';    
        }
        if($html==''){
            $html = '<div class="notification notif-active">
                        <h4>No notifications</h4>
                        <p>There is no activity for now.</p>
                    </div>';
        }
        echo $html;
    }

    public function nbNotifications(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $query = "SELECT COUNT(*) FROM notifications WHERE admin_id = :admin_id AND seen = 0";
        $nbNotifQuery = $this->db->prepare($query);
        $nbNotifQuery->bindParam(':admin_id',$_SESSION['user_id']);
        $nbNotifQuery->execute();
        return $nbNotifQuery->fetchColumn();
    }

    public function seenNotification($notif_id){
        $query = "UPDATE notifications SET seen = 1 WHERE id = :notif_id";
        $updateQuery = $this->db->prepare($query);
        $updateQuery->bindParam(':notif_id', $notif_id);
        $updateQuery->execute(); 
        return True;
    }

    public function addNotification($user_id, $message,$post_id)
    {
        $postModel = new Post();
        $post = $postModel->getPostById($post_id);
        $admin_id = $post['user_id'];
        if($admin_id == $user_id){
            return False;
        }
        $sql = "INSERT INTO notifications (user_id, message, post_id, admin_id) VALUES (:user_id, :message, :post_id, :admin_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':admin_id', $admin_id);
        return $stmt->execute();
    }
}
