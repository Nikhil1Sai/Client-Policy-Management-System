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
    <?php
session_start();
$agent_id = $_SESSION['agent_id'] ;

?>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
            <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
            
                

               <div class="d-flex align-items-center"> 
                <h1>Add the Policies</h1>
                   
                </div>
                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
       
       <div class="vertical-menu">

<div data-simplebar class="h-100">

    <div class="navbar-brand-box">
        <a  class="logo">
            <i class="mdi mdi-alpha-x-circle"></i>
            <span>
                Xacton
            </span>
        </a>
    </div>

<!--- Sidemenu -->
<div id="sidebar-menu">
<!-- Left Menu Start -->
<ul class="metismenu list-unstyled" id="side-menu">
<li class="menu-title">Menu</li>

<li>
<a href="Agent-Dashboard.php" class="waves-effect">
    <i class="feather-airplay"></i><span class="badge badge-pill badge-primary float-right"></span>
    <span>Dashboard</span>
</a>
</li>

<li>
<a href="AgentProfile.php" class="waves-effect">
    <i class="fas fa-user-circle"></i><span>View Profile</span>
</a>
</li>

<li>
<a href="Addclient.php" class="waves-effect">
    <i class="fas fa-user-plus"></i><span>Add Clients</span>
</a>
</li>

<li>
<a href="Addpolicy.php" class="waves-effect">
    <i class="fas fa-file-alt"></i><span>Add Policy</span>
</a>
</li>

<li>
<a href="Renewpolicy.php" class="waves-effect">
    <i class="fas fa-edit"></i><span>Renew Policy</span>
</a>
</li>
<li>
    <a href="SentPassword.php" class="waves-effect">
        <i class="fas fa-envelope"></i><span>Sent Password to client</span>
    </a>
</li>
<li>
<a href="Client&Policystable.php" class="waves-effect">
    <i class="fas fa-users"></i><span>View Clients & Policies</span>
</a>
</li>

<li>
<a href="AgentResetPassword.php" class="waves-effect">
    <i class="fas fa-key"></i><span>Reset Password</span>
</a>
</li>
<li>
            <a href="logout.php" class="waves-effect">
                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
            </a>
</li>
</ul>
</div>

    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Validation</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                        <li class="breadcrumb-item active">Validation</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>     
                    <!-- end page title -->

 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Policy Details</h4>
        <form class="needs-validation" novalidate method="POST" action="Phpforaddpolicy.php" enctype="multipart/form-data">
        <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validationCustom01">Select Client</label>
            <select class="form-control" id="validationCustom01" name="client_id" required>
            <?php
                session_start();

                $agent_id = $_SESSION['agent_id'];

                $db_host = "localhost";
                $db_username = "root";
                $db_password = "";
                $db_name = "database1"; 


                $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
                
                $query = "SELECT client_id, client_name FROM client_details WHERE agent_id = '$agent_id'";
                $result = mysqli_query($conn, $query);
                 
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['client_id'] . "'>" . $row['client_name'] . "</option>";
                }
                
                mysqli_close($conn);
                ?>
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom02">Policy Name</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Policy Name" name="policy_name" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom03">Policy Premium</label>
                <input type="number" class="form-control" id="validationCustom03" placeholder="Policy Premium" name="policy_premium" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom04">Sum Assured</label>
                <input type="number" class="form-control" id="validationCustom04" placeholder="Sum Assured" name="policy_sum" required>
            <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom05">Policy Type</label>
                <input type="text" class="form-control" id="validationCustom05" placeholder="Policy Type" name="policy_type" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom10">Installment Type (In Days)</label>
                <input type="number" class="form-control" id="validationCustom10" placeholder="Installment Type" name="installment_type" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom06">Policy Start Date</label>
                <input type="date" class="form-control" id="validationCustom06" name="policy_start_date" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom08">Policy Expiry Date</label>
                <input type="date" class="form-control" id="validationCustom08" name="policy_expiry_date" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
<script>
    // Function to calculate and fill in the Policy Duration
    function calculatePolicyDuration() {
        const startDate = new Date(document.getElementById("validationCustom06").value);
        const expiryDate = new Date(document.getElementById("validationCustom08").value);

        // Calculate the difference in days
        const timeDifference = expiryDate - startDate;
        const daysDifference = timeDifference / (1000 * 3600 * 24);

        // Fill in the Policy Duration field with the calculated value
        document.getElementById("validationCustom07").value = daysDifference;
    }

    // Add event listeners to the date input fields
    document.getElementById("validationCustom06").addEventListener("change", calculatePolicyDuration);
    document.getElementById("validationCustom08").addEventListener("change", calculatePolicyDuration);

    // Call the function initially in case dates are pre-filled
    calculatePolicyDuration();
</script>

            <div class="col-md-4 mb-3">
                <label for="validationCustom07">Policy Duration (Total Days)</label>
                <input type="number" class="form-control" id="validationCustom07" placeholder="Policy Duration" name="policy_duration" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom09">Policy Document</label>
                <input type="file" class="form-control-file" id="validationCustom09" name="policy_document" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox form-check">
                <input type="checkbox" class="custom-control-input" id="invalidCheck" required>
                <label class="custom-control-label" for="invalidCheck">Agree to terms and conditions</label>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light" type="submit">Add Policy</button>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] === 'success') {
                $policy_id = $_GET['policy_id'];
                echo '<div class="alert alert-success mt-3" role="alert">';
                echo 'Policy added successfully! Policy ID: ' . $policy_id;
                echo '</div>';
            } elseif ($_GET['status'] === 'error') {
                echo '<div class="alert alert-danger mt-3" role="alert">';
                echo 'Policy not added. Please try again.';
                echo '</div>';
            }
        }
        ?>
    </form>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row-->

<!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2019 © Xacton.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by Kohil Media
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- Validation custom js-->
    <script src="assets/pages/validation-demo.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>

</body>

</html>