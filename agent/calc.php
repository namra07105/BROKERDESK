<?php

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();

include("../config.php");


/* =========================================================
   AGENT LOGIN CHECK
========================================================= */

if(!isset($_SESSION['uemail']))
{
    header("Location:login.php");
    exit;
}

$uid = $_SESSION['uid'];

$agentQuery = mysqli_query(
    $con,
    "SELECT * FROM user WHERE uid='$uid' AND LOWER(TRIM(utype))='agent'"
);

if(!$agentQuery || mysqli_num_rows($agentQuery) == 0)
{
    session_destroy();
    header("Location:login.php");
    exit;
}


/* =========================================================
   DEFAULT VALUES
========================================================= */

$amount = 0;
$mon = 0;
$int = 0;
$interest = 0;
$pay = 0;
$month = 0;


/* =========================================================
   EMI CALCULATION
========================================================= */

if(isset($_REQUEST['calc']))
{
    $amount = (float) $_REQUEST['amount'];
    $mon = (float) $_REQUEST['month'];
    $int = (float) $_REQUEST['interest'];

    if($mon > 0)
    {
        $interest = $amount * $int / 100;

        $pay = $amount + $interest;

        $month = $pay / $mon;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- =====================================================
         META
    ====================================================== -->

    <meta charset="utf-8">

    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >

    <meta
        name="description"
        content="EMI Calculator - BROKERDESK"
    >

    <meta
        name="keywords"
        content="EMI calculator, home loan, property loan, real estate"
    >

    <meta
        name="author"
        content="BROKERDESK"
    >


    <!-- =====================================================
         FAVICON
    ====================================================== -->

    <link
        rel="shortcut icon"
        href="../images/favicon.ico"
    >


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

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/login.css"
    >


    <title>EMI Calculator - BROKERDESK</title>


<style>

/* =========================================================
   GLOBAL
========================================================= */

html,
body
{
    width: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}


body
{
    background: #f6f8fb;
}


/* =========================================================
   FIX MAIN BOOTSTRAP ROW WIDTH
========================================================= */

#page-wrapper
{
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}


#page-wrapper > .row
{
    width: 100% !important;
    max-width: 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    display: block;
}


/* =========================================================
   BLUE THEME
========================================================= */

:root
{
    --blue: #1976d2;
    --blue-dark: #1565c0;
    --blue-light: #e3f2fd;
    --blue-border: #c9e2ff;
    --dark: #263238;
    --text: #555;
    --muted: #888;
    --background: #f6f8fb;
}


/* =========================================================
   PAGE BANNER
========================================================= */

.page-banner
{
    display: block !important;

    width: calc(100% - 40px) !important;

    height: 420px !important;

    min-height: 420px !important;

    margin-left: 20px !important;

    margin-right: 20px !important;

    background-image:
        url('../images/emi-calc.jpg') !important;

    background-size: cover !important;

    background-position: center 0px;

    background-repeat: no-repeat !important;

    background-attachment: scroll !important;

    position: relative !important;

    overflow: hidden !important;

    will-change: background-position;
}


/* =========================================================
   BANNER OVERLAY
========================================================= */

.page-banner::before
{
    content: "";

    position: absolute;

    top: 0;
    left: 0;
    right: 0;
    bottom: 0;

    width: 100%;
    height: 100%;

    background:
        linear-gradient(
            90deg,
            rgba(0,0,0,0.68),
            rgba(0,0,0,0.30)
        );

    z-index: 0;
}


/* =========================================================
   BANNER CONTENT
========================================================= */

.page-banner .container
{
    position: relative;
    z-index: 2;
}


.page-banner .page-name
{
    font-size: 42px;

    font-weight: 700;

    letter-spacing: 1px;

    text-shadow:
        0 3px 15px rgba(0,0,0,0.45);
}


/* =========================================================
   HIDE BREADCRUMB
========================================================= */

.page-banner .breadcrumb
{
    display: none !important;
}


.page-banner .breadcrumb-item + .breadcrumb-item::before
{
    display: none !important;
}


/* =========================================================
   EMI SECTION
========================================================= */

.emi-section
{
    width: 100% !important;

    max-width: 100% !important;

    padding-top: 70px;

    padding-bottom: 80px;

    background: var(--background);
}


/* =========================================================
   EMI CONTAINER
========================================================= */

.emi-section .container
{
    width: 100%;

    max-width: 1140px;

    margin-left: auto;

    margin-right: auto;

    padding-left: 15px;

    padding-right: 15px;
}


/* =========================================================
   SECTION HEADING
========================================================= */

.emi-heading
{
    width: 100%;

    text-align: center;

    margin-bottom: 45px;
}


.emi-heading h2
{
    margin: 0;

    font-size: 32px;

    font-weight: 700;

    color: var(--dark);
}


.emi-heading h2::after
{
    content: "";

    display: block;

    width: 55px;

    height: 3px;

    margin: 13px auto 0;

    border-radius: 10px;

    background: var(--blue);
}


.emi-heading p
{
    margin: 14px 0 0;

    color: var(--muted);

    font-size: 14px;
}


/* =========================================================
   CALCULATOR CARD
========================================================= */

.emi-card
{
    width: 100%;

    max-width: 760px;

    margin-left: auto;

    margin-right: auto;

    background: #ffffff;

    border-radius: 14px;

    border: 1px solid #e9edf2;

    border-top: 4px solid var(--blue);

    box-shadow:
        0 12px 40px rgba(0,0,0,0.08);

    overflow: hidden;
}


/* =========================================================
   CARD HEADER
========================================================= */

.emi-card-header
{
    padding: 25px 30px;

    background:
        linear-gradient(
            135deg,
            #1976d2,
            #1565c0
        );

    color: #fff;
}


.emi-card-header h3
{
    margin: 0;

    font-size: 20px;

    font-weight: 600;
}


.emi-card-header p
{
    margin: 7px 0 0;

    font-size: 13px;

    opacity: 0.9;
}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.emi-table-wrap
{
    padding: 30px;
}


/* =========================================================
   TABLE
========================================================= */

.emi-table
{
    width: 100%;

    border-collapse: separate;

    border-spacing: 0;

    border: 1px solid #e7ebef;

    border-radius: 10px;

    overflow: hidden;
}


/* =========================================================
   TABLE HEADER
========================================================= */

.emi-table thead th
{
    padding: 17px 20px;

    background: #f1f7fd;

    color: var(--blue);

    border-bottom: 1px solid var(--blue-border);

    font-size: 14px;

    font-weight: 700;

    text-align: left;
}


.emi-table thead th:last-child
{
    text-align: right;
}


/* =========================================================
   TABLE BODY
========================================================= */

.emi-table tbody tr
{
    transition:
        background 0.2s ease;
}


.emi-table tbody tr:hover
{
    background: #f9fbfd;
}


.emi-table tbody td
{
    padding: 18px 20px;

    border-bottom: 1px solid #edf0f3;

    font-size: 14px;

    color: var(--text);
}


.emi-table tbody tr:last-child td
{
    border-bottom: none;
}


/* =========================================================
   LABEL
========================================================= */

.emi-label
{
    font-weight: 600;

    color: #444;
}


/* =========================================================
   VALUE
========================================================= */

.emi-value
{
    text-align: right;

    font-weight: 700;

    color: var(--dark);

    font-size: 15px;
}


/* =========================================================
   EMI HIGHLIGHT
========================================================= */

.emi-highlight
{
    background: var(--blue-light) !important;
}


.emi-highlight .emi-label
{
    color: var(--blue-dark);

    font-size: 15px;
}


.emi-highlight .emi-value
{
    color: var(--blue);

    font-size: 19px;
}


/* =========================================================
   INFORMATION BOX
========================================================= */

.emi-info
{
    margin-top: 25px;

    padding: 18px 20px;

    border-radius: 9px;

    background: #f8fbff;

    border: 1px solid var(--blue-border);

    display: flex;

    align-items: flex-start;

    gap: 12px;
}


.emi-info-icon
{
    width: 32px;

    height: 32px;

    min-width: 32px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background: var(--blue);

    color: #fff;

    font-size: 13px;
}


.emi-info p
{
    margin: 0;

    color: #667;

    font-size: 13px;

    line-height: 1.7;
}


/* =========================================================
   SCROLL TO TOP
========================================================= */

#scroll
{
    background: var(--blue) !important;

    transition: all 0.25s ease;
}


#scroll:hover
{
    background: var(--blue-dark) !important;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991.98px)
{

    .page-banner
    {
        width: calc(100% - 30px) !important;

        height: 400px !important;

        min-height: 400px !important;

        margin-left: 15px !important;

        margin-right: 15px !important;
    }


    .emi-section
    {
        padding-top: 55px;

        padding-bottom: 65px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767.98px)
{

    .page-banner
    {
        width: calc(100% - 30px) !important;

        height: 360px !important;

        min-height: 360px !important;

        margin-left: 15px !important;

        margin-right: 15px !important;
    }


    .page-banner .page-name
    {
        font-size: 34px;
    }


    .emi-heading h2
    {
        font-size: 28px;
    }


    .emi-card
    {
        max-width: 100%;

        margin-left: auto;

        margin-right: auto;
    }


    .emi-card-header
    {
        padding: 22px;
    }


    .emi-table-wrap
    {
        padding: 20px;
    }


    .emi-table thead th,
    .emi-table tbody td
    {
        padding: 14px 12px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 575.98px)
{

    .page-banner
    {
        width: calc(100% - 20px) !important;

        height: 340px !important;

        min-height: 340px !important;

        margin-left: 10px !important;

        margin-right: 10px !important;
    }


    .page-banner .page-name
    {
        font-size: 30px;
    }


    .emi-section
    {
        padding-top: 45px;

        padding-bottom: 50px;
    }


    .emi-heading
    {
        margin-bottom: 30px;
    }


    .emi-heading h2
    {
        font-size: 25px;
    }


    .emi-card
    {
        border-radius: 10px;
    }


    .emi-card-header
    {
        padding: 20px;
    }


    .emi-card-header h3
    {
        font-size: 18px;
    }


    .emi-table-wrap
    {
        padding: 15px;
    }


    .emi-table thead th,
    .emi-table tbody td
    {
        padding: 13px 10px;
    }


    .emi-table thead th,
    .emi-table tbody td
    {
        font-size: 12px;
    }


    .emi-value
    {
        font-size: 13px;
    }


    .emi-highlight .emi-value
    {
        font-size: 16px;
    }


    .emi-info
    {
        padding: 14px;

        gap: 9px;
    }


    .emi-info p
    {
        font-size: 12px;
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
             BANNER
        ====================================================== -->

        <div class="banner-full-row page-banner">

            <div class="container">

                <div class="row">

                    <div class="col-md-6">

                        <h2
                            class="page-name float-left text-white text-uppercase mt-1 mb-0"
                        >

                            <b>
                                EMI Calculator
                            </b>

                        </h2>

                    </div>


                    <div class="col-md-6">

                        <nav
                            aria-label="breadcrumb"
                            class="float-left float-md-right"
                        >

                            <ol
                                class="breadcrumb bg-transparent m-0 p-0"
                            >

                                <li
                                    class="breadcrumb-item text-white"
                                >

                                    <a href="dashboard.php">
                                        Dashboard
                                    </a>

                                </li>


                                <li class="breadcrumb-item active">

                                    EMI Calculator

                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             EMI CALCULATOR
        ====================================================== -->

        <section class="emi-section">

            <div class="container">


                <!-- =================================================
                     HEADING
                ================================================== -->

                <div class="emi-heading">

                    <h2>
                        EMI Calculator
                    </h2>

                    <p>
                        Calculate your estimated monthly payment easily
                    </p>

                </div>


                <!-- =================================================
                     CALCULATOR CARD
                ================================================== -->

                <div class="emi-card">


                    <!-- CARD HEADER -->

                    <div class="emi-card-header">

                        <h3>
                            Loan Payment Calculator
                        </h3>

                        <p>
                            Enter loan details below to estimate your monthly payment.
                        </p>

                    </div>

                    <form class="emi-form px-4 pb-4" method="post" action="calc.php">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="amount">Property / Loan Amount (₹)</label>
                                <input type="number" min="1" step="1" class="form-control" id="amount" name="amount"
                                       value="<?php echo htmlspecialchars((string)$amount); ?>"
                                       placeholder="e.g. 2500000" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="month">Duration (Months)</label>
                                <input type="number" min="1" step="1" class="form-control" id="month" name="month"
                                       value="<?php echo htmlspecialchars((string)$mon); ?>"
                                       placeholder="e.g. 240" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interest">Interest Rate (% total)</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="interest" name="interest"
                                       value="<?php echo htmlspecialchars((string)$int); ?>"
                                       placeholder="e.g. 8.5" required>
                            </div>
                        </div>
                        <button type="submit" name="calc" value="1" class="btn btn-primary px-4">
                            Calculate EMI
                        </button>
                    </form>


                    <!-- =================================================
                         TABLE
                    ================================================== -->

                    <div class="emi-table-wrap">

                        <table class="emi-table">


                            <thead>

                                <tr>

                                    <th>
                                        Details
                                    </th>

                                    <th>
                                        Amount
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                                <!-- =================================================
                                     AMOUNT
                                ================================================== -->

                                <tr>

                                    <td class="emi-label">

                                        <i
                                            class="fa fa-money"
                                            style="margin-right:8px;color:#1976d2;"
                                        ></i>

                                        Enter Amount

                                    </td>


                                    <td class="emi-value">

                                        <?php
                                        echo number_format($amount, 2);
                                        ?>

                                    </td>

                                </tr>


                                <!-- =================================================
                                     MONTH
                                ================================================== -->

                                <tr>

                                    <td class="emi-label">

                                        <i
                                            class="fa fa-calendar"
                                            style="margin-right:8px;color:#1976d2;"
                                        ></i>

                                        Enter Month

                                    </td>


                                    <td class="emi-value">

                                        <?php
                                        echo number_format($mon, 0);
                                        ?>

                                    </td>

                                </tr>


                                <!-- =================================================
                                     INTEREST
                                ================================================== -->

                                <tr>

                                    <td class="emi-label">

                                        <i
                                            class="fa fa-percent"
                                            style="margin-right:8px;color:#1976d2;"
                                        ></i>

                                        Interest Rate

                                    </td>


                                    <td class="emi-value">

                                        <?php
                                        echo number_format($int, 2);
                                        ?>

                                        %

                                    </td>

                                </tr>


                                <!-- =================================================
                                     TOTAL INTEREST
                                ================================================== -->

                                <tr>

                                    <td class="emi-label">

                                        <i
                                            class="fa fa-line-chart"
                                            style="margin-right:8px;color:#1976d2;"
                                        ></i>

                                        Total Interest

                                    </td>


                                    <td class="emi-value">

                                        <?php
                                        echo number_format($interest, 2);
                                        ?>

                                    </td>

                                </tr>


                                <!-- =================================================
                                     TOTAL AMOUNT
                                ================================================== -->

                                <tr>

                                    <td class="emi-label">

                                        <i
                                            class="fa fa-credit-card"
                                            style="margin-right:8px;color:#1976d2;"
                                        ></i>

                                        Total Amount

                                    </td>


                                    <td class="emi-value">

                                        <?php
                                        echo number_format($pay, 2);
                                        ?>

                                    </td>

                                </tr>


                                <!-- =================================================
                                     EMI
                                ================================================== -->

                                <tr class="emi-highlight">

                                    <td class="emi-label">

                                        <i
                                            class="fa fa-calculator"
                                            style="margin-right:8px;color:#1976d2;"
                                        ></i>

                                        Pay Per Month (EMI)

                                    </td>


                                    <td class="emi-value">

                                        <?php
                                        echo number_format($month, 2);
                                        ?>

                                    </td>

                                </tr>


                            </tbody>

                        </table>


                        <!-- =================================================
                             INFORMATION
                        ================================================== -->

                        <div class="emi-info">

                            <div class="emi-info-icon">

                                <i class="fa fa-info"></i>

                            </div>


                            <p>

                                This EMI calculation provides an estimated
                                monthly payment based on the entered loan
                                amount, duration and interest rate.

                            </p>

                        </div>


                    </div>

                </div>


            </div>

        </section>


        <!-- =====================================================
             AGENT FOOTER
        ====================================================== -->

        <?php include("footer.php"); ?>


        <!-- =====================================================
             SCROLL TO TOP
        ====================================================== -->

        <a
            href="#"
            class="bg-secondary text-white hover-text-secondary"
            id="scroll"
        >

            <i class="fas fa-angle-up"></i>

        </a>


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

<script src="../js/jquery.cookie.js"></script>

<script src="../js/jquery-ui.js"></script>

<script src="../js/wow.js"></script>

<script src="../js/custom.js"></script>


<!-- =========================================================
     EMI BANNER IMAGE SCROLL EFFECT
========================================================= -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function ()
    {

        const banner =
            document.querySelector(".page-banner");


        if(!banner)
        {
            return;
        }


        function moveBannerImage()
        {

            const rect =
                banner.getBoundingClientRect();


            const bannerHeight =
                banner.offsetHeight;


            const windowHeight =
                window.innerHeight;


            /*
             * Calculate the banner's
             * position inside viewport.
             */

            let progress =
                (windowHeight - rect.top) /
                (windowHeight + bannerHeight);


            /*
             * Keep progress between 0 and 1.
             */

            progress =
                Math.max(
                    0,
                    Math.min(
                        1,
                        progress
                    )
                );


            /*
             * Amount of vertical image movement.
             */

            const maximumMovement = 420;


            const moveY =
                -(progress * maximumMovement);


            /*
             * Move only the image.
             * Text remains in place.
             */

            banner.style.backgroundPosition =
                "center " + moveY + "px";

        }


        /* =====================================================
           SCROLL
        ====================================================== */

        window.addEventListener(
            "scroll",
            moveBannerImage,
            {
                passive: true
            }
        );


        /* =====================================================
           RESIZE
        ====================================================== */

        window.addEventListener(
            "resize",
            moveBannerImage
        );


        /* =====================================================
           INITIAL POSITION
        ====================================================== */

        moveBannerImage();

    }

);

</script>


</body>

</html>