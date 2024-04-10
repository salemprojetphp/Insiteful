<?php 
    session_start();
    require_once 'models/User.php';
    $userModel = new User();
    $user = $userModel->getUserById($_SESSION['user_id']);
    include_once 'views/header.php';
    if(($_SESSION['user_id'])!=null){
        $logged="true";
    } else {
        $logged="false";
    }
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $currentFilter = isset($_GET['filter']) ? $_GET['filter'] : 'recent';
?>


<link rel="stylesheet" href="../../public/css/Blog.css">
<link rel="stylesheet" href="../../public/css/general.css">
<script src="../../public/js/Blog/Blog.js" defer></script>
<script src="../../public/js/Blog/LikeSystem.js" defer></script>


<body class="<?= $logged?>">
    <main class="flex" style="margin-top:12%">
        <!-- filter buttons  -->
        <div class="filter-box flex">
            <a href="/blog?page=<?=$currentPage?>&filter=recent" class="filter-btn<?= $currentFilter === 'recent' ? ' selected' : '' ?>" id="recent-btn">Recent</a>
            <a href="/blog?page=<?=$currentPage?>&filter=old" class="filter-btn<?= $currentFilter === 'old' ? ' selected' : '' ?>" id="less-recent-btn">Old</a>
            <a href="/blog?page=<?=$currentPage?>&filter=popular" class="filter-btn<?= $currentFilter === 'popular' ? ' selected' : '' ?>" id="popular-btn">Popular</a>
        </div>

        <!-- add btn for admin  -->
        <?php
            if($user && $user->Role == "Admin"){
                echo "<a href='/addPost' class='add-btn'>+</a>";
            }
        ?>

        <!-- contenu -->
        <section class="blog">
            <div class="content">
                <!-- blog  -->
                <div class="blog-articles" id="blogContainer">
                    <h1 class="h2 mb32">Blog</h1>
                    <!-- Articles -->
                        <?php
                            $postDisplayer= new Post();
                            echo $postDisplayer->getAllPosts($page=$currentPage,$filter=$currentFilter);
                        ?>
                </div>

                <!-- newsletter -->
                <div class="blog-sidebar newsletter gradient-orange">
                    <h3 class="mb8">Welcome</h3>
                    <div class="caption gray mb16">Our dedicated team uploads interesting articles on a weekly basis, covering a wide range of topics to inform, inspire, and entertain.</div>
                </div> 
            </div>
        </section>

        <!-- Pagination buttons -->
        <div class="pagination">
            <?php
            $totalPages = ceil($postDisplayer->getTotalPostsCount() / 5);
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($totalPages > 8) {
                    if ($i == $currentPage) {
                        echo "<a href='?page=$i&filter=$currentFilter' class='pagination-btn btn-white page-selected'>$i</a>";
                    } elseif ($i == $totalPages || ($i >= $currentPage - 2 && $i <= $currentPage + 2)) {
                        echo "<a href='?page=$i&filter=$currentFilter' class='pagination-btn btn-white'>$i</a>";
                    } elseif ($i == $currentPage - 3 || $i == $currentPage + 3) {
                        echo "<span>...</span>";
                    }
                } else {
                    if ($i == $currentPage) {
                        echo "<a href='?page=$i&filter=$currentFilter' class='pagination-btn btn-white page-selected'>$i</a>";
                    } else {
                       echo "<a href='?page=$i&filter=$currentFilter' class='pagination-btn btn-white'>$i</a>"; 
                    }
                }
            }
            ?>
        </div>
    </main>
    <footer></footer>
</body>

</html>
