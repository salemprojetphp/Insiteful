<?php
    require_once 'views/header.php';
    require_once 'models/Post.php';
    require_once 'models/Comment.php';
    require_once 'models/User.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $postId = $_GET['id'];
    $postModel = new Post();
    $commentModel = new Comment();
    $post = $postModel->getPostById($postId);
    $userModel = new User();
    $user_id=$_SESSION['user_id'];
    if($user_id){
        $user= $userModel->getUserById($user_id);
        $username = $user->Username;
    } else {
        $username = "";
    }
    if(isset($_GET['comment'])) {
        echo '<script>
        window.onload = function() { document.querySelector("#comments").scrollIntoView(); }
        </script>';
    }
    if(($_SESSION['user_id'])!=null){
        $logged="true";
        
    } else {
        $logged="false";
    }
?>

<link rel="stylesheet" href="../../public/css/general.css">
<link rel="stylesheet" href="../../public/css/Article.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="../../public/js/Blog/Article.js" defer></script>
<script src="../../public/js/Blog/LikeSystem.js" defer></script>
<script src="../../public/js/Blog/CommentSystem.js" defer></script>
<body class="<?= $logged?>">
    <main class="flex" id='<?= $username ?>'>
        <div class="content">
            <!-- Article  -->
            <h2 style="position: absolute; z-index:3;"><a href="/blog"><</a></h2>
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
                            <img src='../public/images/<?= $postModel->isLiked($postId)?>.svg' alt='like'>
                            <p>
                                <?php
                                    echo $postModel->nbLikes($postId);
                                ?>
                            </p>
                        </button>
                        <button>
                            <img src="../public/images/comment.svg" alt="comment">
                            <p class="nb-comments">
                                <?php
                                    echo $postModel->nbComments($postId);
                                ?>
                            </p>
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
            <div class="comments-container" id="comments">
                <h2 class="h2 mb32">Comments</h2>
                <div class="comment-form">
                    <form id="comment-form" method="POST" action="/blog/comment?id=<?= $postId?>">
                        <textarea name="comment" class="mb16" placeholder="Write your comment here"></textarea>
                        <button type="submit" name="button" class="btn-white comment-btn">Comment</button>
                    </form>
                </div>
                <div class="comments">
                    <!-- Comment -->
                    <?php
                        echo $commentModel->displayComments($postId);
                    ?>
                </div>
            </div>
        </div>

        <!-- newsletter -->
        <div class="blog-sidebar newsletter gradient-orange">
            <h3 class="mb8">Welcome</h3>
            <div class="caption gray mb16">Our dedicated team uploads interesting articles on a weekly basis, covering a wide range of topics to inform, inspire, and entertain.</div>
        </div> 
    </main>
    <footer></footer>
</body>
</html>