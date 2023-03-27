<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (isset($_SESSION['userid'])) {
    header("Location: Dashboard");
}?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register-Crowd Sourcing</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-12">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <h1>Crowd Sourcing</h1>
                                </div>
                                <h2 class="text-center mb-4 text-white">Sign up your account</h2>
                                <h4 class="text-center mb-4 text-white">Basic Information</h4>
                                <form action="Insert" method="post">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-1 text-white"><strong>Username</strong></label>
                                                <input type="text" name="username" class="form-control" placeholder="username" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-1 text-white"><strong>Email</strong></label>
                                                <input type="email" name="email" class="form-control"
                                                       placeholder="hello@example.com" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-1 text-white"><strong>College</strong></label>
                                                <input type="text" name="college" class="form-control" placeholder="college name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-1 text-white"><strong>Major</strong></label>
                                                <input type="text" name="major" class="form-control" placeholder="major subject" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-1 text-white"><strong>Hall</strong></label>
                                                <input type="text" name="hall" class="form-control" placeholder="hall" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-1 text-white"><strong>Society</strong></label>
                                                <input type="text" name="society" class="form-control" placeholder="society" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="mb-1 text-white"><strong>Gender</strong></label>
                                            <select class="form-control" name="gender" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-1 text-white"><strong>Age</strong></label>
                                                <input type="number" name="age" class="form-control" placeholder="Age" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="mb-1 text-white"><strong>Indoor</strong></label>
                                            <div class="form-group" style="background-color: #ffffff; padding: 20px">
                                                <div class="radio">
                                                    <label><input type="radio" name="indoor" required> Computer games</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="indoor" value="Music"> Music</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="indoor" value="Reading"> Reading</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="indoor" value="Revision"> Revision</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="mb-1 text-white"><strong>Outdoor</strong></label>
                                            <div class="form-group" style="background-color: #ffffff; padding: 20px">
                                                <div class="radio">
                                                    <label><input type="radio" name="outdoor" value="Sports" required> Sports</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="outdoor" value="Photography"> Photography</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="outdoor" value="Hiking"> Hiking</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="outdoor" value="Social Work"> Social Work</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="mb-1 text-white"><strong>What type of request would you like to accept</strong></label>
                                                <div class="form-group" style="background-color: #ffffff; padding: 20px">
                                                    <div class="radio">
                                                        <label><input type="radio" name="request_type" value="Take photo" required> Take photo</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="request_type" value="Physical"> Physical</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="request_type" value="Mental"> Mental (E.g. question or questionnaire)</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="request_type" value="F2F"> F2F</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="mb-1 text-white"><strong>Password</strong></label>
                                                    <input type="password" name="password" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" name="sign_up" class="btn bg-white text-primary btn-block">Sign me up
                                        </button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="text-white">Already have an account? <a class="text-white" href="Login">Sign
                                            in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>

</body>

</html>