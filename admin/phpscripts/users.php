<?php
// require($_SERVER["DOCUMENT_ROOT"] . './MovieSite/vendor/autoload.php');
//
// use vendor\phpmailer\phpmailer\src\PHPMailer;
// use vendor\PHPMailer\PHPMailer\src\Exception;


function createUser($fname, $username, $password, $email, $lvllist){
  include('connect.php');
//hash and salt the password aka encrypted
$salted = "seasoningadded".$password."abitmore";
$hashed = hash('haval160,4',$salted);

  $userstring = "INSERT INTO tbl_user VALUES(NULL,'{$fname}','{$username}','{$hashed}','{$email}', NULL, 'no','{$lvllist}')";//order is important, it has to matchup with the database
  //echo $userstring;
$userquery = mysqli_query($link, $userstring);
if($userquery){

  $to      = $email;
  $subject = "Welcome to the Movie Site!";
  $content = "Hey" . $fname . "! Welcome aboard! Please log in on http://localhost. Your username is " . $username . " and your default password is " . $password . ". ";

  mail($to, $subject, $content);
  redirect_to('admin_index.php');

}else {
  $message = "Your hiring practices habe failed you.";
  return $message;
}
  mysqli_close($link);
}

function editUser($fname, $username, $password, $email, $id){
  include('connect.php');

  $salted = "seasoningadded".$password."abitmore";
  $hashed = hash('haval160,4',$salted);

  $updatestring = "UPDATE tbl_user SET user_fname='{$fname}',user_name='{$username}',user_pass='{$hashed}',user_email='{$email}' WHERE user_id={$id}";
  //echo $updatestring;

  $updatequery = mysqli_query($link, $updatestring);
  if($updatequery){
    redirect_to('admin_index.php');
  }else{
    $message = "Guess you got canned...";
    return $message;
  }
  mysqli_close($link);
}

// Use phpmailer to send user information to created users
// if($userquery){
//       $userMsg = "<p>Hey " . $fname . ", welcome aboard! Please find your login information here:" . "</p><br/><li>User Name: " . $username . "</li>" . "<li>Password: " . $password . "</li><br/><p>Plese click <a href='http://localhost/login'>HERE</a> to login.</p>";
//       //send email
//       $mailToUser = new PHPMailer(true);
//           try {
//               $mailToUser->isSMTP();
//               //$mailToUser->SMTPDebug = 2;
//               $mailToUser->SMTPSecure = 'ssl';// Enable verbose debug output
//               $mailToUser->Host = 'smtp.gmail.com';
//               $mailToUser->SMTPAuth = true;
//               $mailToUser->Username = 'yzhao333@gmail.com';
//               $mailToUser->Password = '78f3513441';
//               $mailToUser->Port = 465;
//               $mailToUser->setFrom('yzhao333@gmail.com', 'Admin');
//               $mailToUser->addAddress($email);
//               $mailToUser->isHTML(true);
//               $mailToUser->Subject = 'Welcome to the Movie Site';
//               $mailToUser->addReplyTo('yzhao333@gmail.com', 'Admin');
//               $mailToUser->Body = "<h2>New User</h2>" . $userMsg;
//               $mailToUser->AltBody = "<h2>New User</h2>" . $userMsg;
//               $mailToUser->send();
//               $mailSuccessMsgUser = "Email has been sent.";
//               $message = "You got a new member.";
//               return $message;
//               }
//             catch (Exception $e) {
//               echo 'Message could not be sent.';
//               echo 'Mailer Error: ' . $mailToUser->ErrorInfo;
//               $mailSuccessMsgUser = 'Message could not be sent. ' . 'Mailer Error: ' . $mailToUser->ErrorInfo;
//               return $mailSuccessMsgUser;
//               }
//       redirect_to('admin_createuser.php');
//     }else {
//       $message = "Your hiring practices have failed you.";
//       return $message;
//     }
//       mysqli_close($link);
//   }
//
function deleteUser($id){
  include('connect.php');
  $delstring = "DELETE FROM tbl_user WHERE user_id = {$id}";
  $delquery = mysqli_query($link, $delstring);
  if($delquery){
    redirect_to("../admin_index.php");
  }else{
    $message = "Byr, bye...";
    return $message;
  }
  mysqli_close($link);
}


?>
