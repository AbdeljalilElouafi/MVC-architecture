<?php

namespace App\Models;

use Core\Database;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getUser ($id) {
        $stmt = $this->db->prepare("SELECT * FROM public.\"user\" WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

 
}