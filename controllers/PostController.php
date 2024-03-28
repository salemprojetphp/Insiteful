<?php
require_once __DIR__ . '\\..\\models\\Post.php';

class PostController {
    public function blog(){
        require_once 'views/blog.php';
    }

    public function addPost(){
        require_once 'views/addPost.php';
    }

    public function handleFormSubmission() {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postAdder = new Post(); 
        // TODO: author id should be dynamic instead of 2 
        $postAdder->insert($title, $content, 2, date("Y-m-d"), "image");
        header("Location: /blog");
    }

    public function handleDeletePost() {
        $jsonData = file_get_contents('php://input');

        $data = json_decode($jsonData, true);

        // Access the postId from the decoded data
        $postId = $data['postId'];

        $postDeleter = new Post();
        $postDeleter->delete($postId);
        header("Location: /blog");
    }
}
?>
