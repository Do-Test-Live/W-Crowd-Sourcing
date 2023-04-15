<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
$userid = $_SESSION['userid'];

if(isset($_GET['questionID'])){
    $delete = $db_handle->runQuery("delete from question where question_id = " . $_GET['questionID'] . "");
    echo 'success';
}