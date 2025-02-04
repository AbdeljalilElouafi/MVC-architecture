<?php

namespace App\Models;
use App\Core\Database;
use PDO;

class Article {
    private $db;
    
    public function __construct() {
        try {
            $this->db = Database::getInstance();

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new \Exception("Database connection failed");
        }
    }

    public function getAllArticles() {
        try {
            $stmt = $this->db->query("SELECT * FROM public.articles");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            error_log("Failed to fetch articles: " . $e->getMessage());
            return [];
        }
    }


    public function getArticle($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM public.articles WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Failed to fetch article: " . $e->getMessage());
            return null;
        }
    }

    public function createArticle($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO public.articles (title, content, user_id) 
                VALUES (:title, :content, :user_id)
            ");
            return $stmt->execute($data);
        } catch (\PDOException $e) {
            error_log("Failed to create article: " . $e->getMessage());
            return false;
        }
    }
}