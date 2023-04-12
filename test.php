<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");


echo $userid = $_SESSION['userid'];
echo '<br>';
$hash_tags_match = 0;
$past_performance = 0;


$hash_tags = $db_handle->runQuery("select tags from question where question_id = '1'");
$tags = $hash_tags[0]['tags'];
$tag = explode(',', $tags);
foreach ($tag as $t) {
    $select_in_out = $db_handle->runQuery("select indoor, outdoor from user where user_id = '$userid'");
    $indoor = $select_in_out[0]['indoor'];
    $outdoor = $select_in_out[0]['outdoor'];
    if ($t === $indoor) {
        $hash_tags_match = $hash_tags_match + 1;
    }
    if ($t === $outdoor) {
        $hash_tags_match = $hash_tags_match + 1;
    }
}
echo 'Hash Tags Matched: ' . $hash_tags_match;

echo '<br>';

$points = $db_handle->runQuery("SELECT SUM(points) as point FROM `answer` where user_id = '$userid'");
$past_performance = $points[0]['point'];
echo 'Past Performance: ' . $past_performance . '<br>';


$count = 0;
$time_difference_sum = 0;

$answer = $db_handle->runQuery("select * from answer where user_id = '$userid'");
$no_answer = $db_handle->numRows("select * from answer where user_id = '$userid'");
for ($m = 0; $m < $no_answer; $m++) {
    $answer_time = $answer[0]['inserted_at'];
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
echo 'Total Time Difference: ' . $time_difference_sum .'<br>';
$average_response_time = $time_difference_sum / $no_answer;
echo 'Average Response Time: '.$average_response_time.'<br>';

$a = 3;
$b = 3;
$c = 4;

$score = ($a * $hash_tags_match) + ($b * $past_performance) + ((1/$c) * $average_response_time);
echo 'Final Score: '.$score.'<br>';