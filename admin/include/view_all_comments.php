<!-- php for delete comment -->
<?php 
  if(isset($_GET['delete_comment'])) {
    $comment_id = $_GET['delete_comment'];
    delete_comment($comment_id);
  }
?>
  
  
  <!-- table for showing all comments -->
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Post</th>
        <th>Author</th>
        <th>Content</th>
        <th>Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $query = "SELECT comments.*, posts.title AS title FROM comments LEFT JOIN posts ON posts.id = comments.post_id ORDER BY post_id;";
          $query_select_comments = mysqli_query($connection, $query);
          if (!$query_select_comments) {
            die('Query Failed '. mysqli_error($connection));
          }

          while($row = mysqli_fetch_assoc($query_select_comments)) {
            $comment_id = $row['id'];
            $post_title = $row['title'];
            $post_id = $row['post_id'];
            $author = $row['author'];
            $content = strlen($row['content']) > 30 ? substr($row['content'], 0, 30) . " ..." : $row['content'];
            $time = $row['time'];
        ?>
        <tr>
          <td><a href="../post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>
          <td><?php echo $author ?></td>
          <td><?php echo $content ?></td>
          <td><?php echo $time ?></td>
          <td>
            <!-- this should submit to post.php not view_all_post.php because we do not want to go to different page -->
            <a href="comment.php?delete_comment=<?php echo $comment_id ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
          </td>
        </tr>
        <?php } ?>

    </tbody>
  </table>