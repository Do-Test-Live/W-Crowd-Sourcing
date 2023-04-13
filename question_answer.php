<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (!isset($_SESSION['userid'])) {
    header("Location: Login");
}
$userid = $_SESSION['userid'];

$question_id = $_GET['question_id'];
$notification_id = $_GET['nid'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Question Answer - Crowd Sourcing</title>
    <?php include('include/css.php'); ?>


</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="Dashboard" class="brand-logo">
            <h1>Your Logo</h1>
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->


    <!--**********************************
        Header start
    ***********************************-->
    <?php include('include/header.php'); ?>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <?php include('include/sidebar.php'); ?>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="form-head mb-4">
                <h2 class="text-black font-w600 mb-0">Submit Answer</h2>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="Insert" method="post">
                                    <?php
                                    $question = $db_handle->runQuery("select * from question where question_id = '$question_id'");
                                    ?>
                                    <div class="form-row">
                                        <input type="hidden" value="<?php echo $question_id;?>" name="question_id">
                                        <input type="hidden" value="<?php echo $notification_id;?>" name="notification_id">
                                        <div class="form-group col-md-12" id="payment">
                                            <!--<label>Payment</label>-->
                                            <p><?php echo $question[0]['question'];?></p>
                                        </div>
                                        <div class="form-group col-md-12" id="time">
                                            <label>Answer</label>
                                            <input type="text" class="form-control input-default" placeholder="answer" name="answer">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit_notification_answer">Submit Answer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <?php include('include/js.php'); ?>


</body>

</html>