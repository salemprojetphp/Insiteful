<?php
require_once "Model.php";

class Visitors extends model{
    public $db;
    public function getUserWebsites($user_id){
        $query = "Select distinct website from visitors where user_id = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id]);
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        return($queryRes);
    }
    public function getNumberOfVisits($user_id, $website){
        $query = "select count(website) as number from visitors where user_id=? and website = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetch(PDO::FETCH_OBJ);
        return ($queryRes->number);
    }
    public function getNumberOfDirectVisits($user_id, $website){
        $query = "select count(website) as number from visitors where user_id=? and website = ? and referrer= 'Direct'";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetch(PDO::FETCH_OBJ);
        return ($queryRes->number);
    }
    public function getNumberOfSocialMediaVisits($user_id, $website){
        $query = "select count(website) as number from visitors where user_id=? and website = ? and referrer !='Direct' ";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetch(PDO::FETCH_OBJ);
        return ($queryRes->number);
    }
    public function getNumberOfSearchEngines($user_id, $website){
        $query = "select count(website) as number from visitors where user_id=? and website = ? and browswer !='Other' ";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetch(PDO::FETCH_OBJ);
        return ($queryRes->number);
    }
}
?>