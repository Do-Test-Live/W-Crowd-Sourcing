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
    <title>All Questions - Crowd Sourcing</title>
    <link href="vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
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
                <h2 class="text-black font-w600 mb-0">All Questions</h2>
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
                                            <th>Question</th>
                                            <th>Question Type</th>
                                            <th>Tags</th>
                                            <th>View Details</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $question = $db_handle->runQuery("SELECT * FROM question,answer_method,user WHERE  question.method = answer_method.id and user.user_id = question.user_id");
                                        $no_question = $db_handle->numRows("SELECT * FROM question,answer_method,user WHERE  question.method = answer_method.id and user.user_id = question.user_id");
                                        for($i=0; $i<$no_question; $i++){
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                <td><?php echo $question[$i]['user_name'];?></td>
                                                <td><?php echo $question[$i]['question'];?></td>
                                                <td><?php echo $question[$i]['method_name'];?></td>
                                                <td><?php echo $question[$i]['tags'];?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="Details?question_id=<?php echo $question[$i]['question_id'];?>"
                                                           class="btn btn-primary shadow btn-xs sharp"><i
                                                                    class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a onclick="productDelete(<?php echo $question[$i]["question_id"];?>);"
                                                           class="btn btn-danger shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></a>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        function productDelete(id) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('clicked');
                    $.ajax({
                        type: 'get',
                        url: 'Delete',
                        data: {
                            questionID: id
                        },
                        success: function (data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your question has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location = 'All-Questions';
                                });
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'This question is save)',
                        'error'
                    ).then((result) => {
                        window.location = 'All-Questions';
                    });
                }
            })
        }
    </script>
</body>

</html>