<?php
require_once 'Model.php';

class Verification extends Model{
    public $db;
    
    public function insertVerificationToken($email, $token){
        $query = "insert into verification(email, verification_code) values (?, ?)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$email, $token]);
    }

    public function verifiy($email, $token){
        $query = "select * from verification where email = ? and verification_code = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$email, $token]);
        $queryResult = $queryPrep->fetch(PDO::FETCH_OBJ);
        if($queryPrep->rowCount() == 0){
            return false;
        }
        else{
            $query = "Update users set Verified = 1 where Email = ?";
            $query2 = "delete from verification where email = ?";
            $queryPrep = $this->db->prepare($query);
            $queryPrep2 = $this->db->prepare($query2);
            $queryPrep->execute([$email]);
            $queryPrep2->execute([$email]);
            return true;
        }
    }
}