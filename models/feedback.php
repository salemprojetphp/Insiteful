<?php
require_once 'Model.php';

class Feedback extends Model
{
    public $db;

    public function insert($feedback)
    {
        $date = date('Y-m-d H:i', strtotime(date('Y-m-d H:i') . ' -1 hour'));
        $query = "INSERT INTO Feedbacks (Feedback,Date) VALUES (?,?)";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$feedback,$date]);
    }
    public function getFeedbacks(){
        $query = "select f.id, u.Username, f.Feedback, f.Date from feedbacks f inner join users u on f.user_id= u.id where  Hidden=False";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute();
        return $queryPrep->fetchAll(PDO::FETCH_OBJ);
    }
    public function hide($id){
        $query = "update feedbacks set Hidden = True where id = ?";
        $queryPrep = $this->db->prepare($query);
        $queryPrep->execute([$id]);
    }
}

?>
