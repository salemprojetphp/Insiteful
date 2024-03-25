<?php

require_once 'Database.php';
class Model {
    public $db;

    public function __construct() {
        $this->db = Database::getDatabase();
    }
}
?>
