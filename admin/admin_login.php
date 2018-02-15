<?php
  require_once("phpscripts/config.php");
  $ip = $_SERVER['REMOTE_ADDR'];
  //echo $ip;

  if(isset($_POST['submit'])){
    //echo "Works";
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($username !== "" && $passward !== ""){
      $result = logIn($username, $password, $ip);
      $message = $result;
    }else{
      $message = "Please fill out the required fields.";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Panel</title>
</head>
<body>

  <?php if(!empty($message)){ echo $message;} ?>
  <form action="admin_login.php" method="post">
    <label>Username:</label>
    <input type="text" name="username" value=""></input>
    <br><br>
    <label>Password:</label>
    <input type="password" name="password" value=""></input>
    <br>
    <input type="submit" name="submit" value="Show me the money"></input>

  </form>
</body>
</html>
