<?php 
if(isset($_GET['user'])) {
    $user_name = escape($_GET['user']);
    $query = "SELECT * FROM users WHERE username = '{$user_name}'";
    $user_query = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($user_query) == 0) {
        echo "<h3 class='text-uppercase bg-primary'>user not registered </h3>";
    } else {
        while ($row = mysqli_fetch_assoc($user_query)) {
            //$user_id = $row['id'];
            //$user_first_name = $row['first_name'];
            //$user_last_name = $row['last_name'];
            //$user_birthday = $row['birth_date'];
            //$username = $row['username'];
            $user_email = escape($row['email']);
            $user_pic = escape($row['user_pic']);
            //$user_role = $row['role'];
            $user_registered_date = escape($row['registered_date']);
        }

        echo "<div class='row col-sm-12'>
        <table class='table table-striped table-bordered table-hover'>
        <thead>
            <tr>
                <th>Registration</th>
                <th>email</th>
                <th>Picture</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{$user_registered_date}</td>
                <td>{$user_email}</td>
                <td><img id='image' class='img-responsive' width='100' height='auto' src='./images/{$user_pic}'></td>
            </tr>
        </tbody>
        </table>
        </div>";
    }
    
        

} ?>
<div class="row col-sm-12">
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th >Posts</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * from posts WHERE post_author = '{$user_name}' AND post_status = 'published'";
        $user_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($user_posts)) {
        $selected_post_title = escape($row['post_title']);
        $post_id = escape($row['post_id']);
        echo "<tr><td><a href='post.php?source=user_details&p_id={$post_id}'>{$selected_post_title}</a></td></tr>";
        }
    ?>
    </tbody>
</table>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th >Comments</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * from comments WHERE comment_author = '{$user_name}' AND comment_status = 'approved'";
        $user_comments = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($user_comments)) {
        $comment_id_post = escape($row['comment_id_post']);
        $comment_content = escape($row['comment_content']);
        echo "<tr><td><a href='post.php?source=user_details&p_id={$comment_id_post}'>Go to the comment</a></td></tr>";
        }
    ?>
    </tbody>
</table>
</div>

    </div>

   

        <hr>

               <!-- Footer -->
        <?php include_once './includes/footer.php' ?>