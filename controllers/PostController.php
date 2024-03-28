<?php
require_once '../models/Post.php';
       
class PostController {
    public function handleFormSubmission() {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postAdder = new Post(); 
        $postAdder->insert($title, $content, 2, date("Y-m-d"), "image");
        header("Location: ../views/Blog.php");
    }

    public function handleDeletePost() {
        $postId = $_POST["postId"];
        $postDeleter = new Post();
        $postDeleter->delete($postId);
        header("Location: ../views/Blog.php");
    }
}
?>
