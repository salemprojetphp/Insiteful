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
        //putting the data in json file
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
    public function generateJSONFile($data, $JSONFileName){
        //putting the data in the json file
        $encoded_data = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
        file_put_contents("public/json/".$JSONFileName.".json", $encoded_data);
    }
    public function generateChartJSONFile($user_id, $website, $colonne, $json){
        $query = "select $colonne, count(website) as number from visitors where user_id=? and website = ? group by ($colonne)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        //putting the data in an array to put in a json file as key:value
        $data = array();
        foreach($queryRes as $result) : 
            $data[$result->$colonne] = $result->number;
        endforeach;
        $this->generateJSONFile($data, $json);
    }

    public function generateAdminChartJSONFile($colonne, $json){
        $query = "select $colonne, count($colonne) as number from visitors group by($colonne)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->$colonne] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "/adminjson/$json");
    }
    public function generateAdminDonutChartJSONFile($table, $json){
        $query = "select p.title as post, count(p.title) as number from post p inner join $table l on p.id = l.post_id group by(p.title)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->post] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "/adminjson/$json");
    }
}
?>