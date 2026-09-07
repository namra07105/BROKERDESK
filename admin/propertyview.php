<?php

session_start();

require("config.php");


/* =========================================================
   ADMIN LOGIN CHECK
========================================================= */

if(!isset($_SESSION['auser']))
{
    header("location:index.php");
    exit;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=0"
    >

    <title>Property - BROKERDESK</title>


    <!-- =====================================================
         FAVICON
    ====================================================== -->

    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="assets/img/favicon.png"
    >


    <!-- =====================================================
         BOOTSTRAP CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/bootstrap.min.css"
    >


    <!-- =====================================================
         FONT AWESOME
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/font-awesome.min.css"
    >


    <!-- =====================================================
         FEATHER ICON
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/feathericon.min.css"
    >


    <!-- =====================================================
         DATATABLES CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/plugins/datatables/dataTables.bootstrap4.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/plugins/datatables/responsive.bootstrap4.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/plugins/datatables/select.bootstrap4.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/plugins/datatables/buttons.bootstrap4.min.css"
    >


    <!-- =====================================================
         MAIN CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >


    <!-- =====================================================
         PROPERTY PAGE STYLE
    ====================================================== -->

    <style>

        /* =====================================================
           PROPERTY TABLE CARD
        ===================================================== */

        .property-view-card
        {
            border: none;

            border-radius: 5px;

            box-shadow:
                0 2px 15px rgba(0,0,0,0.06);
        }


        .property-view-card .card-body
        {
            padding: 25px;
        }


        /* =====================================================
           TABLE WRAPPER
        ===================================================== */

        .property-table-wrapper
        {
            width: 100%;

            overflow-x: auto;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .property-view-table
        {
            width: 100%;

            min-width: 950px;

            border-collapse: collapse;
        }


        .property-view-table thead th
        {
            background: #f7f7f7;

            color: #555555;

            font-size: 13px;

            font-weight: 600;

            padding: 14px 12px;

            border-bottom: 1px solid #e5e5e5;

            white-space: nowrap;

            vertical-align: middle;
        }


        .property-view-table tbody td
        {
            padding: 14px 12px;

            border-bottom: 1px solid #eeeeee;

            color: #555555;

            font-size: 14px;

            vertical-align: middle;
        }


        .property-view-table tbody tr:hover
        {
            background: #fafafa;
        }


        /* =====================================================
           PROPERTY IMAGE
        ===================================================== */

        .property-main-image
        {
            width: 90px;

            height: 65px;

            object-fit: cover;

            border-radius: 5px;

            display: block;
        }


        .property-no-image
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

        .property-title
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

        .property-description
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

        .property-bhk
        {
            font-weight: 600;

            color: #333333;

            white-space: nowrap;
        }


        /* =====================================================
           PRICE
        ===================================================== */

        .property-price
        {
            font-weight: 600;

            color: #333333;

            white-space: nowrap;
        }


        /* =====================================================
           LOCATION
        ===================================================== */

        .property-location
        {
            max-width: 180px;

            line-height: 1.5;
        }


        .property-location strong
        {
            color: #444444;

            font-weight: 600;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .property-status
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


        .property-status.available
        {
            background: #e7f8ef;

            color: #16804a;
        }


        .property-status.pending
        {
            background: #fff4df;

            color: #a56a00;
        }


        .property-status.sold
        {
            background: #fde8e8;

            color: #c0392b;
        }


        /* =====================================================
           ACTION BUTTONS
        ===================================================== */

        .property-actions
        {
            display: flex;

            align-items: center;

            gap: 7px;
        }


        .property-edit-btn
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


        .property-edit-btn:hover
        {
            background: #138496;
        }


        .property-delete-btn
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


        .property-delete-btn:hover
        {
            background: #c82333;
        }


        /* =====================================================
           DATATABLE SEARCH
        ===================================================== */

        .dataTables_wrapper .dataTables_filter input
        {
            border: 1px solid #dddddd;

            border-radius: 4px;

            padding: 7px 10px;

            outline: none;
        }


        .dataTables_wrapper .dataTables_length select
        {
            border: 1px solid #dddddd;

            border-radius: 4px;

            padding: 5px 8px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width:767px)
        {

            .property-view-card .card-body
            {
                padding: 15px;
            }


            .property-view-table
            {
                min-width: 950px;
            }


            .property-title
            {
                max-width: 160px;
            }


            .property-description
            {
                max-width: 180px;
            }

        }

    </style>


</head>


<body>


<!-- =========================================================
     MAIN WRAPPER
========================================================= -->


<div class="main-wrapper">


    <!-- =====================================================
         HEADER
         DO NOT CHANGE
    ====================================================== -->

    <?php include("header.php"); ?>


    <!-- =====================================================
         PAGE WRAPPER
    ====================================================== -->

    <div class="page-wrapper">

        <div class="content container-fluid">


            <!-- =================================================
                 PAGE HEADER
            ================================================== -->

            <div class="page-header">

                <div class="row">

                    <div class="col">

                        <h3 class="page-title">
                            Property
                        </h3>


                       <!-- <ul class="breadcrumb">

                            <li class="breadcrumb-item">

                                <a href="dashboard.php">
                                    
                                </a>

                            </li>


                            <li class="breadcrumb-item active">

                                

                            </li>

                        </ul>-->

                    </div>

                </div>

            </div>


            <!-- =================================================
                 PROPERTY TABLE
            ================================================== -->

            <div class="row">

                <div class="col-12">

                    <div class="card property-view-card">

                        <div class="card-body">


                            <!-- =================================================
                                 TITLE
                            ================================================== -->

                            <h4 class="header-title mt-0 mb-4">

                                Property View

                            </h4>


                            <!-- =================================================
                                 MESSAGE
                            ================================================== -->

                            <?php

                            if(isset($_GET['msg']))
                            {
                                echo $_GET['msg'];
                            }

                            ?>


                            <!-- =================================================
                                 TABLE
                            ================================================== -->

                            <div class="property-table-wrapper">

                                <table
                                    id="datatable-buttons"
                                    class="table property-view-table"
                                >


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
                                                Agent ID
                                            </th>

                                            <th>
                                                Date
                                            </th>

                                            <th>
                                                Actions
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                    <?php

                                    /* =================================================
                                       GET ALL PROPERTIES FOR ADMIN
                                    ================================================== */

                                    $query = mysqli_query(
                                        $con,
                                        "SELECT * FROM property ORDER BY pid DESC"
                                    );


                                    if(!$query)
                                    {
                                        die(
                                            "Property Database Error: "
                                            . mysqli_error($con)
                                        );
                                    }


                                    while($row = mysqli_fetch_assoc($query))
                                    {


                                        /* =============================================
                                           PROPERTY VALUES
                                        ============================================== */


                                        $title = !empty($row['title'])
                                            ? $row['title']
                                            : 'Untitled Property';


                                        $description = '';

                                        if(!empty($row['pcontent']))
                                        {

                                            $description =
                                                strip_tags($row['pcontent']);


                                            if(strlen($description) > 85)
                                            {

                                                $description =
                                                    substr(
                                                        $description,
                                                        0,
                                                        85
                                                    ) . '...';

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
                                                        src="property/<?php echo htmlspecialchars($row['pimage']); ?>"
                                                        alt="<?php echo htmlspecialchars($title); ?>"
                                                        class="property-main-image"
                                                    >

                                                <?php

                                                }

                                                else

                                                {

                                                ?>

                                                    <div class="property-no-image">

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

                                                <span class="property-title">

                                                    <?php

                                                    echo htmlspecialchars(
                                                        $title
                                                    );

                                                    ?>

                                                </span>


                                                <?php

                                                if(!empty($description))

                                                {

                                                ?>

                                                    <span class="property-description">

                                                        <?php

                                                        echo htmlspecialchars(
                                                            $description
                                                        );

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

                                                echo htmlspecialchars(
                                                    $type
                                                );

                                                ?>

                                            </td>


                                            <!-- =================================
                                                 BHK
                                            ================================== -->

                                            <td>

                                                <span class="property-bhk">

                                                    <?php

                                                    echo htmlspecialchars(
                                                        $bhk
                                                    );

                                                    ?>

                                                </span>

                                            </td>


                                            <!-- =================================
                                                 AREA
                                            ================================== -->

                                            <td>

                                                <?php

                                                echo htmlspecialchars(
                                                    $area
                                                );

                                                ?>

                                            </td>


                                            <!-- =================================
                                                 PRICE
                                            ================================== -->

                                            <td>

                                                <span class="property-price">

                                                    ₹
                                                    <?php

                                                    echo htmlspecialchars(
                                                        $price
                                                    );

                                                    ?>

                                                </span>

                                            </td>


                                            <!-- =================================
                                                 LOCATION
                                            ================================== -->

                                            <td>

                                                <div class="property-location">

                                                    <strong>

                                                        <?php

                                                        echo htmlspecialchars(
                                                            $location
                                                        );

                                                        ?>

                                                    </strong>


                                                    <?php

                                                    if(!empty($city))

                                                    {

                                                    ?>

                                                        <br>

                                                        <?php

                                                        echo htmlspecialchars(
                                                            $city
                                                        );

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
                                                    class="property-status <?php echo htmlspecialchars($statusClass); ?>"
                                                >

                                                    <?php

                                                    echo htmlspecialchars(
                                                        $status
                                                    );

                                                    ?>

                                                </span>

                                            </td>


                                            <!-- =================================
                                                 AGENT UID
                                            ================================== -->

                                            <td>

                                                <?php

                                                echo htmlspecialchars(
                                                    $row['uid']
                                                );

                                                ?>

                                            </td>


                                            <!-- =================================
                                                 DATE
                                            ================================== -->

                                            <td>

                                                <?php

                                                echo htmlspecialchars(
                                                    $row['date']
                                                );

                                                ?>

                                            </td>


                                            <!-- =================================
                                                 ACTIONS
                                            ================================== -->

                                            <td>

                                                <div class="property-actions">


                                                    <a
                                                        href="propertyedit.php?id=<?php echo intval($row['pid']); ?>"
                                                        class="property-edit-btn"
                                                    >

                                                        <i class="fa fa-edit mr-1"></i>

                                                        Edit

                                                    </a>


                                                    <a
                                                        href="propertydelete.php?id=<?php echo intval($row['pid']); ?>"
                                                        class="property-delete-btn"
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


                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>


</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->


<!-- jQuery -->

<script src="assets/js/jquery-3.2.1.min.js"></script>


<!-- Bootstrap Core JS -->

<script src="assets/js/popper.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script>


<!-- Slimscroll JS -->

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<!-- DataTables JS -->

<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>

<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<script src="assets/plugins/datatables/dataTables.select.min.js"></script>


<!-- DataTables Buttons -->

<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>

<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>

<script src="assets/plugins/datatables/buttons.html5.min.js"></script>

<script src="assets/plugins/datatables/buttons.flash.min.js"></script>

<script src="assets/plugins/datatables/buttons.print.min.js"></script>


<!-- Custom JS -->

<script src="assets/js/script.js"></script>


</body>

</html>