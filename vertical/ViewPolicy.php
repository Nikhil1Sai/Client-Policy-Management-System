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
    <!-- Plugins css -->
    <link href="../plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <?php
        session_start();
        $Client_id = $_SESSION['client_id'];
    ?>
    <style>
        /* Custom CSS for the modal dialog */
        .custom-modal-dialog {
            max-width: 95%; 
        }
    </style>
</head>
<body>
   <!-- Begin page -->
   <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <div class="d-flex align-items-center">
                        <h1>View Policies</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <div class="navbar-brand-box">
                    <a class="logo">
                        <i class="mdi mdi-alpha-x-circle"></i>
                        <span>Xacton</span>
                    </a>
                </div>
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="Client-Dashboard.php" class="waves-effect">
                                <i class="feather-airplay"></i><span class="badge badge-pill badge-primary float-right"></span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="ClientProfile.php" class="waves-effect">
                                <i class="fas fa-user-circle"></i><span>View Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="Agent_details_forClient.php" class="waves-effect">
                                <i class="fas fa-user-circle"></i><span>Agent Details</span>
                            </a>
                        </li> 
                        <li>
                            <a href="ViewPolicy.php" class="waves-effect">
                                <i class="fas fa-users"></i><span>View Policies</span>
                            </a>
                        </li>
                        <li>
                            <a href="ClientResetPassword.php" class="waves-effect">
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
                                <h4 class="mb-0 font-size-18">Tables</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                        <li class="breadcrumb-item active">View Policies</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $db_host = "localhost";
                    $db_username = "root";
                    $db_password = "";
                    $db_name = "database1";
                    
                    // Create connection
                    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
                     
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Details of Policies</h4>
                                    <p class="card-subtitle mb-4">Check the details of Policies and their renewals.</p>
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Policy ID</th>
                                                <th>Policy Name</th>
                                                <th>Policy Premium</th>
                                                <th>Sum Assured</th>
                                                <th>Policy Type</th>
                                                <th>Installment Type (In Days)</th>
                                                <th>Policy Start Date</th>
                                                <th>Policy Days</th>
                                                <th>Policy Expiry Date</th>
                                                <th>Policy Document</th>
                                                <th>View Renewals</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Query to retrieve policies for the specific agent
                                            $policyQuery = "SELECT * FROM policies_table WHERE client_id = $Client_id";
                                            $policyResult = mysqli_query($conn, $policyQuery);
                    
                                            if ($policyResult) {
                                                while ($policyRow = mysqli_fetch_assoc($policyResult)) {
                                                    echo "<tr>";
                                                    echo "<td>" . getClientName($policyRow['client_id'], $conn) . "</td>";
                                                    echo "<td>" . $policyRow['policy_id'] . "</td>";
                                                    echo "<td>" . $policyRow['policy_name'] . "</td>";
                                                    echo "<td>" . $policyRow['policy_premium'] . "</td>";
                                                    echo "<td>" . $policyRow['policy_sum'] . "</td>";
                                                    echo "<td>" . $policyRow['policy_type'] . "</td>";
                                                    echo "<td>" . $policyRow['Installment_Type'] . "</td>";
                                                    echo "<td>" . $policyRow['policy_start_date'] . "</td>";
                                                    echo "<td>" . $policyRow['policy_days'] . "</td>";
                                                    echo "<td>" . $policyRow['policy_Exp_date'] . "</td>";
                                                    echo '<td><a href="' . $policyRow['policy_document'] . '" target="_blank">Download</a></td>';
                                                    echo '<td><a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="viewRenewals(' . $policyRow['policy_id'] . ')">View</a></td>';
                                                    echo "</tr>";
                                                }
                                            }
                    
                                            // Function to get client name based on client_id
                                            function getClientName($client_id, $conn) {
                                                $query = "SELECT client_name FROM client_details WHERE client_id = $client_id";
                                                $result = mysqli_query($conn, $query);
                                                if ($result && $row = mysqli_fetch_assoc($result)) {
                                                    return $row['client_name'];
                                                }
                                                return "";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                    
                                    <!-- Renewal Policy Modal -->
                                    <div class="modal fade" id="renewalPolicyModal" tabindex="-1" role="dialog" aria-labelledby="renewalPolicyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg custom-modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="renewalPolicyModalLabel">Renewal Policies</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Renewal Policy Table -->
                                                    <table class="table table-striped">
                                                        <!-- Table headers for renewal policies go here -->
                                                        <thead>
                                                            <tr>
                                                                <th>Renewal Policy ID</th>
                                                                <th>Renewal Policy Name</th>
                                                                <th>Renewal Policy Premium</th>
                                                                <th>Renewal Policy Sum</th>
                                                                <th>Renewal Policy Type</th>
                                                                <th>Renewal Installment Type</th>
                                                                <th>Renewal Policy Start Date</th>
                                                                <th>Renewal Policy Days</th>
                                                                <th>Renewal Policy Exp. Date</th>
                                                                <th>Renewal Policy Document</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="renewalPolicyTableBody">
                                                            <!-- Renewal policy rows will be inserted here using JavaScript -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <!-- end row-->
                </div> <!-- container-fluid -->
            </div>
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
    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>
    <!-- third party js -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/datatables/buttons.html5.min.js"></script>
    <script src="../plugins/datatables/buttons.flash.min.js"></script>
    <script src="../plugins/datatables/buttons.print.min.js"></script>
    <script src="../plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="../plugins/datatables/dataTables.select.min.js"></script>
    <script src="../plugins/datatables/pdfmake.min.js"></script>
    <script src="../plugins/datatables/vfs_fonts.js"></script>
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="assets/pages/datatables-demo.js"></script>
    <!-- App js -->
    <script src="assets/js/theme.js"></script>
    <script>
        // JavaScript function to display renewal policies in a modal
        function viewRenewals(policyId) {
            $.ajax({
                type: 'GET',
                url: 'fetch_renewal_policies.php',
                data: { policyId: policyId },
                success: function (data) {
                    // Parse the JSON response from the server
                    var renewalPolicies = JSON.parse(data);

                    // Clear existing rows
                    $('#renewalPolicyTableBody').empty();

                    // Iterate through renewal policies and append rows to the table
                    $.each(renewalPolicies, function (index, policy) {
                        var row = '<tr>' +
                            '<td>' + policy.Renewal_policy_id + '</td>' +
                            '<td>' + policy.Renewal_policy_name + '</td>' +
                            '<td>' + policy.Renewal_policy_premium + '</td>' +
                            '<td>' + policy.Renewal_policy_sum + '</td>' +
                            '<td>' + policy.Renewal_policy_type + '</td>' +
                            '<td>' + policy.Renewal_Installment_Type + '</td>' +
                            '<td>' + policy.Renewal_policy_start_date + '</td>' +
                            '<td>' + policy.Renewal_policy_days + '</td>' +
                            '<td>' + policy.Renewal_policy_Exp_date + '</td>' +
                            '<td><a href="' + policy.Renewal_policy_document + '" target="_blank">Download</a></td>' +
                            '</tr>';
                        $('#renewalPolicyTableBody').append(row);
                    });

                    // Show the modal
                    $('#renewalPolicyModal').modal('show');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    </script>
</body>
</html>
