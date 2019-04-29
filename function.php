<?php

  function find_posts_by_category_id($cat_id) {
    global $connection;
    $query = "SELECT * FROM posts WHERE category_id = $cat_id";
    $query_find_posts = mysqli_query($connection, $query);
    if (!$query_find_comments) {
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

 ?>