<?php
require_once 'Model.php';

class User  extends Model{
    public $db;

    public function getUsers() {
        $query = $this->db->query("SELECT * FROM users where Role != 'Admin' ");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function login($email, $password) {
        $query = "select Password from users where Email = ? ";

        $queryPrep = $this->db->prepare($query);
        
        $queryPrep->execute([$email]);
        $queryResult = $queryPrep->fetch(PDO::FETCH_OBJ);
        
        if($queryPrep->rowCount() == 0){
            return "User not found";
        }
        elseif (!password_verify($password, $queryResult->Password)){
            return "Incorrect password";
        }
        else{
            return "Correct information";
        }

    }

    public function register($email, $password, $username) {
        $query = "insert into users(Email,Password,Username) values (?, ?, ?)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$email, $password, $username]);
    }

    public function getUserByEmail($email) {
        $query = "select * from users where Email = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$email]);
        return $queryPrep->fetch(PDO::FETCH_OBJ);
    }
    public function getUserById($id) {
        if(!$id) return null;
        $query = "select * from users where id = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$id]);
        return $queryPrep->fetch(PDO::FETCH_OBJ);
    }
    public function setPassword($email, $password){
        $query = "Update users set Password = ? where Email = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$password, $email]);
    }
    public function verifyPassword($userId,$password){
        $query = "select Password from users where id = ? ";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$userId]);
        $queryResult = $queryPrep->fetch(PDO::FETCH_OBJ);
        if (!password_verify($password, $queryResult->Password)){
            return false;
        }
        else{
            return true;
        }
    }

    public function isVerified($email){
        $query = "select Verified from users where Email = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$email]);
        $queryResult = $queryPrep->fetch(PDO::FETCH_OBJ);
        return $queryResult->Verified;
    }
    public function getNumberOfUsers(){
        $query = "select count(*) as number from users where Role != 'Admin'";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryResult = $queryPrep->fetch(PDO::FETCH_OBJ);
        return $queryResult->number;
    }

    public function updateProfilePicture($userId,$imageInputName){
        $array = explode('.', $_FILES[$imageInputName]['name']);
        $extension=strtolower(end($array));
        $allowed=array('jpg','jpeg','png');
        if(in_array($extension,$allowed)){
            if (empty($_FILES[$imageInputName]['tmp_name']) || $_FILES[$imageInputName]['error'] === UPLOAD_ERR_NO_FILE) {
                $profilePic = null;
                $imageFormat = null;
            } elseif ($_FILES[$imageInputName]['error'] === UPLOAD_ERR_OK) {
                $imageSize=$_FILES[$imageInputName]['size'];
                if($imageSize>10 * 1024 * 1024){ //10Mb
                    return false; //image too big
                }
                // Image provided and upload was successful
                $imageInfo = getimagesize($_FILES[$imageInputName]['tmp_name']);
                $imageFormat = $imageInfo['mime'];
                // Read binary data from image
                $profilePic = file_get_contents($_FILES[$imageInputName]["tmp_name"]);
                if ($profilePic === false) {
                    return false;
                }
            } else {
                return false;
            }
        }
        else{
            return false;
        }
        $query="UPDATE users 
                SET profilePicture=:profilePic , profilePictureFormat=:profilePicFormat
                WHERE id=:user_id";
        $updateQuery=$this->db->prepare($query);
        if(!$updateQuery){
            return false;
        }
        $updateQuery->bindParam(':profilePic',$profilePic,PDO::PARAM_LOB);
        $updateQuery->bindParam(':profilePicFormat',$imageFormat);
        $updateQuery->bindParam(':user_id',$userId);

        $result=$updateQuery->execute();
        return $result;
    }

    public function extractProfilePic($userId) {
        try {
            $query = "SELECT profilePicture FROM users WHERE id = :user_id";
            $query2 = "SELECT profilePictureFormat FROM users WHERE id = :user_id";
            $takeImg = $this->db->prepare($query);
            $takeImg->bindParam(':user_id', $userId);
            $takeImg->execute();
            $takeImgFormat = $this->db->prepare($query2);
            $takeImgFormat->bindParam(':user_id', $userId);
            $takeImgFormat->execute();

            $imageData = $takeImg->fetchColumn();
            $imageFormat = $takeImgFormat->fetchColumn();

            //check the image data
            if ($imageData) {
                $base64Image = base64_encode($imageData);
                $imgSrc = "data:" . $imageFormat . ";base64," . $base64Image;

            } else {
                $imgSrc="../public/images/user.png";
            }
            return $imgSrc;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateInformation($userId,$username="",$mail=""){
        $fieldsToUpdate = [];
        if ($username) {
            $fieldsToUpdate['Username'] = $username;
        }
        if ($mail) {
            $fieldsToUpdate['Email'] = $mail;
        }
        if (!empty($fieldsToUpdate)) {
            $query = "UPDATE users SET ";
            foreach ($fieldsToUpdate as $field => $value) {
                $query .= "$field=:$field, ";
            }
            $query = rtrim($query, ', '); // Remove trailing comma and space
            $query .= " WHERE id=:user_id";

            // Prepare and execute the query
            $updateQuery = $this->db->prepare($query);
            if (!$updateQuery) {
                return false;
            }
            foreach ($fieldsToUpdate as $field => $value) {
                $updateQuery->bindParam(":$field", $value);
            }
            $updateQuery->bindParam(':user_id', $userId);
            $updateQuery->execute();
        }
    }

}

?>
