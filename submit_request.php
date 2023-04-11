<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (!isset($_SESSION['userid'])) {
    header("Location: Login");
}
$userid = $_SESSION['userid'];

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Crowd Sourcing</title>
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
                <h2 class="text-black font-w600 mb-0">Submit New Question</h2>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="Insert" method="post">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Question</label>
                                            <textarea class="form-control" rows="4" id="comment" name="new_question" required></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Choose Question Type:</label>
                                            <select class="form-control default-select" name="type">
                                                <option selected>Choose Question Type.</option>
                                                <?php
                                                $question_type = $db_handle->runQuery("select * from question_type");
                                                $no_question_type = $db_handle->numRows("select * from question_type");
                                                for($i=0; $i<$no_question_type;$i++){
                                                    ?>
                                                    <option value="<?php echo $question_type[$i]['id'];?>"><?php echo $question_type[$i]['question_type'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Select Tags for that question (At most 3):</label>
                                            <select multiple class="form-control default-select" id="sel2" name="tags[]">
                                                <option value="Computer games">Computer games</option>
                                                <option value="Music">Music</option>
                                                <option value="Reading">Reading</option>
                                                <option value="Revision">Revision</option>
                                                <option value="Sports">Sports</option>
                                                <option value="Photography">Photography</option>
                                                <option value="Hiking">Hiking</option>
                                                <option value="Social Work">Social Work</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Choose Method</label>
                                            <select id="answer_method" class="form-control default-select" name="method" onchange="myFunction()">
                                                <option selected value="">Choose Answer Method.</option>
                                                <?php
                                                $answer_method = $db_handle->runQuery("select * from answer_method");
                                                $no_answer_method = $db_handle->numRows("select * from answer_method");
                                                for($i=0; $i<$no_answer_method;$i++){
                                                    ?>
                                                    <option value="<?php echo $answer_method[$i]['id'];?>"><?php echo $answer_method[$i]['method_name'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12" id="payment">
                                            <label>Payment</label>
                                            <input type="number" class="form-control input-default " placeholder="payment" name="payment">
                                        </div>
                                        <div class="form-group col-md-12" id="time" style="display: none">
                                            <label>Waiting Time (In Hours)</label>
                                            <input type="text" class="form-control input-default" placeholder="waiting time" name="waiting_time" value="0">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="question">Submit Question</button>
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
    <script>
        function myFunction() {
            let x = document.getElementById("answer_method").value;
            let p =document.getElementById("time");
            if(x == 2 || x == 3){
                p.style.display = 'block';
            }else{
                p.style.display = 'none';
            }
        }
    </script>

</body>

</html>