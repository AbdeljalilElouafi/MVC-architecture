<?php


namespace App\Controller;
use App\Models\Article;
use App\Core\Controller;

class ArticleController extends Controller {
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
            // echo'in the index of articlecontroller';
            $articles = $this->articleModel->getAllArticles();

            $this->render('articles/index', ['articles'=>$articles]);
            // require_once '../app/views/articles/index.php';
        } catch (\Exception $e) {

            $this->render('error/405');

            // require_once '../app/views/error/405.php';
        }
    }
    public function show($id) {
        $article = $this->articleModel->getArticle($id);
        if (!$article) {

            http_response_code(404);
            require '../app/views/error/404.php';
            return;
        }

        $this->render('articles/show', ['article'=>$article]);

        // require '../app/views/articles/show.php';
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

        $this->render('articles/create');

        // require_once '../app/views/articles/create.php';
    }
}
