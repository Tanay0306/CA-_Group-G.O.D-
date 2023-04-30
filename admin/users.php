<?php
SESSION_START();

if(isset($_SESSION['auth']))
{
   if($_SESSION['auth']!=1)
   {
       header("location:login.php");
   }
}
else
{
   header("location:login.php");
}
 include'header.php';
 include'lib/connection.php';

 if (isset($_POST['delete_user'])) {
     $user_id = $_POST['delete_user'];

     // Delete user
     $delete_sql = "DELETE FROM users WHERE id=$user_id";
     $result = $conn -> query ($delete_sql);
     if ($result) {
         // Redirect to user list
         header('Location: users.php');
         exit;
     } else {
         echo "Error deleting user: " . mysqli_error($conn);
     }
 }

 $sql = "SELECT * FROM users";
 $result = $conn -> query ($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pending_orders.css">

    <script>
        function confirmDelete(user_id) {
            var confirmation = confirm("Are you sure you want to delete this user?");
            if (confirmation) {
                document.getElementById('delete_form_' + user_id).submit();
            }
        }
    </script>
</head>
<body>

<div class="container pendingbody">
  <h5>All Users</h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
    <tr>
      <td><?php echo $row["id"] ?></td>
      <td><?php echo $row["f_name"] ?></td>
      <td><?php echo $row["l_name"] ?></td>
      <td><?php echo $row["email"] ?></td>
      <td>
          <form id="delete_form_<?php echo $row['id']; ?>" method="POST">
              <input type="hidden" name="delete_user" value="<?php echo $row['id']; ?>">
              <button type="button" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
          </form>
      </td>
    </tr>
    <?php 
    }
        } 
        else 
            echo "0 results";
        ?>
  </tbody>
</table>
</div>
    
</body>
</html>
