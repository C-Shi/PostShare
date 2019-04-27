<?php include "include/db.php" ?>
<?php include "include/header.php"; ?>
    <!-- Navigation -->
    <?php include "include/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <!-- db query for specific post -->
                <?php
                    if(isset($_GET['post_id'])) {
                        $post_id = $_GET['post_id'];
                        $query = "SELECT * FROM posts WHERE id = {$post_id}";
                        $query_get_post = mysqli_query($connection, $query);
                        if (!$query_get_post) {
                            die('Query Failed ' . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($query_get_post)) {
                                $post_title = $row['title'];
                                $post_author = $row['author'];
                                $post_date = $row['date'];
                                $post_image = $row['image'];
                                $post_content = $row['content'];
                            }
                        }
                    }
                ?>
                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('l, F d, Y', strtotime($post_date)) ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">

                <hr>

                <!-- Post Content -->
               <!--  <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p> -->
                <p><?php echo $post_content ?></p>


                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php

                    if (isset($_POST['create_comment'])) {
                        // will always have post_id in reqeust params
                        $post_id = $_GET['post_id'];
                        $author = $_POST['author'];
                        $comment = $_POST['comment'];

                        $query = "INSERT INTO comments(post_id, author, content) VALUES($post_id, '$author', '$comment');";
                        $query_insert_comment = mysqli_query($connection, $query);
                        if (!$query_insert_comment) {
                            die('Query Failed ' . mysqli_error($connection));
                        }

                    }

                 ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <input class="form-control" type="text" name="author" placeholder="Let us know who you are: ">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment" placeholder="What do you think about ..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success" name="create_comment">Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "include/sidebar.php" ?>

<?php include "include/footer.php" ?>