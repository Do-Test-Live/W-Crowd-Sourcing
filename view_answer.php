<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (!isset($_SESSION['userid'])) {
    header("Location: Login");
}
$userid = $_SESSION['userid'];
$question_id = $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>View Answer - Crowd Sourcing</title>
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
                <h2 class="text-black font-w600 mb-0">View Answer</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>User Name</th>
                                        <th>Answer</th>
                                        <th>Time</th>
                                        <th>Rating</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $question = $db_handle->runQuery("SELECT q.question, u.user_name,a.answer,a.inserted_at,a.answer_id,a.rating from question as q,user as u,answer as a where q.question_id = a.question_id and q.question_id = '$question_id' and a.user_id = u.user_id;");
                                    $no_question = $db_handle->numRows("SELECT q.question, u.user_name,a.answer,a.inserted_at,a.answer_id,a.rating from question as q,user as u,answer as a where q.question_id = a.question_id and q.question_id = '$question_id' and a.user_id = u.user_id;");
                                    for($i=0; $i<$no_question; $i++){
                                        ?>
                                        <tr>
                                            <td><?php echo $i+1;?></td>
                                            <td><?php echo $question[$i]['user_name'];?></td>
                                            <td><?php echo $question[$i]['answer'];?></td>
                                            <?php
                                            $date = date_create($question[$i]["inserted_at"]);
                                            $date_formatted = date_format($date, "d F y, g:i A");
                                            ?>
                                            <td><?php echo $date_formatted;?></td>
                                            <td><?php echo $question[$i]['rating'];?></td>
                                            <td><div class="d-flex">
                                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModalCenter"
                                                            onclick="passVariable(<?php echo $question[$i]['answer_id'];?>);">Rating</button>
                                                </div></td>

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

    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rating</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Update" method="post">
                        <div class="form-row">
                            <input type="hidden" value="" id="question_id" name="id">
                            <div class="form-group col-md-12" id="payment">
                                <label>Rating (Between 1 to 5)</label>
                                <input type="text" class="form-control input-default" placeholder="Rating" name="rating" pattern="[1-5]">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit_rating">Submit Rating</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
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
        function passVariable(x){
            document.getElementById("question_id").value = x;
        }
    </script>


</body>

</html>