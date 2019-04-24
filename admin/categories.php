<?php include "include/admin_header.php" ?>

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
                        <?php
                            if(isset($_POST['submit'])) {
                                $title = $_POST['title'];

                                // validation for submit title
                                if ($title === "" || empty($title)) {
                                    echo "This field should not be empty";
                                } else {
                                    // adding verification for existing category
                                    $query = "INSERT INTO categories(title) VALUES('{$title}')";
                                    $query_create_category = mysqli_query($connection, $query);

                                    if(!$query_create_category) {
                                        die('Query Failed' . mysqli_error($connection));
                                    }
                                }
                            }
                        ?>
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
                            <?php
                                if(isset($_POST['update'])) {
                                    $title = $_POST['title'];
                                    $id = $_POST['cat_id'];
                                    $query = "UPDATE categories SET title = '{$title}' WHERE id = {$id};";
                                    $update_cat_query = mysqli_query($connection, $query);
                                    if (!$update_cat_query) {
                                        die('Query Failed ' . mysqli_error($connection));
                                    } else {
                                        unset($_GET);
                                    }
                                }
                            ?>
                            <form action="" method="POST">
                                <?php
                                    if(isset($_GET['edit'])) {
                                        $edit_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE id = {$edit_id};";
                                        $query_get_categories = mysqli_query($connection, $query);
                                        $category = mysqli_fetch_assoc($query_get_categories);
                                        echo "<div class='form-group'>";
                                        echo "<input type='text' class='form-control' name='title' value={$category['title']}>";
                                        echo "<input type='hidden' name='cat_id' value={$edit_id}>";
                                        echo "</div>";
                                        echo "<input type='submit' name='update' class='btn btn-primary' value='Update Category'>";
                                    }
                                ?>
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
                                    <?php
                                        if(isset($_GET['delete'])) {
                                            $cat_id = $_GET['delete'];
                                            $query = "DELETE FROM categories WHERE id = {$cat_id};";
                                            $query_delete_category = mysqli_query($connection, $query);
                                            if(!$query_delete_category) {
                                                die('Query Failed' . mysqli_error($connection));
                                            } else {
                                                header("Location: categories.php");
                                            }
                                        }
                                    ?>
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
