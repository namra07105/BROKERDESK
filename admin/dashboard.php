<?php
session_start();
require("config.php");

if(!isset($_SESSION['auser']))
{
    header("location:index.php");
    exit();
}


/*
|--------------------------------------------------------------------------
| DASHBOARD COUNTS
|--------------------------------------------------------------------------
*/

/* Total Users */
$user_count = 0;

$user_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM `user`");

if($user_query)
{
    $user_data = mysqli_fetch_assoc($user_query);
    $user_count = (int)$user_data['total'];
}


/* Total Properties */
$property_count = 0;

$property_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM `property`");

if($property_query)
{
    $property_data = mysqli_fetch_assoc($property_query);
    $property_count = (int)$property_data['total'];
}


/* Total Agents */
$agent_count = 0;

$agent_query = mysqli_query(
    $con,
    "SELECT COUNT(*) AS total FROM `user` WHERE utype='agent'"
);

if($agent_query)
{
    $agent_data = mysqli_fetch_assoc($agent_query);
    $agent_count = (int)$agent_data['total'];
}


/* Total Property Requests */
$request_count = 0;

$request_query = mysqli_query(
    $con,
    "SELECT COUNT(*) AS total FROM `request`"
);

if($request_query)
{
    $request_data = mysqli_fetch_assoc($request_query);
    $request_count = (int)$request_data['total'];
}


/*
|--------------------------------------------------------------------------
| PROPERTY OVERVIEW - LAST 6 MONTHS
|--------------------------------------------------------------------------
*/

$property_chart_data = array();

for($i = 5; $i >= 0; $i--)
{
    $month_start = date('Y-m-01', strtotime("-".$i." months"));
    $month_end = date('Y-m-t', strtotime("-".$i." months"));

    $month_name = date('M', strtotime($month_start));

    $month_count = 0;

    $month_query = mysqli_query(
        $con,
        "SELECT COUNT(*) AS total
         FROM `property`
         WHERE DATE(date) >= '$month_start'
         AND DATE(date) <= '$month_end'"
    );

    if($month_query)
    {
        $month_data = mysqli_fetch_assoc($month_query);
        $month_count = (int)$month_data['total'];
    }

    $property_chart_data[] = array(
        'month' => $month_name,
        'properties' => $month_count
    );
}


/*
|--------------------------------------------------------------------------
| USER / AGENT OVERVIEW - LAST 6 MONTHS
|--------------------------------------------------------------------------
*/

$user_chart_data = array();

for($i = 5; $i >= 0; $i--)
{
    $month_start = date('Y-m-01', strtotime("-".$i." months"));
    $month_end = date('Y-m-t', strtotime("-".$i." months"));

    $month_name = date('M', strtotime($month_start));

    $users = 0;
    $agents = 0;

    /*
     * If your user table contains registration date,
     * this section can be connected to it.
     *
     * For now we use the current totals so the dashboard
     * remains compatible with the existing user table.
     */

    $user_chart_data[] = array(
        'month' => $month_name,
        'users' => $user_count,
        'agents' => $agent_count
    );
}


/*
|--------------------------------------------------------------------------
| RECENT PROPERTIES
|--------------------------------------------------------------------------
*/

$recent_properties = mysqli_query(
    $con,
    "SELECT property.*, user.uname
     FROM `property`
     LEFT JOIN `user`
     ON property.uid = user.uid
     ORDER BY property.date DESC
     LIMIT 5"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>BROKERDESK - Dashboard</title>


    <!-- Favicon -->

    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="assets/img/favicon.png"
    >


    <!-- Bootstrap CSS -->

    <link
        rel="stylesheet"
        href="assets/css/bootstrap.min.css"
    >


    <!-- Fontawesome CSS -->

    <link
        rel="stylesheet"
        href="assets/css/font-awesome.min.css"
    >


    <!-- Feathericon CSS -->

    <link
        rel="stylesheet"
        href="assets/css/feathericon.min.css"
    >


    <!-- Morris CSS -->

    <link
        rel="stylesheet"
        href="assets/plugins/morris/morris.css"
    >


    <!-- Main CSS -->

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    <link rel="stylesheet" type="text/css" href="../css/responsive-fix.css">
    >


    <style>

        /*
        |--------------------------------------------------------------------------
        | Dashboard improvements
        |--------------------------------------------------------------------------
        */

        .dash-widget-icon i {
            font-size: 22px;
        }

        .dashboard-table {
            margin-bottom: 0;
        }

        .dashboard-table th {
            font-weight: 600;
        }

        .property-thumb {
            width: 55px;
            height: 45px;
            object-fit: cover;
            border-radius: 4px;
        }

        .property-title {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .property-location {
            font-size: 12px;
            color: #999;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
        }

        .dashboard-empty {
            padding: 30px;
            text-align: center;
            color: #999;
        }

    </style>


    <!--[if lt IE 9]>

        <script src="assets/js/html5shiv.min.js"></script>

        <script src="assets/js/respond.min.js"></script>

    <![endif]-->

</head>


<body>


<!-- Main Wrapper -->


<!-- Header -->

<?php include("header.php"); ?>

<!-- /Header -->


<!-- Page Wrapper -->

<div class="page-wrapper">

    <div class="content container-fluid">


        <!-- Page Header -->

        <div class="page-header">

            <div class="row">

                <div class="col-sm-12">

                    <h3 class="page-title">
                        Welcome Admin!
                    </h3>

                    <p>
                        Manage your BROKERDESK real estate system
                    </p>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!-- /Page Header -->


        <!-- Dashboard Cards -->

        <div class="row">


            <!-- Total Users -->

            <div class="col-xl-3 col-sm-6 col-12">

                <div class="card">

                    <div class="card-body">

                        <div class="dash-widget-header">

                            <span class="dash-widget-icon bg-primary">

                                <i class="fe fe-users"></i>

                            </span>

                        </div>


                        <div class="dash-widget-info">

                            <h3>
                                <?php echo $user_count; ?>
                            </h3>

                            <h6 class="text-muted">
                                Total Users
                            </h6>

                            <div class="progress progress-sm">

                                <div
                                    class="progress-bar bg-primary"
                                    style="width: 70%;"
                                ></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Total Properties -->

            <div class="col-xl-3 col-sm-6 col-12">

                <div class="card">

                    <div class="card-body">

                        <div class="dash-widget-header">

                            <span class="dash-widget-icon bg-success">

                                <i class="fe fe-home"></i>

                            </span>

                        </div>


                        <div class="dash-widget-info">

                            <h3>
                                <?php echo $property_count; ?>
                            </h3>

                            <h6 class="text-muted">
                                Total Properties
                            </h6>

                            <div class="progress progress-sm">

                                <div
                                    class="progress-bar bg-success"
                                    style="width: 65%;"
                                ></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Total Agents -->

            <div class="col-xl-3 col-sm-6 col-12">

                <div class="card">

                    <div class="card-body">

                        <div class="dash-widget-header">

                            <span class="dash-widget-icon bg-danger">

                                <i class="fe fe-user"></i>

                            </span>

                        </div>


                        <div class="dash-widget-info">

                            <h3>
                                <?php echo $agent_count; ?>
                            </h3>

                            <h6 class="text-muted">
                                Total Agents
                            </h6>

                            <div class="progress progress-sm">

                                <div
                                    class="progress-bar bg-danger"
                                    style="width: 50%;"
                                ></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Property Requests -->

            <div class="col-xl-3 col-sm-6 col-12">

                <div class="card">

                    <div class="card-body">

                        <div class="dash-widget-header">

                            <span class="dash-widget-icon bg-warning">

                                <i class="fe fe-file-text"></i>

                            </span>

                        </div>


                        <div class="dash-widget-info">

                            <h3>
                                <?php echo $request_count; ?>
                            </h3>

                            <h6 class="text-muted">
                                Property Requests
                            </h6>

                            <div class="progress progress-sm">

                                <div
                                    class="progress-bar bg-warning"
                                    style="width: 55%;"
                                ></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>

        <!-- /Dashboard Cards -->


        <!-- Charts -->

        <div class="row">


            <!-- Property Overview -->

            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">

                    <div class="card-header">

                        <h4 class="card-title">
                            Property Overview
                        </h4>

                    </div>


                    <div class="card-body">

                        <div id="propertyOverview"></div>

                    </div>

                </div>

            </div>


            <!-- Users / Agents -->

            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">

                    <div class="card-header">

                        <h4 class="card-title">
                            Users & Agents
                        </h4>

                    </div>


                    <div class="card-body">

                        <div id="userAgentOverview"></div>

                    </div>

                </div>

            </div>


        </div>

        <!-- /Charts -->


        <!-- Recent Properties -->

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">
                            Recent Properties
                        </h4>

                    </div>


                    <div class="card-body">

                        <div class="table-responsive">

                            <table
                                class="table table-hover dashboard-table"
                            >

                                <thead>

                                    <tr>

                                        <th>
                                            Property
                                        </th>

                                        <th>
                                            Location
                                        </th>

                                        <th>
                                            Price
                                        </th>

                                        <th>
                                            Added By
                                        </th>

                                        <th>
                                            Date
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>


                                <?php

                                if(
                                    $recent_properties &&
                                    mysqli_num_rows($recent_properties) > 0
                                )
                                {

                                    while(
                                        $property =
                                        mysqli_fetch_assoc(
                                            $recent_properties
                                        )
                                    )
                                    {

                                        /*
                                         * pimage is the first property
                                         * image in the database.
                                         */

                                        $property_image =
                                            !empty($property['pimage'])
                                            ? $property['pimage']
                                            : '';

                                ?>


                                    <tr>


                                        <!-- Property -->

                                        <td>

                                            <div
                                                class="d-flex align-items-center"
                                            >

                                                <?php

                                                if(
                                                    !empty($property_image)
                                                )
                                                {

                                                ?>

                                                    <img
                                                        src="property/<?php echo htmlspecialchars($property_image); ?>"
                                                        class="property-thumb mr-3"
                                                        alt="Property"
                                                    >

                                                <?php

                                                }
                                                else
                                                {

                                                ?>

                                                    <div
                                                        class="property-thumb mr-3 d-flex align-items-center justify-content-center"
                                                        style="background:#f1f1f1;"
                                                    >

                                                        <i class="fe fe-home"></i>

                                                    </div>

                                                <?php

                                                }

                                                ?>


                                                <div>

                                                    <div
                                                        class="property-title"
                                                    >

                                                        <?php

                                                        echo htmlspecialchars(
                                                            $property['title']
                                                        );

                                                        ?>

                                                    </div>


                                                    <div
                                                        class="property-location"
                                                    >

                                                        <?php

                                                        echo htmlspecialchars(
                                                            $property['city']
                                                        );

                                                        ?>

                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        <!-- Location -->

                                        <td>

                                            <?php

                                            echo htmlspecialchars(
                                                $property['location']
                                            );

                                            ?>

                                        </td>


                                        <!-- Price -->

                                        <td>

                                            <?php

                                            echo htmlspecialchars(
                                                $property['price']
                                            );

                                            ?>

                                        </td>


                                        <!-- Added By -->

                                        <td>

                                            <?php

                                            echo !empty(
                                                $property['uname']
                                            )
                                            ? htmlspecialchars(
                                                $property['uname']
                                            )
                                            : 'Admin';

                                            ?>

                                        </td>


                                        <!-- Date -->

                                        <td>

                                            <?php

                                            if(
                                                !empty($property['date'])
                                            )
                                            {

                                                echo date(
                                                    'd M Y',
                                                    strtotime(
                                                        $property['date']
                                                    )
                                                );

                                            }
                                            else
                                            {

                                                echo '-';

                                            }

                                            ?>

                                        </td>


                                    </tr>


                                <?php

                                    }

                                }
                                else
                                {

                                ?>

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="dashboard-empty"
                                        >

                                            No properties found.

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

        <!-- /Recent Properties -->


    </div>

</div>

<!-- /Page Wrapper -->


<!-- /Main Wrapper -->


<!-- jQuery -->

<script src="assets/js/jquery-3.2.1.min.js"></script>


<!-- Bootstrap Core JS -->

<script src="assets/js/popper.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script>


<!-- Slimscroll JS -->

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<!-- Raphael -->

<script src="assets/plugins/raphael/raphael.min.js"></script>


<!-- Morris -->

<script src="assets/plugins/morris/morris.min.js"></script>


<!-- Custom JS -->

<script src="assets/js/script.js"></script>


<script>

/*
|--------------------------------------------------------------------------
| Property Overview Chart
|--------------------------------------------------------------------------
*/

Morris.Area({

    element: 'propertyOverview',

    data: <?php echo json_encode($property_chart_data); ?>,

    xkey: 'month',

    ykeys: ['properties'],

    labels: ['Properties Added'],

    lineColors: ['#2f80ed'],

    pointFillColors: ['#2f80ed'],

    pointStrokeColors: ['#ffffff'],

    behaveLikeLine: true,

    resize: true,

    hideHover: 'auto',

    gridLineColor: '#eeeeee',

    fillOpacity: 0.2

});


/*
|--------------------------------------------------------------------------
| Users & Agents Chart
|--------------------------------------------------------------------------
*/

Morris.Line({

    element: 'userAgentOverview',

    data: <?php echo json_encode($user_chart_data); ?>,

    xkey: 'month',

    ykeys: ['users', 'agents'],

    labels: ['Users', 'Agents'],

    lineColors: ['#2f80ed', '#f43f5e'],

    resize: true,

    hideHover: 'auto',

    gridLineColor: '#eeeeee'

});

</script>


</body>

</html>