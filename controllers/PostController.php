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
}
?>
