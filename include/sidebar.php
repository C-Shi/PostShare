<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </input>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                <?php
                    $query = "SELECT * FROM categories";
                    $query_select_all_categories = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($query_select_all_categories)) {
                        $title = $row['title'];
                        $category_id = $row['id'];
                        echo "<li><a href='category.php?category_id={$category_id}'>$title</a>";
                    }
                ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>
</div>