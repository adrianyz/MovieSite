<?php
function createUser($fname, $username, $password, $email, $lvllist){
  include('connect.php');
//hash and salt the password aka encrypted
$salted = "seasoningadded".$password."abitmore";
$hashed = hash('haval160,4',$salted);

  $userstring = "INSERT INTO tbl_user VALUES(NULL,'{$fname}','{$username}','{$hashed}','{$email}', NULL, 'no','{$lvllist}')";//order is important, it has to matchup with the database
  //echo $userstring;
$userquery = mysqli_query($link, $userstring);
if($userquery){
  redirect_to('admin_index.php');
}else {
  $message = "Your hiring practices habe failed you.";
  return $message;
}
  mysqli_close($link);
}

?>
