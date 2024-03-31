<?php
require_once __DIR__ . '\\..\\models\\Post.php';
require_once 'Controller.php';
require_once __DIR__ . '\\..\\models\\User.php';

class PostController extends Controller{
    public function blog(){
        require_once 'views/Blog/Blog.php';
    }

    public function addPost(){
        require_once 'views/Blog/addPost.php';
    }

    public function edit(){
        require_once 'views/Blog/editPost.php';
    }
    
    public function handleFormSubmission() {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postAdder = new Post(); 
        $userModel = new User();
        session_start();
        $userId= $_SESSION['user_id'];
        $postAdder->insert($title, $content, $userId, date("Y-m-d"), "image");
        header("Location: /blog");
    }

    public function handleDeletePost() {
        $postId = $_GET['id'];
        $postDeleter = new Post();
        $postDeleter->delete($postId);
        header("Location: /blog");
    }

    public function handleEditPost() {
        $postId = $_GET["id"];
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postEditor = new Post();
        $postEditor->edit($title, $content, $postId,"image");
        header("Location: /blog");
    }

    public function fullArticle(){
        require_once 'views/Blog/Article.php';
    }

}
?>
