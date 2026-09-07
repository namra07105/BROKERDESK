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


$uid = intval($_SESSION['uid']);


/* =========================================================
   CHECK AGENT
========================================================= */

$agentQuery = mysqli_query(
    $con,
    "SELECT * FROM user WHERE uid='$uid'"
);

if(!$agentQuery)
{
    die("Database Error: " . mysqli_error($con));
}


if(mysqli_num_rows($agentQuery) == 0)
{
    session_destroy();

    header("Location: login.php");
    exit;
}


$agent = mysqli_fetch_assoc($agentQuery);


if(strtolower(trim($agent['utype'])) != 'agent')
{
    header("location:../index.php");
    exit;
}


/* =========================================================
   GET LOGGED-IN AGENT PROPERTIES ONLY
========================================================= */

$query = mysqli_query(
    $con,
    "SELECT * FROM property
     WHERE uid='$uid'
     ORDER BY pid DESC"
);

if(!$query)
{
    die("Property Database Error: " . mysqli_error($con));
}

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

    <title>My Properties - BROKERDESK</title>


    <!-- =====================================================
         FONTS
    ====================================================== -->

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
    ====================================================== -->

    <link
        rel="stylesheet"
        href="../css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        href="../css/bootstrap-slider.css"
    >

    <link
        rel="stylesheet"
        href="../css/jquery-ui.css"
    >

    <link
        rel="stylesheet"
        href="../css/layerslider.css"
    >

    <link
        rel="stylesheet"
        href="../css/color.css"
    >

    <link
        rel="stylesheet"
        href="../css/owl.carousel.min.css"
    >

    <link
        rel="stylesheet"
        href="../css/font-awesome.min.css"
    >

    <link
        rel="stylesheet"
        href="../fonts/flaticon/flaticon.css"
    >

    <link
        rel="stylesheet"
        href="../css/style.css"
    <link rel="stylesheet" type="text/css" href="../css/responsive-fix.css">
    >


    <!-- =====================================================
         PAGE CSS
    ====================================================== -->

    <style>

        /* =====================================================
           MAIN PAGE
        ===================================================== */

        .agent-property-page
        {
            background: #f5f6f7;

            padding: 55px 0 70px 0;

            min-height: 500px;
        }


        /* =====================================================
           PAGE HEADING
        ===================================================== */

        .agent-property-heading
        {
            margin-bottom: 30px;
        }


        .agent-property-heading h2
        {
            font-family: "Comfortaa", sans-serif;

            font-size: 28px;

            font-weight: 700;

            color: #333333;

            margin: 0 0 8px 0;
        }


        .agent-property-heading p
        {
            color: #777777;

            font-size: 15px;

            margin: 0;
        }


        /* =====================================================
           ADD PROPERTY BUTTON
        ===================================================== */

        .agent-add-property
        {
            margin-top: 5px;

            padding: 10px 18px;
        }


        /* =====================================================
           TABLE CARD
        ===================================================== */

        .agent-property-box
        {
            background: #ffffff;

            padding: 25px;

            border-radius: 5px;

            box-shadow:
                0 2px 15px rgba(0,0,0,0.06);
        }


        /* =====================================================
           TABLE WRAPPER
        ===================================================== */

        .agent-property-table-wrapper
        {
            width: 100%;

            overflow-x: auto;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .agent-property-table
        {
            width: 100%;

            min-width: 950px;

            border-collapse: collapse;
        }


        .agent-property-table th
        {
            background: #f7f7f7;

            color: #555555;

            font-size: 13px;

            font-weight: 600;

            padding: 15px 12px;

            border-bottom: 1px solid #e5e5e5;

            white-space: nowrap;

            text-align: left;
        }


        .agent-property-table td
        {
            padding: 15px 12px;

            border-bottom: 1px solid #eeeeee;

            color: #555555;

            font-size: 14px;

            vertical-align: middle;
        }


        .agent-property-table tbody tr:hover
        {
            background: #fafafa;
        }


        /* =====================================================
           PROPERTY IMAGE
        ===================================================== */

        .agent-property-image
        {
            width: 90px;

            height: 65px;

            object-fit: cover;

            border-radius: 5px;

            display: block;
        }


        .agent-no-image
        {
            width: 90px;

            height: 65px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #eeeeee;

            border-radius: 5px;

            color: #999999;

            font-size: 22px;
        }


        /* =====================================================
           PROPERTY TITLE
        ===================================================== */

        .agent-property-title
        {
            display: block;

            color: #333333;

            font-size: 15px;

            font-weight: 600;

            max-width: 190px;

            line-height: 1.4;
        }


        /* =====================================================
           PROPERTY DESCRIPTION
        ===================================================== */

        .agent-property-description
        {
            display: block;

            color: #888888;

            font-size: 13px;

            max-width: 220px;

            line-height: 1.5;
        }


        /* =====================================================
           BHK
        ===================================================== */

        .agent-bhk
        {
            font-weight: 600;

            color: #333333;

            white-space: nowrap;
        }


        /* =====================================================
           PRICE
        ===================================================== */

        .agent-price
        {
            font-weight: 600;

            color: #333333;

            white-space: nowrap;
        }


        /* =====================================================
           LOCATION
        ===================================================== */

        .agent-location
        {
            max-width: 180px;

            line-height: 1.5;
        }


        .agent-location strong
        {
            color: #444444;

            font-weight: 600;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .agent-status
        {
            display: inline-block;

            padding: 6px 11px;

            border-radius: 20px;

            background: #f1f1f1;

            color: #555555;

            font-size: 12px;

            font-weight: 600;

            text-transform: capitalize;

            white-space: nowrap;
        }


        .agent-status.available
        {
            background: #e7f8ef;

            color: #16804a;
        }


        .agent-status.pending
        {
            background: #fff4df;

            color: #a56a00;
        }


        .agent-status.sold
        {
            background: #fde8e8;

            color: #c0392b;
        }


        /* =====================================================
           ACTION BUTTONS
        ===================================================== */

        .agent-action-buttons
        {
            display: flex;

            align-items: center;

            gap: 7px;
        }


        .agent-edit-btn
        {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 8px 12px;

            background: #17a2b8;

            color: #ffffff !important;

            border-radius: 4px;

            font-size: 13px;

            text-decoration: none !important;

            white-space: nowrap;
        }


        .agent-edit-btn:hover
        {
            background: #138496;
        }


        .agent-delete-btn
        {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 8px 12px;

            background: #dc3545;

            color: #ffffff !important;

            border-radius: 4px;

            font-size: 13px;

            text-decoration: none !important;

            white-space: nowrap;
        }


        .agent-delete-btn:hover
        {
            background: #c82333;
        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .agent-no-properties
        {
            text-align: center;

            padding: 70px 20px;
        }


        .agent-no-properties i
        {
            font-size: 55px;

            color: #cccccc;

            margin-bottom: 20px;
        }


        .agent-no-properties h4
        {
            color: #444444;

            margin-bottom: 10px;
        }


        .agent-no-properties p
        {
            color: #888888;

            margin-bottom: 25px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width:767px)
        {

            .agent-property-page
            {
                padding: 35px 0 50px 0;
            }


            .agent-property-heading h2
            {
                font-size: 23px;
            }


            .agent-property-heading p
            {
                font-size: 14px;
            }


            .agent-property-box
            {
                padding: 15px;
            }


            .agent-add-property
            {
                margin-top: 20px;
            }


            .agent-property-table
            {
                min-width: 950px;
            }

        }

    </style>

</head>


<body>


<div id="page-wrapper">

    <div class="row">


        <!-- =====================================================
             HEADER
        ===================================================== -->

        <?php include("header.php"); ?>


        <!-- =====================================================
             MY PROPERTIES
        ===================================================== -->

        <div class="full-row agent-property-page">

            <div class="container">


                <!-- =================================================
                     PAGE HEADING
                ================================================= -->

                <div class="row agent-property-heading">

                    <div class="col-md-8">

                        <h2>
                            My Properties
                        </h2>

                        <p>
                            Manage the properties added to your account.
                        </p>

                    </div>


                    <div class="col-md-4 text-md-right">

                        <a
                            href="propertyadd.php"
                            class="btn btn-primary agent-add-property"
                        >

                            <i class="fa fa-plus mr-1"></i>

                            Add Property

                        </a>

                    </div>

                </div>


                <!-- =================================================
                     PROPERTY TABLE
                ================================================= -->

                <div class="agent-property-box">


                    <?php

                    if(mysqli_num_rows($query) > 0)

                    {

                    ?>


                    <div class="agent-property-table-wrapper">

                        <table class="agent-property-table">


                            <thead>

                                <tr>

                                    <th>
                                        Image
                                    </th>

                                    <th>
                                        Property
                                    </th>

                                    <th>
                                        Type
                                    </th>

                                    <th>
                                        BHK
                                    </th>

                                    <th>
                                        Area
                                    </th>

                                    <th>
                                        Price
                                    </th>

                                    <th>
                                        Location
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                            <?php

                            while($row = mysqli_fetch_assoc($query))

                            {

                                /* =====================================
                                   PROPERTY VALUES
                                ===================================== */

                                $title = !empty($row['title'])
                                    ? $row['title']
                                    : 'Untitled Property';


                                $description = '';

                                if(!empty($row['pcontent']))
                                {
                                    $description = strip_tags($row['pcontent']);

                                    if(strlen($description) > 85)
                                    {
                                        $description =
                                            substr($description, 0, 85) . '...';
                                    }
                                }


                                $type = !empty($row['type'])
                                    ? $row['type']
                                    : '-';


                                $bhk = !empty($row['bhk'])
                                    ? $row['bhk']
                                    : '-';


                                $area = !empty($row['size'])
                                    ? $row['size']
                                    : '-';


                                $price = !empty($row['price'])
                                    ? $row['price']
                                    : '-';


                                $location = !empty($row['location'])
                                    ? $row['location']
                                    : '-';


                                $city = !empty($row['city'])
                                    ? $row['city']
                                    : '';


                                $status = !empty($row['status'])
                                    ? trim($row['status'])
                                    : 'Pending';


                                $statusClass =
                                    strtolower(
                                        preg_replace(
                                            '/[^a-zA-Z0-9]+/',
                                            '-',
                                            $status
                                        )
                                    );

                            ?>


                                <tr>


                                    <!-- =================================
                                         IMAGE
                                    ================================== -->

                                    <td>

                                        <?php

                                        if(!empty($row['pimage']))

                                        {

                                        ?>

                                            <img
                                                src="../admin/property/<?php echo htmlspecialchars($row['pimage']); ?>"
                                                alt="<?php echo htmlspecialchars($title); ?>"
                                                class="agent-property-image"
                                            >

                                        <?php

                                        }

                                        else

                                        {

                                        ?>

                                            <div class="agent-no-image">

                                                <i class="fa fa-home"></i>

                                            </div>

                                        <?php

                                        }

                                        ?>

                                    </td>


                                    <!-- =================================
                                         PROPERTY
                                    ================================== -->

                                    <td>

                                        <span class="agent-property-title">

                                            <?php
                                            echo htmlspecialchars($title);
                                            ?>

                                        </span>


                                        <?php

                                        if(!empty($description))

                                        {

                                        ?>

                                            <span class="agent-property-description">

                                                <?php
                                                echo htmlspecialchars($description);
                                                ?>

                                            </span>

                                        <?php

                                        }

                                        ?>

                                    </td>


                                    <!-- =================================
                                         TYPE
                                    ================================== -->

                                    <td>

                                        <?php
                                        echo htmlspecialchars($type);
                                        ?>

                                    </td>


                                    <!-- =================================
                                         BHK
                                    ================================== -->

                                    <td>

                                        <span class="agent-bhk">

                                            <?php
                                            echo htmlspecialchars($bhk);
                                            ?>

                                        </span>

                                    </td>


                                    <!-- =================================
                                         AREA
                                    ================================== -->

                                    <td>

                                        <?php
                                        echo htmlspecialchars($area);
                                        ?>

                                    </td>


                                    <!-- =================================
                                         PRICE
                                    ================================== -->

                                    <td>

                                        <span class="agent-price">

                                            ₹
                                            <?php
                                            echo htmlspecialchars($price);
                                            ?>

                                        </span>

                                    </td>


                                    <!-- =================================
                                         LOCATION
                                    ================================== -->

                                    <td>

                                        <div class="agent-location">

                                            <strong>

                                                <?php
                                                echo htmlspecialchars($location);
                                                ?>

                                            </strong>


                                            <?php

                                            if(!empty($city))

                                            {

                                            ?>

                                                <br>

                                                <?php
                                                echo htmlspecialchars($city);
                                                ?>

                                            <?php

                                            }

                                            ?>

                                        </div>

                                    </td>


                                    <!-- =================================
                                         STATUS
                                    ================================== -->

                                    <td>

                                        <span
                                            class="agent-status <?php echo htmlspecialchars($statusClass); ?>"
                                        >

                                            <?php
                                            echo htmlspecialchars($status);
                                            ?>

                                        </span>

                                    </td>


                                    <!-- =================================
                                         ACTIONS
                                    ================================== -->

                                    <td>

                                        <div class="agent-action-buttons">


                                            <a
                                                href="propertyedit.php?id=<?php echo intval($row['pid']); ?>"
                                                class="agent-edit-btn"
                                            >

                                                <i class="fa fa-edit mr-1"></i>

                                                Edit

                                            </a>


                                            <a
                                                href="propertydelete.php?id=<?php echo intval($row['pid']); ?>"
                                                class="agent-delete-btn"
                                                onclick="return confirm('Are you sure you want to delete this property?');"
                                            >

                                                <i class="fa fa-trash mr-1"></i>

                                                Delete

                                            </a>


                                        </div>

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


                        <!-- =========================================
                             NO PROPERTIES
                        ========================================== -->

                        <div class="agent-no-properties">

                            <i class="fa fa-home"></i>


                            <h4>
                                No Properties Found
                            </h4>


                            <p>
                                You have not added any properties yet.
                            </p>


                            <a
                                href="propertyadd.php"
                                class="btn btn-primary"
                            >

                                <i class="fa fa-plus mr-1"></i>

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
             FOOTER
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