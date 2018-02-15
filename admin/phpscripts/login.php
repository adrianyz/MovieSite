<?php
    function logIn($username, $password, $ip){
      require_once('connect.php');
      $username = mysqli_real_escape_string($link, $username);
      $password = mysqli_real_escape_string($link, $password);
      $loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
      //echo $loginstring;
      $user_set = mysqli_query($link, $loginstring);
      //echo mysqli_num_rows($user_set);
      if(mysqli_num_rows($user_set)){
        $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
        $id = $founduser['user_id'];
        //echo $id;
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $founduser['user_fname'];
        $_SESSION['user_date'] = $founduser['user_date'];

        if(mysqli_query($link, $loginstring)){
          $update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id = {$id}";
// update login time
          $login = "SELECT user_date FROM tbl_user WHERE user_id = {$id}";
          $lastLogin = mysqli_query($link, $login);
          $date = "UPDATE tbl_user SET user_date = CURRENT_TIMESTAMP where user_id = {$id}";
          $updateQuery = mysqli_query($link, $update);
          $newTime = mysqli_query($link, $date);
        }
        redirect_to("admin_index.php");
}else{
  $message = "Leaern how to type you dumb";
  echo $message;
}

      mysqli_close($link);
    }


 ?>
