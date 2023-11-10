<?php  include "includes/dbconnection.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
<?php

if (isset($_SESSION['role'])) {
    if (isset($_GET['u_id'])) {

        $user_id = $_GET['u_id'];
        $query = "SELECT * FROM users WHERE id = '$user_id'";

        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($result)) {
            $user_email_logged = escape($row['email']);
            $user_password_logged = escape($row['password']);
        }

            if(isset($_POST['delete_profile'])) {

                $sub_email = escape($_POST['enter_email']);
                $sub_password = escape($_POST['enter_password']);

                print_r($sub_email, $sub_password);

                if (password_verify($sub_password, $user_password_logged) && $user_email_logged == $sub_email) {
                    $_SESSION['sub_email'] = null;
                    $_SESSION['username'] = null;
                    $_SESSION['role'] = null;
                    $_SESSION['email'] = null;
                    $query = "DELETE FROM `users` WHERE id = {$user_id}";
                    $delete_query_profile = mysqli_query($connection, $query);
                    echo "<h4 class='text-center bg-success'>Profile deleted</h4>";

                } elseif (!password_verify($sub_password, $user_password_logged) || $user_email_logged != $sub_email){
                    echo "<h4 class='text-center bg-danger'>Email or Password wrong</h4>";
                }

            }
        
        
    }
}

?>

<!-- Page Content -->
<div class="container">
    
<section id="delete_user_form">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="bg-primary">Delete</h1>
    <form action='' method='post'>
        <div class='form-group'>
            <label for='email'>Email</label>
            <input type='email' class='form-control' id='enter_email' name='enter_email' required>
        </div>
        <div class='form-group'>
            <label for='password'>Password</label>
            <input autocomplete="off" type='password' class='form-control' id='enter_password' name='enter_password' required>
        </div>
        <div class='form-group'>
            <input type='submit' class='btn btn-primary' name='delete_profile' value='Delete profile'>
        </div>
    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

    <hr>

<?php include "includes/footer.php";?>
