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
      $message = "<p>Please fill out the required fields.</p>";
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
  <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
  <title>Admin Login</title>
</head>
<body>

  <form action="admin_login.php" method="post" class="loginForm">
    <label>Username:</label>
    <input type="text" name="username" value=""></input>
    <br><br>
    <label>Password:</label>
    <input type="password" name="password" value=""></input>
    <br>
    <div class="eroMsg"><?php if(!empty($message)){ echo $message;} ?></div>
    <br>
    <input type="submit" name="submit" value="Ready to go!" class="button"></input>

  </form>
</body>
</html>
