<?php
require_once 'Model.php';

class Post extends Model {
    public $db;

    //inserts post in db and returns true if successful
    public function insert($title, $description, $author, $date, $image) {
        //check the upload of the image
        if ($_FILES[$image]['error'] !== UPLOAD_ERR_OK) {
            echo "Upload error";
            return false;
        }
    
        //extracting image format
        $imageInfo = getimagesize($_FILES[$image]['tmp_name']);
        $imageFormat = $imageInfo['mime'];

        // read binary data from image
        $photo = file_get_contents($_FILES[$image]["tmp_name"]);
        if ($photo === false) {
            return false;
        }
    
        //insert post in db
        $query = "INSERT INTO post (title, description, author, date, image, imageFormat) VALUES (:title, :description, :author, :date, :image, :imageFormat)";
        $insertQuery = $this->db->prepare($query);
        if (!$insertQuery) {
            return false;
        }
        $insertQuery->bindParam(':title', $title);
        $insertQuery->bindParam(':description', $description);
        $insertQuery->bindParam(':author', $author);
        $insertQuery->bindParam(':date', $date);
        $insertQuery->bindParam(':image', $photo, PDO::PARAM_LOB);
        $insertQuery->bindParam(':imageFormat', $imageFormat);

        $result = $insertQuery->execute();

        return $result; 
    }

    //delete post from db and return true if successful
    public function delete($postId) {
        $query = "DELETE FROM post WHERE id = :post_id";
        $deleteQuery = $this->db->prepare($query);
        $deleteQuery->bindParam(':post_id', $postId);
        $result = $deleteQuery->execute();
        return $result;
    }

    // return src of image
    public function extractImage($postId) {
        try {
            //fetch img and imgformat
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
                //convert binary data of img into image
                $base64Image = base64_encode($imageData);
                //construct and return src for image
                $imgSrc = "data:" . $imageFormat . ";base64," . $base64Image;
                return $imgSrc;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    
}    
?>
