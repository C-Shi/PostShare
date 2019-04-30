<?php 
  $query = "SELECT * FROM users";
  $query_get_users = mysqli_query($connection, $query);
  $results = array();
  if(!$query_get_users) {
    die('Query Failed ' . mysqli_error($connection));
  }
  while($row = mysqli_fetch_assoc($query_get_users)) {
    array_push($results, $row);
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
    <?php foreach($results as $user): ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
          <a class="btn btn-sm btn-success">Edit</a>
          <a class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
    <?php endforeach ; ?>
  </tbody>
</table>