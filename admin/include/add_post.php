<?php

  if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $tag = $_POST['tag'];
    $content = $_POST['content'];
    $date = date('d-m-y');
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $comment_count = 4;

    move_uploaded_file($image_temp, "../images/" . $image);
  }
 ?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>Post Title: </label>
    <input type="text" name="title" class="form-control">
  </div>

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
    <label>Upload Image: </label>
    <input type="file" name="image">
  </div>

  <button type="submit" name="create_post" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Add Post</button>
</form>