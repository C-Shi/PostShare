<?php include "include/db.php"?>
<?php include "include/header.php" ?>
<?php include "function.php"?>
<?php include "include/navigation.php" ?>
<?php 
  $user = get_user_by_id($_SESSION['current_user_id']);

  if (isset($_POST['update_user'])) {
    $name = $_POST['name'];
    $id = $_SESSION['current_user_id'];
    $message = "";
    if (!$name) {
      $message = "Display Name Cannot Be Empty!";
    } else {
      $query = "UPDATE users SET name = '$name' WHERE id = $id; ";
      $query_update_user = mysqli_query($connection, $query);
      if(!$query_update_user) {
        $message = mysqli_error($connection);
      } elseif(mysqli_affected_rows($connection) === '0') {
        $message = "Cannot find targeted user!";
      } else {
        $message = "";
        header('Location: /');
      }
    }
  }
?>


<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <form action="" method="POST">
        <div class="form-group">
          <label for="">Email: </label>
          <input type="text" class="form-control" value="<?php echo $user['email']?>" readonly>
        </div>
        <div class="form-group">
          <label for="">Display Name: </label>
          <input type="text" class="form-control" name="name" value="<?php echo $user['name']?>" required>
        </div>
        <?php 
          if($message && $message !== "") {
            echo "<div class=\"alert alert-danger\" role=\"alert\">$message</div>";
          }
        ?>
        <button type="submit" name="update_user" class="btn btn-success">Update</button>
        <a href="/" class="btn btn-primary">Go Back</a>
      </form>
    </div>
  </div>
</div>