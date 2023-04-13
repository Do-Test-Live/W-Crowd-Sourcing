<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");


$select_tags = 'Sports,Photography,Hiking';
$tag = explode(',', $select_tags);

$fetch_user = $db_handle->runQuery("select user_id from score");
$no_fetch_user = $db_handle->numRows("select user_id from score");
for($i=0; $i<$no_fetch_user; $i++){
    $hash_tags_match = 0;
    $past_performance = 0;
    $count = 0;
    $time_difference_sum = 0;
    $average_response_time = 0;
    $userid = $fetch_user[$i]['user_id'];
    echo 'user id: '.$userid.'<br>';
    $select_in_out = $db_handle->runQuery("select indoor, outdoor from user where user_id = '$userid'");
    $indoor = $select_in_out[0]['indoor'];
    $outdoor = $select_in_out[0]['outdoor'];
    foreach ($tag as $t) {
        if ($t === $indoor) {
            $hash_tags_match = $hash_tags_match + 1;
        }
        if ($t === $outdoor) {
            $hash_tags_match = $hash_tags_match + 1;
        }
    }
    echo 'hashtags matched: '.$hash_tags_match.'<br>';
    $points = $db_handle->runQuery("SELECT SUM(points) as point FROM `answer` where user_id = '$userid'");
    if (!is_null($points [0]['point'])) {
        $past_performance = $points[0]['point'];
    }
    echo 'past performance: '.$past_performance.'<br>';
    $answer = $db_handle->runQuery("select * from answer where user_id = '$userid'");
    $no_answer = $db_handle->numRows("select * from answer where user_id = '$userid'");
    if ($no_answer > 0) {
        for ($m = 0; $m < $no_answer; $m++) {
            $answer_time = $answer[$m]['inserted_at'];
            $no_q = $answer[$m]['question_id'];
            $question = $db_handle->runQuery("select inserted_at from question where question_id = '$no_q'");
            $question_time = $question[0]['inserted_at'];


            // Convert the strings to DateTime objects
            $date1 = new DateTime($answer_time);
            $date2 = new DateTime($question_time);

            // Calculate the time difference in seconds
            $time_diff_seconds = $date1->getTimestamp() - $date2->getTimestamp();

            // Convert the time difference to minutes
            $time_diff_minutes = intval($time_diff_seconds / 60);
            $time_difference_sum += $time_diff_minutes;
        }
        $average_response_time = $time_difference_sum / $no_answer;
    }
    echo 'average response time: '.$average_response_time.'<br>';

    $a = 3;
    $b = 3;
    $c = 4;
    $score = ($a * $hash_tags_match) + ($b * $past_performance) + ((1/$c) * $average_response_time);

    echo 'Score: '.$score.'<br>';
}