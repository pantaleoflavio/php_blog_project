<!-- Blog Search Well -->
    <div class="well">
        <form action="http://localhost/cms_project/searchpage.php" method="post">
            <h4>Blog Search</h4>
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form> <!-- form search in cms -->
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">
        <?php if (!isset($_SESSION['role'])) {
        include "login_form.php"; ?>

        <p class='text-left'><a href='forgot.php?forgot=<?php echo uniqid(true); ?>'>Password Forgot?</a></p>

        <?php } else if ($_SESSION['role'] === 'subscriber' ) {
            $username = escape($_SESSION['username']);
            $query = "SELECT * from users WHERE username = '{$username}'";
            $logged_user = mysqli_query( $connection, $query);
            while ($row = mysqli_fetch_assoc($logged_user)) {
                $user_id = escape($row['id']);
                $user_pic = escape($row['user_pic']);
            }
            echo "<div class='well'>
                        <h4 class='bg-success text-center'>Welcome Subscriber {$_SESSION['username']}</h4>
                        <p class='text-center'><a href='user_page.php?source=user_details&user={$username}'><img src='images/{$user_pic}' alt='' width='150'></a></p>
                        <p class='text-center'><a class='btn btn-primary' href='./admin/includes/logout.php'>Log out</a></p>
                        <p class='text-center'><a href='delete_profile.php?u_id={$user_id}' class='btn btn-danger'>Delete Profile</a></p>
                    </div>";
        } elseif ($_SESSION['role'] === 'admin') {
            $username = escape($_SESSION['username']);
            $query = "SELECT * from users WHERE username = '{$username}'";
            $logged_user = mysqli_query( $connection, $query);
            while ($row = mysqli_fetch_assoc($logged_user)) {
                $user_pic = escape($row['user_pic']);
            }
            echo "<div class='well'>
                    <h3 class='bg-success text-center'>Welcome Admin {$_SESSION['username']}</h3>
                    <p class='text-center'><a href='user_page.php?source=user_details&user={$username}'><img src='images/{$user_pic}' alt='' width='150'></a></p>
                    <p class='text-center'><a class='btn btn-primary' href='./admin/includes/logout.php'>Log out</a></p>
                    <p class='text-center'><a class='btn btn-info' href='./admin/admin_index.php' target='_blank'>Admin</a></p>
                </div>";
             
        } elseif ($_SESSION['role'] === 'banned') {
            $username = escape($_SESSION['username']);
            $query = "SELECT * from users WHERE username = '{$username}'";
            $logged_user = mysqli_query( $connection, $query);
            while ($row = mysqli_fetch_assoc($logged_user)) {
                $user_id = escape($row['id']);
                
            }
            echo "<div class='well'>
                <h4 class='bg-danger'>{$_SESSION['username']} your profile is banned!</h4>
                <p class='text-center'><a class='btn btn-primary' href='./admin/includes/logout.php' target='_blank'>Log out</a></p>
                <p class='text-center'><a href='delete_profile.php?u_id={$user_id}' class='btn btn-danger'>Delete Profile</a></p>
                </div>";
        }
        ?>
    
        <!-- /.input-group -->
        
    </div>
   
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
                <?php
                    $query = "SELECT * from categories where id between '1' and '6'";
                    $all_cat = mysqli_query( $connection, $query);
                    while ($row = mysqli_fetch_assoc($all_cat)) {
                        $cat_title = escape($row['title']);
                        $cat_id = escape($row['id']);
                        echo "<li><a href='./category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * from categories having id > 6";
                    $all_cat = mysqli_query( $connection, $query);
                    while ($row = mysqli_fetch_assoc($all_cat)) {
                        $cat_title = escape($row['title']);
                        $cat_id = escape($row['id']);
                        echo "<li><a href='./category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>
                 </ul>
            </div>          
        </div>
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

<!-- /.Blog Sidebar Widgets Column col-md-4 -->
</div>
