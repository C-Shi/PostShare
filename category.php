<?php include "include/db.php" ?>
<?php include "include/header.php" ?>
<?php include "function.php" ?>

<?php include "include/navigation.php" ?>

<div class="container">
  <div class="row">

    <!-- blog section -->
    <div class="col-lg-8">
      <?php
        if (isset($_GET['category_id'])) {
          $category_id = $_GET['category_id'];
          $results = find_posts_by_category_id($category_id);

          if(count($results) > 0) {
            foreach($results as $post) {
        ?>
            <h2><a href="post.php?post_id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a></h2>
            <p class="lead">by <a href="index.php"><?php echo $post['author'] ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('l, F d, Y',strtotime($post['date'])); ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post['image'] ?>" alt="">
            <hr>
            <p>
              <?php
                if (substr($post['content'], 0, 250) == $post['content']) {
                  echo $post['content'];
                } else {
                  echo substr($post['content'], 0, 250) . ' ...';
                }
              ?>
              </p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
      <?php
            }
          } else {
      ?>
            <div class="jumbotron">
              <h3>Opp! No Posts Under This Category</h3>
              <p>We have not found any post in this category. Have something to share? Be the first one to add post!</p>
              <p><a class="btn btn-success btn-lg" href="#" role="button">Add Post</a></p>
            </div>
      <?php
          }
        }
      ?>
    </div>

    <?php include "include/sidebar.php" ?>
  </div>
</div>

<?php include "include/footer.php" ?>