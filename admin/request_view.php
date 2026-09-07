<?php
session_start();
require("config.php");

// Check admin login
if (!isset($_SESSION['auser'])) {
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>LM Homes | Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="assets/css/feathericon.min.css">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/select.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/buttons.bootstrap4.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive-fix.css">
    <link rel="stylesheet" type="text/css" href="assets/css/admin-mobile.css">

</head>

<body>

    <!-- Header -->
    <?php include("header.php"); ?>
    <!-- Header End -->


    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">

                <div class="row">

                    <div class="col">

                        <h3 class="page-title">
                            Property Requests
                        </h3>

                        <ul class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="dashboard.php">
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Property Requests
                            </li>

                        </ul>

                    </div>

                </div>

            </div>
            <!-- Page Header End -->


            <!-- Message -->
            <?php
            if (isset($_GET['msg']) && !empty($_GET['msg'])) {
                $displayMsg = strip_tags($_GET['msg']);
                $displayMsg = htmlspecialchars($displayMsg, ENT_QUOTES, 'UTF-8');

                echo '<div class="alert alert-info">';
                echo $displayMsg;
                echo '</div>';
            }
            ?>


            <!-- Property Request Table -->
            <div class="row">

                <div class="col-sm-12">

                    <div class="card">

                        <div class="card-header">

                            <h4 class="card-title">
                                Property Request List
                            </h4>

                        </div>


                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="basic-datatable" class="table">

                                    <thead>

                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Property</th>
                                            <th>Property Requirements</th>
                                            <th>Status</th>
                                            <th>Delete</th>

                                        </tr>

                                    </thead>


                                    <tbody>

<?php

// Fetch Admin property requests.
// Older requests may have pid = NULL because they were created before
// property-wise requests were added, so those are also kept visible here.
// Requests belonging to Agent properties are NOT shown in the Admin panel.
$query = mysqli_query(
    $con,
    "SELECT request.*,
            property.title AS property_title
     FROM request
     LEFT JOIN property ON request.pid = property.pid
     WHERE request.pid IS NULL
        OR property.uploaded_by = 'admin'
     ORDER BY request.rid DESC"
);

$cnt = 1;

if ($query && mysqli_num_rows($query) > 0) {

    while ($row = mysqli_fetch_assoc($query)) {

?>

                                        <tr>

                                            <!-- ID -->
                                            <td>
                                                <?php echo $cnt; ?>
                                            </td>


                                            <!-- Name -->
                                            <td>
                                                <?php
                                                echo isset($row['name'])
                                                    ? htmlspecialchars($row['name'])
                                                    : 'N/A';
                                                ?>
                                            </td>


                                            <!-- Email -->
                                            <td>
                                                <?php
                                                echo isset($row['email'])
                                                    ? htmlspecialchars($row['email'])
                                                    : 'N/A';
                                                ?>
                                            </td>


                                            <!-- Phone -->
                                            <td>
                                                <?php
                                                echo isset($row['phone'])
                                                    ? htmlspecialchars($row['phone'])
                                                    : 'N/A';
                                                ?>
                                            </td>


                                            <!-- Property -->
                                            <td>
                                                <?php
                                                echo isset($row['property_title'])
                                                    ? htmlspecialchars($row['property_title'])
                                                    : 'N/A';
                                                ?>
                                            </td>


                                            <!-- Property Requirements -->
                                            <td style="max-width:500px; white-space:normal;">

                                                <?php
                                                if (isset($row['requirements'])) {

                                                    echo nl2br(
                                                        htmlspecialchars(
                                                            $row['requirements']
                                                        )
                                                    );

                                                } else {

                                                    echo 'N/A';

                                                }
                                                ?>

                                            </td>


                                            <!-- Status -->
                                            <td>

<?php

if (isset($row['status']) && $row['status'] == 1) {

?>

                                                <span class="badge badge-success">
                                                    Viewed
                                                </span>

<?php

} else {

?>

                                                <span class="badge badge-warning">
                                                    New
                                                </span>

<?php

}

?>

                                            </td>


                                            <!-- DELETE -->
                                            <td>

                                                <a
                                                    href="request_delete.php?id=<?php echo $row['rid']; ?>"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this property request?');"
                                                >
                                                    Delete
                                                </a>

                                            </td>

                                        </tr>

<?php

        $cnt++;

    }

} else {

?>

                                        <tr>

                                            <td colspan="8" class="text-center">

                                                No Property Requests Found

                                            </td>

                                        </tr>

<?php

}

?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <!-- Property Request Table End -->


        </div>

    </div>
    <!-- Page Wrapper End -->


    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Datatables JS -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>

    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <script src="assets/plugins/datatables/dataTables.select.min.js"></script>

    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>

    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>

    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>

    <script src="assets/plugins/datatables/buttons.flash.min.js"></script>

    <script src="assets/plugins/datatables/buttons.print.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

</body>

</html>