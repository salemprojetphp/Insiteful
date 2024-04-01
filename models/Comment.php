<?php
require_once 'Model.php';
require_once 'utils/date_since.php';

class Comment extends Model
{
    public function addComment($user_id,$post_id, $comment){
        $query = "INSERT INTO comments (user_id, post_id, comment, date) VALUES (:user_id, :post_id, :comment, :current_date)";
        $addCommentQuery = $this->db->prepare($query);
        $addCommentQuery->bindParam(':user_id', $user_id);
        $addCommentQuery->bindParam(':post_id', $post_id);
        $addCommentQuery->bindParam(':comment', $comment);
        $current_date = date('Y-m-d H:i', strtotime(date('Y-m-d H:i') . ' -1 hour'));
        $addCommentQuery->bindParam(':current_date', $current_date);
        $result = $addCommentQuery->execute(); 
        if ($result) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }   

    public function displayComments($post_id){
        $query = "SELECT comments.*, users.username AS author_name FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = :post_id ORDER BY date DESC";
        $displayCommentsQuery = $this->db->prepare($query);
        $displayCommentsQuery->bindParam(':post_id', $post_id);
        $displayCommentsQuery->execute();
        $comments = $displayCommentsQuery->fetchAll(PDO::FETCH_ASSOC);
        $user_id = $_SESSION['user_id'];
        $html = "";
        foreach($comments as $comment){
            $author_id = $this->getAuthorId($comment['id']);
            $html .= "<div class='comment' id='" . $comment['id'] . "'>";
            $html .= "<div class='comment-info flex'>";
            $html .= "<div class='user'>";
            $html .= "<img src='../public/images/user.png' width='32' height='32' alt='author'>";
            $html .= "<span class='ml8 mr24'>" . $comment['author_name'] . "</span>";
            $html .= "</div><span class='gray'>" . timeSince($comment['date']) . "</span>";
            if($author_id == $user_id){
                $html .= "<button class='delete-comment-btn' id='" . $comment['id'] . "'>";
                $html .= "<img src='../public/images/delete.png' alt='delete'>";
                $html .= "</button>";
            }
            $html .= "</div>";
            $html .= "<p class='comment-content'>" . $comment['comment'] . "</p>";
            $html .= "</div>";
        }
        return $html;
    }

    public function getAuthorId($comment_id){
        $query = "SELECT user_id FROM comments WHERE id = :comment_id";
        $getAuthorIdQuery = $this->db->prepare($query);
        $getAuthorIdQuery->bindParam(':comment_id', $comment_id);
        $getAuthorIdQuery->execute();
        $author_id = $getAuthorIdQuery->fetch(PDO::FETCH_ASSOC);
        return $author_id['user_id'];
    }

    public function deleteComment($comment_id){
        if ($comment_id == null) {
            $query = "DELETE FROM comments ORDER BY id DESC LIMIT 1";
            $deleteCommentQuery = $this->db->prepare($query);
            $deleteCommentQuery->execute();
        } else {
            $query = "DELETE FROM comments WHERE id = :comment_id";
            $deleteCommentQuery = $this->db->prepare($query);
            $deleteCommentQuery->bindParam(':comment_id', $comment_id);
            $deleteCommentQuery->execute();
        }
    }    
}
