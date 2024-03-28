<?php
// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);

// Access the postId from the decoded data
$postId = $data['postId'];

// Now you can use $postId to delete the post
require_once '../../models/Post.php';
$postDeleter = new Post();
$postDeleter->delete($postId);
header("Location: ../../views/Blog.php");
?>
