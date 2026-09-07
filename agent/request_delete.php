<?php

session_start();

include("../config.php");


/* =========================================================
   AGENT LOGIN CHECK
========================================================= */

if(!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
    header("Location: login.php");
    exit();
}

$uid = intval($_SESSION['uid']);


/* =========================================================
   CHECK AGENT ACCOUNT
========================================================= */

$agentQuery = mysqli_query(
    $con,
    "SELECT * FROM user WHERE uid='$uid' LIMIT 1"
);

if(!$agentQuery)
{
    header("Location: login.php");
    exit();
}

if(mysqli_num_rows($agentQuery) == 0)
{
    session_destroy();

    header("Location: login.php");
    exit();
}

$agent = mysqli_fetch_assoc($agentQuery);


/* =========================================================
   CHECK USER TYPE
========================================================= */

if(strtolower(trim($agent['utype'])) != 'agent')
{
    header("Location:../index.php");
    exit();
}


/* =========================================================
   DELETE PROPERTY REQUEST
   Agent can delete ONLY requests for their own properties
   ========================================================= */

if(isset($_GET['delete']) && !empty($_GET['delete']))
{
    $rid = intval($_GET['delete']);

    if($rid > 0)
    {
        $deleteQuery = mysqli_query(
            $con,
            "DELETE r
             FROM request r
             INNER JOIN property p ON r.pid = p.pid
             WHERE r.rid='$rid'
               AND p.uploaded_by='agent'
               AND p.uid='$uid'"
        );

        if($deleteQuery && mysqli_affected_rows($con) > 0)
        {
            header("Location:request.php?msg=" . urlencode("Request Deleted Successfully"));
            exit();
        }
        else
        {
            header("Location:request.php?msg=" . urlencode("Request Not Deleted"));
            exit();
        }
    }
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

    <title>Property Requests - BROKERDESK</title>


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
         BOOTSTRAP
    ====================================================== -->

    <link
        rel="stylesheet"
        href="../css/bootstrap.min.css"
    >


    <!-- =====================================================
         OTHER CSS
    ====================================================== -->

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
         DATATABLE CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="../admin/assets/plugins/datatables/dataTables.bootstrap4.min.css"
    >

    <link
        rel="stylesheet"
        href="../admin/assets/plugins/datatables/responsive.bootstrap4.min.css"
    >


    <!-- =====================================================
         REQUEST PAGE STYLE
    ====================================================== -->

    <style>

        .request-page
        {
            background: #f5f6f7;

            padding: 50px 0 70px 0;

            min-height: 600px;
        }


        .request-page-heading
        {
            margin-bottom: 30px;
        }


        .request-page-heading h3
        {
            font-family: "Comfortaa", sans-serif;

            font-size: 28px;

            font-weight: 700;

            color: #333333;

            margin-bottom: 8px;
        }


        .request-page-heading p
        {
            color: #777777;

            margin-bottom: 15px;
        }


        .request-card
        {
            background: #ffffff;

            border-radius: 6px;

            box-shadow:
                0 2px 15px rgba(0,0,0,0.06);

            border: none;

            overflow: hidden;
        }


        .request-card-header
        {
            padding: 20px 25px;

            border-bottom: 1px solid #eeeeee;

            background: #ffffff;
        }


        .request-card-header h4
        {
            margin: 0;

            font-size: 18px;

            font-weight: 600;

            color: #333333;
        }


        .request-card-header h4 i
        {
            margin-right: 8px;

            color: #17a2b8;
        }


        .request-card-body
        {
            padding: 25px;
        }


        .request-table
        {
            width: 100%;
        }


        .request-table thead th
        {
            font-size: 13px;

            font-weight: 600;

            color: #555555;

            vertical-align: middle;

            white-space: nowrap;
        }


        .request-table tbody td
        {
            font-size: 13px;

            color: #555555;

            vertical-align: middle;
        }


        .request-description
        {
            min-width: 280px;

            max-width: 450px;

            white-space: normal;

            line-height: 1.6;
        }


        .request-customer-name
        {
            font-weight: 600;

            color: #333333;
        }


        .request-contact
        {
            line-height: 1.7;
        }


        .request-contact i
        {
            width: 17px;

            margin-right: 4px;

            color: #999999;
        }


        .status-badge
        {
            display: inline-block;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 600;
        }


        .status-new
        {
            background: #fff3cd;

            color: #856404;
        }


        .status-viewed
        {
            background: #d4edda;

            color: #155724;
        }


        .no-request
        {
            text-align: center;

            padding: 40px 20px;

            color: #999999;
        }


        .no-request i
        {
            font-size: 40px;

            margin-bottom: 15px;

            display: block;
        }


        @media(max-width:767px)
        {

            .request-page
            {
                padding: 30px 0 50px 0;
            }


            .request-card-body
            {
                padding: 15px;
            }


            .request-card-header
            {
                padding: 18px;
            }


            .request-page-heading h3
            {
                font-size: 23px;
            }

        }

    </style>

</head>


<body>


<div id="page-wrapper">

    <div class="row">


        <!-- =====================================================
             AGENT HEADER
        ====================================================== -->

        <?php include("header.php"); ?>


        <!-- =====================================================
             PAGE CONTENT
        ====================================================== -->

        <div class="full-row request-page">

            <div class="container">


                <!-- =================================================
                     PAGE HEADER
                ================================================== -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="request-page-heading">

                            <h3>
                                Property Requests
                            </h3>

                            <p>
                                View customer property requirements and requests.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     MESSAGE
                ================================================== -->

                <?php

                if(isset($_GET['msg']) && !empty($_GET['msg']))
                {

                ?>

                    <div class="alert alert-info">

                        <?php

                        echo htmlspecialchars(
                            $_GET['msg']
                        );

                        ?>

                    </div>

                <?php

                }

                ?>


                <!-- =================================================
                     REQUEST TABLE
                ================================================== -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="request-card">


                            <!-- =================================================
                                 CARD HEADER
                            ================================================== -->

                            <div class="request-card-header">

                                <h4>

                                    <i class="fa fa-list-alt"></i>

                                    Property Request List

                                </h4>

                            </div>


                            <!-- =================================================
                                 CARD BODY
                            ================================================== -->

                            <div class="request-card-body">

                                <div class="table-responsive">


                                    <table
                                        id="basic-datatable"
                                        class="table table-hover request-table"
                                    >

                                        <thead>

                                            <tr>

                                                <th>
                                                    ID
                                                </th>

                                                <th>
                                                    Customer
                                                </th>

                                                <th>
                                                    Email
                                                </th>

                                                <th>
                                                    Phone
                                                </th>

                                                <th>
                                                    Property
                                                </th>

                                                <th>
                                                    Property Requirements
                                                </th>

                                                <th>
                                                    Status
                                                </th>

                                                <th>
                                                    Action
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>


<?php

/* =========================================================
   FETCH REQUESTS

   IMPORTANT:
   Agent uses the SAME "request" table as Admin.

   Agent can ONLY VIEW requests.

   Agent CANNOT DELETE requests.
========================================================= */

$query = mysqli_query(
    $con,

    "SELECT request.*, property.title AS property_title
     FROM request
     INNER JOIN property ON request.pid = property.pid
     WHERE property.uploaded_by = 'agent'
       AND property.uid = '$uid'
     ORDER BY request.rid DESC"
);


$cnt = 1;


if(
    $query &&
    mysqli_num_rows($query) > 0
)
{

    while(
        $row = mysqli_fetch_assoc($query)
    )
    {

?>

                                            <tr>


                                                <!-- =================================
                                                     ID
                                                ================================== -->

                                                <td>

                                                    <?php

                                                    echo $cnt;

                                                    ?>

                                                </td>


                                                <!-- =================================
                                                     CUSTOMER NAME
                                                ================================== -->

                                                <td>

                                                    <span class="request-customer-name">

                                                        <?php

                                                        if(
                                                            isset($row['name']) &&
                                                            !empty($row['name'])
                                                        )
                                                        {

                                                            echo htmlspecialchars(
                                                                $row['name']
                                                            );

                                                        }
                                                        else
                                                        {

                                                            echo 'N/A';

                                                        }

                                                        ?>

                                                    </span>

                                                </td>


                                                <!-- =================================
                                                     EMAIL
                                                ================================== -->

                                                <td>

                                                    <div class="request-contact">

                                                        <i class="fa fa-envelope"></i>

                                                        <?php

                                                        if(
                                                            isset($row['email']) &&
                                                            !empty($row['email'])
                                                        )
                                                        {

                                                            echo htmlspecialchars(
                                                                $row['email']
                                                            );

                                                        }
                                                        else
                                                        {

                                                            echo 'N/A';

                                                        }

                                                        ?>

                                                    </div>

                                                </td>


                                                <!-- =================================
                                                     PHONE
                                                ================================== -->

                                                <td>

                                                    <div class="request-contact">

                                                        <i class="fa fa-phone"></i>

                                                        <?php

                                                        if(
                                                            isset($row['phone']) &&
                                                            !empty($row['phone'])
                                                        )
                                                        {

                                                            echo htmlspecialchars(
                                                                $row['phone']
                                                            );

                                                        }
                                                        else
                                                        {

                                                            echo 'N/A';

                                                        }

                                                        ?>

                                                    </div>

                                                </td>


                                                <!-- =================================
                                                     PROPERTY
                                                ================================== -->

                                                <td>
                                                    <?php
                                                    echo isset($row['property_title']) && !empty($row['property_title'])
                                                        ? htmlspecialchars($row['property_title'])
                                                        : 'N/A';
                                                    ?>
                                                </td>


                                                <!-- =================================
                                                     REQUIREMENTS
                                                ================================== -->

                                                <td class="request-description">

                                                    <?php

                                                    if(
                                                        isset($row['requirements']) &&
                                                        !empty($row['requirements'])
                                                    )
                                                    {

                                                        echo nl2br(
                                                            htmlspecialchars(
                                                                $row['requirements']
                                                            )
                                                        );

                                                    }
                                                    else
                                                    {

                                                        echo 'N/A';

                                                    }

                                                    ?>

                                                </td>


                                                <!-- =================================
                                                     STATUS
                                                ================================== -->

                                                <td>

                                                    <?php

                                                    if(
                                                        isset($row['status']) &&
                                                        intval($row['status']) == 1
                                                    )
                                                    {

                                                    ?>

                                                        <span class="status-badge status-viewed">

                                                            Viewed

                                                        </span>

                                                    <?php

                                                    }
                                                    else
                                                    {

                                                    ?>

                                                        <span class="status-badge status-new">

                                                            New

                                                        </span>

                                                    <?php

                                                    }

                                                    ?>

                                                </td>


                                                <!-- =================================
                                                     DELETE REQUEST
                                                ================================== -->

                                                <td>

                                                    <a
                                                        href="request.php?delete=<?php echo intval($row['rid']); ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this request?');"
                                                        title="Delete Request"
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </td>


                                            </tr>


<?php

        $cnt++;

    }

}

else

{

?>


                                            <tr>

                                                <td
                                                    colspan="8"
                                                    class="no-request"
                                                >

                                                    <i class="fa fa-inbox"></i>

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


            </div>

        </div>


        <!-- =====================================================
             AGENT FOOTER
        ====================================================== -->

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


<!-- =========================================================
     DATATABLE
========================================================= -->

<script src="../admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../admin/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="../admin/assets/plugins/datatables/dataTables.responsive.min.js"></script>

<script src="../admin/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>


<!-- =========================================================
     CUSTOM JS
========================================================= -->

<script src="../js/custom.js"></script>


<script>

$(document).ready(function()
{

    $('#basic-datatable').DataTable({

        responsive: true,

        pageLength: 10,

        ordering: true,

        searching: true,

        lengthChange: true,

        language:
        {
            emptyTable: "No Property Requests Found",

            search: "Search:",

            lengthMenu: "Show _MENU_ requests",

            info: "Showing _START_ to _END_ of _TOTAL_ requests",

            infoEmpty: "Showing 0 to 0 of 0 requests",

            paginate:
            {
                previous: "Previous",

                next: "Next"
            }
        }

    });

});

</script>


</body>

</html>