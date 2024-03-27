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
    <main class="flex" style = "margin-top:12%">
        <!-- add post form -->
        <form action="" class="add-post-form gradient-white flex">
            <h2 style="position: absolute"><a href="Blog.php"><</a></h2>
            <h2 class="mb32 form-title">Add Post</h2>
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Title" class=" ml8 title-input">
            <br>
            <label for="content">Content</label>
            <textarea name="content" placeholder="Content" class=" ml8 content-input"></textarea>
            <br>
            <label for="image">Image</label>
            <input type="file" name="image" class = "image-input ml8">
            <br>
            <div class="btn-container">
                <a href="Blog.php" class="btn-white">Cancel</a>
                <input type="submit" value="Add" class="btn-blue">
            </div>
        </form>
    </main>    
</body>
</html>