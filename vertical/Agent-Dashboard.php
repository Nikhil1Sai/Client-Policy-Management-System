<?php
session_start();

$agent_id = $_SESSION['agent_id'];

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1"; 


$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// php for calculating total clients
if(isset($_SESSION['agent_id'])) {
    // SQL query to count total clients for the agent
    $sql = "SELECT COUNT(*) as total_clients FROM client_details WHERE agent_id = $agent_id";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        // Display the total number of clients
        $total_clients = $row['total_clients'];
    } else {
        $total_clients = 0;
    }



// php for calculating total policies associated with this agent
// SQL query to fetch all client_ids associated with the agent
$client_query = "SELECT client_id FROM client_details WHERE agent_id = $agent_id";
$client_result = $conn->query($client_query);

$total_policies = 0;

if ($client_result->num_rows > 0) {
    // Loop through each client and count their policies
    while ($row = $client_result->fetch_assoc()) {
        $client_id = $row['client_id'];
        // SQL query to count total policies for each client
        $policy_query = "SELECT COUNT(*) as total_policies FROM policies_table WHERE client_id = $client_id";
        $policy_result = $conn->query($policy_query);

        if ($policy_result->num_rows > 0) {
            $policy_row = $policy_result->fetch_assoc();
            $total_policies += (int)$policy_row['total_policies'];
        }
    }
}
// php for calculating expired policies associated with this agent

$expired_policies = 0;

if ($client_result->num_rows > 0) {
    // Loop through each client
    while ($row = $client_result->fetch_assoc()) {
        $client_id = $row['client_id'];
       
        // SQL query to fetch policies for this client
        $policy_query = "SELECT policy_id, policy_Exp_date FROM Policies_table WHERE client_id = $client_id";
        $policy_result = $conn->query($policy_query);

        if ($policy_result->num_rows > 0) {
            // Loop through each policy for this client
            while ($policy_row = $policy_result->fetch_assoc()) {
                $policy_id = $policy_row['policy_id'];
                $policy_exp_date = strtotime($policy_row['policy_Exp_date']);
                $current_date = strtotime(date('Y-m-d'));
                $remaining_days = $policy_exp_date - $current_date;

                if ($remaining_days < 0) {
                    
                    

                    // // Check if there is a renewal policy associated
                    $renewal_policy_query = "SELECT Renewal_policy_id, Renewal_policy_Exp_date FROM Renewal_policies WHERE policy_id = $policy_id";
                    $renewal_policy_result = $conn->query($renewal_policy_query);
                    

                    if ($renewal_policy_result->num_rows > 0) {
                        // Loop through renewal policies
                        while ($renewal_policy_row = $renewal_policy_result->fetch_assoc()) {
                            $renewal_policy_exp_date = strtotime($renewal_policy_row['Renewal_policy_Exp_date']);
                            $remaining_days_renewal = $renewal_policy_exp_date - $current_date;

                            if ($remaining_days_renewal < 0) {
                                // Renewal policy has also expired
                                $expired_policies++;
                            }
                        }
                    }else{
                        $expired_policies++;
                    }
                }
            }
        }
    }
}

} else {
    echo "Agent ID not set in the session.";
}

?>
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

    <!-- Begin page -->
    <div id="layout-wrapper">

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
            
            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-plus"></i> Add New
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu">
                    <!-- item-->
                    <a href="AddClient.php" class="dropdown-item notify-item">
                        Add Client
                    </a>
                    <!-- item-->
                    <a href="AddPolicy.php" class="dropdown-item notify-item">
                        Add Policy
                    </a>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end flex-grow-1"> 
            <!-- <div class="dropdown d-inline-block ml-2"> -->
                <a href="AgentProfile.php" class="btn header-item waves-effect" id="page-header-user-dropdown">
                    <i class="fas fa-user-circle fa-2x"></i> <!-- Larger profile icon -->
                    <p>View Profile</p>
                </a>
            <!-- </div> -->
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
                                <h4 class="mb-0 font-size-18">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Xacton</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-primary border-primary">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h4 class="card-title mb-0 text-white">Total Clients:</h4>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                <?php
                                                echo $total_clients;
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-success border-success">
                                <div class="card-body">
                                    <div class="mb-4">
                                    <span class="badge badge-soft-light float-right">Active</span>
                                        <h5 class="card-title mb-0 text-white">Total Policies:</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center text-white mb-0">
                                                <?php
                                                echo $total_policies;
                                                ?>
                                            </h2>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col-->

                        <!-- <div class="col-md-6 col-xl-3">
                            <div class="card bg-warning border-warning">
                                <div class="card-body">
                                    <div class="mb-4">
                                    <span class="badge badge-soft-light float-right">Expired</span>
                                        <h5 class="card-title mb-0 text-white">Expired Policies:</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center text-white mb-0">
                                                <?php
                                                // echo $expired_policies;
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  -->

                        <!-- <div class="col-md-6 col-xl-3">
                            <div class="card bg-info border-info">
                                <div class="card-body">
                                    
                                    <div class="row d-flex align-items-center mb-4">
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0 text-white">Sent Password to Client</h5>
                                    </div>
                                    </div>
                                    <div class="col-4 text-right redirect">
                                            <i class="mdi mdi-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div> end col -->
                    </div>
                    <!-- end row -->

                    
                  


                    <div class="row">
<div class="col-xl-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Clients & Their Policies</h4>
            <p class="card-subtitle mb-4 font-size-13">These are the Clients and their total policies each client has taken</p>

            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-centered table-hover table-xl mb-0" id="recent-orders">
                    <thead>
                        <tr>
                            <th class="border-top-0">Client</th>
                            <th class="border-top-0">Policies Taken</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Assuming you have a database connection established earlier
                        $sql = "SELECT c.client_name, COUNT(p.client_id) AS policy_count
                                FROM client_details c
                                LEFT JOIN policies_table p ON c.client_id = p.client_id
                                WHERE c.agent_id = $agent_id
                                GROUP BY c.client_id";

                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $client_name = $row['client_name'];
                                $policy_count = $row['policy_count'];
                                ?>
                                <tr>
                                    <td class="text-truncate"><?php echo $client_name; ?></td>
                                    <td class="text-truncate"><?php echo $policy_count; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "Error: " . mysqli_error($connection);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Reminder Alert</h4>
            <p class="card-subtitle mb-4 font-size-13">Send reminders to the client</p>
            <?php
            if (isset($_POST['sentremainder'])) {
                $client_id = $_POST['client_id'];
                $subject = $_POST['subject'];
                $textarea = $_POST['Textarea'];

                if (!empty($client_id) && !empty($subject) && !empty($textarea)) {
                    // Insert data into the remainder_table
                    $insert_query = "INSERT INTO remainder_table (agent_id, client_id, subject, textarea) VALUES ('$agent_id', '$client_id', '$subject', '$textarea')";

                    if (mysqli_query($conn, $insert_query)) {
                        // Display success message
                        echo '<div class="alert alert-success" role="alert">Reminder sent successfully!</div>';
                    } else {
                        // Display error message if insertion fails
                        echo '<div class="alert alert-danger" role="alert">Error sending reminder. Please try again.</div>';
                    }
                } else {
                    // Display error message if any required field is empty
                    echo '<div class="alert alert-danger" role="alert">Please fill in all required fields.</div>';
                }
            }
            ?>
            <form novalidate method="POST" action="">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">Select Client</label>
                        <select class="form-control" id="validationCustom01" name="client_id" required>
                            <option value="" selected>Select Client</option>
                            <?php
                            $query = "SELECT client_id, client_name FROM client_details WHERE agent_id = '$agent_id'";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['client_id'] . "'>" . $row['client_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <br>
                    <div class="col-md-8 mb-3">
                        <label for="subject">Subject</label>
                        <input class="form-control" type="text" id="subject" name="subject" placeholder="Subject" required>

                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1">Textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="Textarea" rows="3" placeholder="Reminder Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light" name="sentremainder">Send Reminder</button>
            </form>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div> <!-- end col -->


        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>

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


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- Morris Js-->
    <script src="../plugins/morris-js/morris.min.js"></script>
    <!-- Raphael Js-->
    <script src="../plugins/raphael/raphael.min.js"></script>

    <!-- Morris Custom Js-->
    <script src="assets/pages/dashboard-demo.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>

</body>

</html>