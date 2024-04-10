<?php
require_once 'Model.php';

class Post extends Model {
    public $db;

    public function insert($title, $description, $author, $date, $imageInputName,$bgColor) {
        if (empty($_FILES[$imageInputName]['tmp_name']) || $_FILES[$imageInputName]['error'] === UPLOAD_ERR_NO_FILE) {
            $photo = null;
            $imageFormat = null;
        } elseif ($_FILES[$imageInputName]['error'] === UPLOAD_ERR_OK) {
            // Image provided and upload was successful
            $imageInfo = getimagesize($_FILES[$imageInputName]['tmp_name']);
            $imageFormat = $imageInfo['mime'];
    
            // Read binary data from image
            $photo = file_get_contents($_FILES[$imageInputName]["tmp_name"]);
            if ($photo === false) {
                return false;
            }
        } else {
            return false;
        }
    
        $query = "INSERT INTO post (title, description, author, date, image, imageFormat, bgColor) 
        VALUES (:title, :description, :author, :date, :image, :imageFormat, :bgColor)";
        $insertQuery = $this->db->prepare($query);
        if (!$insertQuery) {
            return false;
        }
        $insertQuery->bindParam(':title', $title);
        $insertQuery->bindParam(':description', str_replace("\n", "<br>", $description));
        $insertQuery->bindParam(':author', $author);
        $insertQuery->bindParam(':date', $date);
        $insertQuery->bindParam(':image', $photo, PDO::PARAM_LOB);
        $insertQuery->bindParam(':imageFormat', $imageFormat);
        $insertQuery->bindParam(':bgColor', $bgColor);
        $result = $insertQuery->execute();
    
        return $result;
    }
    
    

    //returns true if successful
    public function delete($postId) {
        $query = "DELETE FROM post WHERE id = :post_id";
        $deleteQuery = $this->db->prepare($query);
        $deleteQuery->bindParam(':post_id', $postId);
        $result = $deleteQuery->execute();
        //delete from notifications
        $notification = new Notification();
        $notification->deleteNotification($postId);
        return $result;
    }

    public function extractImage($postId) {
        try {
            $query = "SELECT image FROM post WHERE id = :post_id";
            $query2 = "SELECT imageFormat FROM post WHERE id = :post_id";
            $takeImg = $this->db->prepare($query);
            $takeImg->bindParam(':post_id', $postId);
            $takeImg->execute();
            $takeImgFormat = $this->db->prepare($query2);
            $takeImgFormat->bindParam(':post_id', $postId);
            $takeImgFormat->execute();

            $imageData = $takeImg->fetchColumn();
            $imageFormat = $takeImgFormat->fetchColumn();
            
            //check the image data
            if ($imageData) {
                $base64Image = base64_encode($imageData);
                $imgSrc = "data:" . $imageFormat . ";base64," . $base64Image;
                
            } else {
                $imgSrc="../public/images/hello.svg";
            }
            return $imgSrc;
        } catch (PDOException $e) {
            return false;
        }
    }

    //return all posts as html elements
    public function getAllPosts($page=1,$filter='recent') {
        $limit=5;
        $offset = ($page - 1) * $limit;
        if($filter == 'recent'){
            $query = "SELECT post.*, users.username AS author_name 
                    FROM post 
                    JOIN users ON post.author = users.id"
                    . " ORDER BY post.date DESC LIMIT :limit OFFSET :offset";
        } elseif ($filter == 'old'){
            $query = "SELECT post.*, users.username AS author_name 
                    FROM post 
                    JOIN users ON post.author = users.id"
                    . " ORDER BY post.date ASC LIMIT :limit OFFSET :offset";
        } elseif ($filter == 'popular'){
            $query = "SELECT post.*, users.username AS author_name 
                    FROM post 
                    JOIN users ON post.author = users.id
                    ORDER BY (SELECT COUNT(*) FROM likes WHERE likes.post_id = post.id) + 
                            (SELECT COUNT(*) FROM comments WHERE comments.post_id = post.id) DESC
                    LIMIT :limit OFFSET :offset";
        }
        $getpostsquery = $this->db->prepare($query);
        $getpostsquery->bindParam(':limit', $limit, PDO::PARAM_INT);
        $getpostsquery->bindParam(':offset', $offset, PDO::PARAM_INT);
        $getpostsquery->execute();
        $posts = $getpostsquery->fetchAll(PDO::FETCH_ASSOC);
        $userModel = new User();
        $user = $userModel->getUserById($_SESSION['user_id']);
        $html = "";
        foreach ($posts as $post) {
            $imgSrc = $this->extractImage($post['id']);
            // Format date
            $date = date('F j, Y', strtotime($post['date']));
            $html .= "<a href='/blog/article?id=" .$post['id']."' class='blog-article bg-white shadow-sm mb32' id='" .$post["id"]."'>";
            $html .= "<div class='blog-preview' style='background: " . $post['bgColor'] . ";'>";
            $html .= "<img src='" . $imgSrc . "' width='auto' height='200' alt='" . $post['title'] . "'>";
            $html .= "</div>";
            $html .= "<div class='blog-article-content'>";
            $html .= "<h2 class='h3 mb16 black'>" . $post['title'] . "</h2>";
            $html .= "<div class='blog-description gray mb24'>" . $post['description'] . "</div>";
            $html .= "<div class='blog-article-content-info flex caption gray'>";
            $html .= "<div class='flex'>";
            $html .= "<img src='../public/images/user.png' width='36' height='36' alt='author'>";
            $html .= "<span class='ml8 mr24'>" . $post['author_name'] . "</span>";
            $html .= "<span>" . $date . "</span>";
            $html .= "</div>";
            $html .= "<div class='interact flex'>";
            $html .= "<button class='like-btn' >";
            $html .= "<img src='../public/images/". $this->isLiked($post['id']) .".svg' data-post-id='" .$post["id"]. "' alt='like'>";
            $html .= "<p>" . $this->nbLikes($post["id"]) ."</p>";
            $html .= "</button>";
            $html .= "<button class='comment-btn' >";
            $html .= "<img src='../public/images/comment.svg' data-post-id='" .$post["id"]. "' alt='comment'>";
            $html .= "<p>" . $this->nbComments($post['id']) ."</p>";
            $html .= "</button>";
            if($user && $user->Role == "Admin"){
                $html .= "<button class='more-btn'><img src='../public/images/more.svg' alt='more'></button>";
                $html .= "<div class='dropdown-menu'>
                            <button class='edit-btn' data-post-id='" .$post["id"]."'>Edit</button>
                            <button class='delete-btn' data-post-id='" .$post["id"]."' >Delete</button>";
                $html .= "</div>";
            }
            $html .= "</div></div></div></a>";
        }
        return $html;
    }

    public function getTotalPostsCount(){
        $query = "SELECT COUNT(*) AS total_count FROM post";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_count'];
    }
    
    //return post by id
    public function getPostById($postId) {
        $query = "SELECT post.*, users.username AS author_name FROM post JOIN users ON post.author = users.id WHERE post.id = :post_id";
        $getPost = $this->db->prepare($query);
        $getPost->bindParam(':post_id', $postId);
        $getPost->execute();
        $post = $getPost->fetch(PDO::FETCH_ASSOC);
        $imgSrc = $this->extractImage($postId);
        $postData = array(
            'postId' => $postId,
            'title' => $post['title'],
            'content' => $post['description'],
            'user_id' => $post['Author'],
            'author' => $post['author_name'],
            'date' => date('F j, Y', strtotime($post['date'])),
            'imgSrc' => $imgSrc,
            'bgColor' => $post['bgColor']
        );
        return $postData;
    }

    public function edit($title, $description, $postId, $imageInputName, $bgColor) {
        // checking if image was provided
        if (empty($_FILES[$imageInputName]['tmp_name']) || $_FILES[$imageInputName]['error'] === UPLOAD_ERR_NO_FILE) {
            $photo = null;
            $imageFormat = null;
        } elseif ($_FILES[$imageInputName]['error'] === UPLOAD_ERR_OK) {
            $imageInfo = getimagesize($_FILES[$imageInputName]['tmp_name']);
            $imageFormat = $imageInfo['mime'];
            $photo = file_get_contents($_FILES[$imageInputName]["tmp_name"]);
            if ($photo === false) {
                return false;
            }
        } else {
            return false;
        }
        $query = "UPDATE post SET title = :title, description = :description, image = :image, imageFormat = :imageFormat, bgColor = :bgColor WHERE id = :post_id";
        $editQuery = $this->db->prepare($query);
        $editQuery->bindParam(':title', $title);
        $editQuery->bindParam(':description', $description);
        $editQuery->bindParam(':image', $photo, PDO::PARAM_LOB);
        $editQuery->bindParam(':imageFormat', $imageFormat);
        $editQuery->bindParam(':post_id', $postId);
        $editQuery->bindParam(':bgColor', $bgColor);
        $result = $editQuery->execute();
        return $result;
    }

    public function like($userId, $postId) {
        $query = "INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)";
        $likeQuery = $this->db->prepare($query);
        $likeQuery->bindParam(':user_id', $userId);
        $likeQuery->bindParam(':post_id', $postId);
        $result = $likeQuery->execute();
        //send notification to the admin
        $notification = new Notification();
        $notification->addNotification($userId, "liked your post", $postId);
        return $result;
    }

    public function dislike($userId,$postId){
        $query = "DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id";
        $dislikeQuery = $this->db->prepare($query);
        $dislikeQuery->bindParam(':user_id', $userId);
        $dislikeQuery->bindParam(':post_id', $postId);
        $result = $dislikeQuery->execute();
        return $result;
    }

    public function nbLikes($postId){
        $query = "SELECT COUNT(*) FROM likes WHERE post_id = :post_id";
        $nbLikesQuery = $this->db->prepare($query);
        $nbLikesQuery->bindParam(':post_id', $postId);
        $nbLikesQuery->execute();
        $nbLikes = $nbLikesQuery->fetchColumn();
        return $nbLikes;
    }

    public function isLiked($post_id){
        $user_id = $_SESSION['user_id'];
        $query = "SELECT COUNT(*) FROM likes WHERE user_id = :user_id AND post_id = :post_id";
        $isLikedQuery = $this->db->prepare($query);
        $isLikedQuery->bindParam(':user_id', $user_id);
        $isLikedQuery->bindParam(':post_id', $post_id);
        $isLikedQuery->execute();
        $isLiked = $isLikedQuery->fetchColumn();
        if($isLiked){
            return 'like-active';
        }else{
            return 'like';
        }
    }

    public function nbComments($post_id){
        $query = "SELECT COUNT(*) FROM comments WHERE post_id = :post_id";
        $nbCommentsQuery = $this->db->prepare($query);
        $nbCommentsQuery->bindParam(':post_id', $post_id);
        $nbCommentsQuery->execute();
        $nbComments = $nbCommentsQuery->fetchColumn();
        return $nbComments;
    }
    
}    
?>
