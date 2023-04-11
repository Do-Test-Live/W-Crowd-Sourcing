<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
$userid = $_SESSION['userid'];

if (isset($_POST["sign_up"])) {
    $username = $db_handle->checkValue($_POST['username']);
    $email = $db_handle->checkValue($_POST['email']);
    $college = $db_handle->checkValue($_POST['college']);
    $major = $db_handle->checkValue($_POST['major']);
    $hall = $db_handle->checkValue($_POST['hall']);
    $society = $db_handle->checkValue($_POST['society']);
    $gender = $db_handle->checkValue($_POST['gender']);
    $age = $db_handle->checkValue($_POST['age']);
    $indoor = $db_handle->checkValue($_POST['indoor']);
    $outdoor = $db_handle->checkValue($_POST['outdoor']);
    $request_type = $db_handle->checkValue($_POST['request_type']);
    $password = $db_handle->checkValue($_POST['password']);
    $key = 'crowd_sourcing';
    $Pwd_peppered = Hash_hmac("Sha256", $password, $key);
    $Pwd_hashed = Password_hash($Pwd_peppered, PASSWORD_ARGON2ID);

    $inserted_at = date("Y-m-d H:i:s");

    $insert = $db_handle->insertQuery("INSERT INTO `user`(`user_name`, `user_email`, `password`, `college`, `major`, `hall`, `society`, `gender`, `age`, `indoor`, `outdoor`, `request_type`, `updated_at`)
VALUES ('$username','$email','$Pwd_hashed','$college','$major','$hall','$society','$gender','$age','$indoor','$outdoor','$request_type','$inserted_at')");
    if($insert){
        echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Login';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Register';
                </script>";
    }
}


if(isset($_POST['question'])){
    $question = $db_handle->checkValue($_POST['new_question']);
    $type = $db_handle->checkValue($_POST['type']);
    $tags = $_POST['tags'];
    $method = $db_handle->checkValue($_POST['method']);
    $payment = $db_handle->checkValue($_POST['payment']);
    $waiting_time = $db_handle->checkValue($_POST['waiting_time']);
    $select_tags = implode(',',$tags);
    $inserted_at = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];

    $insert = $db_handle->insertQuery("INSERT INTO `question`(`question`,`user_id`, `type`, `tags`, `method`, `payment`, `waiting_time`, `inserted_at`) VALUES 
                                                                ('$question','$userid','$type','$select_tags','$method','$payment','$waiting_time','$inserted_at')");
    if($insert){
        echo "<script>
                document.cookie = 'alert = 4;';
                window.location.href='New-Question';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='New-Question';
                </script>";
    }

}