<?php
    include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSITEFUL</title>
    <link rel="icon" href="../public/images/insiteful.png">
    <link rel="stylesheet" href="../public/css/general.css">
    <link rel="stylesheet" href="../public/css/addPostForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <main class="flex">
        <!-- add post form -->
        <form action="" class="add-post-form gradient-white flex ml64">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Title" class="title-input">
            <br>
            <label for="content">Content</label>
            <textarea name="content" placeholder="Content" class="content-input"></textarea>
            <br>
            <label for="image">Image</label>
            <input type="file" name="image">
            <br>
            <div class="btn-container">
                <a href="Blog.php" class="btn-white">Cancel</a>
                <input type="submit" value="Add" class="btn-blue">
            </div>
        </form>
    </main>    
</body>
</html>