<?php

  function find_posts_by_category_id($cat_id) {
    global $connection;
    $query = "SELECT * FROM posts WHERE category_id = $cat_id";
    $query_find_posts = mysqli_query($connection, $query);
    $results = array();
    while ($row = mysqli_fetch_assoc($query_find_posts)) {
      array_push($results, $row);
    }
    return $results;
  }

 ?>