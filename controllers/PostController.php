<?php
require_once '../models/Post.php';
class PostController {
    public function handleFormSubmission() {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $image = $_FILES["image"];
        ECHO $title;
        ECHO $content;
        ECHO !($image);
        $postAdder = new Post(); 
        $postAdder->insert($title, $content, 2, date("Y-m-d"), $image);
        echo "Form submitted successfully!";
    }
}
?>
