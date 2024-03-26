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
    <link rel="stylesheet" href="../public/css/Blog.css">
</head>

<body>

    <main class="flex">
        <!-- filter buttons  -->
        <div class="filter-box flex">
            <button class="filter-btn selected" id="all-btn">All</button>
            <button class="filter-btn" id="recent-btn">Recent</button>
            <button class="filter-btn" id="pertinence-btn">Pertinence</button>
            <button class="filter-btn" id="popular-btn">Popular</button>
        </div>
        
        <a href="AddForm.php" class="add-btn">+</a>
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
                    <a href="" class="blog-article bg-white shadow-sm mb32">
                        <div class="blog-preview">
                            <img src="../public/images/hello.svg" width="258" height="200" alt="Hello blog world">
                        </div>
                        <div class="blog-article-content">
                            <h2 class="h3 mb16 black">No News is Good News</h2>
                            <div class="blog-description gray mb24">Everything is operating normally.</div>
                            <div class="blog-article-content-info flex caption gray">
                                <div class="flex">
                                    <img src="../public/images/user.png" width="24" height="24" alt="author">
                                    <span class="ml8 mr24">Irae Hueck Costa</span>
                                        Apr 14, 2023
                                </div>
                                <div class="interact flex">
                                    <button><img src="../public/images/like.svg" alt="like"></button>
                                    <button><img src="../public/images/comment.svg" alt="comment"></button>
                                    <button><img src="../public/images/more.svg" alt="more"></button>
                                </div>
                            </div>
                        </div>
                    </a>
    
                <a href="" class="blog-article bg-white shadow-sm mb32">
                    <div class="blog-preview">
                        <img src="../public/images/hello.svg" width="258" height="200" alt="Hello blog world">
                    </div>
                    <div class="blog-article-content">
                        <h2 class="h3 mb16 black">External tracking script</h2>
                        <div class="blog-description gray mb24">No more inline javascript needed</div>
                        <div class="blog-article-content-info flex caption gray">
                            <div class="flex">
                                <img src="../public/images/user.png" width="24" height="24" alt="author">
                                <span class="ml8 mr24">Irae Hueck Costa</span>
                                Sep 18, 2022
                            </div>
                            <div class="interact flex">
                                <button><img src="../public/images/like.svg" alt="like"></button>
                                <button><img src="../public/images/comment.svg" alt="comment"></button>
                                <button><img src="../public/images/more.svg" alt="more"></button>
                            </div>
                        </div>
                    </div>
                </a>
    
                <a href="" class="blog-article bg-white shadow-sm mb32">
                    <div class="blog-preview">
                        <img src="../public/images/hello.svg" width="258" height="200" alt="Hello blog world">
                    </div>
                    <div class="blog-article-content">
                        <h2 class="h3 mb16 black">Hello blog world</h2>
                        <div class="blog-description gray mb24">We have a blog now.</div>
                        <div class="blog-article-content-info flex caption gray">
                            <div class="flex">
                                <img src="../public/images/user.png" width="24" height="24" alt="author">
                                <span class="ml8 mr24">Irae Hueck Costa</span>
                                May 22, 2022
                            </div>
                            <div class="interact flex">
                                <button><img src="../public/images/like.svg" alt="like"></button>
                                <button><img src="../public/images/comment.svg" alt="comment"></button>
                                <button><img src="../public/images/more.svg" alt="more"></button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </main>
    <footer></footer>
</body>
<script src="../public/js/Blog.js"></script>
</html>
