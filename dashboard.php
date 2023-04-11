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
                <h2 class="text-black font-w600 mb-0">Dashboard</h2>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="widget-stat card bg-danger">
                                <div class="card-body  p-4">
                                    <div class="media">
									<span class="mr-3">
										<i class="flaticon-381-calendar-1"></i>
									</span>
                                        <div class="media-body text-white text-right">
                                            <p class="mb-1">Total Question Asked</p>
                                            <?php
                                            $total_question = $db_handle->runQuery("select count('question_id') as number from question");
                                            ?>
                                            <h3 class="text-white"><?php echo $total_question[0]['number']; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="widget-stat card bg-success">
                                <div class="card-body p-4">
                                    <div class="media">
									<span class="mr-3">
										<i class="flaticon-381-user-1"></i>
									</span>
                                        <div class="media-body text-white text-right">
                                            <p class="mb-1">Total Users</p>
                                            <?php
                                            $total_user = $db_handle->runQuery("select count('user_id') as number from user");
                                            ?>
                                            <h3 class="text-white"><?php echo $total_user[0]['number']; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="widget-stat card bg-info">
                                <div class="card-body p-4">
                                    <div class="media">
									<span class="mr-3">
										<i class="flaticon-381-search-2"></i>
									</span>
                                        <div class="media-body text-white text-right">
                                            <p class="mb-1">Total Question Answered</p>
                                            <h3 class="text-white">78</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <div class="widget-stat card bg-primary">
                                <div class="card-body p-4">
                                    <div class="media">
									<span class="mr-3">
										<i class="flaticon-381-heart"></i>
									</span>
                                        <div class="media-body text-white text-right">
                                            <p class="mb-1">My Points</p>
                                            <h3 class="text-white">76</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Open Questions to Answer</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>User</th>
                                        <th>Question Type</th>
                                        <th>Tags</th>
                                        <th>Payment</th>
                                        <th>Answer</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $select_question = $db_handle->runQuery("SELECT * FROM question,question_type,user where question.method = '1' and question.type = question_type.id AND question.user_id = user.user_id");
                                    $no_select_question = $db_handle->numRows("SELECT * FROM question,question_type,user where question.method = '1' and question.type = question_type.id AND question.user_id = user.user_id");
                                    for($j=0;$j<$no_select_question;$j++){
                                        ?>
                                        <tr>
                                            <td><?php echo $j+1;?></td>
                                            <td><?php echo $select_question[$j]['user_name'];?></td>
                                            <td><?php echo $select_question[$j]['question_type'];?></td>
                                            <td><?php echo $select_question[$j]['tags'];?></td>
                                            <td><?php echo $select_question[$j]['payment'];?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                class="fa fa-pencil"></i></a>
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