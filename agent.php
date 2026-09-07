<?php
session_start();
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- =====================================================
         META
         ===================================================== -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >

    <meta
        name="description"
        content="Real Estate Agents"
    >

    <meta
        name="author"
        content="BROKERDESK"
    >


    <!-- =====================================================
         FAVICON
         ===================================================== -->

    <link
        rel="shortcut icon"
        href="images/favicon.ico"
    >


    <!-- =====================================================
         GOOGLE FONTS
         ===================================================== -->

    <link
        href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700,800&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css?family=Comfortaa:400,700&display=swap"
        rel="stylesheet"
    >


    <!-- =====================================================
         CSS
         ===================================================== -->

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
        id="color-change"
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
    <link rel="stylesheet" type="text/css" href="css/responsive-fix.css">
    >


    <!-- =====================================================
         CUSTOM AGENT PAGE CSS
         ===================================================== -->

    <style>

        * {
            box-sizing: border-box;
        }


        body {
            font-family: "Muli", sans-serif;
            margin: 0;
            padding: 0;
        }


        /* =====================================================
           HERO
           ===================================================== */

        .agent-hero {

            position: relative;

            width: 100%;

            height: 440px;

            overflow: hidden;

            background: #111;

        }


        /* =====================================================
           VERTICAL SCROLLABLE IMAGE

           The image is intentionally taller than the banner.
           JavaScript moves it vertically while scrolling.
           ===================================================== */

        .agent-hero-image {

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 160%;

            object-fit: cover;

            object-position: center top;

            display: block;

            will-change: transform;

            transform:
                translate3d(0, 0, 0);

        }


        /* =====================================================
           DARK OVERLAY
           ===================================================== */

        .agent-hero-overlay {

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 100%;

            background:
                linear-gradient(
                    90deg,
                    rgba(0,0,0,0.68) 0%,
                    rgba(0,0,0,0.40) 45%,
                    rgba(0,0,0,0.12) 100%
                );

            z-index: 1;

            pointer-events: none;

        }


        /* =====================================================
           HERO CONTENT
           ===================================================== */

        .agent-hero-content {

            position: relative;

            z-index: 2;

            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            pointer-events: none;

        }


        .agent-hero-inner {

            max-width: 700px;

        }


        /* =====================================================
           HERO TITLE
           ===================================================== */

        .agent-hero-title {

            color: #ffffff;

            font-size: 52px;

            line-height: 1.12;

            font-weight: 800;

            margin: 0 0 18px;

            text-shadow:
                0 2px 12px rgba(0,0,0,0.30);

        }


        .agent-hero-text {

            color:
                rgba(255,255,255,0.90);

            font-size: 17px;

            line-height: 1.7;

            max-width: 620px;

            margin: 0;

            text-shadow:
                0 1px 5px rgba(0,0,0,0.30);

        }


        /* =====================================================
           AGENT SECTION
           ===================================================== */

        .agents-main-section {

            width: 100%;

            padding: 85px 0 90px;

            background: #f8f9fb;

        }


        /* =====================================================
           SECTION HEADING
           ===================================================== */

        .agents-section-heading {

            text-align: center;

            max-width: 750px;

            margin:
                0 auto 55px;

        }


        .agents-section-heading
        .small-title {

            display: block;

            margin-bottom: 10px;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 2px;

            text-transform: uppercase;

            color: #888;

        }


        .agents-section-heading h2 {

            margin:
                0 0 16px;

            font-size: 36px;

            line-height: 1.2;

            font-weight: 800;

            color: #222;

        }


        .agents-section-heading
        .heading-line {

            width: 55px;

            height: 3px;

            margin:
                0 auto 20px;

            background: #444;

            border-radius: 10px;

        }


        .agents-section-heading p {

            margin: 0;

            color: #777;

            font-size: 15px;

            line-height: 1.8;

        }


        /* =====================================================
           AGENT CARD WRAPPER
           ===================================================== */

        .agent-card-wrapper {

            margin-bottom: 30px;

        }


        /* =====================================================
           AGENT CARD
           ===================================================== */

        .agent-card {

            position: relative;

            height: 100%;

            min-height: 390px;

            padding:
                35px 28px 30px;

            text-align: center;

            background: #ffffff;

            border:
                1px solid #e9e9e9;

            border-radius: 6px;

            overflow: hidden;

            box-shadow:
                0 5px 25px
                rgba(0,0,0,0.055);

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease,
                border-color 0.35s ease;

        }


        /* =====================================================
           CARD TOP LINE
           ===================================================== */

        .agent-card::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 4px;

            background: #333;

            transform:
                scaleX(0);

            transform-origin:
                center;

            transition:
                transform 0.35s ease;

        }


        .agent-card:hover {

            transform:
                translateY(-8px);

            box-shadow:
                0 18px 45px
                rgba(0,0,0,0.11);

            border-color:
                #dddddd;

        }


        .agent-card:hover::before {

            transform:
                scaleX(1);

        }


        /* =====================================================
           AGENT BADGE
           ===================================================== */

        .agent-badge {

            display: inline-block;

            margin-bottom: 20px;

            padding: 5px 12px;

            border-radius: 20px;

            background: #f1f1f1;

            color: #555;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 1px;

            text-transform: uppercase;

        }


        /* =====================================================
           AGENT IMAGE
           ===================================================== */

        .agent-image-wrapper {

            position: relative;

            width: 145px;

            height: 145px;

            margin:
                0 auto 25px;

        }


        .agent-image-wrapper::before {

            content: "";

            position: absolute;

            top: -7px;

            left: -7px;

            width:
                calc(100% + 14px);

            height:
                calc(100% + 14px);

            border:
                1px solid #e2e2e2;

            border-radius: 50%;

            transition:
                all 0.35s ease;

        }


        .agent-card:hover
        .agent-image-wrapper::before {

            transform:
                rotate(8deg);

            border-color:
                #aaa;

        }


        .agent-image-wrapper img {

            position: relative;

            width: 145px;

            height: 145px;

            object-fit: cover;

            border-radius: 50%;

            border:
                5px solid #ffffff;

            box-shadow:
                0 5px 20px
                rgba(0,0,0,0.13);

            display: block;

        }


        /* =====================================================
           AGENT NAME
           ===================================================== */

        .agent-name {

            margin:
                0 0 20px;

            font-size: 21px;

            font-weight: 800;

            color: #252525;

        }


        /* =====================================================
           CONTACT INFORMATION
           ===================================================== */

        .agent-contact {

            margin-top: 5px;

        }


        .agent-contact-item {

            display: flex;

            align-items: center;

            text-align: left;

            width: 100%;

            padding:
                11px 12px;

            margin-bottom: 9px;

            background: #f7f7f7;

            border-radius: 4px;

            transition:
                background 0.25s ease,
                transform 0.25s ease;

        }


        .agent-contact-item:hover {

            background: #eeeeee;

            transform:
                translateX(3px);

        }


        .agent-contact-icon {

            flex:
                0 0 34px;

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 10px;

            border-radius: 50%;

            background: #333;

            color: #ffffff;

            font-size: 13px;

        }


        .agent-contact-text {

            min-width: 0;

            flex: 1;

        }


        .agent-contact-label {

            display: block;

            margin-bottom: 2px;

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.8px;

            color: #999;

        }


        .agent-contact-value {

            display: block;

            color: #444;

            font-size: 13px;

            line-height: 1.4;

            word-break: break-word;

        }


        /* =====================================================
           NO AGENTS
           ===================================================== */

        .no-agent-box {

            max-width: 650px;

            margin:
                20px auto 0;

            padding:
                60px 30px;

            text-align: center;

            background: #ffffff;

            border:
                1px solid #e8e8e8;

            border-radius: 6px;

            box-shadow:
                0 5px 25px
                rgba(0,0,0,0.05);

        }


        .no-agent-icon {

            width: 70px;

            height: 70px;

            margin:
                0 auto 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #f2f2f2;

            color: #777;

            font-size: 27px;

        }


        .no-agent-box h4 {

            margin:
                0 0 10px;

            font-size: 22px;

            font-weight: 700;

            color: #333;

        }


        .no-agent-box p {

            margin: 0;

            color: #888;

            font-size: 14px;

        }


        /* =====================================================
           RESPONSIVE
           ===================================================== */

        @media (max-width: 991px) {

            .agent-hero {

                height: 400px;

            }


            .agent-hero-title {

                font-size: 44px;

            }


            .agents-main-section {

                padding:
                    70px 0;

            }

        }


        @media (max-width: 767px) {

            .agent-hero {

                height: 360px;

            }


            .agent-hero-title {

                font-size: 36px;

            }


            .agent-hero-text {

                font-size: 15px;

            }


            .agents-main-section {

                padding:
                    55px 15px 65px;

            }


            .agents-section-heading {

                margin-bottom: 40px;

            }


            .agents-section-heading h2 {

                font-size: 29px;

            }


            .agent-card {

                min-height: auto;

            }

        }


        @media (max-width: 480px) {

            .agent-hero {

                height: 330px;

            }


            .agent-hero-title {

                font-size: 31px;

            }


            .agent-hero-text {

                font-size: 14px;

            }


            .agent-image-wrapper,
            .agent-image-wrapper img {

                width: 135px;

                height: 135px;

            }


            .agent-card {

                padding:
                    30px 20px 25px;

            }

        }

    </style>

</head>


<body>


<!-- =========================================================
     PAGE WRAPPER

     IMPORTANT:
     No outer Bootstrap .row around the complete page.
     ========================================================= -->

<div id="page-wrapper">


    <!-- =====================================================
         USER HEADER
         ===================================================== -->

    <?php include("include/header.php"); ?>


    <!-- =====================================================
         HERO
         ===================================================== -->

    <section
        class="agent-hero"
        id="houseBanner"
    >


        <!-- =================================================
             VERTICALLY SCROLLABLE AGENT IMAGE
             ================================================= -->

        <img
            src="images/agentimg.jpg"
            alt="Our Agents"
            class="agent-hero-image"
            id="houseImage"
        >


        <!-- =================================================
             DARK OVERLAY
             ================================================= -->

        <div class="agent-hero-overlay"></div>


        <!-- =================================================
             HERO CONTENT

             NO BROKERDESK TEXT
             ================================================= -->

        <div class="agent-hero-content">

            <div class="container">

                <div class="agent-hero-inner">


                    <h1 class="agent-hero-title">

                        Meet Our Agents

                    </h1>


                    <p class="agent-hero-text">

                        Connect with our professional real estate
                        agents and find the right property for your
                        needs with confidence.

                    </p>


                </div>

            </div>

        </div>


    </section>


    <!-- =====================================================
         AGENTS SECTION
         ===================================================== -->

    <section class="agents-main-section">

        <div class="container">


            <!-- =================================================
                 SECTION HEADING
                 ================================================= -->

            <div class="agents-section-heading">


                <span class="small-title">

                    Our Professionals

                </span>


                <h2>

                    Find Your Property Expert

                </h2>


                <div class="heading-line"></div>


                <p>

                    Our experienced agents are here to guide you
                    through every step of your real estate journey.
                    Get in touch with an agent today.

                </p>


            </div>


            <!-- =================================================
                 AGENT GRID
                 ================================================= -->

            <div class="row">


                <?php

                /*
                 * Fetch all agents
                 */

                $query = mysqli_query(
                    $con,
                    "SELECT * FROM user WHERE utype='agent'"
                );


                if (
                    $query &&
                    mysqli_num_rows($query) > 0
                ) {


                    while (
                        $row = mysqli_fetch_assoc($query)
                    ) {


                        /* -----------------------------------------
                           Agent Name
                           ----------------------------------------- */

                        $agentName =
                            !empty($row['uname'])
                            ? $row['uname']
                            : 'Agent';


                        /* -----------------------------------------
                           Agent Email
                           ----------------------------------------- */

                        $agentEmail =
                            !empty($row['uemail'])
                            ? $row['uemail']
                            : 'Email not available';


                        /* -----------------------------------------
                           Agent Phone
                           ----------------------------------------- */

                        $agentPhone =
                            !empty($row['uphone'])
                            ? $row['uphone']
                            : 'Phone not available';


                        /* -----------------------------------------
                           Agent Image
                           ----------------------------------------- */

                        $agentImage =
                            "images/default-user.jpg";


                        if (
                            !empty($row['uimage']) &&
                            file_exists(
                                "admin/user/" .
                                $row['uimage']
                            )
                        ) {

                            $agentImage =
                                "admin/user/" .
                                $row['uimage'];

                        }

                ?>


                        <!-- =====================================
                             AGENT CARD
                             ===================================== -->

                        <div
                            class="col-lg-4 col-md-6 col-sm-12 agent-card-wrapper"
                        >


                            <div class="agent-card">


                                <!-- =============================
                                     BADGE
                                     ============================= -->

                                <span class="agent-badge">

                                    Real Estate Agent

                                </span>


                                <!-- =============================
                                     PROFILE IMAGE
                                     ============================= -->

                                <div class="agent-image-wrapper">


                                    <img
                                        src="<?php echo htmlspecialchars($agentImage); ?>"
                                        alt="<?php echo htmlspecialchars($agentName); ?>"
                                    >


                                </div>


                                <!-- =============================
                                     AGENT NAME
                                     ============================= -->

                                <h3 class="agent-name">

                                    <?php

                                    echo htmlspecialchars(
                                        $agentName
                                    );

                                    ?>

                                </h3>


                                <!-- =============================
                                     CONTACT DETAILS
                                     ============================= -->

                                <div class="agent-contact">


                                    <!-- EMAIL -->

                                    <div class="agent-contact-item">


                                        <div
                                            class="agent-contact-icon"
                                        >

                                            <i
                                                class="fas fa-envelope"
                                            ></i>

                                        </div>


                                        <div
                                            class="agent-contact-text"
                                        >


                                            <span
                                                class="agent-contact-label"
                                            >

                                                Email

                                            </span>


                                            <span
                                                class="agent-contact-value"
                                            >

                                                <?php

                                                echo htmlspecialchars(
                                                    $agentEmail
                                                );

                                                ?>

                                            </span>


                                        </div>


                                    </div>


                                    <!-- PHONE -->

                                    <div class="agent-contact-item">


                                        <div
                                            class="agent-contact-icon"
                                        >

                                            <i
                                                class="fas fa-phone-alt"
                                            ></i>

                                        </div>


                                        <div
                                            class="agent-contact-text"
                                        >


                                            <span
                                                class="agent-contact-label"
                                            >

                                                Phone

                                            </span>


                                            <span
                                                class="agent-contact-value"
                                            >

                                                <?php

                                                echo htmlspecialchars(
                                                    $agentPhone
                                                );

                                                ?>

                                            </span>


                                        </div>


                                    </div>


                                </div>


                            </div>


                        </div>


                <?php

                    }


                } else {

                ?>


                    <!-- =========================================
                         NO AGENTS
                         ========================================= -->

                    <div class="col-md-12">


                        <div class="no-agent-box">


                            <div class="no-agent-icon">

                                <i
                                    class="fas fa-user-tie"
                                ></i>

                            </div>


                            <h4>

                                No Agents Available

                            </h4>


                            <p>

                                There are currently no registered
                                agents available.

                            </p>


                        </div>


                    </div>


                <?php

                }

                ?>


            </div>


        </div>

    </section>


    <!-- =====================================================
         USER FOOTER
         ===================================================== -->

    <?php include("include/footer.php"); ?>


    <!-- =====================================================
         SCROLL TO TOP
         ===================================================== -->

    <a
        href="#"
        class="bg-secondary text-white hover-text-secondary"
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

<script src="js/jquery.cookie.js"></script>

<script src="js/custom.js"></script>


<!-- =========================================================
     VERTICAL IMAGE SCROLL
     ========================================================= -->

<script>

(function () {


    const banner =
        document.getElementById(
            "houseBanner"
        );


    const image =
        document.getElementById(
            "houseImage"
        );


    if (!banner || !image) {

        return;

    }


    /* =====================================================
       MOVE IMAGE VERTICALLY

       TOP of image is shown at the beginning.

       MIDDLE of image is shown while scrolling.

       BOTTOM of image is shown near the end.
       ===================================================== */

    function updateImagePosition() {


        const rect =
            banner.getBoundingClientRect();


        const viewportHeight =
            window.innerHeight;


        /*
         * Start when banner enters viewport.
         */

        const startPoint =
            viewportHeight;


        /*
         * Finish when banner leaves viewport.
         */

        const endPoint =
            -banner.offsetHeight;


        /*
         * Calculate scroll progress.
         */

        let progress =
            (
                startPoint -
                rect.top
            )
            /
            (
                startPoint -
                endPoint
            );


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
         * The image is 160% height.

         * Banner = 100%

         * Extra image = 60%

         * Therefore the image can move
         * vertically by 60% of banner height.
         */

        const maximumMovement =
            banner.offsetHeight * 0.60;


        /*
         * Calculate vertical position.
         */

        const movement =
            -(maximumMovement * progress);


        /*
         * X remains 0.

         * Only Y changes.
         */

        image.style.transform =
            "translate3d(0, " +
            movement +
            "px, 0)";

    }


    /* =====================================================
       SCROLL
       ===================================================== */

    window.addEventListener(
        "scroll",
        updateImagePosition,
        {
            passive: true
        }
    );


    /* =====================================================
       RESIZE
       ===================================================== */

    window.addEventListener(
        "resize",
        updateImagePosition
    );


    /* =====================================================
       INITIAL POSITION
       ===================================================== */

    updateImagePosition();


})();

</script>


</body>

</html>