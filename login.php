<?php 

session_start();

include("config.php");

$error="";
$msg="";


if(isset($_REQUEST['login']))
{
    $email=$_REQUEST['email'];
    $pass=$_REQUEST['pass'];
    
    if(!empty($email) && !empty($pass))
    {
        $sql = "SELECT * FROM user WHERE uemail='$email' AND upass='$pass'";
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_array($result);

        if($row)
        {
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['uemail'] = $row['uemail'];
            $_SESSION['utype'] = $row['utype'];

            /*
             * Redirect according to user type
             *
             * Agent -> Agent Dashboard
             * Normal User -> Normal User Homepage
             */

            if(strtolower(trim($row['utype'])) == 'agent')
            {
                header("Location: agent/dashboard.php");
                exit;
            }
            else
            {
                header("Location: index.php");
                exit;
            }
        }
        else
        {
            $error = "<p class='alert alert-warning'>Login Not Successfully</p> ";
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

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
>


<!-- Meta Tags -->

<meta http-equiv="X-UA-Compatible" content="IE=edge">


<link
    rel="shortcut icon"
    href="images/favicon.ico"
>


<!-- Fonts
========================================================-->

<link
    href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap"
    rel="stylesheet"
>

<link
    href="https://fonts.googleapis.com/css?family=Comfortaa:400,700"
    rel="stylesheet"
>


<!-- Css Link
========================================================-->

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


<!-- =========================================================
     LOGIN BANNER CSS
========================================================= -->

<style>

.page-banner
{
    width: calc(100% - 40px);

    min-height: 420px;

    margin-left: 20px;
    margin-right: 20px;

    background-image:
        url('images/loginimg.jpg') !important;

    background-size: cover;

    background-position: center center;

    background-repeat: no-repeat;

    background-attachment: scroll;

    position: relative;
}


/* Dark overlay */

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


/* Keep banner content above image */

.page-banner .container
{
    position: relative;

    z-index: 1;
}


/* Remove breadcrumb */

.page-banner .breadcrumb-item + .breadcrumb-item::before
{
    display: none !important;
}


.page-banner .breadcrumb
{
    display: none !important;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991.98px)
{

    .page-banner
    {
        min-height: 400px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 575.98px)
{

    .page-banner
    {
        width: calc(100% - 30px);

        min-height: 350px;

        margin-left: 15px;
        margin-right: 15px;

        background-attachment: scroll;
    }

}


/* =========================================================
   LOGIN FORM - BLUE COLOR ACCENTS
========================================================= */

.loginbox
{
    border-top: 4px solid #1976d2;
}


.login-right-wrap h1
{
    color: #3f3f3f;
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


.login-right-wrap .form-control
{
    border-left: 3px solid #c9e2ff;
}


.login-right-wrap .form-control:focus
{
    border-left-color: #1976d2;
}


.login-right-wrap .btn-primary
{
    background: #1976d2;

    border-color: #1976d2;

    color: #fff;
}


.login-right-wrap .btn-primary:hover,
.login-right-wrap .btn-primary:focus
{
    background: #1565c0;

    border-color: #1565c0;

    color: #fff;
}


.dont-have a
{
    color: #1976d2;
}


.dont-have a:hover
{
    color: #1565c0;

    text-decoration: none;
}


/* =========================================================
   LOGIN FORM - CLEAN MODERN STYLING
   Only the login form is changed.
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
    border-color: #1976d2;

    background: #fff;

    outline: none;

    box-shadow:
        0 0 0 3px rgba(25,118,210,0.10);
}


.login-right-wrap .btn-primary
{
    width: 100%;

    height: 50px;

    margin-top: 5px;

    border-radius: 6px;

    border: none;

    background: #1976d2;

    border-color: #1976d2;

    color: #fff;

    font-size: 15px;

    font-weight: 600;

    transition: all 0.25s ease;
}


.login-right-wrap .btn-primary:hover
{
    background: #1565c0;

    transform: translateY(-1px);

    box-shadow:
        0 6px 16px rgba(0,0,0,0.12);
}


.login-right-wrap .alert
{
    border-radius: 6px;

    margin-bottom: 18px;

    font-size: 13px;
}


.dont-have
{
    margin-top: 24px;

    color: #777;

    font-size: 14px;
}


.dont-have a
{
    font-weight: 600;

    margin-left: 3px;
}


/* =========================================================
   MOBILE LOGIN
========================================================= */

@media (max-width: 575.98px)
{

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


/* =========================================================
   MOBILE BANNER SIDE SPACE
========================================================= */

@media (max-width: 575.98px)
{

    .page-banner
    {
        width: calc(100% - 20px);

        margin-left: 10px;

        margin-right: 10px;
    }

}

</style>


<!-- Title
=========================================================-->

<title>Homex - Real Estate Template</title>

</head>


<body>


<div id="page-wrapper">


    <div class="row">


        <!-- Header start -->

        <?php include("include/header.php");?>

        <!-- Header end -->


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
                                Login
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

                                    <a href="#">
                                        Home
                                    </a>

                                </li>


                                <li class="breadcrumb-item active">

                                    Login

                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>

        <!-- Banner end -->


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
                                    Login
                                </h1>


                                <p class="account-subtitle">
                                    Access to our dashboard
                                </p>


                                <?php echo $error; ?>

                                <?php echo $msg; ?>


                                <!-- Login Form -->

                                <form method="post">


                                    <div class="form-group">

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Your Email*"
                                        >

                                    </div>


                                    <div class="form-group">

                                        <input
                                            type="password"
                                            name="pass"
                                            class="form-control"
                                            placeholder="Your Password"
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


                                <div
                                    class="text-center dont-have"
                                >

                                    Don't have an account?

                                    <a href="register.php">
                                        Register
                                    </a>

                                </div>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Login end -->


        <!-- Footer start -->

        <?php include("include/footer.php");?>

        <!-- Footer end -->


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

        <!-- End Scroll To top -->


    </div>

</div>


<!-- Wrapper End -->


<!-- =========================================================
     JS LINKS
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
     LOGIN BANNER SCROLL EFFECT
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


    /*
     * Controls vertical image movement.
     * Increase 150 for stronger scrolling.
     */

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