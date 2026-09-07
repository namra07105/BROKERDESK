<?php

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

session_start();

include("../config.php");


/* =========================================================
   AGENT AUTHENTICATION
========================================================= */

if(!isset($_SESSION['uemail']))
{
    header("Location: login.php");
    exit();
}


/* =========================================================
   CHECK AGENT ACCOUNT
========================================================= */

$uid = $_SESSION['uid'];

$agentQuery = mysqli_query(
    $con,
    "SELECT * FROM user WHERE uid='$uid'"
);

$agentData = mysqli_fetch_assoc($agentQuery);

if(!$agentData)
{
    header("Location: login.php");
    exit();
}


/* =========================================================
   FEEDBACK
========================================================= */

$error = "";
$msg = "";


if(isset($_POST['insert']))
{
    $content = trim($_POST['content']);

    if(!empty($content))
    {
        $content = mysqli_real_escape_string($con, $content);

        $sql = "INSERT INTO feedback
                (uid, fdescription, status)
                VALUES
                ('$uid', '$content', '0')";

        $result = mysqli_query($con, $sql);

        if($result)
        {
            $msg = "
                <div class='feedback-alert success-alert'>
                    <div class='alert-icon'>
                        <i class='fas fa-check'></i>
                    </div>

                    <div>
                        <strong>Feedback Sent Successfully</strong>
                        <p>Thank you for sharing your feedback.</p>
                    </div>
                </div>
            ";
        }
        else
        {
            $error = "
                <div class='feedback-alert error-alert'>
                    <div class='alert-icon'>
                        <i class='fas fa-exclamation'></i>
                    </div>

                    <div>
                        <strong>Feedback Could Not Be Sent</strong>
                        <p>Please try again.</p>
                    </div>
                </div>
            ";
        }
    }
    else
    {
        $error = "
            <div class='feedback-alert error-alert'>
                <div class='alert-icon'>
                    <i class='fas fa-exclamation'></i>
                </div>

                <div>
                    <strong>Please Enter Your Feedback</strong>
                    <p>The feedback field cannot be empty.</p>
                </div>
            </div>
        ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- =========================================================
         META
    ========================================================== -->

    <meta charset="utf-8">

    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >


    <!-- =========================================================
         FAVICON
    ========================================================== -->

    <link
        rel="shortcut icon"
        href="../images/favicon.ico"
    >


    <!-- =========================================================
         FONTS
    ========================================================== -->

    <link
        href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css?family=Comfortaa:400,700"
        rel="stylesheet"
    >


    <!-- =========================================================
         CSS
    ========================================================== -->

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
    <link rel="stylesheet" type="text/css" href="../css/responsive-fix.css">
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="../css/login.css"
    >


    <title>Agent Feedback - Homex</title>


    <!-- =========================================================
         FEEDBACK PAGE DESIGN
    ========================================================== -->

    <style>

        /* =====================================================
           PAGE BACKGROUND
        ===================================================== */

        body {
            background: #f5f6f8;
        }


        /* =====================================================
           SCROLLABLE HERO
        ===================================================== */

        .feedback-hero {
            width: calc(100% - 40px);

            height: 420px;

            margin-left: 20px;
            margin-right: 20px;

            overflow: hidden;

            position: relative;

            background: #111;
        }


        .feedback-hero-image {
            position: absolute;

            top: 0;
            left: 0;

            width: 100%;

            height: auto;

            min-height: 100%;

            object-fit: cover;

            object-position: center center;

            display: block;

            transform: translateY(0);

            will-change: transform;
        }


        /* =====================================================
           HERO DARK OVERLAY
        ===================================================== */

        .feedback-hero::after {
            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            background:
                linear-gradient(
                    90deg,
                    rgba(0,0,0,0.62),
                    rgba(0,0,0,0.22),
                    rgba(0,0,0,0.12)
                );

            z-index: 1;
        }


        /* =====================================================
           HERO CONTENT
        ===================================================== */

        .feedback-hero-content {
            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;

            z-index: 2;
        }


        .feedback-hero-content .container {
            width: 100%;
        }


        .feedback-hero-text {
            max-width: 650px;
        }


        .feedback-hero-text .small-title {
            display: inline-block;

            margin-bottom: 14px;

            padding: 7px 15px;

            border-radius: 30px;

            background: rgba(134,184,23,0.95);

            color: #fff;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: 1.5px;

            text-transform: uppercase;
        }


        .feedback-hero-text h1 {
            margin: 0 0 12px;

            color: #fff;

            font-size: 52px;

            font-weight: 700;

            line-height: 1.1;
        }


        .feedback-hero-text p {
            max-width: 570px;

            margin: 0;

            color: rgba(255,255,255,0.88);

            font-size: 16px;

            line-height: 1.7;
        }


        /* =====================================================
           MAIN SECTION
        ===================================================== */

        .feedback-section {
            padding: 75px 0 90px;
        }


        .feedback-heading {
            text-align: center;

            margin-bottom: 45px;
        }


        .feedback-heading .section-tag {
            display: inline-block;

            margin-bottom: 10px;

            color: #1976d2;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 1.5px;

            text-transform: uppercase;
        }


        .feedback-heading h2 {
            margin: 0 0 12px;

            color: #333;

            font-size: 34px;

            font-weight: 700;
        }


        .feedback-heading p {
            max-width: 650px;

            margin: 0 auto;

            color: #777;

            font-size: 15px;

            line-height: 1.7;
        }


        /* =====================================================
           MAIN CARDS
        ===================================================== */

        .feedback-card {
            height: 100%;

            padding: 38px;

            background: #fff;

            border-radius: 12px;

            border: 1px solid #ececec;

            box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        }


        .feedback-card-title {
            display: flex;

            align-items: center;

            margin-bottom: 28px;
        }


        .feedback-card-icon {
            width: 48px;
            height: 48px;

            margin-right: 14px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #e3f2fd;

            color: #1976d2;

            font-size: 19px;
        }


        .feedback-card-title h4 {
            margin: 0;

            color: #333;

            font-size: 21px;

            font-weight: 700;
        }


        .feedback-card-title span {
            display: block;

            margin-top: 3px;

            color: #999;

            font-size: 12px;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .feedback-form-group {
            margin-bottom: 22px;
        }


        .feedback-form-group label {
            display: block;

            margin-bottom: 8px;

            color: #444;

            font-size: 13px;

            font-weight: 600;
        }


        .feedback-form-control {
            width: 100%;

            min-height: 50px;

            padding: 13px 16px;

            border: 1px solid #e1e1e1;

            border-left: 3px solid #c9e2ff;

            border-radius: 7px;

            background: #fafafa;

            color: #333;

            font-size: 14px;

            outline: none;

            transition: all 0.25s ease;
        }


        .feedback-form-control:hover {
            border-color: #cfcfcf;

            background: #fff;
        }


        .feedback-form-control:focus {
            border-color: #1976d2;

            border-left-color: #1976d2;

            background: #fff;

            box-shadow: 0 0 0 3px rgba(25,118,210,0.10);
        }


        textarea.feedback-form-control {
            min-height: 170px;

            resize: vertical;
        }


        .feedback-submit {
            width: 100%;

            height: 50px;

            border: none;

            border-radius: 7px;

            background: #1976d2;

            color: #fff;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition: all 0.25s ease;
        }


        .feedback-submit:hover {
            background: #1565c0;

            transform: translateY(-1px);

            box-shadow: 0 7px 18px rgba(25,118,210,0.25);
        }


        /* =====================================================
           ALERTS
        ===================================================== */

        .feedback-alert {
            display: flex;

            align-items: flex-start;

            padding: 14px 16px;

            margin-bottom: 22px;

            border-radius: 8px;

            font-size: 13px;
        }


        .feedback-alert .alert-icon {
            flex-shrink: 0;

            width: 32px;
            height: 32px;

            margin-right: 12px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            font-size: 13px;
        }


        .feedback-alert strong {
            display: block;

            margin-bottom: 2px;

            font-size: 13px;
        }


        .feedback-alert p {
            margin: 0;

            font-size: 12px;
        }


        .success-alert {
            background: #e3f2fd;

            border: 1px solid #c9e2ff;

            color: #1565c0;
        }


        .success-alert .alert-icon {
            background: #1976d2;

            color: #fff;
        }


        .error-alert {
            background: #fff2f2;

            border: 1px solid #f0d2d2;

            color: #a44;
        }


        .error-alert .alert-icon {
            background: #d9534f;

            color: #fff;
        }


        /* =====================================================
           PROFILE CARD
        ===================================================== */

        .agent-profile-card {
            position: relative;

            height: 100%;

            padding: 38px;

            background: #fff;

            border-radius: 12px;

            border: 1px solid #ececec;

            box-shadow: 0 8px 30px rgba(0,0,0,0.06);

            overflow: hidden;
        }


        .agent-profile-card::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 5px;

            background: #1976d2;
        }


        .profile-heading {
            margin-bottom: 28px;
        }


        .profile-heading h4 {
            margin: 0 0 5px;

            color: #333;

            font-size: 21px;

            font-weight: 700;
        }


        .profile-heading p {
            margin: 0;

            color: #999;

            font-size: 12px;
        }


        .agent-profile-image {
            width: 115px;
            height: 115px;

            margin: 0 auto 22px;

            border-radius: 50%;

            border: 5px solid #e3f2fd;

            overflow: hidden;

            background: #f4f4f4;
        }


        .agent-profile-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }


        .agent-role {
            display: inline-block;

            padding: 6px 14px;

            margin-bottom: 28px;

            border-radius: 30px;

            background: #e3f2fd;

            color: #1565c0;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        .agent-details {
            border-top: 1px solid #eeeeee;

            padding-top: 10px;
        }


        .agent-detail-item {
            display: flex;

            align-items: center;

            padding: 14px 0;

            border-bottom: 1px solid #f0f0f0;
        }


        .agent-detail-icon {
            width: 36px;
            height: 36px;

            margin-right: 12px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #eef6ff;

            color: #1976d2;

            font-size: 13px;
        }


        .agent-detail-text {
            min-width: 0;
        }


        .agent-detail-text small {
            display: block;

            margin-bottom: 2px;

            color: #999;

            font-size: 10px;

            text-transform: uppercase;

            letter-spacing: 0.7px;
        }


        .agent-detail-text span {
            display: block;

            color: #444;

            font-size: 13px;

            word-break: break-word;
        }


        /* =====================================================
           FEEDBACK NOTE
        ===================================================== */

        .feedback-note {
            margin-top: 25px;

            padding: 15px 17px;

            border-radius: 8px;

            background: #f8f9fa;

            color: #777;

            font-size: 12px;

            line-height: 1.7;
        }


        .feedback-note i {
            margin-right: 6px;

            color: #1976d2;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 991.98px)
        {

            .feedback-hero {
                height: 400px;
            }


            .feedback-hero-text h1 {
                font-size: 44px;
            }


            .feedback-card,
            .agent-profile-card {
                padding: 30px;
            }

        }


        @media (max-width: 767px)
        {

            .feedback-hero {
                width: calc(100% - 30px);

                height: 350px;

                margin-left: 15px;
                margin-right: 15px;
            }


            .feedback-hero-text h1 {
                font-size: 38px;
            }


            .feedback-hero-text p {
                font-size: 14px;
            }


            .feedback-section {
                padding: 55px 0 65px;
            }


            .feedback-heading h2 {
                font-size: 29px;
            }


            .feedback-card,
            .agent-profile-card {
                padding: 25px;
            }


            .agent-profile-card {
                margin-top: 25px;
            }

        }


        @media (max-width: 575.98px)
        {

            .feedback-hero {
                width: calc(100% - 20px);

                height: 330px;

                margin-left: 10px;
                margin-right: 10px;
            }


            .feedback-hero-text h1 {
                font-size: 32px;
            }


            .feedback-hero-text .small-title {
                font-size: 10px;
            }


            .feedback-card,
            .agent-profile-card {
                padding: 22px;
            }


            .feedback-heading {
                margin-bottom: 32px;
            }


            .feedback-heading h2 {
                font-size: 26px;
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
             HERO SECTION
        ====================================================== -->

        <div
            class="feedback-hero"
            id="feedbackHero"
        >

            <img
                src="../images/feedback.jpg"
                alt="Feedback"
                class="feedback-hero-image"
                id="feedbackHeroImage"
            >


            <div class="feedback-hero-content">

                <div class="container">

                    <div class="feedback-hero-text">



                        <h1>
                            Feedback
                        </h1>

                        <p>
                            Your feedback helps us improve the
                            BROKERDESK experience and provide
                            better services.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             FEEDBACK SECTION
        ====================================================== -->

        <section class="feedback-section">

            <div class="container">


                <!-- =================================================
                     HEADING
                ================================================== -->

                <div class="feedback-heading">

                    <span class="section-tag">
                        Share Your Experience
                    </span>

                    <h2>
                        We'd Love To Hear From You
                    </h2>

                    <p>
                        Tell us about your experience with the
                        platform. Your suggestions and feedback
                        help us make BROKERDESK better.
                    </p>

                </div>


                <!-- =================================================
                     CONTENT
                ================================================== -->

                <div class="row">


                    <!-- =================================================
                         FEEDBACK FORM
                    ================================================== -->

                    <div class="col-lg-7 col-md-12">

                        <div class="feedback-card">


                            <div class="feedback-card-title">

                                <div class="feedback-card-icon">

                                    <i class="fas fa-comment-dots"></i>

                                </div>

                                <div>

                                    <h4>
                                        Send Feedback
                                    </h4>

                                    <span>
                                        Share your thoughts with us
                                    </span>

                                </div>

                            </div>


                            <?php echo $msg; ?>

                            <?php echo $error; ?>


                            <form
                                action=""
                                method="post"
                            >


                                <!-- =================================================
                                     NAME
                                ================================================== -->

                                <div class="feedback-form-group">

                                    <label>
                                        Name
                                    </label>

                                    <input
                                        type="text"
                                        class="feedback-form-control"
                                        value="<?php echo htmlspecialchars($agentData['uname']); ?>"
                                        readonly
                                    >

                                </div>


                                <!-- =================================================
                                     PHONE
                                ================================================== -->

                                <div class="feedback-form-group">

                                    <label>
                                        Phone Number
                                    </label>

                                    <input
                                        type="text"
                                        class="feedback-form-control"
                                        value="<?php echo htmlspecialchars($agentData['uphone']); ?>"
                                        readonly
                                    >

                                </div>


                                <!-- =================================================
                                     FEEDBACK
                                ================================================== -->

                                <div class="feedback-form-group">

                                    <label>
                                        Your Feedback
                                    </label>

                                    <textarea
                                        name="content"
                                        class="feedback-form-control"
                                        placeholder="Write your feedback here..."
                                        required
                                    ></textarea>

                                </div>


                                <!-- =================================================
                                     SUBMIT
                                ================================================== -->

                                <button
                                    type="submit"
                                    name="insert"
                                    value="Send"
                                    class="feedback-submit"
                                >

                                    <i class="fas fa-paper-plane mr-2"></i>

                                    Send Feedback

                                </button>


                            </form>


                            <div class="feedback-note">

                                <i class="fas fa-info-circle"></i>

                                Your feedback will be reviewed by the
                                BROKERDESK administration team.

                            </div>


                        </div>

                    </div>


                    <!-- =================================================
                         AGENT PROFILE
                    ================================================== -->

                    <div class="col-lg-5 col-md-12">

                        <div class="agent-profile-card">


                            <div class="profile-heading">

                                <h4>
                                    Your Profile
                                </h4>

                                <p>
                                    Feedback will be associated with this account
                                </p>

                            </div>


                            <!-- =================================================
                                 PROFILE IMAGE
                            ================================================== -->

                            <div class="text-center">

                                <div class="agent-profile-image">

                                    <?php

                                    $agentImage = $agentData['uimage'];

                                    if(!empty($agentImage))
                                    {

                                    ?>

                                        <img
                                            src="../admin/user/<?php echo htmlspecialchars($agentImage); ?>"
                                            alt="Agent Profile"
                                        >

                                    <?php

                                    }
                                    else
                                    {

                                    ?>

                                        <img
                                            src="../images/user.png"
                                            alt="Agent Profile"
                                        >

                                    <?php

                                    }

                                    ?>

                                </div>


                                <span class="agent-role">

                                    <?php

                                    echo htmlspecialchars(
                                        $agentData['utype']
                                    );

                                    ?>

                                </span>

                            </div>


                            <!-- =================================================
                                 DETAILS
                            ================================================== -->

                            <div class="agent-details">


                                <!-- NAME -->

                                <div class="agent-detail-item">

                                    <div class="agent-detail-icon">

                                        <i class="fas fa-user"></i>

                                    </div>

                                    <div class="agent-detail-text">

                                        <small>
                                            Name
                                        </small>

                                        <span>

                                            <?php

                                            echo htmlspecialchars(
                                                $agentData['uname']
                                            );

                                            ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- EMAIL -->

                                <div class="agent-detail-item">

                                    <div class="agent-detail-icon">

                                        <i class="fas fa-envelope"></i>

                                    </div>

                                    <div class="agent-detail-text">

                                        <small>
                                            Email
                                        </small>

                                        <span>

                                            <?php

                                            echo htmlspecialchars(
                                                $agentData['uemail']
                                            );

                                            ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- PHONE -->

                                <div class="agent-detail-item">

                                    <div class="agent-detail-icon">

                                        <i class="fas fa-phone-alt"></i>

                                    </div>

                                    <div class="agent-detail-text">

                                        <small>
                                            Phone
                                        </small>

                                        <span>

                                            <?php

                                            echo htmlspecialchars(
                                                $agentData['uphone']
                                            );

                                            ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- ROLE -->

                                <div class="agent-detail-item">

                                    <div class="agent-detail-icon">

                                        <i class="fas fa-user-tie"></i>

                                    </div>

                                    <div class="agent-detail-text">

                                        <small>
                                            Account Type
                                        </small>

                                        <span>

                                            <?php

                                            echo htmlspecialchars(
                                                $agentData['utype']
                                            );

                                            ?>

                                        </span>

                                    </div>

                                </div>


                            </div>


                            <!-- =================================================
                                 PROFILE NOTE
                            ================================================== -->

                            <div class="feedback-note">

                                <i class="fas fa-shield-alt"></i>

                                Your account information is used only
                                to identify the feedback submission.

                            </div>


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

<script src="../js/wow.js"></script>

<script src="../js/custom.js"></script>


<!-- =========================================================
     HERO IMAGE SCROLL
========================================================= -->

<script>

window.addEventListener("scroll", function () {

    const banner =
        document.getElementById("feedbackHero");

    const image =
        document.getElementById("feedbackHeroImage");


    if(!banner || !image)
    {
        return;
    }


    const rect =
        banner.getBoundingClientRect();


    const windowHeight =
        window.innerHeight;


    const imageHeight =
        image.offsetHeight;


    const bannerHeight =
        banner.offsetHeight;


    const maxMove =
        Math.max(
            0,
            imageHeight - bannerHeight
        );


    let progress =
        (windowHeight - rect.top) /
        (windowHeight + rect.height);


    progress =
        Math.max(
            0,
            Math.min(1, progress)
        );


    const moveY =
        -(maxMove * progress);


    image.style.transform =
        "translateY(" + moveY + "px)";

});


window.addEventListener("resize", function () {

    const banner =
        document.getElementById("feedbackHero");

    const image =
        document.getElementById("feedbackHeroImage");


    if(!banner || !image)
    {
        return;
    }


    const rect =
        banner.getBoundingClientRect();


    const windowHeight =
        window.innerHeight;


    const imageHeight =
        image.offsetHeight;


    const bannerHeight =
        banner.offsetHeight;


    const maxMove =
        Math.max(
            0,
            imageHeight - bannerHeight
        );


    let progress =
        (windowHeight - rect.top) /
        (windowHeight + rect.height);


    progress =
        Math.max(
            0,
            Math.min(1, progress)
        );


    const moveY =
        -(maxMove * progress);


    image.style.transform =
        "translateY(" + moveY + "px)";

});


</script>


</body>

</html>