<?php

  if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];
    $tag = $_POST['tag'];
    $content = $_POST['content'];
    $date = date('y-m-d');
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $status = $_POST['status'];

    move_uploaded_file($image_temp, "../images/" . $image);

    $query = "INSERT INTO posts(title, category_id, author, tag, content, date, image, status) ";
    $query .= "VALUES('{$title}',{$category_id} ,'{$author}', '{$tag}', '{$content}', '${date}', '{$image}', '{$status}')";
    $create_post_query = mysqli_query($connection, $query);

    if(!$create_post_query) {
      die('Query Failed '. mysqli_error($connection));
    }
  }
 ?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control">
  </div>

  <div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control">
      <?php
        $categories = get_all_categories();
        foreach($categories as $category) {
          echo "<option value='${category['id']}'>{$category['title']}</option>";
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label>Author</label>
    <input type="text" name="author" class="form-control">
  </div>

  <div class="form-group">
    <label>Tag</label>
    <input type="text" name="tag" class="form-control">
  </div>

  <div class="form-group">
    <label>Content</label>
    <textarea class="form-control" name="content"></textarea>
  </div>

  <div class="form-group">
      <label>Status</label>
      <select class="form-control" name="status">
        <option value="PUBLISHED">PUBLISHED</option>
        <option value="DRAFT">DRAFT</option>
        <option value="REJECTED">REJECTED</option>
      </select>
  </div>

  <div class="form-group">
    <label>Upload Image: </label>
    <input type="file" name="image">
  </div>

  <button type="submit" name="create_post" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Add Post</button>
</form>