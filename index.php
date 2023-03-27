<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (isset($_SESSION['userid'])) {
    header("Location: Dashboard");
}
if(isset($_POST['signin'])){
    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);
    $key = 'crowd_sourcing';
    $Pwd_peppered = Hash_hmac("Sha256", $password, $key);

    $login = $db_handle->numRows("select * from user where user_email = '$email' and status = '1'");
    $login_data = $db_handle->runQuery("select * from user where user_email = '$email' and status = '1'");

    if($login == 1){
        $pass = $login_data[0]['password'];
        for($i=0; $i<$login; $i++){
            $id = $login_data[$i]['user_id'];
        }
        if(Password_verify($Pwd_peppered, $pass)){
            session_start();
            $_SESSION['userid'] = $id;
            echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Dashboard';
                </script>";
        }else{
            echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Login';
                </script>";
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login-Crowd Sourcing</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">

    <!-- Toastr -->
    <link rel="stylesheet" href="vendor/toastr/css/toastr.min.css">

</head>

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <h1>Crowd Sourcing</h1>
                                </div>
                                <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Password</strong></label>
                                        <input type="password" name="password" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <a class="text-white" href="#">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="signin" class="btn bg-white text-primary btn-block">Sign Me In</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="text-white">Don't have an account? <a class="text-white" href="Register">Sign up</a></p>
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


<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>

<!-- Toastr -->
<script src="vendor/toastr/js/toastr.min.js"></script>

<!-- All init script -->
<script src="js/plugins-init/toastr-init.js"></script>

</body>


</html>