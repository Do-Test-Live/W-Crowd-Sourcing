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
                                <form>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Question</label>
                                            <textarea class="form-control" rows="4" id="comment" required></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Choose Question Type:</label>
                                            <select id="inputState" class="form-control default-select">
                                                <option selected>Choose Question Type.</option>
                                                <option value="Take photo">Take photo</option>
                                                <option value="Physical">Physical</option>
                                                <option value="Mental">Mental</option>
                                                <option value="F2F">F2F</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Select Tags for that question (At most 3):</label>
                                            <select multiple class="form-control default-select" id="sel2">
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
                                            <select id="inputState" class="form-control default-select">
                                                <option selected>Choose Answer Method.</option>
                                                <option value="1">First-come-first-serve</option>
                                                <option value="2">Best answer</option>
                                                <option value="3">Mixed mode</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Payment</label>
                                            <input type="number" class="form-control input-default " placeholder="payment">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Waiting Time (In Hours)</label>
                                            <input type="text" class="form-control input-default " placeholder="waiting time">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Question</button>
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

    </script>

</body>

</html>