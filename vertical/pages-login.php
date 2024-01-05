<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Xacton - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <style>
        /* Custom CSS to align buttons */
        /* .login-buttons {
            display: flex;
            justify-content: space-between;
        }
        .login-buttons button {
            width: 48%;
        } */
       /* Animation CSS */
    

        
    </style>

</head>

<body>


    <div>
    
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left">
                                <!-- <div class="login-text-container">
                                    <h1 class="login-text-title">Login</h1>
                                </div> -->
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-x-circle"></i> <b>XACTON</b>
                                            </a>h
                                        </div>
                                        <h1 class="h5 mb-1">Welcome Back!</h1>
                                        <p class="text-muted mb-4">Enter your email address and password.</p>


                                        <?php
                                        if (isset($_GET['error'])) {
                                            $error_message = $_GET['error'];
                                            echo '<div class="alert alert-danger mt-3" role="alert">';
                                            echo $error_message;
                                            echo '</div>';
                                        }
                                        ?>


                                        <form class="user" method="POST" action="Multilogin.php">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"  name="user_email" placeholder="Email Address" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="user_password" placeholder="Password" required>
                                            </div>
                                            <div class="login-buttons">
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light" name="agent_login"> Agent Log In </button>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light" name="client_login"> Client Log In </button>
                                            </div>

                                            
                                        </form>

                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <p class="text-muted mb-2">If you are Client and forgot the password contact the Agent for credentials</p>
                                                <p class="text-muted mb-2"><a href="AgentRecoverypassword.php" class="text-muted font-weight-medium ml-1">If you are Agent and Forgot your password? <b>Recover password</b></a></p>
                                                <p class="text-muted mb-0">If you are Agent and Don't have an account? <a href="AgentRegister.php" class="text-muted font-weight-medium ml-1"><b>Sign Up</b></a></p>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
       
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>

</body>


</html>
