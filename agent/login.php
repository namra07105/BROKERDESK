<?php

session_start();

include("../config.php");

$error = "";
$msg = "";


/* =========================================================
   AGENT LOGIN
========================================================= */

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    if(!empty($email) && !empty($pass))
    {
        /*
         * Only Agent accounts are allowed here.
         */
        $sql = "SELECT * FROM user 
                WHERE uemail='$email' 
                AND upass='$pass'
                AND LOWER(TRIM(utype))='agent'";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result);

        if($row)
        {
            $_SESSION['uid']    = $row['uid'];
            $_SESSION['uemail'] = $row['uemail'];
            $_SESSION['utype']  = $row['utype'];

            header("Location: dashboard.php");
            exit;
        }
        else
        {
            $error = "<p class='alert alert-warning'>Invalid Agent Email or Password</p>";
        }
    }
    else
    {
        $error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >

    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >


    <!-- Favicon -->

    <link
        rel="shortcut icon"
        href="../images/favicon.ico"
    >


    <!-- Fonts -->

    <link
        href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css?family=Comfortaa:400,700"
        rel="stylesheet"
    >


    <!-- CSS -->

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


    <title>Agent Login - Homex</title>


    <style>

        /* =========================================================
           PAGE BANNER
        ========================================================= */

        .page-banner
        {
            width: calc(100% - 40px);

            min-height: 420px;

            margin-left: 20px;
            margin-right: 20px;

            background-image:
                url('../images/loginimg.jpg') !important;

            background-size: cover;

            background-position: center center;

            background-repeat: no-repeat;

            background-attachment: scroll;

            position: relative;
        }


        /* =========================================================
           DARK OVERLAY
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

            background: rgba(0, 0, 0, 0.55);

            z-index: 0;
        }


        /* =========================================================
           BANNER CONTENT
        ========================================================= */

        .page-banner .container
        {
            position: relative;

            z-index: 1;
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
           LOGIN FORM
        ========================================================= */

        .login-body
        {
            padding-top: 60px;

            padding-bottom: 70px;
        }


        .loginbox
        {
            max-width: 520px;

            margin: 0 auto;

            background: #ffffff;

            border-radius: 10px;

            /* BLUE */

            border-top: 4px solid #1976d2;

            box-shadow:
                0 8px 30px rgba(0,0,0,0.08);

            overflow: hidden;
        }


        .login-right
        {
            width: 100%;
        }


        .login-right-wrap
        {
            width: 100%;

            padding: 42px 45px 40px;
        }


        .login-right-wrap h1
        {
            margin: 0 0 8px;

            font-size: 30px;

            font-weight: 700;

            color: #333;

            text-align: center;
        }


        .login-right-wrap h1::after
        {
            content: "";

            display: block;

            width: 45px;

            height: 3px;

            margin: 10px auto 0;

            border-radius: 10px;

            /* BLUE */

            background: #1976d2;
        }


        .login-right-wrap .account-subtitle
        {
            margin: 0 0 30px;

            color: #888;

            font-size: 14px;

            text-align: center;
        }


        .login-right-wrap .form-group
        {
            margin-bottom: 18px;
        }


        .login-right-wrap .form-control
        {
            width: 100%;

            height: 50px;

            padding: 0 16px;

            border: 1px solid #e2e2e2;

            /* LIGHT BLUE */

            border-left: 3px solid #c9e2ff;

            border-radius: 6px;

            background: #fafafa;

            color: #333;

            font-size: 14px;

            transition: all 0.25s ease;
        }


        .login-right-wrap .form-control::placeholder
        {
            color: #999;
        }


        .login-right-wrap .form-control:hover
        {
            border-color: #ccc;

            background: #fff;
        }


        .login-right-wrap .form-control:focus
        {
            /* BLUE */

            border-color: #1976d2;

            border-left-color: #1976d2;

            background: #fff;

            outline: none;

            box-shadow:
                0 0 0 3px rgba(25,118,210,0.10);
        }


        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .login-right-wrap .btn-primary
        {
            width: 100%;

            height: 50px;

            margin-top: 5px;

            border-radius: 6px;

            border: none;

            /* BLUE */

            background: #1976d2;

            border-color: #1976d2;

            color: #fff;

            font-size: 15px;

            font-weight: 600;

            transition: all 0.25s ease;
        }


        .login-right-wrap .btn-primary:hover,
        .login-right-wrap .btn-primary:focus
        {
            /* DARK BLUE */

            background: #1565c0;

            border-color: #1565c0;

            color: #fff;

            transform: translateY(-1px);

            box-shadow:
                0 6px 16px rgba(0,0,0,0.12);
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .login-right-wrap .alert
        {
            border-radius: 6px;

            margin-bottom: 18px;

            font-size: 13px;
        }


        /* =========================================================
           AGENT LOGIN NOTE
        ========================================================= */

        .agent-login-note
        {
            margin-top: 22px;

            padding: 12px 15px;

            border-radius: 6px;

            /* LIGHT BLUE */

            background: #e3f2fd;

            /* BLUE */

            border-left: 3px solid #1976d2;

            color: #666;

            font-size: 13px;

            text-align: center;
        }


        /* =========================================================
           USER LOGIN LINK
        ========================================================= */

        .user-login-link
        {
            margin-top: 20px;

            text-align: center;

            font-size: 14px;

            color: #777;
        }


        .user-login-link a
        {
            /* BLUE */

            color: #1976d2;

            font-weight: 600;

            margin-left: 3px;
        }


        .user-login-link a:hover
        {
            /* DARK BLUE */

            color: #1565c0;

            text-decoration: none;
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 991.98px)
        {

            .page-banner
            {
                min-height: 400px;
            }

        }


        @media (max-width: 575.98px)
        {

            .page-banner
            {
                width: calc(100% - 20px);

                min-height: 350px;

                margin-left: 10px;

                margin-right: 10px;

                background-attachment: scroll;
            }


            .login-body
            {
                padding-top: 40px;

                padding-bottom: 50px;
            }


            .loginbox
            {
                margin: 0 10px;

                border-radius: 8px;
            }


            .login-right-wrap
            {
                padding: 35px 25px 32px;
            }


            .login-right-wrap h1
            {
                font-size: 27px;
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
                                Agent Login
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
                                        Home
                                    </a>

                                </li>


                                <li
                                    class="breadcrumb-item active"
                                >

                                    Agent Login

                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             LOGIN
        ====================================================== -->

        <div
            class="page-wrappers login-body full-row bg-gray"
        >

            <div class="login-wrapper">

                <div class="container">

                    <div class="loginbox">

                        <div class="login-right">

                            <div class="login-right-wrap">


                                <h1>
                                    Agent Login
                                </h1>


                                <p class="account-subtitle">
                                    Access your Agent dashboard
                                </p>


                                <?php echo $error; ?>

                                <?php echo $msg; ?>


                                <!-- =================================================
                                     LOGIN FORM
                                ================================================== -->

                                <form method="post">


                                    <div class="form-group">

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Agent Email*"
                                            required
                                        >

                                    </div>


                                    <div class="form-group">

                                        <input
                                            type="password"
                                            name="pass"
                                            class="form-control"
                                            placeholder="Agent Password*"
                                            required
                                        >

                                    </div>


                                    <button
                                        class="btn btn-primary"
                                        name="login"
                                        value="Login"
                                        type="submit"
                                    >

                                        Login

                                    </button>


                                </form>


                                <div class="agent-login-note">

                                    Only registered Agent accounts
                                    can access this panel.

                                </div>


                                <div class="user-login-link">

                                    Are you a regular user?

                                    <a href="../login.php">
                                        User Login
                                    </a>

                                </div>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             FOOTER
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
     JS
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
     BANNER SCROLL EFFECT
========================================================= -->

<script>

window.addEventListener("scroll", function () {

    const banner =
        document.querySelector(".page-banner");

    if (!banner) return;

    const rect =
        banner.getBoundingClientRect();

    const bannerHeight =
        banner.offsetHeight;

    const windowHeight =
        window.innerHeight;

    let progress =
        (windowHeight - rect.top) /
        (windowHeight + bannerHeight);

    progress =
        Math.max(
            0,
            Math.min(
                1,
                progress
            )
        );

    const moveY =
        -(progress * 150);

    banner.style.backgroundPosition =
        "center " + moveY + "px";

});


window.addEventListener("resize", function () {

    const banner =
        document.querySelector(".page-banner");

    if (!banner) return;

    const rect =
        banner.getBoundingClientRect();

    const bannerHeight =
        banner.offsetHeight;

    const windowHeight =
        window.innerHeight;

    let progress =
        (windowHeight - rect.top) /
        (windowHeight + bannerHeight);

    progress =
        Math.max(
            0,
            Math.min(
                1,
                progress
            )
        );

    const moveY =
        -(progress * 150);

    banner.style.backgroundPosition =
        "center " + moveY + "px";

});

</script>


</body>

</html>