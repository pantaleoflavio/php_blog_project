<?php
include_once "delete_modal.php";

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        if (isset($_POST['checkboxArray'])) {
            foreach ($_POST['checkboxArray'] as $postID) {
                $bulk_options = $_POST['bulk_options'];
                switch ($bulk_options) {
                    case 'clonate':
                        $query = "SELECT * FROM posts WHERE post_id = '{$postID}'";
                        $select_post_id = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_post_id)) {
                            $post_id = escape($row['post_id']);
                            $post_id_category = escape($row['post_id_category']);
                            $post_title = escape($row['post_title']);
                            $post_author = escape($row['post_author']);
                            $post_date = escape($row['post_date']);
                            $post_image = escape($row['post_image']);
                            $post_content = escape($row['post_content']);
                            $post_tags = escape($row['post_tags']);
                            $post_status = escape($row['post_status']);
                            $post_view_count = escape($row['post_view_count']);
                        }

                        $query = "INSERT INTO posts(`post_id_category`,`post_title`,";
                        $query .= "`post_author`,`post_date`,`post_image`,`post_content`,`post_tags`,`post_status`) ";
                        $query .= "VALUES ('{$post_id_category}','{$post_title} CLONE','{$post_author}',now(),";
                        $query .= "'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

                        $clone_query_post = mysqli_query($connection, $query);
                        if (!$clone_query_post) {
                            die("Query failed" . mysqli_error($connection));
                        } else {
                            echo "<h4 class='bg-success text-center text-uppercase'> post clonated</h4>";
                        }
                        break;
                    case 'published':
                        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postID}'";
                        $update_publish_status = mysqli_query($connection, $query);
                        confirmQuery($update_publish_status);
                        break;
                    case 'unpublished':
                        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postID}' ";
                        $update_unpublish_status = mysqli_query($connection, $query);
                        confirmQuery($update_unpublish_status);

                        break;
                    case 'delete':
                        $query = "DELETE FROM `posts` WHERE post_id = {$postID}";
                        $query1 = "DELETE FROM `comments` WHERE comment_id_post = {$postID}";
                        $delete_query_post = mysqli_query($connection, $query);
                        $delete_query_related_comments = mysqli_query($connection, $query1);
                        if (!$delete_query_post || !$delete_query_related_comments) {
                            die("Query failed" . mysqli_error($connection));
                        } else {
                            echo "<h4 class='bg-success text-center text-uppercase'> post deleted</h4>";
                        }
                        break;
                    default:
                        header("Location: posts.php");
                        break;
                }
            }
        }
        
        if (isset($_GET['reset_views'])) {
            $post_id = escape($_GET['reset_views']);
            $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = '{$post_id}' ";
            $reset_post_views = mysqli_query($connection, $query);
            if (!$reset_post_views) {
                die("Query failed" . mysqli_error($connection));
            } else {
                echo "<h4 class='bg-warning text-center text-uppercase'> Views reset</h4>";
            }
        }
    } else {
        echo "<h2 class='text-center text-uppercase bg-danger'>you are not an admin</h2>";
    }

}
?>

<form action="" method="post">
<div class="row" class="pl-0">
    <div id="bulkOptionsContainer" class="col-sm-5">
        <select class="form-control" name="bulk_options" id="">
            <option value="no">Select Option</option>
            <option value="clonate">Create Clone</option>
            <option value="published">Publish</option>
            <option value="unpublished">Unpublish</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-sm-5">
        <input class="btn btn-success" type="submit" name="submit" value="apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
</div>   
<div class="row">  
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Title</th>
            <th>Author</th>
            <th>Categories</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th></th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT posts.post_id, posts.post_title, posts.post_author, posts.post_id_category, posts.post_status, posts.post_image, posts.post_tags, ";
        $query .= "posts.post_date, posts.post_view_count, categories.id, categories.title ";
        $query .= "FROM posts LEFT JOIN categories ON posts.post_id_category = categories.id ORDER BY post_date DESC";

        $posts_cat_join = mysqli_query( $connection, $query);
        confirmQuery($posts_cat_join);
            while ($row = mysqli_fetch_assoc($posts_cat_join)) {
                $post_id = escape($row['post_id']);
                $post_title = escape($row['post_title']);
                $post_author = escape($row['post_author']);

                $cat_id = escape($row['id']);
                $cat_name = escape($row['title']);

                $post_id_category = escape($row['post_id_category']);
                $post_status = escape($row['post_status']);
                $post_image = escape($row['post_image']);
                $post_tags = escape($row['post_tags']);
                $post_date = escape($row['post_date']);
                $post_view_count = escape($row['post_view_count']);
                ?>
                <tr><td><input value='<?php echo $post_id ?>' class='checkboxes' type='checkbox' name='checkboxArray[]'></td>
                <?php
                echo "<td>{$post_id}</td>";
                echo "<td><a target='_blank' href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                echo "<td>{$post_author}</td>";

                if (!$cat_name) {
                    echo "<td class='bg-warning'>No categories</td>";
                } else {
                    echo "<td class='bg-primary'>{$cat_name}</td>";

                }
                
                echo "<td>{$post_status}</td>";
                echo "<td><img src='../images/{$post_image}' alt='' width='100' height='50'></td>";
                echo "<td>{$post_tags}</td>";

                $query = "SELECT * from comments WHERE comment_id_post = {$post_id}";
                $comment_count_query = mysqli_query( $connection, $query);
                $comment_count =mysqli_num_rows($comment_count_query);

                echo "<td>{$comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td>{$post_view_count}</td>";
                echo "<td><a onClick=\"javascript: return confirm('Are u sure?');\" href='posts.php?reset_views={$post_id}' class='btn btn-warning' type='button'>Reset Views</a></td></tr>";
            }
        
        ?>
    </tbody>
</table>
</div> 
</form>