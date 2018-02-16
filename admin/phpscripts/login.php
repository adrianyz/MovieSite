<?php
function logIn($username, $password, $ip) {
    require_once('connect.php');
    date_default_timezone_set('America/Toronto');
    //added a new table tbl_attempts to store attempts
    $checkAttempt = "SELECT * FROM tbl_attempts WHERE att_ip = '{$ip}'";
    $checkResult = mysqli_query($link, $checkAttempt);
    $ticTok = 1;
    if(mysqli_num_rows($checkResult)){
        $att = mysqli_fetch_array($checkResult, MYSQLI_ASSOC);
        if($att['att_time'] > 3){
            $message = "Oops, you got trouble.";
            return $message;
            //lock after 3 tries. reference:http://webcheatsheet.com/php/blocking_system_access.php
        }
        else{
            $username = mysqli_real_escape_string($link, $username);
            $password = mysqli_real_escape_string($link, $password);
            $loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
            $user_set = mysqli_query($link, $loginstring);
            if(mysqli_num_rows($user_set)){
                $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
                $id = $founduser['user_id'];
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name']= $founduser['user_fname'];

                //update login time
                $setTime = date('Y-m-d H:i:s');
                $update = "UPDATE tbl_user SET user_ip='{$ip}', user_date='{$setTime}' WHERE user_id={$id}";
                $updateQuery = mysqli_query($link, $update);


                //zero attempt when successfully logged in
                $attemptZero = "DELETE * FROM tbl_attempts WHERE att_ip = '{$ip}'";
                $delResult = mysqli_query($link, $attemptZero);

                redirect_to("admin_index.php");
            }else{
                //counting attempts
                $ticTok = $att['att_time'] + 1;
                $updateAtt = "UPDATE tbl_attempts SET att_time = '{$ticTok}' WHERE att_ip = '{$ip}'";
                $updateResult = mysqli_query($link, $updateAtt);
                $message = "Something went wrong, try again.";
                return $message;
            }
            mysqli_close($link);
        }
    }
    else{
        $username = mysqli_real_escape_string($link, $username);
        $password = mysqli_real_escape_string($link, $password);
        $loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
        $user_set = mysqli_query($link, $loginstring);
        //echo mysqli_num_rows($user_set);
        if(mysqli_num_rows($user_set)){
            $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
            $id = $founduser['user_id'];
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name']= $founduser['user_fname'];

            //update login time
            $setTime = date('Y-m-d H:i:s');
            $update = "UPDATE tbl_user SET user_ip='{$ip}', user_date='{$setTime}' WHERE user_id={$id}";
            $updateqQuery = mysqli_query($link, $update);

            redirect_to("admin_index.php");
        }else{
            $createAttempt = "INSERT INTO tbl_attempts (att_time, att_ip) VALUES ('1', '{$ip}')";
            $createResult = mysqli_query($link, $createAttempt);
            $message = "Your username or password is invalid.";
            return $message;
        }
        mysqli_close($link);
    }
}


 ?>
