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

</head>

<body>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-x-circle"></i> <b>XACTON</b>
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Recover your Password</h1>
                                        <p class="text-muted mb-4">Enter your valid email address that you have given while registration.</p>
                                        <p class="text-muted mb-4">You will get your password through your mail.</p>
                                        <form method="post" action="PhpforAgentRP.php">
                                            <div class="form-group">
                                                <label for="exampleInputEmail">Email Address</label>
                                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" name = "email" placeholder="Email Address">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Get Your Password </button>
                                            

                                        </form>
        <?php
        // Display error message if set
        if (isset($_GET['error']) && $_GET['error'] === 'email_not_found') {
            echo '<p class="text-danger">Email not found.</p>';
        }
        if (isset($_GET['success']) && $_GET['success'] === 'email_found') {
            echo '<p class="text-success">Check your mail for password.</p>';
        }
        ?>
    
                                        <div class="row mt-5">
                                            <div class="col-12 text-center">
                                            <p class="text-muted">Email Received?<a href="pages-login.php" class="text-muted font-weight-medium ml-1"><b>Log In</b></a></p>
                                            </div> <!-- end col -->
                                        </div>

                                       
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