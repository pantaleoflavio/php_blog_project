<!-- header -->

<?php include "./includes/admin-header.php" ?>

<?php 
/* try to use a function for convalidate admin
if (is_admin($_SESSION['username'])) {
    header("Location: admin_index.php");
}
*/
?>

<div id="wrapper">

<?php 

?>
<!-- Navigation -->
    
<?php include "./includes/admin-navigation.php" ?>
    
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        
<?php include "./includes/admin-sidebar.php" ?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h2>
                HI ADMIN
            </h2>
            <?php 
                if ( isset( $_GET['source'])) {
                    $source = escape($_GET['source']);
                } else {
                    $source = "";
                }
                
                switch ($source) {
                    case 'add_user':
                        include "./includes/add_user.php";
                        break;
                    case 'edit_user':
                        include "./includes/edit_user.php";
                        break;
                    default:
                        include "./includes/view_all_users.php";
                        break;
                }
                
            ?>  
        </div>
    </div>
</div>
    <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

            <!-- Footer -->

            <?php include "./includes/admin-footer.php" ?>