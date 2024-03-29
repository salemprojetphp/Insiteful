<?php
require_once 'Model.php';

class User  extends Model{
    public $db;

    public function getUsers() {
        $query = $this->db->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
    public function isVerified($email){
        $query = "select Verified from users where Email = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$email]);
        $queryResult = $queryPrep->fetch(PDO::FETCH_OBJ);
        return $queryResult->Verified;
    }

    public function setPassword($email, $password){
        $query = "Update users set Password = ? where Email = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$password, $email]);

    }

}
?>
