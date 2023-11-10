
<!-- header -->

<?php include "./includes/admin-header.php" ?>

<?php

if ( isset( $_SESSION['user_email']) ) {
    $log_user = escape($_SESSION['user_email']);
    $query = "SELECT * FROM users WHERE email = '{$log_user}'";
    $user_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($user_query) ) {
        $user_id = escape($row['id']);
        $user_first_name = escape($row['first_name']);
        $user_last_name = escape($row['last_name']);
        $user_birthday = escape($row['birth_date']);
        $username = escape($row['username']);
        $user_email = escape($row['email']);
        $user_pic = escape($row['user_pic']);
        $user_role = escape($row['role']);
    }
}

?>

<div id="wrapper">

<!-- Navigation -->
        
<?php include "./includes/admin-navigation.php" ?>

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
<?php include "./includes/admin-sidebar.php" ?>

<div id="page-wrapper">

<div class="container-fluid">

               <!-- Page Heading -->
               <div class="row">
                    <div class="col-lg-12">
                        <h1 class="huge"> <small class="text-muted">Your Profile </small>
                            <?php echo $username ?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

               <div class="row">
                    <div class="col-md-6">

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Your name:</h3>
                            </div>
                            <div class="panel-body text-uppercase text-center" id="user_first_name"">
                                <mark><?php echo $user_first_name; ?></mark>
                            </div>
                        </div>
                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Your last name:</h3>
                            </div>
                            <div class="panel-body text-uppercase text-center" id="user_last_name"">
                                <mark><?php echo $user_last_name; ?></mark>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Your Birthday:</h3>
                            </div>
                            <div class="panel-body text-uppercase text-center" id="user_birthday"">
                                <mark><?php echo $user_birthday; ?></mark>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Your Email:</h3>
                            </div>
                            <div class="panel-body text-uppercase text-center" id="user_email"">
                                <mark><?php echo $user_email; ?></mark>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Your Role:</h3>
                            </div>
                            <div class="panel-body text-uppercase text-center" id="user_role"">
                                <mark><?php echo $user_role; ?></mark>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="">
                                <img class="img-responsive img-thumbnail" width="400" src="../images/<?php echo $user_pic; ?>" alt="Responsive image" id="image">
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            <!-- Footer -->

    <?php include "./includes/admin-footer.php" ?>