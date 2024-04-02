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
    public function generateLineChartJSONFile($user_id, $website){
        $query = "select date, count(website) as number from visitors where user_id=? and website = ? group by (date)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        //putting the data in an array to put in a json file as key:value
        $data = array();
        foreach($queryRes as $result) : 
            $data[$result->date] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "lineChart");
    }

    public function generateBrowsersDonutChartJSONFile($user_id, $website){
        $query = "select browswer, count(website) as number from visitors where user_id=? and website = ?  group by(browswer)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->browswer] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "browsersDonutChart");
    }
    public function generateDevicesDonutChartJSONFile($user_id, $website){
        $query = "select device, count(website) as number from visitors where user_id=? and website = ? group by(device)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->device] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "devicesDonutChart");
    }
    public function generateSourcesJSONFile($user_id, $website){
        $query = "select referrer, count(website) as number from visitors where user_id=? and website = ? group by(referrer)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->referrer] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "sources");
    }
    public function generateCountriesJSONFile($user_id, $website){
        $query = "select country, count(website) as number from visitors where user_id=? and website = ? group by(country)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$user_id, $website]);
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->country] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "countries");
    }
    public function generateWebsitesLineChartJSONFile(){
        $query = "select website, count(website) as number from visitors group by(website)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->website] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "/adminjson/websitesLineChart");
    }
    public function generateLikesDonutChartJSONFile(){
        $query = "select p.title as post, count(p.title) as number from post p inner join likes l on p.id = l.post_id group by(p.title)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->post] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "/adminjson/likesDonutChart");
    }
    public function generateCommentsDonutChartJSONFile(){
        $query = "select p.title as post, count(p.title) as number from post p inner join comments c on p.id = c.post_id group by(p.title)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        $queryRes = $queryPrep->fetchAll(PDO::FETCH_OBJ);
        $data = array();
        foreach($queryRes as $result):
            $data[$result->post] = $result->number;
        endforeach;
        $this->generateJSONFile($data, "/adminjson/commentsDonutChart");
    }
}
?>