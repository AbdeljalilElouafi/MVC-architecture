<?php


namespace App\Controller;
use App\Models\Article;

class ArticleController {
    private $articleModel;

    public function __construct() {
        try {
            $this->articleModel = new Article();
        } catch (\Exception $e) {

            die("Could not initialize the article system");
        }
    }

    public function index() {
        try {
            echo'in the index of articlecontroller';
            $articles = $this->articleModel->getAllArticles();

            require_once '../app/views/articles/index.php';
        } catch (\Exception $e) {

            require_once '../app/views/error/405.php';
        }
    }
    public function show($id) {
        $article = $this->articleModel->getArticle($id);
        if (!$article) {

            http_response_code(404);
            require '../app/views/error/404.php';
            return;
        }
        require '../app/views/articles/show.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'user_id' => $_POST['user_id']
            ];
            $this->articleModel->createArticle($data);
            header('Location: /articles');
        }
        require_once '../app/views/articles/create.php';
    }
}
