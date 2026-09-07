<?php 

include("config.php");

$error="";
$msg="";


/* =========================================================
   REGISTRATION
========================================================= */

if(isset($_REQUEST['reg']))
{
    $name=$_REQUEST['name'];
    $email=$_REQUEST['email'];
    $phone=$_REQUEST['phone'];
    $pass=$_REQUEST['pass'];
    $utype=$_REQUEST['utype'];
    
    $uimage=$_FILES['uimage']['name'];
    $temp_name1 = $_FILES['uimage']['tmp_name'];
    
    
    /* =====================================================
       CHECK EXISTING EMAIL
    ===================================================== */

    $query = "SELECT * FROM user where uemail='$email'";

    $res=mysqli_query($con, $query);

    $num=mysqli_num_rows($res);
    
    
    if($num == 1)
    {
        $error =
        "<p class='alert alert-warning register-alert'>
            Email Id already Exist
        </p>";
    }
    else
    {
        
        if(
            !empty($name) &&
            !empty($email) &&
            !empty($phone) &&
            !empty($pass) &&
            !empty($uimage)
        )
        {
            
            $sql="INSERT INTO user
            (uname,uemail,uphone,upass,utype,uimage)
            VALUES
            ('$name','$email','$phone','$pass','$utype','$uimage')";
            
            
            $result=mysqli_query($con, $sql);
            
            
            move_uploaded_file(
                $temp_name1,
                "admin/user/$uimage"
            );
            
            
            if($result)
            {
                $msg =
                "<p class='alert alert-success register-alert'>
                    Register Successfully
                </p>";
            }
            else
            {
                $error =
                "<p class='alert alert-warning register-alert'>
                    Register Not Successfully
                </p>";
            }
        }
        else
        {
            $error =
            "<p class='alert alert-warning register-alert'>
                Please Fill all the fields
            </p>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

<!-- Required meta tags -->

<meta charset="utf-8">

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge"
>

<meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
>


<!-- Meta Tags -->

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge"
>


<link
    rel="shortcut icon"
    href="images/favicon.ico"
>


<!-- Fonts -->

<link
    href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap"
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


<title>Register - BROKERDESK</title>


<style>

/* =========================================================
   BLUE THEME
========================================================= */

:root
{
    --blue: #1976d2;
    --blue-dark: #1565c0;
    --blue-light: #e3f2fd;
    --blue-border: #c9e2ff;

    --text-dark: #333;
    --text-light: #777;

    --background: #f7f9fc;
}


/* =========================================================
   PAGE BANNER
========================================================= */

.page-banner
{
    width: calc(100% - 40px);

    height: 420px;

    margin-left: 20px;
    margin-right: 20px;

    background-image:
        url('images/registerimg.jpg') !important;

    background-size: cover;

    background-position: center 0px;

    background-repeat: no-repeat;

    position: relative;

    overflow: hidden;

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

    background:
        linear-gradient(
            90deg,
            rgba(0,0,0,0.62),
            rgba(0,0,0,0.35)
        );

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


.page-banner .page-name
{
    font-size: 42px;

    font-weight: 700;

    letter-spacing: 1px;

    text-shadow:
        0 3px 12px rgba(0,0,0,0.4);
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
   REGISTER BODY
========================================================= */

.register-body
{
    padding-top: 65px;

    padding-bottom: 75px;

    background: #f7f9fc;
}


/* =========================================================
   REGISTER BOX
========================================================= */

.registerbox
{
    max-width: 560px;

    margin: 0 auto;

    background: #ffffff;

    border-radius: 14px;

    border: 1px solid #edf0f4;

    border-top: 4px solid var(--blue);

    box-shadow:
        0 12px 40px rgba(0,0,0,0.08);

    overflow: hidden;
}


/* =========================================================
   REGISTER WRAPPER
========================================================= */

.register-right
{
    width: 100%;
}


.register-right-wrap
{
    width: 100%;

    padding: 42px 48px 40px;
}


/* =========================================================
   TITLE
========================================================= */

.register-right-wrap h1
{
    margin: 0 0 8px;

    font-size: 30px;

    font-weight: 700;

    color: #333;

    text-align: center;
}


.register-right-wrap h1::after
{
    content: "";

    display: block;

    width: 50px;

    height: 3px;

    margin: 11px auto 0;

    border-radius: 10px;

    background: var(--blue);
}


/* =========================================================
   SUBTITLE
========================================================= */

.account-subtitle
{
    margin: 0 0 30px;

    color: #888;

    font-size: 14px;

    text-align: center;
}


/* =========================================================
   ALERTS
========================================================= */

.register-alert
{
    border-radius: 7px;

    margin-bottom: 20px;

    font-size: 13px;
}


/* =========================================================
   FORM GROUP
========================================================= */

.register-form .form-group
{
    margin-bottom: 18px;
}


/* =========================================================
   INPUTS
========================================================= */

.register-form .form-control
{
    width: 100%;

    height: 50px;

    padding: 0 16px;

    border: 1px solid #e0e5eb;

    border-left: 3px solid var(--blue-border);

    border-radius: 7px;

    background: #fafcff;

    color: #333;

    font-size: 14px;

    transition: all 0.25s ease;
}


.register-form .form-control:hover
{
    background: #fff;

    border-color: #cfd6de;
}


.register-form .form-control:focus
{
    border-color: var(--blue-border);

    border-left-color: var(--blue);

    background: #fff;

    outline: none;

    box-shadow:
        0 0 0 3px rgba(25,118,210,0.10);
}


.register-form .form-control::placeholder
{
    color: #999;
}


/* =========================================================
   PASSWORD FIELD
========================================================= */

.register-form input[name="pass"]
{
    letter-spacing: 0.3px;
}


/* =========================================================
   ACCOUNT TYPE
========================================================= */

.account-type-title
{
    display: block;

    margin: 25px 0 12px;

    font-size: 14px;

    font-weight: 600;

    color: #444;
}


.account-types
{
    display: flex;

    gap: 10px;

    flex-wrap: wrap;

    margin-bottom: 24px;
}


.account-type
{
    flex: 1;

    min-width: 100px;

    position: relative;
}


.account-type input
{
    position: absolute;

    opacity: 0;

    pointer-events: none;
}


.account-type label
{
    display: block;

    text-align: center;

    padding: 11px 10px;

    border: 1px solid #dfe5ec;

    border-radius: 7px;

    background: #fafcff;

    color: #555;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;

    transition: all 0.25s ease;
}


.account-type label:hover
{
    border-color: var(--blue);

    color: var(--blue);

    background: var(--blue-light);
}


.account-type input:checked + label
{
    background: var(--blue);

    border-color: var(--blue);

    color: #fff;

    box-shadow:
        0 4px 12px rgba(25,118,210,0.20);
}


/* =========================================================
   IMAGE UPLOAD
========================================================= */

.image-upload
{
    margin-top: 8px;

    margin-bottom: 25px;
}


.image-upload-label
{
    display: block;

    font-size: 14px;

    font-weight: 600;

    color: #444;

    margin-bottom: 8px;
}


.image-upload-box
{
    border: 1px dashed var(--blue-border);

    border-radius: 8px;

    padding: 14px;

    background: #f8fbff;

    transition: all 0.25s ease;
}


.image-upload-box:hover
{
    border-color: var(--blue);

    background: var(--blue-light);
}


.image-upload-box input[type="file"]
{
    width: 100%;

    font-size: 13px;

    color: #666;
}


/* =========================================================
   REGISTER BUTTON
========================================================= */

.register-submit
{
    width: 100%;

    height: 50px;

    border: none;

    border-radius: 7px;

    background: var(--blue);

    color: #fff;

    font-size: 15px;

    font-weight: 600;

    transition: all 0.25s ease;
}


.register-submit:hover,
.register-submit:focus
{
    background: var(--blue-dark);

    color: #fff;

    transform: translateY(-1px);

    box-shadow:
        0 6px 18px rgba(25,118,210,0.25);
}


/* =========================================================
   OR DIVIDER
========================================================= */

.register-or
{
    display: flex;

    align-items: center;

    gap: 12px;

    margin: 28px 0 20px;
}


.register-or-line
{
    flex: 1;

    height: 1px;

    background: #e5e8ec;
}


.register-or-text
{
    color: #999;

    font-size: 12px;

    font-weight: 600;

    text-transform: uppercase;
}


/* =========================================================
   SOCIAL LOGIN
========================================================= 

.social-register
{
    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;
}


.social-register span
{
    color: #777;

    font-size: 13px;

    margin-right: 5px;
}


.social-register a
{
    width: 36px;

    height: 36px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #f2f5f8;

    color: #666;

    text-decoration: none;

    transition: all 0.25s ease;
}


.social-register a:hover
{
    background: var(--blue);

    color: #fff;

    transform: translateY(-2px);
}
*/

/* =========================================================
   LOGIN LINK
========================================================= */

.already-account
{
    margin-top: 25px;

    padding-top: 20px;

    border-top: 1px solid #eeeeee;

    text-align: center;

    color: #777;

    font-size: 14px;
}


.already-account a
{
    color: var(--blue);

    font-weight: 600;

    margin-left: 4px;

    text-decoration: none;
}


.already-account a:hover
{
    color: var(--blue-dark);

    text-decoration: none;
}


/* =========================================================
   SCROLL TO TOP
========================================================= */

#scroll
{
    background: var(--blue) !important;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991.98px)
{

    .page-banner
    {
        height: 400px;
    }


    .register-body
    {
        padding-top: 50px;

        padding-bottom: 60px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 575.98px)
{

    .page-banner
    {
        width: calc(100% - 20px);

        height: 350px;

        margin-left: 10px;

        margin-right: 10px;
    }


    .page-banner .page-name
    {
        font-size: 32px;
    }


    .register-body
    {
        padding-top: 40px;

        padding-bottom: 50px;
    }


    .registerbox
    {
        margin: 0 10px;

        border-radius: 10px;
    }


    .register-right-wrap
    {
        padding: 35px 22px 30px;
    }


    .register-right-wrap h1
    {
        font-size: 27px;
    }


    .account-types
    {
        gap: 7px;
    }


    .account-type
    {
        min-width: 85px;
    }


    .account-type label
    {
        padding: 10px 6px;

        font-size: 12px;
    }


    .social-register
    {
        flex-wrap: wrap;
    }


    .social-register span
    {
        width: 100%;

        text-align: center;

        margin-bottom: 5px;
    }

}

</style>

</head>


<body>


<div id="page-wrapper">

    <div class="row">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <?php include("include/header.php"); ?>


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
                                Register
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

                                    Register

                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             REGISTER
        ====================================================== -->

        <div
            class="page-wrappers register-body full-row"
        >

            <div class="register-wrapper">

                <div class="container">

                    <div class="registerbox">

                        <div class="register-right">

                            <div class="register-right-wrap">


                                <!-- TITLE -->

                                <h1>
                                    Create Account
                                </h1>


                                <p class="account-subtitle">
                                    Register to access your dashboard
                                </p>


                                <!-- ALERTS -->

                                <?php echo $error; ?>

                                <?php echo $msg; ?>


                                <!-- =================================================
                                     REGISTRATION FORM
                                ================================================== -->

                                <form
                                    method="post"
                                    enctype="multipart/form-data"
                                    class="register-form"
                                >


                                    <!-- NAME -->

                                    <div class="form-group">

                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            placeholder="Your Name*"
                                        >

                                    </div>


                                    <!-- EMAIL -->

                                    <div class="form-group">

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Your Email*"
                                        >

                                    </div>


                                    <!-- PHONE -->

                                    <div class="form-group">

                                        <input
                                            type="text"
                                            name="phone"
                                            class="form-control"
                                            placeholder="Your Phone*"
                                            maxlength="10"
                                        >

                                    </div>


                                    <!-- PASSWORD -->

                                    <div class="form-group">

                                        <input
                                            type="text"
                                            name="pass"
                                            class="form-control"
                                            placeholder="Your Password*"
                                        >

                                    </div>


                                    <!-- =================================================
                                         ACCOUNT TYPE
                                    ================================================== -->

                                    <span class="account-type-title">
                                        Select Account Type
                                    </span>


                                    <div class="account-types">


                                        <!-- USER -->

                                        <div class="account-type">

                                            <input
                                                type="radio"
                                                id="type-user"
                                                name="utype"
                                                value="user"
                                                checked
                                            >

                                            <label for="type-user">
                                                User
                                            </label>

                                        </div>


                                        <!-- AGENT -->

                                        <div class="account-type">

                                            <input
                                                type="radio"
                                                id="type-agent"
                                                name="utype"
                                                value="agent"
                                            >

                                            <label for="type-agent">
                                                Agent
                                            </label>

                                        </div>


                                        <!-- BUILDER 

                                        <div class="account-type">

                                            <input
                                                type="radio"
                                                id="type-builder"
                                                name="utype"
                                                value="builder"
                                            >

                                            <label for="type-builder">
                                                Builder
                                            </label>

                                        </div>-->


                                    </div>


                                    <!-- =================================================
                                         USER IMAGE
                                    ================================================== -->

                                    <div class="image-upload">

                                        <label class="image-upload-label">
                                            User Image
                                        </label>


                                        <div class="image-upload-box">

                                            <input
                                                name="uimage"
                                                type="file"
                                            >

                                        </div>

                                    </div>


                                    <!-- =================================================
                                         REGISTER BUTTON
                                    ================================================== -->

                                    <button
                                        class="btn register-submit"
                                        name="reg"
                                        value="Register"
                                        type="submit"
                                    >

                                        Register

                                    </button>


                                </form>


                                <!-- =================================================
                                     OR DIVIDER
                                ================================================== 

                                <div class="register-or">

                                    <span class="register-or-line"></span>

                                    <span class="register-or-text">
                                        or
                                    </span>

                                    <span class="register-or-line"></span>

                                </div>


                               =================================================
                                     SOCIAL REGISTER
                                ================================================== 

                                <div class="social-register">

                                    <span>
                                        Register with
                                    </span>


                                    <a
                                        href="#"
                                        title="Facebook"
                                    >

                                        <i class="fab fa-facebook-f"></i>

                                    </a>


                                    <a
                                        href="#"
                                        title="Google"
                                    >

                                        <i class="fab fa-google"></i>

                                    </a>


                                    <a
                                        href="#"
                                        title="Twitter"
                                    >

                                        <i class="fab fa-twitter"></i>

                                    </a>


                                    <a
                                        href="#"
                                        title="Instagram"
                                    >

                                        <i class="fab fa-instagram"></i>

                                    </a>

                                </div>-->


                                <!-- =================================================
                                     LOGIN LINK
                                ================================================== -->

                                <div class="already-account">

                                    Already have an account?

                                    <a href="login.php">
                                        Login
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

        <?php include("include/footer.php"); ?>


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
     SCROLLABLE ABOUTUSIMG BANNER
========================================================= -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    const banner = document.querySelector(".page-banner");

    if (!banner) return;


    function moveBannerImage()
    {

        const rect = banner.getBoundingClientRect();


        let progress =
            (window.innerHeight - rect.top) /
            (window.innerHeight + rect.height);


        progress =
            Math.max(
                0,
                Math.min(1, progress)
            );


        /*
         * Controls how far aboutusimg.jpg
         * moves vertically.
         */

        const maximumMovement = 420;


        const moveY =
            -(progress * maximumMovement);


        banner.style.backgroundPosition =
            "center " + moveY + "px";

    }


    window.addEventListener(
        "scroll",
        moveBannerImage,
        { passive: true }
    );


    window.addEventListener(
        "resize",
        moveBannerImage
    );


    moveBannerImage();

});

</script>


</body>

</html>