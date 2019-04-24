<?php include "include/admin_header.php" ?>
<?php include "function.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "include/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

                        <!-- add category form -->
                        <?php add_category() ?>
                        <div class="col-sm-6">
                            <!-- form for adding category -->
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label>Category Title</label>
                                    <input type="test" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                                </div>
                            </form>

                            <!-- form for edit category -->
                            <!-- update query for category title -->
                            <?php update_category() ?>

                            <form action="" method="POST">
                                <?php show_edit() ?>
                            </form>
                        </div>

                        <!-- view all categories table -->
                        <div class="col-sm-6">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- catch delete request -->
                                    <?php delete_category() ?>
                                    <?php
                                        $query = "SELECT * FROM categories";
                                        $query_select_all_categories = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_assoc($query_select_all_categories)){
                                            $id = $row['id'];
                                            $title = $row['title'];
                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $title ?></td>
                                            <td><a href="categories.php?delete=<?php echo $id ?>">Delete</a></td>
                                            <td><a href="categories.php?edit=<?php echo $id ?>">Edit</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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
