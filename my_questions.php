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
                <h2 class="text-black font-w600 mb-0">My Questions</h2>
            </div>
            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                ?>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    $select_detail = $db_handle->runQuery("SELECT q.question, q.payment,q.waiting_time,a.method_name,a.id as method_id, t.question_type, t.id as question_type_id   FROM question as q,answer_method as a,question_type as t WHERE q.user_id = '$userid' and q.method = a.id and q.question_id = '$id' AND q.type = t.id");
                                    ?>
                                    <form action="Update" method="post">
                                        <div class="form-row">
                                            <input type="hidden" value="<?php echo $id;?>" name="id">
                                            <div class="form-group col-md-12">
                                                <label>Question</label>
                                                <textarea class="form-control" rows="4" id="comment" name="new_question" required><?php echo $select_detail[0]['question'];?></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Choose Question Type:</label>
                                                <select class="form-control default-select" name="type">
                                                    <option selected value="<?php echo $select_detail[0]['question_type_id'];?>"><?php echo $select_detail[0]['question_type'];?></option>
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
                                                <label>Choose Method</label>
                                                <select id="answer_method" class="form-control default-select" name="method" onchange="myFunction()">
                                                    <option selected value="<?php echo $select_detail[0]['method_id'];?>"><?php echo $select_detail[0]['method_name'];?></option>
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
                                                <input type="number" class="form-control input-default " placeholder="payment" name="payment" value="<?php echo $select_detail[0]['payment'];?>">
                                            </div>
                                            <div class="form-group col-md-12" id="time" style="display: none">
                                                <label>Waiting Time (In Hours)</label>
                                                <input type="text" class="form-control input-default" placeholder="waiting time" name="waiting_time" value="<?php echo $select_detail[0]['waiting_time'];?>" >
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update_question">Update Question</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Question</th>
                                            <th>Question Type</th>
                                            <th>Tags</th>
                                            <th>Payment</th>
                                            <th>Edit</th>
                                            <th>View Answer</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $question = $db_handle->runQuery("SELECT * FROM `question`,answer_method WHERE question.user_id = '$userid' and question.method = answer_method.id");
                                        $no_question = $db_handle->numRows("SELECT * FROM `question`,answer_method WHERE question.user_id = '$userid' and question.method = answer_method.id");
                                        for($i=0; $i<$no_question; $i++){
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                <td><?php echo $question[$i]['question'];?></td>
                                                <td><?php echo $question[$i]['method_name'];?></td>
                                                <td><?php echo $question[$i]['tags'];?></td>
                                                <td><?php echo $question[$i]['payment'];?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="My-Questions?id=<?php echo $question[$i]['question_id']?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                    class="fa fa-pencil"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                    class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
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