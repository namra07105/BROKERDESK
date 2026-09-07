<?php

session_start();

include("../config.php");


/* =========================================================
   AGENT LOGIN CHECK
========================================================= */

if(!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
    header("Location: login.php");
    exit;
}


/* =========================================================
   GET LOGGED-IN AGENT
========================================================= */

$uid = intval($_SESSION['uid']);

$agentQuery = mysqli_query(
    $con,
    "SELECT * FROM user WHERE uid='$uid'"
);


/* =========================================================
   DATABASE ERROR
========================================================= */

if(!$agentQuery)
{
    die("Database Error: " . mysqli_error($con));
}


/* =========================================================
   AGENT NOT FOUND
========================================================= */

if(mysqli_num_rows($agentQuery) == 0)
{
    session_destroy();

    header("Location: login.php");
    exit;
}


$agent = mysqli_fetch_assoc($agentQuery);


/* =========================================================
   CHECK AGENT TYPE
========================================================= */

if(strtolower(trim($agent['utype'])) != 'agent')
{
    die(
        "This account is not registered as an Agent. Current user type: "
        . htmlspecialchars($agent['utype'])
    );
}


/* =========================================================
   TOTAL PROPERTIES
========================================================= */

$totalProperties = 0;

$totalPropertyQuery = mysqli_query(
    $con,
    "SELECT COUNT(*) AS total
     FROM property
     WHERE uid='$uid'"
);

if($totalPropertyQuery)
{
    $propertyData = mysqli_fetch_assoc($totalPropertyQuery);

    $totalProperties = intval($propertyData['total']);
}


/* =========================================================
   AVAILABLE PROPERTIES
========================================================= */

$availableProperties = 0;

$availableQuery = mysqli_query(
    $con,
    "SELECT COUNT(*) AS total
     FROM property
     WHERE uid='$uid'
     AND LOWER(TRIM(status))='available'"
);

if($availableQuery)
{
    $availableData = mysqli_fetch_assoc($availableQuery);

    $availableProperties = intval($availableData['total']);
}


/* =========================================================
   OTHER PROPERTIES
   Includes:
   - Properties uploaded by Admin
   - Properties uploaded by other Agents
   Excludes:
   - Properties uploaded by the logged-in Agent
========================================================= */

$otherProperties = 0;

$otherPropertyQuery = mysqli_query(
    $con,
    "SELECT COUNT(*) AS total
     FROM property
     WHERE uid != '$uid'
        OR uid IS NULL"
);

if($otherPropertyQuery)
{
    $otherPropertyData = mysqli_fetch_assoc($otherPropertyQuery);

    $otherProperties = intval($otherPropertyData['total']);
}


/* =========================================================
   PROPERTY REQUESTS
========================================================= */

$totalRequests = 0;


/* Check whether request table exists */

$requestTableCheck = mysqli_query(
    $con,
    "SHOW TABLES LIKE 'request'"
);

if(
    $requestTableCheck &&
    mysqli_num_rows($requestTableCheck) > 0
)
{
    $requestQuery = mysqli_query(
        $con,
        "SELECT COUNT(*) AS total
         FROM request"
    );

    if($requestQuery)
    {
        $requestData = mysqli_fetch_assoc($requestQuery);

        $totalRequests = intval($requestData['total']);
    }
}


/* =========================================================
   RECENT PROPERTIES
========================================================= */

$recentProperties = mysqli_query(
    $con,
    "SELECT *
     FROM property
     WHERE uid='$uid'
     ORDER BY pid DESC
     LIMIT 5"
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >

    <title>Agent Dashboard - BROKERDESK</title>


    <!-- =====================================================
         FONTS
    ===================================================== -->

    <link
        href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css?family=Comfortaa:400,700"
        rel="stylesheet"
    >


    <!-- =====================================================
         CSS
    ===================================================== -->

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/bootstrap-slider.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/jquery-ui.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/layerslider.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/color.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/owl.carousel.min.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/font-awesome.min.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../fonts/flaticon/flaticon.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/style.css"
    >


    <!-- =====================================================
         COLOURFUL AGENT DASHBOARD CSS
    ===================================================== -->

    <style>

        /* =====================================================
           DASHBOARD BACKGROUND
        ===================================================== */

        .agent-dashboard-wrapper
        {
            background: linear-gradient(
                135deg,
                #f4f7fb 0%,
                #eef3f9 100%
            );

            padding: 60px 0;
        }


        /* =====================================================
           WELCOME BOX
        ===================================================== */

        .agent-welcome-box
        {
            background: linear-gradient(
                135deg,
                #ffffff 0%,
                #eef6ff 100%
            );

            padding: 35px;

            margin-bottom: 30px;

            border-radius: 12px;

            border-left: 5px solid #2d6cdf;

            box-shadow:
                0 5px 20px rgba(45,108,223,0.10);

            position: relative;

            overflow: hidden;
        }


        .agent-welcome-box:after
        {
            content: "";

            position: absolute;

            width: 180px;

            height: 180px;

            right: -60px;

            top: -80px;

            background:
                rgba(45,108,223,0.08);

            border-radius: 50%;
        }


        .agent-welcome-box h2
        {
            margin: 0 0 10px 0;

            font-family: "Comfortaa", sans-serif;

            font-size: 28px;

            font-weight: 700;

            color: #2457a6;

            position: relative;

            z-index: 2;
        }


        .agent-welcome-box p
        {
            margin: 0;

            color: #68778d;

            font-size: 15px;

            position: relative;

            z-index: 2;
        }


        /* =====================================================
           STATISTICS
        ===================================================== */

        .agent-stat-box
        {
            background: #ffffff;

            min-height: 125px;

            padding: 25px;

            margin-bottom: 30px;

            border-radius: 12px;

            box-shadow:
                0 5px 18px rgba(0,0,0,0.07);

            transition: all 0.3s ease;

            border-top: 4px solid #2d6cdf;
        }


        .agent-stat-box:hover
        {
            transform: translateY(-5px);

            box-shadow:
                0 10px 25px rgba(0,0,0,0.10);
        }


        .agent-stat-icon
        {
            width: 55px;

            height: 55px;

            line-height: 55px;

            text-align: center;

            float: left;

            margin-right: 18px;

            border-radius: 50%;

            background: #eaf2ff;

            color: #2d6cdf;

            font-size: 21px;

            transition: all 0.3s ease;
        }


        .agent-stat-box:hover .agent-stat-icon
        {
            transform: scale(1.08);
        }


        .agent-stat-box h3
        {
            margin: 0;

            padding-top: 3px;

            font-size: 28px;

            font-weight: 600;

            color: #26364d;
        }


        .agent-stat-box p
        {
            margin: 6px 0 0 0;

            color: #718096;

            font-size: 14px;
        }


        /* =====================================================
           STAT CARD 1 - BLUE
        ===================================================== */

        .agent-stat-box:nth-child(1)
        {
            border-top-color: #2d6cdf;
        }


        .agent-stat-box:nth-child(1) .agent-stat-icon
        {
            background: #eaf2ff;

            color: #2d6cdf;
        }


        /* =====================================================
           STAT CARD 2 - GREEN
        ===================================================== */

        .agent-stat-box:nth-child(2)
        {
            border-top-color: #28a745;
        }


        .agent-stat-box:nth-child(2) .agent-stat-icon
        {
            background: #e9f8ee;

            color: #28a745;
        }


        /* =====================================================
           STAT CARD 3 - ORANGE
        ===================================================== */

        .agent-stat-box:nth-child(3)
        {
            border-top-color: #f39c12;
        }


        .agent-stat-box:nth-child(3) .agent-stat-icon
        {
            background: #fff4df;

            color: #f39c12;
        }


        /* =====================================================
           STAT CARD 4 - RED
        ===================================================== */

        .agent-stat-box:nth-child(4)
        {
            border-top-color: #e74c3c;
        }


        .agent-stat-box:nth-child(4) .agent-stat-icon
        {
            background: #ffeded;

            color: #e74c3c;
        }


        /* =====================================================
           DASHBOARD SECTION
        ===================================================== */

        .agent-dashboard-section
        {
            background: #ffffff;

            padding: 30px;

            margin-bottom: 30px;

            border-radius: 12px;

            box-shadow:
                0 5px 18px rgba(0,0,0,0.06);

            border-top: 3px solid #2d6cdf;
        }


        .agent-dashboard-title
        {
            margin: 0 0 25px 0;

            font-family: "Comfortaa", sans-serif;

            font-size: 21px;

            color: #26364d;

            font-weight: 700;

            position: relative;

            padding-left: 14px;
        }


        .agent-dashboard-title:before
        {
            content: "";

            position: absolute;

            left: 0;

            top: 2px;

            width: 4px;

            height: 23px;

            background:
                linear-gradient(
                    to bottom,
                    #2d6cdf,
                    #6f42c1
                );

            border-radius: 5px;
        }


        /* =====================================================
           QUICK ACTIONS
        ===================================================== */

        .agent-action-box
        {
            display: block;

            background:
                linear-gradient(
                    135deg,
                    #ffffff 0%,
                    #f8faff 100%
                );

            padding: 25px 15px;

            text-align: center;

            border: 1px solid #e5eaf2;

            border-radius: 10px;

            text-decoration: none !important;

            transition: all 0.3s ease;

            position: relative;

            overflow: hidden;
        }


        .agent-action-box:hover
        {
            transform: translateY(-6px);

            box-shadow:
                0 10px 25px rgba(45,108,223,0.15);

            border-color: #2d6cdf;
        }


        .agent-action-box i
        {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 65px;

            height: 65px;

            font-size: 30px;

            margin-bottom: 15px;

            border-radius: 50%;

            background: #eaf2ff;

            color: #2d6cdf;

            transition: all 0.3s ease;
        }


        .agent-action-box:hover i
        {
            transform:
                scale(1.1)
                rotate(3deg);
        }


        .agent-action-box span
        {
            display: block;

            color: #334155;

            font-size: 14px;

            font-weight: 600;
        }


        /* Add Property */

        .agent-action-box:nth-child(1) i
        {
            background: #eaf2ff;

            color: #2d6cdf;
        }


        /* Manage Properties */

        .agent-action-box:nth-child(2) i
        {
            background: #e9f8ee;

            color: #28a745;
        }


        /* Property Requests */

        .agent-action-box:nth-child(3) i
        {
            background: #fff0f0;

            color: #e74c3c;
        }


        /* =====================================================
           PROPERTY TABLE
        ===================================================== */

        .agent-property-table-wrapper
        {
            width: 100%;

            overflow-x: auto;
        }


        .agent-property-table
        {
            width: 100%;

            border-collapse: separate;

            border-spacing: 0;

            overflow: hidden;

            border-radius: 8px;
        }


        .agent-property-table th
        {
            padding: 14px;

            background: #eef4ff;

            border-bottom:
                2px solid #dce7fb;

            color: #36527a;

            font-size: 13px;

            font-weight: 600;

            text-transform: uppercase;
        }


        .agent-property-table td
        {
            padding: 14px;

            border-bottom:
                1px solid #eeeeee;

            vertical-align: middle;

            color: #444444;

            font-size: 14px;

            background: #ffffff;
        }


        .agent-property-table tbody tr
        {
            transition: all 0.2s ease;
        }


        .agent-property-table tbody tr:hover td
        {
            background: #f7faff;
        }


        .agent-property-image
        {
            width: 70px;

            height: 55px;

            object-fit: cover;

            border-radius: 6px;

            display: block;
        }


        .agent-property-title
        {
            font-weight: 600;

            color: #2d6cdf;

            margin-bottom: 4px;
        }


        .agent-property-location
        {
            color: #888888;

            font-size: 13px;
        }


        .agent-property-price
        {
            font-weight: 600;

            color: #28a745;
        }


        .agent-view-all
        {
            float: right;

            font-size: 14px;

            color: #2d6cdf !important;

            font-weight: 600;
        }


        .agent-view-all:hover
        {
            color: #1b4f9c !important;
        }


        /* =====================================================
           EMPTY PROPERTY
        ===================================================== */

        .agent-empty
        {
            text-align: center;

            padding: 45px 20px;
        }


        .agent-empty i
        {
            font-size: 45px;

            color: #aebbd0;

            margin-bottom: 15px;
        }


        .agent-empty h5
        {
            margin-bottom: 8px;

            color: #3b4a60;
        }


        .agent-empty p
        {
            color: #888888;

            margin-bottom: 20px;
        }


        .agent-empty .btn
        {
            background: #2d6cdf;

            border-color: #2d6cdf;
        }


        .agent-empty .btn:hover
        {
            background: #1f56b5;

            border-color: #1f56b5;
        }


        /* =====================================================
           BUTTONS
        ===================================================== */

        .agent-dashboard-section .btn-primary
        {
            background: #2d6cdf;

            border-color: #2d6cdf;

            border-radius: 6px;
        }


        .agent-dashboard-section .btn-primary:hover
        {
            background: #1f56b5;

            border-color: #1f56b5;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width:767px)
        {

            .agent-dashboard-wrapper
            {
                padding: 35px 0;
            }


            .agent-welcome-box
            {
                padding: 25px;
            }


            .agent-welcome-box h2
            {
                font-size: 23px;
            }


            .agent-dashboard-section
            {
                padding: 20px;
            }


            .agent-property-table
            {
                min-width: 700px;
            }

        }

    </style>

</head>


<body>


<div id="page-wrapper">

    <div class="row">


        <!-- =====================================================
             AGENT HEADER
        ===================================================== -->

        <?php include("header.php"); ?>


        <!-- =====================================================
             AGENT DASHBOARD
        ===================================================== -->

        <div class="full-row agent-dashboard-wrapper">

            <div class="container">


                <!-- =================================================
                     WELCOME
                ================================================= -->

                <div class="agent-welcome-box">

                    <h2>

                        Welcome,
                        <?php
                        echo htmlspecialchars($agent['uname']);
                        ?>!

                    </h2>


                    <p>

                        Welcome to your BROKERDESK Agent Dashboard.
                        Manage your properties and property requests
                        from one place.

                    </p>

                </div>


                <!-- =================================================
                     STATISTICS
                ================================================= -->

                <div class="row">


                    <!-- My Properties -->

                    <div class="col-lg-3 col-md-6">

                        <div class="agent-stat-box">

                            <div class="agent-stat-icon">

                                <i class="fas fa-home"></i>

                            </div>


                            <h3>

                                <?php
                                echo $totalProperties;
                                ?>

                            </h3>


                            <p>
                                My Properties
                            </p>


                            <div style="clear:both;"></div>

                        </div>

                    </div>


                    <!-- Available Properties -->

                    <div class="col-lg-3 col-md-6">

                        <div class="agent-stat-box">

                            <div class="agent-stat-icon">

                                <i class="fas fa-check-circle"></i>

                            </div>


                            <h3>

                                <?php
                                echo $availableProperties;
                                ?>

                            </h3>


                            <p>
                                Available Properties
                            </p>


                            <div style="clear:both;"></div>

                        </div>

                    </div>


                    <!-- Other Properties -->

                    <div class="col-lg-3 col-md-6">

                        <div class="agent-stat-box">

                            <div class="agent-stat-icon">

                                <i class="fas fa-building"></i>

                            </div>


                            <h3>

                                <?php
                                echo $otherProperties;
                                ?>

                            </h3>


                            <p>
                                Other Properties
                            </p>


                            <div style="clear:both;"></div>

                        </div>

                    </div>


                    <!-- Property Requests -->

                    <div class="col-lg-3 col-md-6">

                        <div class="agent-stat-box">

                            <div class="agent-stat-icon">

                                <i class="fas fa-envelope"></i>

                            </div>


                            <h3>

                                <?php
                                echo $totalRequests;
                                ?>

                            </h3>


                            <p>
                                Property Requests
                            </p>


                            <div style="clear:both;"></div>

                        </div>

                    </div>


                </div>


                <!-- =================================================
                     QUICK ACTIONS
                ================================================= -->

                <div class="agent-dashboard-section">

                    <h3 class="agent-dashboard-title">
                        Quick Actions
                    </h3>


                    <div class="row">


                        <!-- Add Property -->

                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">

                            <a
                                href="propertyadd.php"
                                class="agent-action-box"
                            >

                                <i class="fas fa-plus-circle"></i>

                                <span>
                                    Add New Property
                                </span>

                            </a>

                        </div>


                        <!-- My Properties -->

                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">

                            <a
                                href="propertyview.php"
                                class="agent-action-box"
                            >

                                <i class="fas fa-home"></i>

                                <span>
                                    Manage My Properties
                                </span>

                            </a>

                        </div>


                        <!-- Property Requests -->

                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">

                            <a
                                href="request.php"
                                class="agent-action-box"
                            >

                                <i class="fas fa-envelope"></i>

                                <span>
                                    Property Requests
                                </span>

                            </a>

                        </div>


                    </div>

                </div>


                <!-- =================================================
                     RECENT PROPERTIES
                ================================================= -->

                <div class="agent-dashboard-section">


                    <a
                        href="propertyview.php"
                        class="agent-view-all"
                    >
                        View All Properties →
                    </a>


                    <h3 class="agent-dashboard-title">

                        My Recent Properties

                    </h3>


                    <?php

                    if(
                        $recentProperties &&
                        mysqli_num_rows($recentProperties) > 0
                    )
                    {

                    ?>


                    <div class="agent-property-table-wrapper">

                        <table class="agent-property-table">

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
                                        Type
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                            <?php

                            while(
                                $property =
                                mysqli_fetch_assoc($recentProperties)
                            )
                            {


                                $propertyImage =
                                    !empty($property['pimage'])
                                    ? $property['pimage']
                                    : '';


                                $propertyTitle =
                                    !empty($property['title'])
                                    ? $property['title']
                                    : 'Untitled Property';


                                $propertyLocation =
                                    !empty($property['location'])
                                    ? $property['location']
                                    : '';


                                $propertyPrice =
                                    !empty($property['price'])
                                    ? $property['price']
                                    : '';


                                $propertyType =
                                    !empty($property['type'])
                                    ? $property['type']
                                    : '';

                            ?>


                                <tr>


                                    <!-- Property -->

                                    <td>

                                        <div
                                            style="
                                                display:flex;
                                                align-items:center;
                                            "
                                        >


                                            <?php

                                            if($propertyImage != '')
                                            {

                                            ?>

                                                <img
                                                    src="../admin/property/<?php echo htmlspecialchars($propertyImage); ?>"
                                                    class="agent-property-image"
                                                    alt="Property"
                                                >

                                            <?php

                                            }
                                            else
                                            {

                                            ?>

                                                <div
                                                    class="agent-property-image"
                                                    style="
                                                        background:#eeeeee;
                                                        text-align:center;
                                                        line-height:55px;
                                                    "
                                                >

                                                    <i class="fas fa-home"></i>

                                                </div>

                                            <?php

                                            }

                                            ?>


                                            <div
                                                style="
                                                    margin-left:12px;
                                                "
                                            >

                                                <div
                                                    class="agent-property-title"
                                                >

                                                    <?php

                                                    echo htmlspecialchars(
                                                        $propertyTitle
                                                    );

                                                    ?>

                                                </div>

                                            </div>


                                        </div>

                                    </td>


                                    <!-- Location -->

                                    <td>

                                        <span
                                            class="agent-property-location"
                                        >

                                            <?php

                                            echo htmlspecialchars(
                                                $propertyLocation
                                            );

                                            ?>

                                        </span>

                                    </td>


                                    <!-- Price -->

                                    <td>

                                        <span
                                            class="agent-property-price"
                                        >

                                            <?php

                                            echo htmlspecialchars(
                                                $propertyPrice
                                            );

                                            ?>

                                        </span>

                                    </td>


                                    <!-- Type -->

                                    <td>

                                        <?php

                                        echo htmlspecialchars(
                                            $propertyType
                                        );

                                        ?>

                                    </td>


                                    <!-- Action -->

                                    <td>

                                        <a
                                            href="propertyedit.php?pid=<?php echo intval($property['pid']); ?>"
                                            class="btn btn-primary btn-sm"
                                        >

                                            Edit

                                        </a>

                                    </td>


                                </tr>


                            <?php

                            }

                            ?>


                            </tbody>

                        </table>

                    </div>


                    <?php

                    }
                    else
                    {

                    ?>


                        <div class="agent-empty">

                            <i class="fas fa-home"></i>


                            <h5>
                                No Properties Yet
                            </h5>


                            <p>

                                You have not added any properties
                                to your account yet.

                            </p>


                            <a
                                href="propertyadd.php"
                                class="btn btn-primary"
                            >

                                Add Your First Property

                            </a>

                        </div>


                    <?php

                    }

                    ?>


                </div>


            </div>

        </div>


        <!-- =====================================================
             AGENT FOOTER
        ===================================================== -->

        <?php include("footer.php"); ?>


    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script src="../js/jquery.min.js"></script>

<script src="../js/greensock.js"></script>

<script src="../js/layerslider.transitions.js"></script>

<script src="../js/layerslider.kreaturamedia.jquery.js"></script>

<script src="../js/popper.min.js"></script>

<script src="../js/bootstrap.min.js"></script>

<script src="../js/owl.carousel.min.js"></script>

<script src="../js/tmpl.js"></script>

<script src="../js/jquery.dependClass-0.1.js"></script>

<script src="../js/draggable-0.1.js"></script>

<script src="../js/jquery.slider.js"></script>

<script src="../js/wow.js"></script>

<script src="../js/custom.js"></script>


</body>

</html>