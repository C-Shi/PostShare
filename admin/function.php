<?php

function get_all_categories() {
  global $connection;
  $query = "SELECT * FROM categories;";
  $query_get_categories = mysqli_query($connection, $query);
  $result = [];
  while($row = mysqli_fetch_assoc($query_get_categories)) {
    array_push($result, $row);
  }
  return $result;
}

function add_category() {
    global $connection;
    if(isset($_POST['submit'])) {
      $title = $_POST['title'];

      // validation for submit title
      if ($title === "" || empty($title)) {
          echo "This field should not be empty";
      } else {
          // adding verification for existing category
          $query = "INSERT INTO categories(title) VALUES('{$title}')";
          $query_create_category = mysqli_query($connection, $query);

          if(!$query_create_category) {
              die('Query Failed' . mysqli_error($connection));
          }
      }
    }
}

function update_category() {
  global $connection;
  if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $id = $_POST['cat_id'];
    $query = "UPDATE categories SET title = '{$title}' WHERE id = {$id};";
    $update_cat_query = mysqli_query($connection, $query);
    if (!$update_cat_query) {
        die('Query Failed ' . mysqli_error($connection));
    } else {
        unset($_GET);
    }
  }
}

function delete_category() {
  global $connection;
  if(isset($_GET['delete'])) {
      $cat_id = $_GET['delete'];
      $query = "DELETE FROM categories WHERE id = {$cat_id};";
      $query_delete_category = mysqli_query($connection, $query);
      if(!$query_delete_category) {
          die('Query Failed' . mysqli_error($connection));
      } else {
          header("Location: categories.php");
      }
  }

}

function show_edit() {
  global $connection;
  if(isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $query = "SELECT * FROM categories WHERE id = {$edit_id};";
    $query_get_categories = mysqli_query($connection, $query);
    $category = mysqli_fetch_assoc($query_get_categories);
    echo "<div class='form-group'>";
    echo "<input type='text' class='form-control' name='title' value={$category['title']}>";
    echo "<input type='hidden' name='cat_id' value={$edit_id}>";
    echo "</div>";
    echo "<input type='submit' name='update' class='btn btn-primary' value='Update Category'>";
  }
}


?>