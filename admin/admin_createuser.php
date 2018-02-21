<?php
require_once('phpscripts/config.php');
ini_set('display_errors',1);
error_reporting(E_ALL);
  //confirm_logged_in();
//require_once('phpscripts/connect.php');
if(isset($_POST['submit'])){
  $fname = trim($_POST['fname']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $email = trim($_POST['email']);
  $lvllist = trim($_POST['lvllist']);
  if(empty($lvllist)){
    $message = "lease select a user level";
  }else {
    $result = createUser($fname, $username, $password, $email, $lvllist);
    $message = $result;
  }
}
 ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Create User</title>
  </head>

  <body>
    <div class="createUser">
      <h2>Create User</h2>
      <?php if(!empty($message)){echo $message;}?>
      <form action="admin_createuser.php" method="post" class="createForm">
        <label>First Name:</label>
        <input type="text" name="fname" value="">
        <label>Username:</label>
        <input type="text" name="username" value="">
        <label>Paassword:</label>
        <input type="text" name="password" value="">
        <label>Email:</label>
        <input type="text" name="email" value="">
        <select name="lvllist">
       <option value="">Select User Level</option>
       <option value="2">Web admin</option>
       <option value="1">Web Master</option>
     </select><br><br>

        <input type="submit" name="submit" Password="submit">

      </form>
    </div>
  </body>

  </html>
