<?php 
  // render edit page for target user
  if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user = get_user_by_id($user_id);
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error! </strong>No User Info Provided! <a href=\"users.php\">Go Back</a></div>";
    die();
  }

  // Handle Update User Request
  if(isset($_POST['update_user'])) {
    $udpate_user_id = $_POST['update_user'];
    $role = $_POST['role'];
    $query = "UPDATE users SET role = '$role' WHERE id = $udpate_user_id";
    $query_update_role = mysqli_query($connection, $query);
    if(!$query_update_role) {
      die('Query Failed ' . mysqli_error($connection));
    }
    if(mysqli_affected_rows($connection) == 0) {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Nothing Updated! Please Verify Form Info</div>";
      exit(0);
    }
    header("Location: users.php");
  }
?>

<form action="" method="POST">
  <div class="form-group">
    <label>Name: </label>
    <input type="text" class="form-control" value="<?php echo $user['name'] ?>" readonly>
  </div>
  <div class="form-group">
    <label>Email: </label>
    <input type="email" class="form-control" value="<?php echo $user['email'] ?>" readonly>
  </div>
  <div class="form-group">
    <label>Role: </label>
    <select name="role" id="" class="form-control">
      <?php 
          foreach(["Admin", "Subscriber"] as $role) {
            if ($user['role'] === $role) {
              echo "<option value=\"{$role}\" selected=\"selected\">{$role}</option>";
            } else {
              echo "<option value=\"{$role}\">{$role}</option>";
            }
          }
      ?>
    </select>
    <hr>
    <div class="form-group">
      <button type="submit" name="update_user" value="<?php echo $user['id'] ?>" class="btn btn-sm btn-success">Update</button>
      <a href="users.php" class="btn btn-sm btn-primary">Go Back</a>
    </div>
  </div>
</form>

