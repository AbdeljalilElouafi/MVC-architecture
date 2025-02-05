<?php

namespace App\Models;

use App\Core\Database;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getUser ($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM public.user WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Failed to fetch article: " . $e->getMessage());
            return null;
        }
    }

 
}