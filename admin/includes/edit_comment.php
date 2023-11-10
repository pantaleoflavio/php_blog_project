<?php
if(isset($_GET['c_id'])) {
    $comment_id_to_edit = escape($_GET['c_id']);
}

$query = "SELECT * from comments WHERE id = $comment_id_to_edit";
$select_comment_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_comment_id)) {
    $comment_id = escape($row['id']);
    $pcomment_id_post = escape($row['comment_id_post']);
    $comment_author = escape($row['comment_author']);
    $author_email = escape($row['author_email']);
    $comment_content = escape($row['comment_content']);
    $comment_date = escape($row['comment_date']);
    }


    if(isset($_POST['update_comment'])) {

        $comment_author = escape($_POST['comment_author']);
        $author_email = escape($_POST['author_email']);
        $comment_content = escape($_POST['comment_content']);
        $comment_date = date('y-m-d h:i:s');

        $query = "UPDATE comments SET `comment_author`='{$comment_author}',";
        $query .= "`author_email`='{$author_email}',";
        $query .= "`comment_content`='{$comment_content}',";
        $query .= "`comment_date`='now()' ";
        $query .= "WHERE id = {$comment_id}";

        $edit_query_comment = mysqli_query($connection, $query);
        confirmQuery($edit_query_comment);

        echo "<p class='bg-success'>Comment Updated. <a target='_blank' href='./admin_comments.php'>View All comments </a></p>";

    }
?>

<div class="well">
    <h4>Modify the Comment:</h4>
    <form role="form" action="" method="post">
        <div class="form-group">
            <label for="author">Author</label>
            <input value="<?php echo $comment_author; ?>" type="text" id="comment_author" name="comment_author" class="form-control"></input>
        </div>
        <div class="form-group">
        <label for="email">email</label>
            <input value="<?php echo $author_email; ?>" type="email" id="author_email" name="author_email" class="form-control"></input>
        </div>
        <div class="form-group">
            <textarea id="comment_content" name="comment_content" class="form-control" rows="3"><?php echo $comment_content; ?></textarea>
        </div>
        <button name="update_comment" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>