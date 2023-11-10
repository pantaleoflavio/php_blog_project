<!-- Header -->
<?php include_once './includes/header.php' ?>

    <!-- Navigation -->
    <?php include_once './includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

            <?php
if (isset($_GET['p_id'])) {
    $selected_post_id = escape($_GET['p_id']);

    $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = '{$selected_post_id}' ";
    $view_query = mysqli_query($connection, $query);
    confirmQuery($view_query);

    $query = "SELECT * from posts where post_id = '$selected_post_id'";
    $one_post = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($one_post)) {
        $post_id = escape($row['post_id']);
        $post_title = escape($row['post_title']);
        $post_author = escape($row['post_author']);
        $post_date = escape($row['post_date']);
        $post_image = escape($row['post_image']);
        $post_content = escape($row['post_content']);
        ?>

            <!-- Blog Post -->
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
            <hr>

    <?php } 


} else {
    header("Location: index.php");
} ?>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php include 'comments.php' ?>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                $query = "SELECT * from comments WHERE comment_id_post = {$selected_post_id} ";
                $query .= "AND comment_status = 'approved' ORDER BY comment_date DESC";
                $approved_comments = mysqli_query( $connection, $query);
                while ($row = mysqli_fetch_assoc($approved_comments)) {
                    $comment_id = escape($row['id']);
                    $comment_id_post = escape($row['comment_id_post']);
                    $comment_author = escape($row['comment_author']);
                    $author_email = escape($row['author_email']);
                    $comment_content = escape($row['comment_content']);
                    $comment_status = escape($row['comment_status']);
                    $comment_date = escape($row['comment_date']);
                ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="user_page.php?source=user_details&user=<?php echo $comment_author; ?>"><?php echo $comment_author; ?></a>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <h4 class="media-heading"> <?php echo $author_email; ?></h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>

                <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column without login -->
            <div class="col-md-4">

            <?php include_once './includes/sidebar.php' ?>


        </div>
        <!-- /.row -->

        <hr>

<!-- Footer -->
<?php include_once './includes/footer.php' ?>