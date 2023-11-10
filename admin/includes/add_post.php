
<?php
if (isset($_SESSION['role'])) {

  if (isset($_POST['create_post'])) {
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

    $query = "INSERT INTO `posts`( `post_id_category`, `post_title`,";
    $query .= "`post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) ";
    $query .= "VALUES ('{$post_id_category}','{$post_title}','{$post_author}',now(),";
    $query .= "'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    if ($_SESSION['role'] === 'admin') {
        $create_post_query = mysqli_query($connection, $query);

        if (!$create_post_query) {
            die("Query failed" . mysqli_error($connection));
        } else {
            echo "<h4 class='text-center text-uppercase bg-success'>POST PUBBLISHED SUCCESSFULLY</h4>";
        }
    } else {
      echo "<h2 class='text-center text-uppercase bg-danger'>you are not an admin</h2>";
    }

  }
}



?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" id="post_title" name="post_title">
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
    <input type="text" class="form-control" id="post_author" name="post_author">
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
        <label class="form-label " for="post_image">Choose file</label>
        <input type="file" class="form-control d-none" id="post_image" name="post_image">
     </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" id="post_tags" name="post_tags">
  </div>
  <div class="form-group">
    <label for="content">Post Content</label>
    <textarea class="form-control" id="post_content" rows="3" name="post_content"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Submit Post">
  </div>
</form>