
<?php
require_once '../../models/Post.php';
$title = $_POST["title"];
$content = $_POST["content"];
$postAdder = new Post(); 
$postAdder->insert($title, $content, 2, date("Y-m-d"), "image");
header("Location: ../views/Blog.php");
?>