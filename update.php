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

if(isset($_POST['submit_rating'])){
    $id = $db_handle->checkValue($_POST['id']);
    $rating = $db_handle->checkValue($_POST['rating']);


    $point = 1;
    if($rating == '5'){
        $update_point = $point + 3;
    }elseif ($rating == '4'){
        $update_point = $point + 2;
    }elseif ($rating == '3'){
        $update_point = $point + 1;
    }elseif ($rating == '2'){
        $update_point = $point + 0;
    }elseif ($rating == '1'){
        $update_point = $point - 2;
    }elseif ($rating == '0'){
        $update_point = $point - 3;
    }


    $update = $db_handle->insertQuery("update answer set rating = '$rating',points = '$update_point' where answer_id = '$id'");
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

if(isset($_POST['variable'])){
    $a = $db_handle->checkValue($_POST['a']);
    $b = $db_handle->checkValue($_POST['b']);
    $c = $db_handle->checkValue($_POST['c']);
    $updated_at = date("Y-m-d H:i:s");

    $update = $db_handle->insertQuery("UPDATE `variables` SET `a`='$a',`b`='$b',`c`='$c',`updated_at`='$updated_at' WHERE id='1'");
    if($update){
        echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Dashboard';
                </script>";
    }else{
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Dashboard';
                </script>";
    }
}
