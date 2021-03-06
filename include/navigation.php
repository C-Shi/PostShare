<!-- logout logic -->
<?php 
    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_GET['logout']);
        header("Location: index.php");
    }
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!-- Echo out all categories on navigation-->
                <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $title = $row['title'];
                        echo "<li><a>{$title}</a></li>";
                    }
                ?>
                <?php 
                    if($_SESSION['current_user_id']) {
                        echo "<li><a href=\"profile.php\">Profile</a></li>";
                    }

                    if($_SESSION['current_user_id'] && $_SESSION['current_user_role'] === 'Admin') {
                        echo "<li><a href=\"admin/index.php\">Admin</a></li>";
                    }
                ?>
            </ul>
            <?php if(isset($_SESSION['current_user_email'])): ?>
            <p class="navbar-text navbar-right">
                Welcome! <?php echo $_SESSION['current_user_email']; ?> <a href="index.php?logout" class="navbar-link">Sign Out</a>
            </p>
            <?php endif; ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>