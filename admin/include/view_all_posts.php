  <!-- delete query -->
  <?php
    if(isset($_GET['delete_post'])) {
      $id = $_GET['delete_post'];
      $query = "DELETE FROM posts WHERE id = {$id};";
      $query_delete_post = mysqli_query($connection, $query);
      if (!$query_delete_post) {
        die("Query Failed ". mysqli_error($connection));
      }
      unset($_GET['delete_post']);
    }
  ?>

  <!-- table for showing all posts -->
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT posts.*, categories.title AS 'cat_title' FROM posts LEFT JOIN categories ON posts.category_id = categories.id";
        $query_get_all_post = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($query_get_all_post)) {
          $id = $row['id'];
          $title = $row['title'];
          $author = $row['author'];
          $category = $row['cat_title'];
          $date = $row['date'];
          $image = $row['image'];
          $comment_count = $row['comment_count'];
          $tag = $row['tag'];
          $status = $row['status'];
        ?>
        <tr>
          <td><?php echo $id ?></td>
          <td><?php echo $title ?></td>
          <td><?php echo $author ?></td>
          <td><?php echo $category ?></td>
          <td><?php echo $status ?></td>
          <td><img src='../images/<?php echo $image ?>' width=100 ></td>
          <td><?php echo $tag ?></td>
          <td><?php echo $comment_count ?></td>
          <td><?php echo $date ?></td>
          <td>
            <!-- this should submit to post.php not view_all_post.php because we do not want to go to different page -->
            <a href="post.php?source=edit_post&&p_id=<?php echo $id ?>" class="btn btn-sm btn-success">Edit</a>
            <a href="post.php?delete_post=<?php echo $id ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
          </td>
        </tr>
        <?php } ?>

    </tbody>
  </table>