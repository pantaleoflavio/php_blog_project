<!-- Header -->
<?php include_once 'includes/header.php' ?>

<!-- Navigation -->
<?php include_once 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            $per_page = 4;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

$all_post_count = "SELECT * from posts";
$all_post_count_query = mysqli_query( $connection, $all_post_count);
$count = mysqli_num_rows($all_post_count_query);

$count = ceil($count / $per_page);

if ($count > 0) {

    $query = "SELECT * from posts WHERE post_status = 'published' ORDER BY post_date DESC LIMIT $page_1, $per_page";
    $all_posts = mysqli_query($connection, $query);

    if (mysqli_num_rows($all_posts) == 0) {
        echo "<h1 class='text-center text-uppercase bg-primary'>no posts published</h1>";
    } else {
    while ($row = mysqli_fetch_assoc($all_posts)) {
        $post_id = escape($row['post_id']);
        $post_title = escape($row['post_title']);
        $post_author = escape($row['post_author']);
        $post_date = escape($row['post_date']);
        $post_image = escape($row['post_image']);
        $post_content = substr(escape($row['post_content']), 0, 400);
        $post_status =  escape($row['post_status']);

        ?>
            <!-- First Blog Post -->
            
            <h2 class="text-uppercase">
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="user_page.php?source=user_details&user=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
    <?php

        } //end while posts
    }
} else {
    echo "<h2 class='text-center text-uppercase bg-warning'>sorry there are no posts</h2>";
}
        
    ?>

    </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
                
        <?php include_once './includes/sidebar.php' ?>
        </div>
        <!-- /.row -->

        <hr>

    
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
            <a href="" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
            </li>

        <?php
        for ($i=1; $i <= $count ; $i++) { 
            if ($i == $page) {
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
            
        } 
        
        ?>
            <li>
            <a href="" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
            </li>
        </ul>
    </nav>

               <!-- Footer -->
        <?php include_once './includes/footer.php' ?>