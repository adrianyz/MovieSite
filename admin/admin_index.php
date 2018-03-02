<?php
require_once('phpscripts/config.php');
  //confirm_logged_in();
require_once('phpscripts/connect.php');
if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
$previousTime = "SELECT user_date FROM tbl_user WHERE user_id = '{$user_id}'";
$timeToPass = mysqli_query($link, $previousTime);
$theTime = "";
if(mysqli_num_rows($timeToPass)){
  $founduser = mysqli_fetch_array($timeToPass, MYSQLI_ASSOC);
  $theTime = $_SESSION['user_date'];}}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="css/main.css">
   <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
   <title>Admin Panel</title>
 </head>
 <body>
<div class="greeting">
<?php
// generate different greeting base on current time
date_default_timezone_set('America/Toronto');

$currentTime = date('H:i:s');
$theUser = $_SESSION['user_name'];

if ( $currentTime >= "04:00:00" && $currentTime <= "11:00:00" ) {
    echo "<p>Morning, {$theUser}! <br> Have you had your daily survival juice yet?</p>" ;
} else if ( $currentTime >= "12:00:00" && $currentTime <= "18:00:00" ) {
    echo "<p>Hey, {$theUser}! <br> It's almost there, stay awake!</p>";
} else if ( $currentTime >= "19:00:00" || $currentTime <= "03:00:00" ) {
    echo "<p>Good Evening, {$theUser}! <br> Go watch some Schitt's Creek!</p>";
}
?>

<div class="loginTime">
  <?php
  echo "<p>Last time you were here: " . $theTime . "</p>";
  ?>
</div>

<h2><?php echo $_SESSION['user_name']; ?></h2>
<a href="admin_createuser.php">Create User</a>
<a href="admin_edituser.php">Edit User</a>
<a href="admin_deleteuser.php">Delete User</a>
<a href="phpscripts/caller.php?caller_id=logout">Sign Out</a>

</div>
 </body>
 </html>
