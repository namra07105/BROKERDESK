<?php

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

session_start();

include("config.php");


/* =========================================================
   CHECK USER LOGIN
   ========================================================= */

if (!isset($_SESSION['uemail'])) {

    header("location:login.php");
    exit();

}


/* =========================================================
   VARIABLES
   ========================================================= */

$error = '';
$msg = '';

$uid = $_SESSION['uid'];


/* =========================================================
   GET CURRENT USER INFORMATION
   ========================================================= */

$userQuery = mysqli_query(
    $con,
    "SELECT * FROM `user` WHERE uid='$uid'"
);

$userData = mysqli_fetch_assoc($userQuery);

$userName  = isset($userData['uname']) ? $userData['uname'] : '';
$userEmail = isset($userData['uemail']) ? $userData['uemail'] : '';
$userPhone = isset($userData['uphone']) ? $userData['uphone'] : '';
$userRole  = isset($userData['utype']) ? $userData['utype'] : '';
$userImage = isset($userData['uimage']) ? $userData['uimage'] : '';

/* =========================================================
   GET SELECTED PROPERTY
   ========================================================= */

$pid = isset($_POST['pid']) ? intval($_POST['pid']) : (isset($_GET['pid']) ? intval($_GET['pid']) : 0);
$propertyData = null;

if ($pid > 0) {
    $propertyQuery = mysqli_query(
        $con,
        "SELECT pid, title, location, city, state, price
         FROM property
         WHERE pid='$pid'
         LIMIT 1"
    );

    if ($propertyQuery && mysqli_num_rows($propertyQuery) > 0) {
        $propertyData = mysqli_fetch_assoc($propertyQuery);
    } else {
        $pid = 0;
    }
}



/* =========================================================
   SUBMIT PROPERTY REQUEST
   ========================================================= */

if (isset($_POST['insert'])) {

    $name = mysqli_real_escape_string(
        $con,
        trim($_POST['name'])
    );

    $phone = mysqli_real_escape_string(
        $con,
        trim($_POST['phone'])
    );

    $requirements = mysqli_real_escape_string(
        $con,
        trim($_POST['content'])
    );

    $email = mysqli_real_escape_string(
        $con,
        $_SESSION['uemail']
    );


    /* =====================================================
       VALIDATION
       ===================================================== */

    if (
        $pid > 0 &&
        !empty($name) &&
        !empty($phone) &&
        !empty($requirements)
    ) {


        /* =================================================
           INSERT INTO REQUEST TABLE
           ================================================= */

        $sql = "INSERT INTO `request`
                (`uid`, `pid`, `name`, `email`, `phone`, `requirements`, `status`)
                VALUES
                ('$uid', '$pid', '$name', '$email', '$phone', '$requirements', '0')";


        $result = mysqli_query($con, $sql);


        /* =================================================
           SUCCESS
           ================================================= */

        if ($result) {

            $msg = "
                <p class='alert alert-success request-alert'>
                    Property Request Sent Successfully
                </p>
            ";

        }


        /* =================================================
           ERROR
           ================================================= */

        else {

            $error = "
                <p class='alert alert-danger request-alert'>
                    Property Request Not Sent.<br>
                    Database Error: <?php echo htmlspecialchars(mysqli_error($con)); ?>
                </p>
            ";

        }

    }


    /* =====================================================
       EMPTY FIELDS
       ===================================================== */

    else {

        $error = "
            <p class='alert alert-warning request-alert'>
                Please Fill All The Fields
            </p>
        ";

    }

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


    <!-- =====================================================
         FAVICON
    ====================================================== -->

    <link
        rel="shortcut icon"
        href="images/favicon.ico"
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
        href="css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/bootstrap-slider.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/jquery-ui.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/layerslider.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/color.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/owl.carousel.min.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/font-awesome.min.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="fonts/flaticon/flaticon.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style.css"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="css/login.css"
    >


    <title>Property Request - BROKERDESK</title>


    <style>

        /* =====================================================
           BLUE THEME
           SAME AS FEEDBACK PAGE
        ===================================================== */

        :root {

            --blue: #1976d2;
            --blue-dark: #1565c0;
            --blue-light: #e3f2fd;
            --blue-border: #c9e2ff;

            --text-dark: #333;
            --text-light: #666;

            --background: #f7f9fc;

        }


        /* =====================================================
           PAGE BACKGROUND
        ===================================================== */

        body {

            background: #f7f9fc;

        }


        /* =====================================================
           SCROLLABLE REQUEST BANNER
        ===================================================== */

        .request-banner {

            width: calc(100% - 40px);

            height: 420px;

            margin-left: 20px;
            margin-right: 20px;

            overflow: hidden;

            position: relative;

            background: #000;

            border-radius: 0 0 6px 6px;

        }


        .request-banner img {

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;

            height: auto;

            min-height: 100%;

            display: block;

            object-fit: cover;

            object-position: center center;

            transform: translateY(0);

            will-change: transform;

        }


        /* =====================================================
           DARK OVERLAY
        ===================================================== */

        .request-banner::after {

            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            background: rgba(0,0,0,0.30);

            z-index: 1;

            pointer-events: none;

        }


        /* =====================================================
           BANNER CONTENT
        ===================================================== */

        .request-banner-content {

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;

            z-index: 2;

            pointer-events: none;

        }


        .request-banner-content .container {

            position: relative;

            z-index: 3;

        }


        .request-banner-content .page-name {

            font-size: 42px;

            font-weight: 700;

            letter-spacing: 1px;

            text-shadow:
                0 3px 12px rgba(0,0,0,0.45);

        }


        /* =====================================================
           MAIN REQUEST SECTION
        ===================================================== */

        .request-section {

            padding: 70px 0;

            background: #f7f9fc;

        }


        /* =====================================================
           SECTION HEADING
        ===================================================== */

        .request-heading {

            margin-bottom: 45px;

        }


        .request-heading h2 {

            font-size: 32px;

            font-weight: 700;

            color: var(--text-dark);

            margin-bottom: 12px;

        }


        .request-heading p {

            color: var(--text-light);

            font-size: 15px;

            max-width: 650px;

            margin: 0 auto;

            line-height: 1.7;

        }


        /* =====================================================
           MAIN REQUEST CARD
        ===================================================== */

        .request-card {

            background: #fff;

            border-radius: 14px;

            padding: 42px;

            box-shadow:
                0 10px 35px rgba(0,0,0,0.07);

            border: 1px solid #edf0f4;

            position: relative;

            overflow: hidden;

        }


        .request-card::before {

            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 4px;

            background: var(--blue);

        }


        /* =====================================================
           FORM TITLE
        ===================================================== */

        .request-form-title {

            font-size: 23px;

            font-weight: 700;

            color: #333;

            margin-bottom: 28px;

            position: relative;

            padding-bottom: 15px;

            border-bottom: 1px solid #eeeeee;

        }


        .request-form-title::after {

            content: "";

            position: absolute;

            left: 0;
            bottom: -1px;

            width: 55px;
            height: 3px;

            background: var(--blue);

            border-radius: 5px;

        }


        /* =====================================================
           FORM
        ===================================================== */

        .request-form .form-group {

            margin-bottom: 22px;

        }


        .request-form label {

            display: block;

            font-size: 14px;

            font-weight: 600;

            color: #444;

            margin-bottom: 8px;

        }


        .request-form .form-control {

            height: 50px;

            border-radius: 7px;

            border: 1px solid #dfe5ec;

            border-left: 3px solid var(--blue-border);

            background: #fafcff;

            padding: 10px 15px;

            font-size: 14px;

            transition: all 0.25s ease;

        }


        .request-form textarea.form-control {

            height: auto;

            min-height: 150px;

            resize: vertical;

        }


        .request-form .form-control:focus {

            border-color: var(--blue-border);

            border-left-color: var(--blue);

            background: #fff;

            box-shadow:
                0 0 0 3px rgba(25,118,210,0.10);

            outline: none;

        }


        .request-form .form-control::placeholder {

            color: #a0a8b2;

        }


        /* =====================================================
           SUBMIT BUTTON
        ===================================================== */

        .request-submit {

            background: var(--blue);

            border: 1px solid var(--blue);

            color: #fff;

            padding: 12px 32px;

            min-width: 140px;

            border-radius: 6px;

            font-size: 15px;

            font-weight: 600;

            transition: all 0.25s ease;

        }


        .request-submit:hover {

            background: var(--blue-dark);

            border-color: var(--blue-dark);

            color: #fff;

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(25,118,210,0.25);

        }


        /* =====================================================
           ALERT
        ===================================================== */

        .request-alert {

            border-radius: 7px;

            margin-bottom: 25px;

            font-size: 14px;

        }


        /* =====================================================
           USER PROFILE CARD
        ===================================================== */

        .user-profile-card {

            background: #fff;

            border-radius: 12px;

            border: 1px solid #edf0f4;

            box-shadow:
                0 8px 28px rgba(0,0,0,0.06);

            padding: 32px;

            height: 100%;

        }


        /* =====================================================
           PROFILE TOP
        ===================================================== */

        .profile-top {

            text-align: center;

            padding-bottom: 25px;

            margin-bottom: 25px;

            border-bottom: 1px solid #eeeeee;

        }


        /* =====================================================
           PROFILE IMAGE
        ===================================================== */

        .profile-image-wrapper {

            width: 115px;
            height: 115px;

            margin: 0 auto 18px;

            border-radius: 50%;

            padding: 4px;

            background: var(--blue-light);

            border: 2px solid var(--blue-border);

        }


        .profile-image-wrapper img {

            width: 100%;
            height: 100%;

            border-radius: 50%;

            object-fit: cover;

            display: block;

        }


        /* =====================================================
           PROFILE NAME
        ===================================================== */

        .profile-top h4 {

            margin: 0 0 5px;

            font-size: 20px;

            font-weight: 700;

            color: #333;

        }


        /* =====================================================
           PROFILE ROLE
        ===================================================== */

        .profile-role {

            display: inline-block;

            background: var(--blue-light);

            color: var(--blue-dark);

            padding: 5px 14px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 600;

            text-transform: capitalize;

        }


        /* =====================================================
           PROFILE DETAILS
        ===================================================== */

        .profile-details {

            margin-top: 10px;

        }


        .profile-detail {

            display: flex;

            align-items: flex-start;

            padding: 14px 0;

            border-bottom: 1px solid #f0f2f5;

        }


        .profile-detail:last-child {

            border-bottom: none;

        }


        .profile-detail-icon {

            width: 38px;
            height: 38px;

            min-width: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            background: var(--blue-light);

            color: var(--blue);

            margin-right: 12px;

        }


        .profile-detail-content {

            overflow: hidden;

        }


        .profile-detail-label {

            display: block;

            font-size: 11px;

            color: #999;

            text-transform: uppercase;

            letter-spacing: 0.5px;

            margin-bottom: 3px;

        }


        .profile-detail-value {

            display: block;

            font-size: 14px;

            color: #444;

            word-break: break-word;

        }


        /* =====================================================
           INFORMATION BOX
        ===================================================== */

        .request-info-box {

            margin-top: 25px;

            padding: 18px;

            background: var(--blue-light);

            border-radius: 9px;

            border-left: 3px solid var(--blue);

        }


        .request-info-box i {

            color: var(--blue);

            margin-right: 7px;

        }


        .request-info-box p {

            margin: 0;

            color: #4d6480;

            font-size: 13px;

            line-height: 1.6;

        }


        /* =====================================================
           SCROLL TO TOP
        ===================================================== */

        #scroll {

            background: var(--blue) !important;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 991px) {

            .request-card {

                padding: 30px;

            }


            .user-profile-card {

                margin-top: 30px;

            }

        }


        @media (max-width: 767px) {

            .request-banner {

                height: 350px;

                width: calc(100% - 30px);

                margin-left: 15px;

                margin-right: 15px;

            }


            .request-banner img {

                width: auto;

                height: 100%;

                min-width: 100%;

                object-fit: cover;

            }


            .request-banner-content .page-name {

                font-size: 32px;

            }


            .request-section {

                padding: 50px 0;

            }


            .request-card {

                padding: 25px 20px;

            }

        }


        @media (max-width: 575px) {

            .request-banner {

                width: calc(100% - 20px);

                margin-left: 10px;

                margin-right: 10px;

            }


            .request-heading h2 {

                font-size: 27px;

            }


            .request-card {

                padding: 22px 16px;

            }


            .user-profile-card {

                padding: 25px 20px;

            }


            .request-submit {

                width: 100%;

            }

        }

    </style>

</head>


<body>


<div id="page-wrapper">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <?php include("include/header.php"); ?>


    <!-- =====================================================
         SCROLLABLE PROPERTY REQUEST BANNER
    ====================================================== -->

    <div
        class="request-banner"
        id="requestBanner"
    >

        <img
            src="images/request.jpg"
            alt="Property Request"
            id="requestImage"
        >


        <div class="request-banner-content">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-md-12">

                        <h2
                            class="page-name text-white text-uppercase mb-0"
                        >

                            <b>Property Request</b>

                        </h2>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         PROPERTY REQUEST SECTION
    ====================================================== -->

    <section class="request-section">

        <div class="container">


            <!-- =================================================
                 SECTION HEADING
            ================================================== -->

            <div class="request-heading text-center">

                <h2>
                    Request a Property
                </h2>

                <p>
                    Tell us what type of property you are looking for
                    and our team will help you find the right property.
                </p>

            </div>


            <!-- =================================================
                 MAIN REQUEST CARD
            ================================================== -->

            <div class="request-card">

                <div class="row">


                    <!-- =================================================
                         REQUEST FORM
                    ================================================== -->

                    <div class="col-lg-7 col-md-12">

                        <?php if ($propertyData) { ?>

                            <div style="
                                background:#e3f2fd;
                                border:1px solid #c9e2ff;
                                border-left:4px solid #1976d2;
                                border-radius:8px;
                                padding:16px 18px;
                                margin-bottom:25px;
                            ">
                                <div style="font-size:12px; color:#1565c0; font-weight:700; text-transform:uppercase; margin-bottom:5px;">
                                    Request For Property
                                </div>

                                <div style="font-size:18px; font-weight:700; color:#333;">
                                    <?php echo htmlspecialchars($propertyData['title']); ?>
                                </div>

                                <?php if (!empty($propertyData['location']) || !empty($propertyData['city']) || !empty($propertyData['state'])) { ?>
                                    <div style="font-size:13px; color:#666; margin-top:5px;">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?php
                                        echo htmlspecialchars(
                                            trim(
                                                $propertyData['location'] . 
                                                (!empty($propertyData['city']) ? ', ' . $propertyData['city'] : '') .
                                                (!empty($propertyData['state']) ? ', ' . $propertyData['state'] : '')
                                            )
                                        );
                                        ?>
                                    </div>
                                <?php } ?>

                            </div>

                        <?php } else { ?>

                            <div class="alert alert-warning request-alert">
                                Please open a property first and click <b>Send Property Request</b>.
                            </div>

                        <?php } ?>

                        <h4 class="request-form-title">
                            Property Request Form
                        </h4>


                        <!-- SUCCESS MESSAGE -->

                        <?php echo $msg; ?>


                        <!-- ERROR MESSAGE -->

                        <?php echo $error; ?>


                        <form
                            action="request.php<?php echo $pid > 0 ? '?pid=' . $pid : ''; ?>"
                            method="post"
                            class="request-form"
                        >

                            <input type="hidden" name="pid" value="<?php echo $pid; ?>">


                            <!-- =================================================
                                 NAME
                            ================================================== -->

                            <div class="form-group">

                                <label for="name">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    placeholder="Enter your name"
                                    value="<?php
                                        echo htmlspecialchars($userName);
                                    ?>"
                                >

                            </div>


                            <!-- =================================================
                                 PHONE
                            ================================================== -->

                            <div class="form-group">

                                <label for="phone">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                    placeholder="Enter your phone number"
                                    maxlength="10"
                                    value="<?php
                                        echo htmlspecialchars($userPhone);
                                    ?>"
                                >

                            </div>


                            <!-- =================================================
                                 PROPERTY REQUIREMENTS
                            ================================================== -->

                            <div class="form-group">

                                <label for="content">
                                    Property Request / Description
                                </label>

                                <textarea
                                    class="form-control"
                                    name="content"
                                    id="content"
                                    rows="7"
                                    placeholder="Describe the property you are looking for..."
                                ></textarea>

                            </div>


                            <!-- =================================================
                                 SUBMIT
                            ================================================== -->

                            <input
                                type="submit"
                                class="btn request-submit"
                                name="insert"
                                value="Send Request"
                                <?php echo $pid <= 0 ? 'disabled' : ''; ?>
                            >

                        </form>

                    </div>


                    <!-- =================================================
                         SPACE
                    ================================================== -->

                    <div class="col-lg-1 d-none d-lg-block">
                    </div>


                    <!-- =================================================
                         USER PROFILE
                    ================================================== -->

                    <div class="col-lg-4 col-md-12">

                        <div class="user-profile-card">


                            <!-- =================================================
                                 PROFILE TOP
                            ================================================== -->

                            <div class="profile-top">

                                <div class="profile-image-wrapper">

                                    <?php

                                    if (!empty($userImage)) {

                                    ?>

                                        <img
                                            src="admin/user/<?php
                                                echo htmlspecialchars($userImage);
                                            ?>"
                                            alt="User Image"
                                        >

                                    <?php

                                    }
                                    else {

                                    ?>

                                        <img
                                            src="images/default-user.png"
                                            alt="User Image"
                                        >

                                    <?php

                                    }

                                    ?>

                                </div>


                                <h4>

                                    <?php
                                        echo htmlspecialchars($userName);
                                    ?>

                                </h4>


                                <?php

                                if (!empty($userRole)) {

                                ?>

                                    <span class="profile-role">

                                        <?php
                                            echo htmlspecialchars($userRole);
                                        ?>

                                    </span>

                                <?php

                                }

                                ?>

                            </div>


                            <!-- =================================================
                                 PROFILE DETAILS
                            ================================================== -->

                            <div class="profile-details">


                                <!-- NAME -->

                                <div class="profile-detail">

                                    <div class="profile-detail-icon">

                                        <i class="fas fa-user"></i>

                                    </div>

                                    <div class="profile-detail-content">

                                        <span class="profile-detail-label">
                                            Name
                                        </span>

                                        <span class="profile-detail-value">

                                            <?php
                                                echo htmlspecialchars($userName);
                                            ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- EMAIL -->

                                <div class="profile-detail">

                                    <div class="profile-detail-icon">

                                        <i class="fas fa-envelope"></i>

                                    </div>

                                    <div class="profile-detail-content">

                                        <span class="profile-detail-label">
                                            Email
                                        </span>

                                        <span class="profile-detail-value">

                                            <?php
                                                echo htmlspecialchars($userEmail);
                                            ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- PHONE -->

                                <div class="profile-detail">

                                    <div class="profile-detail-icon">

                                        <i class="fas fa-phone"></i>

                                    </div>

                                    <div class="profile-detail-content">

                                        <span class="profile-detail-label">
                                            Phone
                                        </span>

                                        <span class="profile-detail-value">

                                            <?php
                                                echo htmlspecialchars($userPhone);
                                            ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- ROLE -->

                                <div class="profile-detail">

                                    <div class="profile-detail-icon">

                                        <i class="fas fa-user-tag"></i>

                                    </div>

                                    <div class="profile-detail-content">

                                        <span class="profile-detail-label">
                                            Role
                                        </span>

                                        <span class="profile-detail-value">

                                            <?php
                                                echo htmlspecialchars($userRole);
                                            ?>

                                        </span>

                                    </div>

                                </div>


                            </div>


                            <!-- =================================================
                                 INFORMATION BOX
                            ================================================== -->

                            <div class="request-info-box">

                                <p>

                                    <i class="fas fa-info-circle"></i>

                                    Tell us your preferred location,
                                    budget, property type, BHK and other
                                    requirements so we can help you better.

                                </p>

                            </div>


                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <?php include("include/footer.php"); ?>


    <!-- =====================================================
         SCROLL TO TOP
    ====================================================== -->

    <a
        href="#"
        class="text-white hover-text-secondary"
        id="scroll"
    >

        <i class="fas fa-angle-up"></i>

    </a>


</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script src="js/jquery.min.js"></script>

<script src="js/greensock.js"></script>

<script src="js/layerslider.transitions.js"></script>

<script src="js/layerslider.kreaturamedia.jquery.js"></script>

<script src="js/popper.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/owl.carousel.min.js"></script>

<script src="js/tmpl.js"></script>

<script src="js/jquery.dependClass-0.1.js"></script>

<script src="js/draggable-0.1.js"></script>

<script src="js/jquery.slider.js"></script>

<script src="js/wow.js"></script>

<script src="js/custom.js"></script>


<!-- =========================================================
     PROPERTY REQUEST IMAGE SCROLL EFFECT
========================================================= -->

<script>

(function () {


    const banner =
        document.getElementById("requestBanner");


    const image =
        document.getElementById("requestImage");


    if (!banner || !image) {

        return;

    }


    function moveImage() {


        const rect =
            banner.getBoundingClientRect();


        const imageHeight =
            image.offsetHeight;


        const bannerHeight =
            banner.offsetHeight;


        const maxMove =
            Math.max(
                0,
                imageHeight - bannerHeight
            );


        const viewportHeight =
            window.innerHeight;


        const start =
            viewportHeight;


        const end =
            -banner.offsetHeight;


        let progress =
            (start - rect.top) /
            (start - end);


        progress =
            Math.max(
                0,
                Math.min(
                    1,
                    progress
                )
            );


        const moveY =
            -(maxMove * progress);


        image.style.transform =
            "translateY(" + moveY + "px)";

    }


    window.addEventListener(
        "scroll",
        moveImage,
        { passive: true }
    );


    window.addEventListener(
        "resize",
        moveImage
    );


    image.addEventListener(
        "load",
        moveImage
    );


    moveImage();


})();

</script>


</body>

</html>