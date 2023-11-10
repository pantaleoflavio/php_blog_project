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
        if ( isset( $_POST['submit'] ) ) {
            $search = escape($_POST['search']);
            $query = "SELECT * from posts where `post_tags` LIKE '%$search%'";
            $search_query = mysqli_query($connection, $query);
            if ( !$search_query ) {
                die("QUERY FAILED " . mysqli_error($connection));
            }
            $count = mysqli_num_rows($search_query);
            if ( $count == 0 ) {
                echo '<h2>NO RESULT</h2>';
            } else {
                while ($row = mysqli_fetch_assoc($search_query)) {
                $post_title = escape($row['post_title']);
                $post_author = escape($row['post_author']);
                $post_date = escape($row['post_date']);
                $post_image = escape($row['post_image']);
                $post_content = escape($row['post_content']);
    ?>
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>
            <!-- First Blog Post -->
            <h2>
            <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">by <a href="index.php"><?php echo $post_author; ?></a></p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
                <?php }
            }

        }
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                
            <?php include_once './includes/sidebar.php' ?>

        <!-- /.row -->

        <hr>

               <!-- Footer -->
        <?php include_once './includes/footer.php' ?>