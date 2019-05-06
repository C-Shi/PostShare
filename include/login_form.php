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
            <small>Not Yet With Us? <a href="register.php">Register Now</a></small>
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