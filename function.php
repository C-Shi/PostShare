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
        if($password === $user['password']) {
            header("Location: admin/index.php");
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">Incorrect Password</div>";
        }
    }
  }

 ?>