<?php include "include/admin_header.php" ?>
<?php include "function.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "include/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <h1>Welcome To Admin <small>Author</small></h1>
                    <div class="col-lg-12">

                    <!-- table for showing all posts -->
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Title</th>
                          <th>Author</th>
                          <th>Category</th>
                          <th>Status</th>
                          <th>Image</th>
                          <th>Tags</th>
                          <th>Comments</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $query = "SELECT * FROM posts";
                          $query_get_all_post = mysqli_query($connection, $query);
                          while($row = mysqli_fetch_assoc($query_get_all_post)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $author = $row['author'];
                            $category = $row['category_id'];
                            $date = $row['date'];
                            $image = $row['image'];
                            $comment_count = $row['comment_count'];
                            $tag = $row['tag'];
                            $status = $row['status'];
                          ?>
                          <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $title ?></td>
                            <td><?php echo $author ?></td>
                            <td><?php echo $category ?></td>
                            <td><?php echo $status ?></td>
                            <td><img src='../images/<?php echo $image ?>' width=100 ></td>
                            <td><?php echo $tag ?></td>
                            <td><?php echo $comment_count ?></td>
                            <td><?php echo $date ?></td>
                          </tr>
                          <?php } ?>

                      </tbody>
                    </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "include/admin_footer.php" ?>
