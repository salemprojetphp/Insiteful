<?php
    include_once 'views/header.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSITEFUL</title>
    <link rel="icon" href="../../public/images/insiteful.png">
    <link rel="stylesheet" href="../../public/css/general.css">
    <link rel="stylesheet" href="../../public/css/PostForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="../../public/js/PostForm.js" defer></script>
</head>

<body>
    <main class="flex">
        <form action="/addPost/action" method="post" enctype="multipart/form-data" class="add-post-form gradient-white flex">
            <h2 style="position: absolute"><a href="/blog"><</a></h2>
            <h2 class="mb32 form-title">Add Post</h2>
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Title" class=" ml8 title-input">
            <br>
            <label for="content">Content</label>
            <textarea name="content" placeholder="Content" class=" ml8 content-input"></textarea>
            <br>
            <label for="bg-color">Background Color</label>
            <div class="color-inputs">
                <input type="color" name="bg-color1" class="ml8 bg-color-input" value="#00ffff">
                <input type="color" name="bg-color2" class="ml8 bg-color-input" value="#147efb">
            </div>
            <br>
            <label for="image">Image</label>
            <div class="image-input-container">
                <input type="file" name="image" class = "image-input ml8" value="<?= $imgSrc?>">
                <a class="btn-white" id="no-img-btn">Delete Image</a>
            </div>
            <br>
            <div class="image-preview">
                <img src="<?= $imgSrc?>" alt="" class="image-preview-image">
            </div>
            <div class="btn-container">
                <a href="/blog" class="btn-white">Cancel</a>
                <input type="submit" value="Add" class="btn-blue" id="add-btn">
            </div>
        </form>
    </main>    
</body>
</html>
<?php
include_once 'footer.php';?>