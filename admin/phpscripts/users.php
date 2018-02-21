<?php
function createUser($fname, $username, $password, $email, $lvllist){
  include('connect.php');
  $userstring = "INSERT INTO tbl_user VALUES(NULL,'{$fname}','{$username}','{$password}','{$email}', NULL, 'no','{$lvllist}')";//order is important, it has to matchup with the database
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
