<?php
    require_once 'views/header.php';
    require_once 'models/Post.php';
    session_start();
    $postId = $_GET['id'];
    $postModel = new Post();
    $post = $postModel->getPostById($postId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSITEFUL</title>
    <link rel="icon" href="../../public/images/insiteful.png">
    <link rel="stylesheet" href="../../public/css/general.css">
    <link rel="stylesheet" href="../../public/css/Article.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="../../public/js/Article.js" defer></script>
</head>
<body>
    <main class="flex">
        <div class="content">
            <!-- Article  -->
            <div class="article-container">
                <h1 class="h2 mb32"><?= $post['title'] ?></h1>
                <p class="article-content"><?= $post['content']?></p>
                <img src="<?= $post['imgSrc'] ?>" alt="article-image" class="article-img mb16">
                <div class="article-info flex">
                    <div class="author-info">
                        <img src="../public/images/user.png" width="32" height="32" alt="author">
                        <span class="ml8 mr32"><?= $post['author']?></span>
                    </div>
                    <span class="caption gray"><?= $post['date'] ?></span>
                    <div class="interact">
                        <button class="like-btn">
                            <img src="../public/images/like.svg" alt="like">
                            <p>0</p>
                        </button>
                        <button>
                            <img src="../public/images/comment.svg" alt="comment">
                            <p>0</p>
                        </button>
                        <?php
                        if(isset($_SESSION['user']) && $_SESSION['user']->Role == "Admin"){
                            echo "<button class='more-btn'><img src='../public/images/more.svg' alt='more'></button>";
                            echo "<div class='dropdown-menu'>
                                    <button class='edit-btn' data-post-id='" .$post["postId"]."'>Edit</button>
                                    <button class='delete-btn' data-post-id='" .$post["postId"]."' >Delete</button>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>    
            
            <!-- newsletter -->
            <div class="blog-sidebar newsletter gradient-orange">
                <h3 class="mb8">Newsletter</h3>
                <div class="caption gray mb16">No spam, ever. Only musings and writings.</div>
                <form id="newsletter-subscribe" method="POST">
                    <input type="text" class="width-full mb16" name="mail" placeholder="Enter your email" />
                    <button type="submit" name="button" class="btn-white">Subscribe</button>
                </form>         
            </div> 
        </div>
        <div class="comments-container">
            <h2 class="h2 mb32">Comments</h2>
            <div class="comment-form">
                <form id="comment-form" method="POST">
                    <textarea name="comment" class="width-full mb16" placeholder="Write your comment here"></textarea>
                    <button type="submit" name="button" class="btn-white">Comment</button>
                </form>
            </div>
            <div class="comments">
                <!-- Comment -->
                <div class="comment">
                    <div class="comment-info flex">
                        <img src="../public/images/user.png" width="32" height="32" alt="author">
                        <span class="ml8 mr32">John Doe</span>
                        <span class="caption gray">2 hours ago</span>
                    </div>
                    <p class="comment-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec purus ut libero ultricies ultricies. Nullam nec purus ut libero ultricies ultricies.</p>
                    <!-- <div class="interact">
                        <button class="like-btn">
                            <img src="../public/images/like.svg" alt="like">
                            <p>0</p>
                        </button>
                        <button>
                            <img src="../public/images/comment.svg" alt="comment">
                            <p>0</p>
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>