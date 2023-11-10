<?php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {

        if(isset($_GET['p_id'])) {
            $post_id_to_edit = escape($_GET['p_id']);
        }
        $query = "SELECT * from posts WHERE post_id = $post_id_to_edit";
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
        }

        if(isset($_POST['update_post'])) {
            $post_id_category = escape($_POST['post_id_category']);
            $post_title = escape($_POST['post_title']);
            $post_author = escape($_POST['post_author']);
            $post_date = date('y-m-d h:i:s');

            $post_image = escape($_FILES['post_image']['name']);
            $post_image_temp = escape($_FILES['post_image']['tmp_name']);

            $post_content = escape($_POST['post_content']);
            $post_tags = escape($_POST['post_tags']);
            $post_status = escape($_POST['post_status']);

            move_uploaded_file($post_image_temp, "../images/$post_image");

            if (empty($post_image)) {
                $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                $select_image = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_image)) {
                    $post_image = $row['post_image'];
                }
            }

            $query = "UPDATE posts SET `post_id_category`='{$post_id_category}',";
            $query .= "`post_title`='{$post_title}',";
            $query .= "`post_author`='{$post_author}',";
            $query .= "`post_date`='{$post_date}',";
            $query .= "`post_image`='{$post_image}',";
            $query .= "`post_content`='{$post_content}',";
            $query .= "`post_tags`='{$post_tags}',";
            $query .= "`post_status`='{$post_status}' ";
            $query .= "WHERE post_id = {$post_id}";

            $edit_query_post = mysqli_query($connection, $query);
            confirmQuery($edit_query_post);

            echo "<p class='bg-success'>Post Updated. <a target='_blank' href='../post.php?p_id={$post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";

        }
    } else {
        header("Location: ../index.php");
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" id="post_title" name="post_title">
    </div>
    <div class="form-group">
        <label for="categories">Choose a Category:</label>
        <select name="post_id_category" id="post_id_category">
        <option value=''>No Category</option >
            <?php
                $query = "SELECT * from categories";
                $select_category = mysqli_query( $connection, $query);
                while ($row = mysqli_fetch_assoc($select_category)) {
                    $cat_id = escape($row['id']);
                    $cat_name = escape($row['title']);
                    echo "<option value='{$cat_id}'>{$cat_name}</option >";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" id="post_author" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="">Select Status</option>
            <option value="draft">draft</option>
            <option value="published">published</option>
            <option value="unpublished">denied</option>
        </select>
  </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="" id="post_image" name="post_image">
        <input type="file" class="form-control d-none" id="post_image" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" id="post_tags" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="post_content" rows="5" name="post_content"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Edit Post">
    </div>
</form>