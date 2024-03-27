<?php
require_once '../models/Post.php';
$title = $_POST["title"];
$content = $_POST["content"];
$image = $_FILES["image"];
ECHO $title;
ECHO $content;
ECHO !($image);
$postAdder = new Post(); // Assuming PostAdder is a class to handle post insertion
$postAdder->insert($title, $content, 2, date("Y-m-d"), $image);
echo "Form submitted successfully!";
// require_once 'insiteful/views/AddForm.php';
// class PostController {
//     public function handleFormSubmission() {
        
//     }
// }
?>
