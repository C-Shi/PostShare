<?php include "include/db.php"?>
<?php include "include/header.php" ?>
<?php include "function.php"?>

<?php 
  if(isset($_SESSION['current_user_id'])) {
    header("Location: /");
  }
?>

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      <h2>
      <a class="btn btn-sm" href="/"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
        Register
      </h2>
      <form action="" method="POST" class="well">
        <div class="form-group">
          <label for="">User Email: </label>
          <input type="email" class="form-control" name="email" placeholder="Your Email Account">
        </div>
        <div class="form-group">
          <label for="">Password: </label>
          <input type="password" class="form-control" name="new_password" placeholder="Enter Your Password">
        </div>
        <div class="form-group">
          <label for="">Confirm Password:</label>
          <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Your Password">
        </div>
        <div class="form-group">
          <label for="">Display Name:</label>
          <input type="text" class="form-control" name="name" placeholder="Name/Alias You Would Like to Display">
        </div>
        <?php 
            if(isset($_POST['register'])) {
              $email = $_POST['email'];
              $password = $_POST['new_password'];
              $confirm_password = $_POST['confirm_password'];
              $name = $_POST['name'];
              $message = register_user($email, $password, $confirm_password, $name);
              if ($message === 'Registeration Completed!') {
                // login_process($email, $password);
                echo "<div class='alert alert-success' role='alert' id='message'>$message</div>";
              } else {
                echo "<div class='alert alert-danger' role='alert' id='message'>$message</div>";
              }
              unset($_POST);
            }
        ?>
        <button type="submit" name="register" class="btn btn-sm btn-success">Register</button>
        <button type="button" id="clear" class="btn btn-sm btn-primary">Clear</button>
      </form>
    </div>
  </div>
</div>

<script>
  var message = $("#message");
  if(!message.is(':empty')) {
    setTimeout(function() {
      message.remove();
    }, 3000)
  }
</script>

<?php include "include/footer.php" ?>