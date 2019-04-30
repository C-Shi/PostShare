<?php 
// code for show all users 
  $users = get_all_users();
// code for delete user
  if(isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];
    delete_user($user_id);
  }
?>

<table class="table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Name</th>
      <th>Role</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user): ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
          <a class="btn btn-sm btn-success">Edit</a>
          <form style="display: inline" action="" method="POST">
            <button class="btn btn-sm btn-danger" type="submit" name="delete_user" value="<?php echo $user['id'] ?>">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach ; ?>
  </tbody>
</table>