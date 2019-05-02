       
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <!-- count number of post -->
                    <?php 
                      $q = "SELECT COUNT(*) AS count FROM posts; ";
                      $q_count_posts = mysqli_query($connection, $q);
                      $posts_count = mysqli_fetch_assoc($q_count_posts)['count'];
                    ?>
                    <div class='huge'><?php echo $posts_count;?></div>
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
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <!-- comment count -->
                    <?php 
                      $q = "SELECT COUNT(*) AS count FROM comments;";
                      $q_count_comments = mysqli_query($connection, $q);
                      $comments_count = mysqli_fetch_assoc($q_count_comments)['count'];
                    ?>
                     <div class='huge'><?php echo $comments_count ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <!-- count user -->
                     <?php 
                      $q = "SELECT COUNT(*) AS count FROM users";
                      $q_count_users = mysqli_query($connection, $q);
                      $users_count = mysqli_fetch_assoc($q_count_users)['count'];
                     ?>
                    <div class='huge'><?php echo $users_count ?></div>
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
                    <!-- count category -->
                    <?php 
                      $q = "SELECT COUNT(*) AS count FROM categories;";
                      $q_count_categories = mysqli_query($connection, $q);
                      $categories_count = mysqli_fetch_assoc($q_count_categories)['count'];
                    ?>
                        <div class='huge'><?php echo $categories_count?></div>
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
</div>

<!-- chart area -->
<div class="row">
    <div class="col-lg-6 col-sm-12">
      <div id="post_status_chart" style="height: 400px; width:98%"></div>
    </div>
    <div class="col-lg-6 col-sm-12">
      <div id="post_category_chart" style="height: 400px; width:98%"></div>
    </div>
</div>

<!-- post status -->
<?php 
  $q_post_status = "SELECT status, COUNT(*) AS count FROM posts GROUP BY status;";
  $query_post_status = mysqli_query($connection, $q_post_status);
  $posts_status = [];
  while($row = mysqli_fetch_assoc($query_post_status)) {
    array_push($posts_status, $row);
  }

  $q_post_category = "SELECT categories.title, COUNT(posts.category_id) AS count FROM categories LEFT JOIN posts ON posts.category_id = categories.id GROUP BY categories.id;";
  $query_post_category = mysqli_query($connection, $q_post_category);
  $posts_category  = [];
  while($row = mysqli_fetch_assoc($query_post_category)) {
    array_push($posts_category, $row);
  }
?>
<script src="js/chart.js"></script>
<script type="text/javascript">
    var posts_status = <?php echo json_encode($posts_status) ?>;
    var posts_category = <?php echo json_encode($posts_category) ?>;

    loadPostStatus(posts_status);
    loadPostCategory(posts_category);
    
    
  </script>
