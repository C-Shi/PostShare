<div class="col-md-4">
    <!-- login form well -->
    <div class="well">
        <form action="index.php" method="POST">
            <h4>Login</h4>
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email Account" class="form-control">
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Your Password" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="login">Login</button>
                </span>
            </div>
            <br>
            <!-- login processer -->
            <?php 
                if(isset($_POST['login'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    login_processor($email, $password);
                    unset($_POST['login']);
                }
            ?>
        </form>
    </div>

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