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
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">

                            <?php insertCategories(); ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title" id="">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" id="" value="Add Category">
                                </div>
                            </form>

                        <?php
                            if ( isset($_GET['edit']) ) {
                                $cat_id = escape($_GET['edit']);
                                include 'includes/admin-update-cat.php';
                            }
                            
                        ?>


                        </div> <!-- Add Category Form -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php findAllCategories(); ?>
                                    <?php deleteCategory(); ?>
                                </tbody>
                            </table>
                        </div> <!--  -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            <!-- Footer -->

    <?php include "./includes/admin-footer.php" ?>