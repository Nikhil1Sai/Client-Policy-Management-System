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
                <h1>Renew the Policies</h1>
                   
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
                                        <li class="breadcrumb-item active">Renew Policy</li>
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
<form class="needs-validation" novalidate method="POST" action="renew_policy_process.php" enctype="multipart/form-data" >

        <div class="form-row">
            <!-- Dropdown menu for client selection -->
            <div class="col-md-4 mb-3">
        <label for="validationCustom01">Select Client</label>
        <select class="form-control" id="validationCustom01" name="client_id" required>
            <option value="">Select Client</option> <!-- Default option -->
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
        <label for="validationCustom02">Select Policy</label>
        <select class="form-control" id="validationCustom02" name="policy_id" required>
            <option value="">Select Policy</option> <!-- Default option -->
        </select>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>    

    
            <!-- Get Details Button -->
            <div class="col-md-4 mb-3">
                <label>&nbsp;</label>
                <button class="btn btn-primary form-control" type="button" id="getDetailsBtn">Get Details</button>
            </div>
        </div>
        
        <!-- Hidden div to display policy details and allow editing -->
<div id="policyDetails" style="display: none;">
                <!-- Policy Status and Remaining Days -->
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="policyStatus">Policy Status</label>
                        <input type="text" class="form-control" id="policyStatus" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="remainingDays">Remaining Days</label>
                        <input type="text" class="form-control" id="remainingDays" readonly>
                    </div>
                    
                </div>

                <!-- Editable Policy Details -->
                
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="policyName">Policy Name</label>
        <input type="text" class="form-control" id="policyName" name="policy_name" placeholder="Policy Name" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="policyPremium">Policy Premium</label>
        <input type="number" class="form-control" id="policyPremium" name="policy_premium" placeholder="Policy Premium" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="policySum">Policy Sum</label>
        <input type="number" class="form-control" id="policySum" name="policy_sum" placeholder="Policy Sum" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="policyType">Policy Type</label>
        <input type="text" class="form-control" id="policyType" name="policy_type" placeholder="Policy Type" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="installmentType">Installment Type</label>
        <input type="text" class="form-control" id="installmentType" name="installment_type" placeholder="Installment Type" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
<!-- Calculate Policy Days -->

    <div class="col-md-6 mb-3">
        <label for="policyStartDate">Policy Start Date</label>
        <input type="date" class="form-control" id="policyStartDate" name="policy_start_date" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="policyExpDate">Policy Expiration Date</label>
        <input type="date" class="form-control" id="policyExpDate" name="policy_Exp_date" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="policyDays">Policy Days</label>
        <input type="number" class="form-control" id="policyDays" name="policy_days" placeholder="Policy Days" readonly>
    </div>
</div>
<div class="form-row">
    <div class="col-md-12 mb-3">
        <label for="policyDocument">Policy Document</label>
        <input type="file" class="form-control-file" id="policyDocument" name="policy_document">
    </div>
</div>


                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn btn-success form-control" type="button"  name="renewPolicyButton" value="Renew Policy">
                    </div>
                </div>
            </div>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] === 'success') {
                $policy_id = $_GET['policy_id'];
                echo '<div class="alert alert-success mt-3" role="alert">';
                echo 'Policy renewed successfully! Policy ID: ' . $policy_id;
                echo '</div>';
            } elseif ($_GET['status'] === 'error') {
                echo '<div class="alert alert-danger mt-3" role="alert">';
                echo 'Policy renewal failed. Please try again.';
                echo '</div>';
            }
        }
        ?>
        
</form>

<script>
document.getElementById("policyStartDate").addEventListener("change", updatePolicyDays);
document.getElementById("policyExpDate").addEventListener("change", updatePolicyDays);

function updatePolicyDays() {
    const startDateInput = document.getElementById("policyStartDate");
    const expDateInput = document.getElementById("policyExpDate");
    const policyDaysInput = document.getElementById("policyDays");

    const startDate = new Date(startDateInput.value);
    const expDate = new Date(expDateInput.value);

    if (!isNaN(startDate) && !isNaN(expDate) && expDate >= startDate) {
        const timeDifference = expDate - startDate;
        const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));
        policyDaysInput.value = daysDifference;
    } else {
        policyDaysInput.value = "";
    }
}

// Trigger the initial calculation if policy start or expiration date are pre-filled
updatePolicyDays();

</script>
<script>
    var getDetailsBtn = document.getElementById("getDetailsBtn");
    var policyDetails = document.getElementById("policyDetails");
    var policyStatusInput = document.getElementById("policyStatus");
    var remainingDaysInput = document.getElementById("remainingDays");
    var policyStartDateInput = document.getElementById("policyStartDate");
    var policyExpDateInput = document.getElementById("policyExpDate");
    var policyDaysInput = document.getElementById("policyDays");

    getDetailsBtn.addEventListener("click", function () {
        policyDetails.style.display = "block";
        var policyId = document.getElementById("validationCustom02").value;

        if (policyId) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_policy_details.php?policy_id=" + policyId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var policyData = JSON.parse(xhr.responseText);

                    document.getElementById("policyName").value = policyData.policy_name;
                    document.getElementById("policyPremium").value = policyData.policy_premium;
                    document.getElementById("policySum").value = policyData.policy_sum;
                    document.getElementById("policyType").value = policyData.policy_type;
                    document.getElementById("installmentType").value = policyData.Installment_Type;
                    policyStartDateInput.value = policyData.policy_start_date;
                    policyExpDateInput.value = policyData.policy_Exp_date;
                    
                    // Calculate Policy Status and Remaining Days
                    var currentDate = new Date();
                    var startDate = new Date(policyStartDateInput.value);
                    var expDate = new Date(policyExpDateInput.value);

                    if (currentDate > expDate) {
                        policyStatusInput.value = "Expired";
                        remainingDaysInput.value = "0";
                    } else {
                        policyStatusInput.value = "Still Not Expired";
                        var timeDifference = expDate - currentDate;
                        var daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));
                        remainingDaysInput.value = daysDifference;

                        // If Remaining Days is greater than 0, adjust the start date
                        if (daysDifference > 0) {
                            var newStartDate = new Date(startDate);
                            newStartDate.setDate(startDate.getDate() + daysDifference);
                            var formattedStartDate = newStartDate.toISOString().split('T')[0];
                            policyStartDateInput.value = formattedStartDate;
                        }
                    }
                }
            };
            xhr.send();
        }
    });
</script>

<script>
        // JavaScript to dynamically load policies based on selected client
        var clientIdSelect = document.getElementById("validationCustom01");
        var policyDropdown = document.getElementById("validationCustom02");

        clientIdSelect.addEventListener("change", function () {
            var clientId = clientIdSelect.value;
            if (clientId !== "") {
                // Make an AJAX request to fetch policies for the selected client
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "get_policies.php?clientId=" + clientId, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Parse the JSON response and populate the "Select Policy" dropdown
                        var policies = JSON.parse(xhr.responseText);
                        policyDropdown.innerHTML = '<option value="">Select Policy</option>'; // Reset dropdown
                        policies.forEach(function (policy) {
                            var option = document.createElement("option");
                            option.value = policy.policy_id;
                            option.text = policy.policy_name;
                            policyDropdown.appendChild(option);
                        });
                    }
                };
                xhr.send();
            }
        });
    </script>
   
    
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