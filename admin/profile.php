<?php include "include/admin_header.php" ?>
<?php include "function.php" ?>
<?php $user = get_user_by_id($_SESSION['current_user_id']);?>



<div id="wrapper">
  <?php include "include/admin_navigation.php"?>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <h1>Welcome To Admin <small>Author</small></h1>
        <div class="col-lg-12">
        <!-- update profile handler -->
        <?php 
          if(isset($_POST['update_profile'])) {
            $current_user_id = $_SESSION['current_user_id'];
            $name = $_POST['name'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            $q_name = "UPDATE users SET name = '$name' WHERE id = $current_user_id";
            $q_update_name = mysqli_query($connection, $q_name);
            if(!$q_update_name) {
              die('Query Failed ' . mysqli_error($connection));
            }
            if(mysqli_affected_rows($connection) === '0') {
              echo "<div class=\"alert alert-danger\" role=\"alert\">Cannot Find User</div>";
            } else if(empty($_POST['old_password'])) {
              echo "<div class='alert alert-success' role='alert'>Update Completed</div>";
            } else if (!empty($_POST['old_password'])) {
              if($new_password !== $confirm_password) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">Password Please Confirmed</div>";
   
              }
              if($old_password === $user['password']) {
                $q_password = "UPDATE users SET password = '$new_password';";
                $q_reset_password = mysqli_query($connection, $q_password);
                if(!$q_reset_password) {
                  die('Query Failed '. mysqli_error($connection));
                }
                if(mysqli_affected_rows($connection) === '0') {
                  echo "<div class=\"alert alert-danger\" role=\"alert\">Cannot Find User</div>";
                } else {
                  echo "<div class='alert alert-success' role='alert'>Update Completed</div>";
                }
              } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\">Invalid Password Authentication</div>";
              }
            }
          }

          unset($_POST);
        ?>
          <!-- form for profile edit -->
          <form action="" method="POST">
            <div class="form-group">
              <label for="">Display Name: </label>
              <input class="form-control" type="text" name="name" value="<?php echo $user['name']?>">
            </div>

            <div id="password_reset" class="hidden">
              <div class="form-group">
                <label for="">Old password</label>
                <input class="form-control" type="password" name="old_password" placeholder="******">
              </div>
              <div class="form-group">
                <label for="">New Password</label>
                <input class="form-control" type="password" name="new_password" placeholder="******">
              </div>
              <div>
                <label>Confirm New Password</label>
                <input class="form-control" type="password" name="confirm_password" placeholder="******">
              </div>
            </div>
            <button id="change_password" type="button" class="btn btn-info btn-sm">Change Password</button>
            <button type="submit" name="update_profile" class="btn btn-sm btn-success">Update Profile</button>
            <button id="clear_password" type="button" class="btn btn-info btn-sm hidden">Clear Password</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include "include/admin_footer.php" ?>
<script src="js/profile.js"></script>