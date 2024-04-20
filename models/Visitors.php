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
    public function getUserWebsiteInformation($user_id, $website){
        $query = "Select date, referrer, country, device, browser from visitors where user_id = ? and website = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
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
        $query = "select count(website) as number from visitors where user_id=? and website = ? and browser !='Other' ";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetch(PDO::FETCH_OBJ);
        return ($queryRes->number);
    }
    public function generateJSONFile($queryRes, $JSONFileName, $colonne){
        //the following takes the query result as an std::obj and transforms it into an array like key(column)=>value(value)
        $data = array();
        if($queryRes != ''){
            foreach($queryRes as $result) : 
                $data[$result->$colonne] = $result->number;
            endforeach;
        }
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
        $this->generateJSONFile($queryRes , $json, $colonne);
    }

    public function generateAdminChartJSONFile($colonne, $json){
        $query = "select $colonne, count($colonne) as number from visitors group by($colonne)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $this->generateJSONFile($queryRes, "/adminjson/$json", $colonne);
    }
    public function generateAdminDonutChartJSONFile($table, $json){
        $query = "select p.title as post, count(p.title) as number from post p inner join $table l on p.id = l.post_id group by(p.title)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $this->generateJSONFile($queryRes, "/adminjson/$json", "post");
    }
    public function generateHTMLTable($website){


    }
}
?>