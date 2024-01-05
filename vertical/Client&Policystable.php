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
    $agent_id = $_SESSION['agent_id'];
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
                        <h1>View Clients and Policies</h1>
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
                                <h4 class="mb-0 font-size-18">Tables</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                        <li class="breadcrumb-item active">View Clients & Policies</li>
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
                                    <h4 class="card-title">Client Details</h4>
                                    <p class="card-subtitle mb-4">These are the Clients and their details and if you want to delete, you can do it from here.</p>
                                    <table id="basic-datatable" class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Client ID</th> <!-- Updated column name -->
                                                <th>Client Name</th>
                                                <th>Mail</th>
                                                <th>Mobile Number</th> <!-- Updated column name -->
                                                <th>Mobile Number2</th> <!-- Updated column name -->
                                                <th>WhatsApp</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Zip</th>
                                                <th>State</th>
                                                <th>Action</th> <!-- Added Action column -->
                                            </tr>
                                        </thead>
                                        <tbody>
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

        // Query to retrieve client details for the specific agent
        $query = "SELECT * FROM client_details WHERE agent_id = $agent_id";
        // Execute the query and fetch client data
        $result = mysqli_query($conn, $query);
                                            

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['client_id'] . "</td>";
                echo "<td>" . $row['client_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['mobile1'] . "</td>";
                echo "<td>" . $row['whatsapp'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['zip'] . "</td>";
                echo "<td>" . $row['state'] . "</td>";
                echo '<td><a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row['client_id'] . ')">Delete</a></td>';
                echo "</tr>";
            }
        }
        ?>
                                            
                                            <!-- Add more rows with client data here -->
                                        </tbody>
                                    </table>
<script>
    // JavaScript function to handle delete confirmation
    function confirmDelete(clientId) {
        if (confirm("Are you sure you want to delete this client?")) {
            // If the user confirms, proceed with the deletion
            window.location.href = "delete_client.php?client_id=" + clientId;
        }
    }
</script>  

<script>
    // JavaScript function to display a success message as a popup
    function displaySuccessMessage() {
        const urlParams = new URLSearchParams(window.location.search);
        const successMessage = urlParams.get("success_message");

        if (successMessage) {
            // Display the success message in a popup
            alert(successMessage);
        }
    }

    // Call the function to display the success message
    window.onload = displaySuccessMessage;
</script>                                  
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <!-- end row-->
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
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Query to retrieve policies for the specific agent
        $policyQuery = "SELECT * FROM policies_table WHERE client_id IN (SELECT client_id FROM client_details WHERE agent_id = $agent_id)";
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

                
                echo '<td><a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="confirmDeletePolicy(' . $policyRow['policy_id'] . ')">Delete</a></td>';
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
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="renewalPolicyTableBody">
                            <!-- Renewal policy rows will be inserted here using JavaScript -->
                        </tbody>
    </table>
    </div>
    </div>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
    // JavaScript function to handle policy delete confirmation
    function confirmDeletePolicy(policyId) {
        if (confirm("Are you sure you want to delete this policy?")) {
            // If the user confirms, proceed with the deletion
            window.location.href = "delete_policy.php?policy_id=" + policyId;
        }
    }

    // JavaScript function to handle delete confirmation for renewal policies
    function confirmDeleteRenewal(renewalPolicyId) {
        if (confirm("Are you sure you want to delete this renewal policy?")) {
            // If the user confirms, proceed with the deletion
            window.location.href = "delete_renewal_policy.php?renewal_policy_id=" + renewalPolicyId;
        }
    }

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
                        '<td><a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="confirmDeleteRenewal(' + policy.Renewal_policy_id + ')">Delete</a></td>' +
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
</body>
</html>
