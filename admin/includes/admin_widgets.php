<?php if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
    
?>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $posts_count = widgetCounter('posts'); ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-orange" style="background-color: orange;">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $comments_count = widgetCounter('comments'); ?></div>
                    <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="admin_comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-pink" style="background-color: pink";>
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $users_count = widgetCounter('users'); ?></div>
                    <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $cats_count = widgetCounter('categories'); ?></div>
                    <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <h1 class="usersonline"><?php //echo users_online(); ?></h1>
                    </div>
                </div>
            </div>
                <div class="panel-footer">
                    <span class="pull-right">Users Online</span>
                    <div class="clearfix"></div>
                </div>
        </div>
    </div>
</div>

<?php
$draft_posts_count = widgetCheckStatus('posts','post_status','unpublished');
$unapproved_comments_count = widgetCheckStatus('comments','comment_status','unapproved');
$banned_users_count = widgetCheckStatus('users','role','banned');
?>

<div class="row">        
<script type="text/javascript">

        google.load("visualization", "1.1", {packages:["bar"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
                
            <?php
            
            $elements = ['All Posts', 'Draft/unpublished Posts', 'Categories', 'Users', 'Banned Users', 'Comments', 'Unapproved Comments'];
            $element_data = [$posts_count, $draft_posts_count ,$cats_count, $users_count, $banned_users_count, $comments_count, $unapproved_comments_count];

            for($i=0;$i<7; $i++){
                echo   "['{$elements[$i]}'" . "," . "{$element_data[$i]}],";
            }
            ?>
    
            ]);

            var options = {
            chart: {
                title: '',
                subtitle: '',
            }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, options);
        }
    </script>
                   
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

</div>

<?php
    } else {
        header("Location: ../index.php");
    } //ifelse role admin

} //close if session role
?>