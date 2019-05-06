<?php

  function find_posts_by_category_id($cat_id) {
    global $connection;
    $query = "SELECT * FROM posts WHERE category_id = $cat_id AND status = 'PUBLISHED'";
    $query_find_posts = mysqli_query($connection, $query);
    if (!$query_find_posts) {
      die('Query Failed ' . mysqli_error($connection));
    }
    $results = array();
    while ($row = mysqli_fetch_assoc($query_find_posts)) {
      array_push($results, $row);
    }
    return $results;
  }

  function find_comments_by_post_id($post_id) {
    global $connection;
    $query = "SELECT * FROM comments WHERE post_id = $post_id;";
    $query_find_comments = mysqli_query($connection, $query);

    if (!$query_find_comments) {
      die('Query Failed ' . mysqli_error($connection));
    }
    $results = array();
    while ($row = mysqli_fetch_assoc($query_find_comments)) {
      array_push($results, $row);
    }
    return $results;
  }

  function login_processor($email, $password) {
    global $connection;
    // sanitize login credential
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $query_find_user = mysqli_query($connection, $query);
    if(!$query_find_user) {
        die('Query Failed ' . mysqli_error($connection));
    }
    if(mysqli_num_rows($query_find_user) === '0') {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Account Does Not Exist</div>"; 
    } else {
        $user = mysqli_fetch_assoc($query_find_user);
        if(password_verify($password, $user['password'])){
          // set session about user
            $_SESSION['current_user_email'] = $user['email'];
            $_SESSION['current_user_name'] = $user['name'];
            $_SESSION['current_user_role'] = $user['role'];
            $_SESSION['current_user_id'] = $user['id'];
            header("Location: admin/index.php");
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">Incorrect Password</div>";
        }
    }
  }

  function register_user($email, $password, $confirm_password, $name) {
    global $connection;
    $message = "";
    // verify posted data
    if(!$email || !$password || !$confirm_password || !$name) {
      $message = "Empty Field Detected";
    } elseif ($password !== $confirm_password) {
      $message .= " Password Does Not Match";
    } else {
      $email = mysqli_real_escape_string($connection, $email);
      $password = mysqli_real_escape_string($connection, $password);
      $name = mysqli_real_escape_string($connection, $name);
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO users(email, password, name, role) VALUES('$email', '$hash', '$name', 'Subscriber');";
      $query_register_user = mysqli_query($connection, $query);
      if(!$query_register_user) {
        $message .= " " . mysqli_error($connection);
      } elseif (mysqli_affected_rows($connection) === '0') {
        $message .= " Cannot Insert!";
      } else {
        $message = "Registeration Completed!";
      } 
    }
    return $message;
  }

  function get_user_by_id($user_id) {
    global $connection;
    $query = "SELECT * FROM users WHERE id = $user_id;";
    $query_get_user = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($query_get_user);
    return $user;
  }

 ?>