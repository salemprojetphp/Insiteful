<?php 
    include_once 'views/header.php';
    require_once 'models/User.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSITEFUL</title>
    <link rel="icon" href="../../public/images/insiteful.png">
    <link rel="stylesheet" href="../../public/css/Blog.css">
    <link rel="stylesheet" href="../../public/css/general.css">
    <script src="../../public/js/Blog.js" defer></script>
</head>

<body>
    <main class="flex" style="margin-top:12%">
        <!-- filter buttons  -->
        <div class="filter-box flex">
            <button class="filter-btn selected" id="all-btn">All</button>
            <button class="filter-btn" id="recent-btn">Recent</button>
            <button class="filter-btn" id="pertinence-btn">Pertinence</button>
            <button class="filter-btn" id="popular-btn">Popular</button>
        </div>

        <!-- add btn for admin  -->
        <?php
            $userModel = new User();
            session_start();
            $user = $userModel->getUserById($_SESSION['user_id']);
            if($user && $user->Role == "Admin"){
                echo "<a href='/addPost' class='add-btn'>+</a>";
            }
        ?>

        <!-- contenu -->
        <section class="blog">
            <div class="content">
                <!-- newsletter -->
                <div class="blog-sidebar newsletter gradient-orange">
                    <h3 class="mb8">Newsletter</h3>
                    <div class="caption gray mb16">No spam, ever. Only musings and writings.</div>
                    <form id="newsletter-subscribe" method="POST">
                        <input type="text" class="width-full mb16" name="mail" placeholder="Enter your email" />
                        <button type="submit" name="button" class="btn-white">Subscribe</button>
                    </form>         
                </div> 

                <!-- blog  -->
                <div class="blog-articles" id="blogContainer">
                    <h1 class="h2 mb32">Blog</h1>
                    <!-- Articles -->
                        <?php
                            $postDisplayer= new Post();
                            echo $postDisplayer->getAllPosts();
                        ?>
            </div>
        </section>
    </main>
    <footer></footer>
</body>

</html>
