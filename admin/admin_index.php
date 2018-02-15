<?php
require_once('phpscripts/config.php');
  confirm_logged_in();
require_once('phpscripts/connect.php');
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
 </head>
 <body>
<div class="greeting">
<?php
// generate different greeting base on current time
date_default_timezone_set('America/Toronto');

$currentTime = date('H:i:s');
$theUser = $_SESSION['user_name'];

if ( $currentTime >= "04:00:00" && $currentTime <= "11:00:00" ) {
    echo "Morning, {$theUser}! Have you had your daily survival juice yet?" ;
} else if ( $currentTime >= "12:00:00" && $currentTime <= "18:00:00" ) {
    echo "Hey, {$theUser}! It's almost there, stay awake!";
} else if ( $currentTime >= "19:00:00" || $currentTime <= "03:00:00" ) {
    echo "Good Evening, {$theUser}! Go watch some Schitt's Creek!";
}
?></div>

<div class="loginTime">
  <?php
  $user_id = $_SESSION['user_id'];
  $previousTime = "SELECT user_date FROM tbl_user WHERE user_id = '{$user_id}'";
  $timeToPass = mysqli_query($link, $previousTime);
  $theTime;

  if(mysqli_num_rows($timeToPass)){
    $founduser = mysqli_fetch_array($timeToPass, MYSQLI_ASSOC);
    $theTime = $founduser['user_date'];
    echo "<p>You were here: " . $theTime. "</p>";
  }


  ?>
</div>
 </body>
 </html>
