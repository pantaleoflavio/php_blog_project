<!-- header -->

<?php include "./includes/admin-header.php" ?>

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
                        <h1 class="page-header">
                            Welcome Admin
                            <h3 class="huge well"><?php echo $_SESSION['username'] ?></h3>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <?php include "./includes/admin_widgets.php" ?>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

            <!-- Footer -->

    <?php include "./includes/admin-footer.php" ?>