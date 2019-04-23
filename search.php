<?php include "include/db.php" ?>
<?php include "include/header.php"; ?>

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

                <!-- Blog Area -->
                <?php
                    if($_POST['submit']) {
                        $search = $_POST['search'];
                        $query = "SELECT * FROM posts WHERE tag LIKE '%$search%'";
                        $search_query = mysqli_query($connection, $query);
                        if (!$search_query) {
                            die("Query Failed " . mysqli_error($connection));
                        }

                        $count = mysqli_num_rows($search_query);
                        if ($count === 0) {
                            echo "<h1>No Result</h1>";
                        } else {
                            while($row = mysqli_fetch_assoc($search_query)) {
                                $post_title = $row['title'];
                                $post_author = $row['author'];
                                $post_date = $row['date'];
                                $post_image = $row['image'];
                ?>
                <!-- post title -->
                <h2><a href="#"><?php echo $post_title ?></a></h2>
                <p class="lead">by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- end of php while loop -->
                <?php
                        }
                    }
                }
                ?>


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