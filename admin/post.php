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

                      <?php

                        if(isset($_GET['source'])) {
                          $source = $_GET['source'];
                        } else {
                          $source = "";
                        }

                        switch($source) {
                          case "add_post":
                          include "include/add_post.php";
                          break;

                          case "edit_post":
                          include "include/edit_post.php";
                          break;

                          default:
                          include "include/view_all_posts.php";
                        }

                       ?>
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


