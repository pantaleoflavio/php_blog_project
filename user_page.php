<!-- Header -->
<?php include_once 'includes/header.php' ?>

<!-- Navigation -->
<?php include_once 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">
    <div class="col-lg-12">
        <div class="page-header">
        <h2 class="text-uppercase">subscriber <?php echo $_GET['user'] ?></h2>
            <?php 
                if ( isset( $_GET['source'])) {
                    $source = escape($_GET['source']);
                } else {
                    $source = "";
                }
                
                switch ($source) {
                    case 'user_details':
                        include "./includes/view_all_user_action.php";
                        break;
                    default:
                        include "index.php";
                        break;
                }
                
            ?>  
        </div>
    </div>
</div>

   

        <hr>

               <!-- Footer -->
        <?php include_once './includes/footer.php' ?>