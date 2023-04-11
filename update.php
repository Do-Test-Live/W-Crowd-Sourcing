<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
$userid = $_SESSION['userid'];


if(isset($_POST['update_question'])){
    $id = $db_handle->checkValue($_POST['id']);
    $new_question = $db_handle->checkValue($_POST['new_question']);
    $type = $db_handle->checkValue($_POST['type']);
    $method = $db_handle->checkValue($_POST['method']);
    $payment = $db_handle->checkValue($_POST['payment']);
    $waiting_time = $db_handle->checkValue($_POST['waiting_time']);
    $updated_at = date("Y-m-d H:i:s");

    $update = $db_handle->insertQuery("UPDATE `question` SET `question`='$new_question',`type`='$type',
                      `method`='$method',`payment`='$payment',`waiting_time`='$waiting_time',`updated_at`='$updated_at' WHERE question_id = '$id'");
    if($update){
        echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='My-Questions';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='My-Questions';
                </script>";
    }
}
