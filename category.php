<!-- Header -->
<?php include_once './includes/header.php' ?>

<!-- Navigation -->
<?php include_once './includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php

if (isset($_GET['category'])) {
    $cat_id = escape($_GET['category']);
}
            $query = "SELECT * from posts WHERE post_id_category = $cat_id ";
            $query .= "ORDER BY post_date DESC";
            $all_posts = mysqli_query( $connection, $query);

            if (mysqli_num_rows($all_posts) == 0) {
                echo "<h1 class='text-center text-uppercase bg-primary'>no posts related</h1>";
            } else {

                while ($row = mysqli_fetch_assoc($all_posts)) {
                    $post_id = escape($row['post_id']);
                    $post_title = escape($row['post_title']);
                    $post_author = escape($row['post_author']);
                    $post_date = escape($row['post_date']);
                    $post_image = escape($row['post_image']);
                    $post_content = substr(escape($row['post_content']), 0, 400);
                    $post_id_category = escape($row['post_id_category']);

        ?>
                    <!-- First Blog Post -->
                    <h2>
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

                <?php } //end while
            } //end else?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                
            <?php include_once './includes/sidebar.php' ?>

        <!-- /.row -->

        <hr>

               <!-- Footer -->
        <?php include_once './includes/footer.php' ?>