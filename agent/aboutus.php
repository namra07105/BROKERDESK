<?php
include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- =========================================================
         META
    ========================================================= -->

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
        content="BROKERDESK - About Us"
    >

    <meta
        name="keywords"
        content="real estate, property, broker, brokerdesk"
    >

    <meta
        name="author"
        content="BROKERDESK"
    >


    <!-- =========================================================
         FAVICON
    ========================================================= -->

    <link
        rel="shortcut icon"
        href="../images/favicon.ico"
    >


    <!-- =========================================================
         FONTS
    ========================================================= -->

    <link
        href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700,800&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css?family=Comfortaa:400,700&display=swap"
        rel="stylesheet"
    >


    <!-- =========================================================
         CSS
    ========================================================= -->

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
        id="color-change"
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


    <!-- =========================================================
         CUSTOM ABOUT PAGE CSS
    ========================================================= -->

    <style>


        /* =========================================================
           GENERAL
        ========================================================= */

        body {
            font-family: 'Muli', sans-serif;

            margin: 0;
            padding: 0;

            background: #ffffff;
        }


        #page-wrapper {
            overflow: hidden;
        }


        /* =========================================================
           HERO / BANNER
        ========================================================= */

        #aboutBanner {

            position: relative;

            width: 100%;

            height: 430px !important;

            background-image:
                url('../images/aboutusimg.jpg');

            background-repeat: no-repeat;

            background-size: cover;

            background-position:
                center 0px;

            overflow: hidden;

            display: flex;

            align-items: center;

            will-change:
                background-position;

        }


        /* =========================================================
           HERO OVERLAY
        ========================================================= */

        #aboutBanner::before {

            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    90deg,
                    rgba(0,0,0,0.72) 0%,
                    rgba(0,0,0,0.48) 48%,
                    rgba(0,0,0,0.20) 100%
                );

            z-index: 1;

        }


        .about-banner-content {

            position: relative;

            z-index: 2;

            width: 100%;

        }


        /* =========================================================
           HERO TITLE
        ========================================================= */

        .about-banner-title {

            font-family:
                'Comfortaa',
                sans-serif;

            font-size: 48px;

            line-height: 1.15;

            font-weight: 700;

            color: #ffffff;

            margin:
                0 0 14px;

            letter-spacing:
                0.5px;

            text-shadow:
                0 2px 12px
                rgba(0,0,0,0.30);

        }


        .about-banner-subtitle {

            max-width: 560px;

            margin: 0;

            color:
                rgba(255,255,255,0.90);

            font-size: 17px;

            line-height: 1.7;

            text-shadow:
                0 1px 5px
                rgba(0,0,0,0.30);

        }


        /* =========================================================
           ABOUT SECTION
        ========================================================= */

        .about-section {

            padding:
                90px 0;

            background:
                #ffffff;

        }


        /* =========================================================
           SECTION LABEL
        ========================================================= */

        .about-section-label {

            display: inline-block;

            margin-bottom: 13px;

            color: #777;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 2px;

            text-transform:
                uppercase;

        }


        /* =========================================================
           MAIN TITLE
        ========================================================= */

        .about-main-title {

            position: relative;

            margin:
                0 0 25px;

            color: #242424;

            font-family:
                'Comfortaa',
                sans-serif;

            font-size: 38px;

            line-height: 1.3;

            font-weight: 700;

        }


        .about-main-title::after {

            content: "";

            display: block;

            width: 65px;

            height: 4px;

            margin-top: 18px;

            border-radius: 10px;

            background:
                #28a745;

        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .about-content-box {

            padding-right: 35px;

            color: #666;

            font-size: 16px;

            line-height: 1.9;

        }


        .about-content-box p {

            margin-bottom: 18px;

        }


        .about-content-box ul {

            padding-left: 20px;

        }


        .about-content-box li {

            margin-bottom: 9px;

        }


        /* =========================================================
           IMAGE CARD
        ========================================================= */

        .about-image-wrapper {

            position: relative;

            padding: 12px;

            background:
                #ffffff;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 15px 45px
                rgba(0,0,0,0.12);

        }


        /* =========================================================
           IMAGE CARD TOP CORNER
        ========================================================= */

        .about-image-wrapper::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            width: 75px;

            height: 75px;

            border-top:
                5px solid #28a745;

            border-left:
                5px solid #28a745;

            border-radius:
                15px 0 0 0;

            z-index: 2;

            pointer-events: none;

        }


        /* =========================================================
           IMAGE CARD BOTTOM CORNER
        ========================================================= */

        .about-image-wrapper::after {

            content: "";

            position: absolute;

            right: 0;

            bottom: 0;

            width: 75px;

            height: 75px;

            border-right:
                5px solid #28a745;

            border-bottom:
                5px solid #28a745;

            border-radius:
                0 0 15px 0;

            z-index: 2;

            pointer-events: none;

        }


        /* =========================================================
           ABOUT IMAGE
        ========================================================= */

        .about-main-image {

            display: block;

            width: 100%;

            height: 430px;

            object-fit: cover;

            border-radius: 12px;

            transition:
                transform 0.6s ease;

        }


        .about-image-wrapper:hover
        .about-main-image {

            transform:
                scale(1.025);

        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .about-empty {

            max-width: 650px;

            margin:
                20px auto;

            padding:
                80px 30px;

            text-align: center;

            background:
                #f8f9fa;

            border-radius: 18px;

            color: #777;

        }


        .about-empty i {

            display: block;

            margin-bottom: 18px;

            color: #999;

            font-size: 45px;

        }


        .about-empty h4 {

            margin:
                0 0 8px;

            color: #333;

            font-size: 22px;

            font-weight: 700;

        }


        .about-empty p {

            margin: 0;

            color: #888;

            font-size: 14px;

        }


        /* =========================================================
           RESPONSIVE - TABLET
        ========================================================= */

        @media (max-width: 991px) {

            .about-banner-title {

                font-size: 40px;

            }


            .about-content-box {

                padding-right: 0;

                margin-bottom: 45px;

            }


            .about-main-title {

                font-size: 34px;

            }

        }


        /* =========================================================
           RESPONSIVE - MOBILE
        ========================================================= */

        @media (max-width: 767px) {

            #aboutBanner {

                height:
                    380px !important;

                background-size:
                    cover;

                background-position:
                    center 0px;

            }


            .about-banner-title {

                font-size: 32px;

                margin-bottom: 10px;

            }


            .about-banner-subtitle {

                font-size: 15px;

                line-height: 1.6;

            }


            .about-section {

                padding:
                    60px 0;

            }


            .about-main-title {

                font-size: 29px;

            }


            .about-content-box {

                font-size: 15px;

                line-height: 1.8;

            }


            .about-main-image {

                height:
                    320px;

            }

        }


        /* =========================================================
           RESPONSIVE - SMALL MOBILE
        ========================================================= */

        @media (max-width: 480px) {

            .about-banner-title {

                font-size: 28px;

            }


            .about-main-title {

                font-size: 26px;

            }


            .about-main-image {

                height:
                    280px;

            }

        }


    </style>


    <title>
        About Us - BROKERDESK
    </title>

</head>


<body>


<!-- =========================================================
     PAGE WRAPPER
========================================================= -->

<div id="page-wrapper">


    <!-- =====================================================
         HEADER
    ===================================================== -->

    <?php include("header.php"); ?>


    <!-- =====================================================
         HERO / BANNER
    ===================================================== -->

    <div
        class="banner-full-row page-banner"
        id="aboutBanner"
    >


        <div
            class="about-banner-content"
        >


            <div class="container">


                <div class="row align-items-center">


                    <!-- =================================================
                         HERO CONTENT
                    ================================================= -->

                    <div
                        class="col-lg-8 col-md-9"
                    >


                        <div
                            class="about-banner-title"
                        >

                            About Us

                        </div>


                        <p
                            class="about-banner-subtitle"
                        >

                            Discover a smarter and simpler way
                            to find properties with BROKERDESK.

                        </p>


                    </div>


                </div>


            </div>


        </div>


    </div>


    <!-- =====================================================
         ABOUT COMPANY
    ===================================================== -->

    <section
        class="about-section"
    >


        <div class="container">


            <?php

            /*
             * Get About information entered
             * from Admin Panel.
             */

            $query = mysqli_query(
                $con,
                "SELECT * FROM about ORDER BY id DESC"
            );


            if (
                $query &&
                mysqli_num_rows($query) > 0
            ) {


                while (
                    $row = mysqli_fetch_assoc($query)
                ) {

            ?>


                    <!-- =============================================
                         ABOUT CONTENT ROW
                    ============================================== -->

                    <div
                        class="row align-items-center"
                    >


                        <!-- =========================================
                             CONTENT
                        ========================================== -->

                        <div
                            class="col-lg-7 col-md-12"
                        >


                            <div
                                class="about-content-box"
                            >


                                <span
                                    class="about-section-label"
                                >

                                    Who We Are

                                </span>


                                <h2
                                    class="about-main-title"
                                >

                                    <?php

                                    echo htmlspecialchars(
                                        $row['title']
                                    );

                                    ?>

                                </h2>


                                <div>

                                    <?php

                                    /*
                                     * Admin content may contain
                                     * HTML formatting.
                                     */

                                    echo $row['content'];

                                    ?>

                                </div>


                            </div>


                        </div>


                        <!-- =========================================
                             IMAGE
                        ========================================== -->

                        <div
                            class="col-lg-5 col-md-12"
                        >


                            <?php

                            if (
                                !empty($row['image'])
                            ) {

                            ?>


                                <div
                                    class="about-image-wrapper"
                                >


                                    <img
                                        src="../admin/upload/<?php
                                        echo htmlspecialchars(
                                            $row['image']
                                        );
                                        ?>"
                                        alt="<?php
                                        echo htmlspecialchars(
                                            $row['title']
                                        );
                                        ?>"
                                        class="about-main-image"
                                    >


                                </div>


                            <?php

                            }

                            ?>


                        </div>


                    </div>


            <?php

                }


            } else {

            ?>


                <!-- =============================================
                     NO ABOUT DATA
                ============================================== -->

                <div
                    class="about-empty"
                >


                    <i
                        class="fas fa-building"
                    ></i>


                    <h4>

                        About Information Not Available

                    </h4>


                    <p>

                        About information has not been added yet.

                    </p>


                </div>


            <?php

            }

            ?>


        </div>


    </section>


    <!-- =====================================================
         FOOTER
    ===================================================== -->

    <?php include("footer.php"); ?>


    <!-- =====================================================
         SCROLL TO TOP
    ===================================================== -->

    <a
        href="#"
        class="bg-secondary text-white hover-text-secondary"
        id="scroll"
    >

        <i
            class="fas fa-angle-up"
        ></i>

    </a>


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

<script src="../js/jquery.cookie.js"></script>

<script src="../js/custom.js"></script>


<!-- =========================================================
     STRONG VERTICAL HERO IMAGE SCROLL
========================================================= -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {


        const banner =
            document.getElementById(
                "aboutBanner"
            );


        if (!banner) {

            return;

        }


        /*
         * =====================================================
         * MOVE BANNER IMAGE
         *
         * Image moves vertically:
         *
         * TOP
         *   ↓
         * MIDDLE
         *   ↓
         * BOTTOM
         * =====================================================
         */

        function moveBannerImage() {


            const rect =
                banner.getBoundingClientRect();


            /*
             * Calculate how far the
             * banner has moved through
             * the viewport.
             */

            let progress =
                (
                    window.innerHeight -
                    rect.top
                )
                /
                (
                    window.innerHeight +
                    rect.height
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
             * Strong vertical movement.
             *
             * This is intentionally
             * larger than the previous
             * 200px movement.
             */

            const moveY =
                -(progress * 420);


            /*
             * Change only the Y position.
             */

            banner.style.backgroundPosition =
                "center " +
                moveY +
                "px";

        }


        /*
         * =====================================================
         * SCROLL EVENT
         * ===================================================== */

        window.addEventListener(
            "scroll",
            moveBannerImage,
            {
                passive: true
            }
        );


        /*
         * =====================================================
         * RESIZE EVENT
         * ===================================================== */

        window.addEventListener(
            "resize",
            moveBannerImage
        );


        /*
         * =====================================================
         * INITIAL POSITION
         * ===================================================== */

        moveBannerImage();


    }
);

</script>


</body>

</html>