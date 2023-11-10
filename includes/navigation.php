
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> My new Blog Project</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

        <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <?php
                        if ( !isset($_SESSION['role']) ) {
                            echo "<a href='registration.php'>Registration</a>";
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                        if ( isset($_SESSION['role']) ) {
                            if ( $_SESSION['role'] === 'admin' ) {
                                if (isset($_GET['p_id'])) {
                                    $post_id = escape($_GET['p_id']);
                                    $query = "SELECT * from posts WHERE post_id = '$post_id' ";
                                    echo "<a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a>";
                                }
                            }
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
