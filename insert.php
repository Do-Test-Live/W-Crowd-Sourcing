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

    $check = $db_handle->runQuery("select * from user where user_email = '$email'");
    $no_check = $db_handle->numRows("select * from user where user_email = '$email'");
    if ($no_check == 0) {
        $insert = $db_handle->insertQuery("INSERT INTO `user`(`user_name`, `user_email`, `password`, `college`, `major`, `hall`, `society`, `gender`, `age`, `indoor`, `outdoor`, `request_type`, `updated_at`)
VALUES ('$username','$email','$Pwd_hashed','$college','$major','$hall','$society','$gender','$age','$indoor','$outdoor','$request_type','$inserted_at')");
        if ($insert) {
            $score = $db_handle->runQuery("select user_id from user where user_email = '$email'");
            $userid = $score[0]['user_id'];
            $insert_score = $db_handle->insertQuery("INSERT INTO `score`(`user_id`) VALUES ('$userid')");
            if ($insert_score) {
                echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Login';
                </script>";
            }
        } else {
            echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Register';
                </script>";
        }
    } else {
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Register';
                </script>";
    }
}


if (isset($_POST['question'])) {
    $question = $db_handle->checkValue($_POST['new_question']);
    $type = $db_handle->checkValue($_POST['type']);
    $tags = $_POST['tags'];
    $method = $db_handle->checkValue($_POST['method']);
    $payment = $db_handle->checkValue($_POST['payment']);
    $waiting_time = $db_handle->checkValue($_POST['waiting_time']);
    $select_tags = implode(',', $tags);
    $inserted_at = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];

    $insert = $db_handle->insertQuery("INSERT INTO `question`(`question`,`user_id`, `type`, `tags`, `method`, `payment`, `waiting_time`, `inserted_at`) VALUES 
                                                                ('$question','$userid','$type','$select_tags','$method','$payment','$waiting_time','$inserted_at')");
    if ($insert) {
        $tag = explode(',', $select_tags);
        $fetch_user = $db_handle->runQuery("select user_id from score");
        $no_fetch_user = $db_handle->numRows("select user_id from score");

        for ($i = 0; $i < $no_fetch_user; $i++) {
            $hash_tags_match = 0;
            $past_performance = 0;
            $count = 0;
            $time_difference_sum = 0;
            $average_response_time = 0;

            $userid = $fetch_user[$i]['user_id'];
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
            $points = $db_handle->runQuery("SELECT SUM(points) as point FROM `answer` where user_id = '$userid'");
            if (!is_null($points [0]['point'])) {
                $past_performance = $points[0]['point'];
            }
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

            $a = 3;
            $b = 3;
            $c = 4;
            $score = ($a * $hash_tags_match) + ($b * $past_performance) + ((1/$c) * $average_response_time);
            $update_score = $db_handle->insertQuery("update score set score = '$score' where user_id = '$userid'");
        }
        $select_question = $db_handle->runQuery("select count(question_id) as no_of_question from question");
        $question_id = $select_question[0]['no_of_question'];

        $select_user = $db_handle->runQuery("select * from score where user_id != '$userid' order by score desc limit 10");
        $no_select_user = $db_handle->numRows("select * from score where user_id != '$userid' order by score desc limit 10");

        for($j=0; $j<$no_select_user; $j++){
            $selected_user = $select_user[$j]['user_id'];
            $insert_notification = $db_handle->insertQuery("INSERT INTO `notification`(`user_id`, `question_id`, `inserted_at`) VALUES ('$selected_user','$question_id','$inserted_at')");
        }
        echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='New-Question';
                </script>";

    } else {
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='New-Question';
                </script>";
    }

}


if (isset($_POST['submit_answer'])) {
    $question_id = $db_handle->checkValue($_POST['question_no']);
    $answer = $db_handle->checkValue($_POST['answer']);
    $inserted_at = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];

    $insert = $db_handle->insertQuery("INSERT INTO `answer`( `user_id`, `question_id`, `answer`, `inserted_at`) VALUES ('$userid','$question_id','$answer','$inserted_at')");

    if ($insert) {
        echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Dashboard';
                </script>";
    } else {
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Dashboard';
                </script>";
    }
}