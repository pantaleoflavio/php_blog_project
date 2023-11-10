<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
            <?php
                if (isset($_GET['edit'])) {
                    $id_cat_to_edit = escape($_GET['edit']);
                    $query = "SELECT * from categories where id = {$id_cat_to_edit}";
                    $cat_query = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($cat_query)) {
                        $cat_id = escape($row['id']);
                        $cat_title = escape($row['title']);
            ?>
                        <input value="<?php if(isset($cat_title)) {echo $cat_title ;} ?>" class="form-control" type="text" name="cat_title" id="">

                    <?php } ?>

                <?php } ?>

        <?php 
        if ( isset( $_POST['update-category'] )) {
            $the_cat_title = escape($_POST['cat_title']);
            $query = "UPDATE `categories` SET `title` = '{$the_cat_title}' WHERE id = {$cat_id}";
            $update_query = mysqli_query($connection, $query);
    
            if ( !$update_query ) {
                die("Query failed" . mysqli_error($connection));
            }
            
        }
        ?>    
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update-category" id="" value="Update Category">
    </div>
</form>