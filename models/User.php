<?php
require_once 'Model.php';

class User  extends Model{
    private $db;

    public function getUsers() {
        $query = $this->db->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
