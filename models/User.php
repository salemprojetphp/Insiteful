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
