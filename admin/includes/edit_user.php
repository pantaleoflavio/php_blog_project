<?php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {

        if(isset($_GET['u_id'])) {
            $user_id_to_edit = escape($_GET['u_id']);
        }
        $query = "SELECT * from users WHERE id = $user_id_to_edit";
        $select_user_id = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_user_id)) {
            $user_id = escape($row['id']);
            $user_first_name = escape($row['first_name']);
            $user_last_name = escape($row['last_name']);
            $user_birthday = escape($row['birth_date']);
            $username = escape($row['username']);
            $user_email = escape($row['email']);
            $user_pic = escape($row['user_pic']);
            $user_role = escape($row['role']);
        }

        if(isset($_POST['update_user'])) {
            $user_first_name = escape($_POST['user_first_name']);
            $user_last_name = escape($_POST['user_last_name']);
            $user_birthday = escape($_POST['user_birthday']);
            $username = escape($_POST['username']);
            $user_email = escape($_POST['user_email']);

            $user_pic = escape($_FILES['image']['name']);
            $user_image_temp = escape($_FILES['image']['tmp_name']);
            $user_role = escape($_POST['user_role']);

            move_uploaded_file($user_image_temp, "../images/$user_pic");

            if (empty($user_pic)) {
                $query = "SELECT * FROM users WHERE id = {$user_id}";
                $select_image = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_image)) {
                    $user_pic = escape($row['user_pic']);
                }
            }
            
            $query = "UPDATE users SET `first_name`='{$user_first_name}',";
            $query .= "`last_name`='{$user_last_name}',";
            $query .= "`birth_date`='{$user_birthday}',";
            $query .= "`username`='{$username}',";
            $query .= "`user_pic`='{$user_pic}',";
            $query .= "`role`='{$user_role}' ";
            $query .= "WHERE id = {$user_id}";

            $edit_query_user = mysqli_query($connection, $query);

            if (!$edit_query_user) {
                die("Query failed" . mysqli_error($connection));
            }

            echo "<p class='bg-success'> Profile was Updated.</p>";
        }
    } else {
        header("Location: ../index.php");
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_first_name">Your name</label>
        <input value="<?php echo $user_first_name; ?>" type="text" class="form-control" id="user_first_name" name="user_first_name">
    </div>
    <div class="form-group">
        <label for="user_last_name">Your last name</label>
        <input value="<?php echo $user_last_name; ?>" type="text" class="form-control" id="user_last_name" name="user_last_name">
    </div>
    <div class="form-group">
        <label for="user_birthday">Birthday:</label>
        <input value="<?php echo $user_birthday; ?>" type="date" id="user_birthday" name="user_birthday">
    </div>
    <div class="form-group">
        <label for="username">Your username</label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
        <label for="username">Your Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" id="user_email" name="user_email">
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $user_pic; ?>" alt="" id="image" name="image">
        <input type="file" class="form-control d-none" id="image" name="image">
    </div>
    <div class="form-group">
        <label for='role'>Choose a role:</label>
        <select name='user_role' id='user_role'>
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 
                if ( $user_role == 'admin') {
                    echo "<option value='subscriber'>subscriber</option>";
                    echo "<option value='banned'>banned</option>";
                } elseif ( $user_role == 'subscriber' ) {
                    echo "<option value='admin'>admin</option>";
                    echo "<option value='banned'>banned</option>";
                } else {
                    echo "<option value='subscriber'>subscriber</option>";
                    echo "<option value='admin'>admin</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Edit User">
    </div>
</form>