<?php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {

        if (isset($_POST['checkboxArray'])) {
            foreach ($_POST['checkboxArray'] as $commentID) {
                $bulk_options = $_POST['bulk_options'];
                switch ($bulk_options) {
                    case 'approved':
                        $query = "UPDATE `comments` SET `comment_status` = 'approved' WHERE id = {$commentID}";
                        $approve_query_comment = mysqli_query($connection, $query);
                        if (!$approve_query_comment) {
                            die("Query failed" . mysqli_error($connection));
                        } else {
                            echo "<h4 class='bg-success text-center text-uppercase'> status changed</h4>";
                        }
                        break;
                    case 'unapproved':
                        $query = "UPDATE `comments` SET `comment_status` = 'unapproved' WHERE id = {$commentID}";
                        $unapprove_query_comment = mysqli_query($connection, $query);
                        if (!$unapprove_query_comment) {
                            die("Query failed" . mysqli_error($connection));
                        } else {
                            echo "<h4 class='bg-success text-center text-uppercase'> status changed</h4>";
                        }
                        break;
                    default:
                        header("Location: admin_comments.php");
                        break;
                }
            }
        }

        if(isset($_GET['delete'])) {
            $comment_id_todelete = escape($_GET['delete']);
            $query = "DELETE FROM `comments` WHERE id = {$comment_id_todelete}";
            $delete_query_comment = mysqli_query($connection, $query);

            confirmQuery($delete_query_comment);

        }

    } else {
        echo "<h2 class='text-center text-uppercase bg-danger'>you are not an admin</h2>";
    }
}
?>

<form action="" method="post">
<div class="row">
    <div id="bulkOptionsContainer" class="col-sm-5">
        <select class="form-control" name="bulk_options" id="">
            <option value="no">Select Option</option>
            <option value="approved">Approve</option>
            <option value="unapproved">Unapprove</option>
        </select>
    </div>
    <div class="col-sm-5">
        <input class="btn btn-success" type="submit" name="submit" value="apply">
    </div>
</div>   
<div class="row"> 
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th >Id</th>
            <th >Author</th>
            <th >Email</th>
            <th >Content</th>
            <th >Status</th>
            <th >Comment Data</th>
            <th >Related Post</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * from comments";
        $comments = mysqli_query( $connection, $query);
            while ($row = mysqli_fetch_assoc($comments)) {
                $comment_id = escape($row['id']);
                $comment_id_post = escape($row['comment_id_post']);
                $comment_author = escape($row['comment_author']);
                $author_email = escape($row['author_email']);
                $comment_content = escape($row['comment_content']);
                $comment_status = escape($row['comment_status']);
                $comment_date = escape($row['comment_date']);
                ?>
                <tr><td><input value='<?php echo $comment_id ?>' class='checkboxes' type='checkbox' name='checkboxArray[]'></td>
                <td><?php echo $comment_id; ?></td>
                <td><?php echo $comment_author; ?></td>
                <td><?php echo $author_email; ?></td>
                <td><?php echo $comment_content; ?></td>
                <td><?php echo $comment_status; ?></td>
                <td><?php echo $comment_date; ?></td>

                <?php
                $query = "SELECT * from posts WHERE post_id = {$comment_id_post}";
                $select_post = mysqli_query( $connection, $query);
                while ($row = mysqli_fetch_assoc($select_post)) {
                    $post_id = escape($row['post_id']);
                    $post_title = escape($row['post_title']);
                }
                confirmQuery($select_post);

                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                echo "<td><a href='admin_comments.php?source=edit_comment&c_id={$comment_id}'>Edit</a></td>";
                echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are u sure?');\" href='admin_comments.php?delete={$comment_id}'>Delete</a></td></tr>";
                
            }
            if( isset($_GET['delete'])){
                echo "<p class='bg-success'>Comment Deleted</p>";
            }
        ?>
    </tbody>
</table>
</div> 
</form>