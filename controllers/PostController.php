<?php
require_once __DIR__ . '\\..\\models\\Post.php';
require_once 'Controller.php';
require_once __DIR__ . '\\..\\models\\User.php';
require_once __DIR__ . '\\..\\models\\Comment.php';

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
        $bgColor = 'linear-gradient(96.55deg, ' . $_POST['bg-color1'] .' -25.2%, ' . $_POST['bg-color2'] .' 55.15%)';
        echo $bgColor;
        $postAdder = new Post(); 
        $userModel = new User();
        session_start();
        $userId= $_SESSION['user_id'];
        $postAdder->insert($title, $content, $userId, date("Y-m-d"), "image",$bgColor);
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
        $bgColor = 'linear-gradient(96.55deg,' . $_POST['bg-color1'] .' -25.2%, ' . $_POST['bg-color2'] .' 55.15%)';
        $postEditor = new Post();
        $postEditor->edit($title, $content, $postId,"image",$bgColor);
        header("Location: /blog");
    }

    public function fullArticle(){
        require_once 'views/Blog/Article.php';
    }

    public function like(){
        $postId = $_GET['id'];
        session_start();
        $userId= $_SESSION['user_id'];
        $postLiker = new Post();
        $postLiker->like($userId,$postId);
    }

    public function dislike(){
        $postId = $_GET['id'];
        session_start();
        $userId= $_SESSION['user_id'];
        $postDisliker = new Post();
        $postDisliker->dislike($userId,$postId);
    }

    public function addComment(){
        $postId = $_GET['id'];
        $comment = $_POST['comment'];
        session_start();
        $user_id=$_SESSION['user_id'];
        $commentAdder = new Comment();
        $commentAdder->addComment($user_id,$postId,$comment);
    }

    public function deleteComment(){
        $comment_id = $_GET['id'];
        $commentDeleter = new Comment();
        $commentDeleter->deleteComment($comment_id);
    }

    public function editComment(){
        $comment_id=$_GET['id'];
        $comment=$_GET['content'];
        $commentEditor = new Comment();
        $commentEditor->editComment($comment_id,$comment);
    }

    public function getCommentId(){
        $commentModel = new Comment();
        $commentModel->getCommentId();
    }

}
?>
