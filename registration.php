<?php  include "includes/dbconnection.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
<?php
if(isset($_POST['create_user'])) {

    $user_first_name = escape($_POST['user_first_name']);
    $user_last_name = escape($_POST['user_last_name']);
    $user_birthday = escape($_POST['user_birthday']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);

    $user_pic = escape($_FILES['image']['name']);
    $user_image_temp = escape($_FILES['image']['tmp_name']);

    move_uploaded_file($user_image_temp, "images/$user_pic");

    $password = escape($_POST['password']);
    $confirm_password = escape($_POST['confirm_password']);
    $pattern = "/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/";
    $encr_pass = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));

    if (username_exists($username) || email_exists($user_email)) {
        echo "<h2 class='text-center text-uppercase bg-warning'>username or email already registered</h2>";
    } elseif (!username_exists($username) && !email_exists($user_email)) {

        if ($password === $confirm_password && strlen($password) > 7 && preg_match($pattern, $password)) {
            $query = "INSERT INTO users SET `first_name`='{$user_first_name}',";
            $query .= "`last_name`='{$user_last_name}',";
            $query .= "`birth_date`='{$user_birthday}',";
            $query .= "`username`='{$username}',";
            $query .= "`email`='{$user_email}',";
            $query .= "`user_pic`='{$user_pic}',";
            $query .= "`password`='{$encr_pass}'";

            $edit_query_user = mysqli_query($connection, $query);
            confirmQuery($edit_query_user);

            echo "<h4 class='bg-success text-white text-center'>Your Profile was Created.</h4>";

        } else {
            echo "<h4 class='bg-danger text-white text-center'>the password doesn't match or is too weak!</h4>";
        }
    }

}
?>

<!-- Page Content -->
<div class="container">
    
<section id="registratiom">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_first_name">Your name</label>
        <input type="text" class="form-control" id="user_first_name" name="user_first_name" required>
    </div>
    <div class="form-group">
        <label for="user_last_name">Your last name</label>
        <input type="text" class="form-control" id="user_last_name" name="user_last_name" required>
    </div>
    <div class="form-group">
        <label for="user_birthday">Birthday:</label>
        <input type="date" id="user_birthday" name="user_birthday">
    </div>
    <div class="form-group">
        <label for="username">Your username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="username">Your Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required>
    </div>
    <div class="form-group">
        <label for="image">Your Picture</label>
        <input type="file" class="form-control d-none" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input autocomplete="off" type="password" class="form-control d-none" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input autocomplete="off" type="password" class="form-control d-none" id="confirm_password" name="confirm_password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create">
    </div>
</form>
          
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

    <hr>

<?php include "includes/footer.php";?>
