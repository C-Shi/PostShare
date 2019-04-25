<?php
  // get post info from database
  if(isset($_GET['p_id'])) {
    $id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE id = {$id}";
    $query_get_post = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_get_post)) {
      $post_id = $row['id'];
      $post_title = $row['title'];
      $post_author = $row['author'];
      $post_tag = $row['tag'];
      $post_content = $row['content'];
      $post_status = $row['status'];
      $cat_id = $row['category_id'];
      $image = $row['image'];
    }
  }

  if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id'];
    $category_id = $_POST['category_id'];
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
    // check if image is re-upload
    if (empty($image)) {
      $image_q = "SELECT image FROM posts WHERE id = {$post_id}";
      $image_q_get = mysqli_query($connection, $image_q);
      while($row = mysqli_fetch_assoc($image_q_get)) {
        $image = $row['image'];
      }
    }
    $query = "UPDATE posts SET ";
    $query .= "title = '{$title}', author = '{$author}', tag = '{$tag}', content = '{$content}', image = '{$image}', status = '{$status}', category_id = {$category_id} ";
    $query .= "WHERE id = {$post_id}";

    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
      die('Query Failed '. mysqli_error($connection));
    } else {
      header('Location: post.php');
    }
  }

?>

<form action="" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
  <div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="<?php echo $post_title ?>">
  </div>

  <div class="form-group">
    <label>Category</label>
    <select class="form-control" id="category" name="category_id">
      <?php
        $categories = get_all_categories();
        foreach($categories as $category) {
          if ($category['id'] === $cat_id) {
            echo "<option value='{$category['id']}' selected=selected>{$category['title']}</option>";
          } else {
            echo "<option value='{$category['id']}'>{$category['title']}</option>";
          }
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label>Author</label>
    <input type="text" name="author" class="form-control" value="<?php echo $post_author ?>">
  </div>

  <div class="form-group">
    <label>Tag</label>
    <input type="text" name="tag" class="form-control" value="<?php echo $post_tag ?>">
  </div>

  <div class="form-group">
    <label>Content</label>
    <textarea class="form-control" name="content"><?php echo $post_content ?></textarea>
  </div>

  <div class="form-group">
      <label>Status</label>
      <select class="form-control" name="status">
        <?php
          $status = ['PUBLISHED', 'DRAFT', 'REJECTED'];
          foreach($status as $stat) {
            if ($stat === $post_status) {
              echo "<option selected='selected'>{$stat}</option>";
            } else {
              echo "<option>{$stat}</option>";
            }
          }
         ?>
      </select>
  </div>

  <div class="form-group"><image width="100" src="../images/<?php echo $image ?>"></div>
  <div class="form-group">
    <label>Upload Image: </label>
    <input type="file" name="image">
  </div>

  <button type="submit" name="edit_post" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Update Post</button>
</form>