<?php

session_start();
require("config.php");

// Check admin login
if(!isset($_SESSION['auser']))
{
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>BROKERDESK | Contact Messages</title>

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

</head>

<body>

    <!-- Header -->
    <?php include("header.php"); ?>
    <!-- /Header -->


    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">

                <div class="row">

                    <div class="col">

                        <h3 class="page-title">
                            Contact
                        </h3>

                        <ul class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="dashboard.php">
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Contact
                            </li>

                        </ul>

                    </div>

                </div>

            </div>
            <!-- /Page Header -->


            <div class="row">

                <div class="col-sm-12">

                    <div class="card">

                        <div class="card-header">

                            <h4 class="card-title">
                                Contact Form Messages
                            </h4>

                            <?php

                            if(isset($_GET['msg']))
                            {
                                echo '<div class="alert alert-success mt-2">';
                                echo htmlspecialchars($_GET['msg']);
                                echo '</div>';
                            }

                            ?>

                        </div>


                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="basic-datatable"
                                       class="table table-striped">

                                    <thead>

                                        <tr>

                                            <th>ID</th>

                                            <th>Name</th>

                                            <th>Email</th>

                                            <th>Phone</th>

                                            <th>Subject</th>

                                            <th>Message</th>

                                            <th>Status</th>

                                            <th>Delete</th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                    <?php

                                    /*
                                     * Get contact messages
                                     * from contact table.
                                     */

                                    $query = mysqli_query(
                                        $con,
                                        "SELECT
                                            cid,
                                            name,
                                            email,
                                            phone,
                                            subject,
                                            message
                                         FROM contact
                                         ORDER BY cid DESC"
                                    );


                                    if(!$query)
                                    {
                                        echo '<tr>';
                                        echo '<td colspan="8">';
                                        echo '<div class="alert alert-danger">';
                                        echo 'Database Error: ' . htmlspecialchars(mysqli_error($con));
                                        echo '</div>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    else if(mysqli_num_rows($query) == 0)
                                    {
                                        echo '<tr>';
                                        echo '<td colspan="8" class="text-center">';
                                        echo 'No Contact Messages Found';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    else
                                    {

                                        $cnt = 1;

                                        while($row = mysqli_fetch_assoc($query))
                                        {

                                    ?>

                                            <tr>

                                                <!-- ID -->
                                                <td>
                                                    <?php
                                                    echo $cnt;
                                                    ?>
                                                </td>


                                                <!-- Name -->
                                                <td>
                                                    <?php
                                                    echo htmlspecialchars($row['name']);
                                                    ?>
                                                </td>


                                                <!-- Email -->
                                                <td>
                                                    <?php
                                                    echo htmlspecialchars($row['email']);
                                                    ?>
                                                </td>


                                                <!-- Phone -->
                                                <td>
                                                    <?php
                                                    echo htmlspecialchars($row['phone']);
                                                    ?>
                                                </td>


                                                <!-- Subject -->
                                                <td>
                                                    <?php
                                                    echo htmlspecialchars($row['subject']);
                                                    ?>
                                                </td>


                                                <!-- Message -->
                                                <td style="min-width:350px; max-width:500px; white-space:normal;">

                                                    <?php
                                                    echo nl2br(
                                                        htmlspecialchars($row['message'])
                                                    );
                                                    ?>

                                                </td>


                                                <!-- Status -->
                                                <td>

                                                    <span class="badge badge-success">
                                                        Received
                                                    </span>

                                                </td>


                                                <!-- Delete -->
                                                <td>

                                                    <a
                                                        href="contactdelete.php?id=<?php echo $row['cid']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this contact message?');"
                                                    >
                                                        Delete
                                                    </a>

                                                </td>

                                            </tr>

                                    <?php

                                            $cnt++;

                                        }

                                    }

                                    ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- /Page Wrapper -->


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