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
}

?>
