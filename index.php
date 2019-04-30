<?php include "include/db.php" ?>
<?php include "include/header.php"; ?>
<?php include "function.php" ?>

    <!-- Navigation -->
    <?php include "include/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php
                    $query = "SELECT * FROM posts WHERE status = 'PUBLISHED'";
                    $select_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_post_query)) {
                        $post_id = $row['id'];
                        $post_title = $row['title'];
                        $post_author = $row['author'];
                        $post_date = $row['date'];
                        $post_image = $row['image'];
                        $post_content = $row['content'];
                ?>
                <!-- post title -->
                <h2><a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></h2>
                <p class="lead">by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p>
                  <?php
                    if (substr($post_content, 0, 250) == $post_content) {
                      echo $post_content;
                    } else {
                      echo substr($post_content, 0, 250) . ' ...';
                    }
                  ?>
                </p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- end of php while loop -->
                <?php } ?>


                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "include/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "include/footer.php";?>