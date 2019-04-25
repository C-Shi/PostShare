<?php

  if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $tag = $_POST['tag'];
    $content = $_POST['content'];
    $date = date('y-m-d');
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $status = $_POST['status'];
    $comment_count = 4;

    move_uploaded_file($image_temp, "../images/" . $image);

    $query = "INSERT INTO posts(title, author, tag, content, date, image, status) ";
    $query .= "VALUES('{$title}', '{$author}', '{$tag}', '{$content}', '${date}', '{$image}', '{$status}')";
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
      <select class="form-control">
        <option>PUBLISHED</option>
        <option>DRAFT</option>
        <option>REJECTED</option>
      </select>
  </div>

  <div class="form-group">
    <label>Upload Image: </label>
    <input type="file" name="image">
  </div>

  <button type="submit" name="create_post" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Add Post</button>
</form>