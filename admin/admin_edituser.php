<?php
require_once('phpscripts/config.php');
ini_set('display_errors',1);
error_reporting(E_ALL);
  //confirm_logged_in();
//require_once('phpscripts/connect.php');

$id = $_SESSION['user_id'];
$tbl = "tbl_user";
$col = "user_id";
$popForm = getSingle($tbl, $col, $id);
$info = mysqli_fetch_array($popForm);
//echo $info;

if(isset($_POST['submit'])){
  $fname = trim($_POST['fname']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $email = trim($_POST['email']);
  $result = editUser($fname, $username, $password, $email, $id);
  $message = $result;
  }
 ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Edit User</title>
  </head>

  <body>
    <div class="createUser">
      <h2>Edit User</h2>
      <?php if(!empty($message)){echo $message;}?>
      <form action="admin_edituser.php" method="post" class="createForm">
        <label>First Name:</label>
        <input type="text" name="fname" value="
        <?php
        echo $info['user_fname'];
        ?>"><br>
        <label>Username:</label>
        <input type="text" name="username" value="<?php
        echo $info['user_name'];
        ?>"><br>
        <label>Paassword:</label>
        <input type="text" name="password" value="<?php
        echo $info['user_pass'];
        ?>"><br>
        <label>Email:</label>
        <input type="text" name="email" value="<?php
        echo $info['user_email'];
        ?>"><br>

        <input type="submit" name="submit" Password="submit" value="edit_account" id="submitBtn">

      </form>
    </div>
  </body>

  </html>
