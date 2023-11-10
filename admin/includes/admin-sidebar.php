<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="./admin_index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="http://localhost/cms_project/admin/categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-book"></i></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="./posts.php">View all Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add a Post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-user"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="./users.php">View all Users</a>
                            </li>
                            <li>
                                <a href="./users.php?source=add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="./admin_comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                    <li>
                        <a href="./profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>