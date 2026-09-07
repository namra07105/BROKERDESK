<?php

include("../config.php");

$error = "";
$msg = "";


/* =========================================================
   CONTACT FORM
========================================================= */

if(isset($_POST['send']))
{
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if(
        !empty($name) &&
        !empty($email) &&
        !empty($phone) &&
        !empty($subject) &&
        !empty($message)
    )
    {
        $sql = "INSERT INTO contact
                (name,email,phone,subject,message)
                VALUES
                ('$name','$email','$phone','$subject','$message')";

        $result = mysqli_query($con, $sql);

        if($result)
        {
            $msg = "<p class='alert alert-success'>Message Send Successfully</p>";
        }
        else
        {
            $error = "<p class='alert alert-warning'>Message Not Send Successfully</p>";
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

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
>


<link
    rel="shortcut icon"
    href="../images/favicon.ico"
>


<link
    href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&display=swap"
    rel="stylesheet"
>


<link
    href="https://fonts.googleapis.com/css?family=Comfortaa:400,700&display=swap"
    rel="stylesheet"
>


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


<style>

/* =========================================================
   GLOBAL
========================================================= */

body
{
    background: #f7f8fa;

    font-family: 'Muli', sans-serif;
}

#page-wrapper
{
    overflow: hidden;
}

*
{
    box-sizing: border-box;
}


/* =========================================================
   CONTACT HERO
========================================================= */

.scroll-house-banner
{
    position: relative;

    width: calc(100% - 40px);

    height: 430px;

    margin-left: 20px;

    margin-right: 20px;

    overflow: hidden;

    background: #111;
}


/* =========================================================
   HERO IMAGE
========================================================= */

.scroll-house-image
{
    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    height: auto;

    min-height: 100%;

    object-fit: cover;

    object-position: center center;

    display: block;

    transform: translateY(0px);

    will-change: transform;

    transition: transform 0.08s linear;
}


/* =========================================================
   HERO OVERLAY
========================================================= */

.scroll-house-banner::after
{
    content: "";

    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    height: 100%;

    background:
        linear-gradient(
            90deg,
            rgba(0,0,0,0.72) 0%,
            rgba(0,0,0,0.48) 45%,
            rgba(0,0,0,0.20) 100%
        );

    z-index: 1;
}


/* =========================================================
   HERO CONTENT
========================================================= */

.scroll-house-content
{
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


.scroll-house-content .container
{
    position: relative;

    z-index: 3;
}


.scroll-house-content .page-name
{
    color: #ffffff !important;

    font-family: 'Comfortaa', sans-serif;

    font-size: 48px;

    font-weight: 700;

    letter-spacing: 1px;

    text-shadow:
        0 3px 15px rgba(0,0,0,0.45);

    margin: 0 !important;
}


.scroll-house-content .page-name::after
{
    display: none !important;
}


.scroll-house-content .breadcrumb,
.scroll-house-content .breadcrumb-item
{
    display: none !important;
}


/* =========================================================
   CONTACT SECTION
========================================================= */

.full-row
{
    padding: 90px 0;

    background: #f7f8fa;
}


.contact-main-row
{
    align-items: stretch;
}


/* =========================================================
   CONTACT INFORMATION CARD
========================================================= */

.contact-card
{
    height: 100%;

    padding: 42px 38px;

    background:
        linear-gradient(
            145deg,
            #078b61 0%,
            #046f50 100%
        );

    border-radius: 18px;

    box-shadow:
        0 18px 45px rgba(0,0,0,0.13);

    position: relative;

    overflow: hidden;
}


.contact-card::before
{
    content: "";

    position: absolute;

    width: 210px;

    height: 210px;

    border-radius: 50%;

    background:
        rgba(255,255,255,0.07);

    top: -90px;

    right: -80px;
}


.contact-card::after
{
    content: "";

    position: absolute;

    width: 160px;

    height: 160px;

    border-radius: 50%;

    background:
        rgba(255,255,255,0.05);

    bottom: -70px;

    left: -60px;
}


/* =========================================================
   CONTACT HEADING
========================================================= */

.contact-card h3
{
    position: relative;

    z-index: 2;

    font-family: 'Comfortaa', sans-serif;

    font-size: 28px;

    font-weight: 700;

    margin-bottom: 35px !important;

    color: #fff !important;
}


.contact-card h3::after
{
    content: "";

    display: block;

    width: 48px;

    height: 3px;

    background:
        rgba(255,255,255,0.8);

    border-radius: 5px;

    margin-top: 12px;
}


/* =========================================================
   CONTACT LIST
========================================================= */

.contact-card ul
{
    list-style: none;

    padding: 0;

    margin: 0;

    position: relative;

    z-index: 2;
}


.contact-card ul li
{
    display: flex;

    align-items: flex-start;

    padding: 20px 0;

    margin: 0 !important;

    border-bottom:
        1px solid rgba(255,255,255,0.16);
}


.contact-card ul li:last-child
{
    border-bottom: none;
}


/* =========================================================
   CONTACT ICON
========================================================= */

.contact-card ul li > i
{
    flex-shrink: 0;

    width: 45px;

    height: 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    background:
        rgba(255,255,255,0.13);

    border-radius: 12px;

    font-size: 16px;

    margin-right: 15px !important;

    margin-top: 0 !important;
}


/* =========================================================
   CONTACT TEXT
========================================================= */

.contact-address h5
{
    font-family: 'Comfortaa', sans-serif;

    font-size: 15px;

    font-weight: 700;

    margin-bottom: 8px;

    color: #fff !important;
}


.contact-address span
{
    display: block;

    color:
        rgba(255,255,255,0.78) !important;

    font-size: 14px;

    line-height: 1.8;
}


/* =========================================================
   FORM CARD
========================================================= */

.contact-form-card
{
    background: #fff;

    border-radius: 18px;

    padding: 48px 48px 50px;

    box-shadow:
        0 15px 45px rgba(0,0,0,0.08);

    border:
        1px solid rgba(0,0,0,0.04);
}


/* =========================================================
   FORM HEADING
========================================================= */

.contact-form-card h2
{
    font-family: 'Comfortaa', sans-serif;

    font-size: 30px;

    font-weight: 700;

    color: #333 !important;

    text-align: left !important;

    margin-bottom: 35px !important;

    position: relative;
}


.contact-form-card h2::after
{
    content: "";

    display: block;

    width: 55px;

    height: 3px;

    background: #17a673;

    border-radius: 5px;

    margin-top: 13px;
}


/* =========================================================
   FORM INPUTS
========================================================= */

.contact-form-card .form-group
{
    margin-bottom: 20px;
}


.contact-form-card .form-control
{
    width: 100%;

    height: 54px;

    border:
        1px solid #e2e5e8;

    border-radius: 10px;

    background: #fafbfc;

    padding: 0 17px;

    font-family: 'Muli', sans-serif;

    font-size: 14px;

    color: #333;

    box-shadow: none;

    transition:
        border-color 0.25s ease,
        background 0.25s ease,
        box-shadow 0.25s ease,
        transform 0.25s ease;
}


.contact-form-card textarea.form-control
{
    height: 145px;

    padding: 15px 17px;

    resize: vertical;
}


.contact-form-card .form-control::placeholder
{
    color: #9ba1a7;

    opacity: 1;
}


.contact-form-card .form-control:focus
{
    border-color: #17a673;

    background: #fff;

    box-shadow:
        0 0 0 3px rgba(23,166,115,0.10);

    outline: none;

    transform: translateY(-1px);
}


/* =========================================================
   SEND BUTTON
========================================================= */

.contact-form-card .btn-primary
{
    min-width: 170px;

    height: 52px;

    padding: 0 28px;

    border: none;

    border-radius: 10px;

    background:
        linear-gradient(
            135deg,
            #17b77e,
            #078b61
        );

    color: #fff;

    font-family: 'Muli', sans-serif;

    font-size: 14px;

    font-weight: 700;

    letter-spacing: 0.3px;

    box-shadow:
        0 8px 20px rgba(7,139,97,0.22);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        filter 0.25s ease;
}


.contact-form-card .btn-primary:hover
{
    transform: translateY(-2px);

    box-shadow:
        0 12px 25px rgba(7,139,97,0.30);

    filter: brightness(1.03);
}


.contact-form-card .btn-primary:active
{
    transform: translateY(0);
}


/* =========================================================
   ALERT
========================================================= */

.contact-form-card .alert
{
    border: none;

    border-radius: 10px;

    padding: 13px 16px;

    font-size: 13px;

    margin-bottom: 25px;
}


/* =========================================================
   MAP
========================================================= */

.contact-map
{
    width: 100%;

    height: 450px;

    display: block;

    border: 0;

    margin-bottom: 60px;

    filter: grayscale(15%);

    transition:
        filter 0.3s ease;
}


.contact-map:hover
{
    filter: grayscale(0%);
}


/* =========================================================
   SCROLL TOP
========================================================= */

#scroll
{
    border-radius: 8px !important;

    width: 42px !important;

    height: 42px !important;

    display: flex !important;

    align-items: center;

    justify-content: center;

    box-shadow:
        0 6px 18px rgba(0,0,0,0.18);

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}


#scroll:hover
{
    transform: translateY(-3px);

    box-shadow:
        0 9px 22px rgba(0,0,0,0.23);
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px)
{

    .scroll-house-banner
    {
        width: calc(100% - 40px);

        margin-left: 20px;

        margin-right: 20px;

        height: 390px;
    }


    .scroll-house-content .page-name
    {
        font-size: 40px;
    }


    .full-row
    {
        padding: 65px 0;
    }


    .contact-card
    {
        margin-bottom: 30px;

        padding: 35px 30px;
    }


    .contact-form-card
    {
        padding: 40px 32px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px)
{

    .scroll-house-banner
    {
        width: calc(100% - 30px);

        margin-left: 15px;

        margin-right: 15px;

        height: 350px;
    }


    .scroll-house-image
    {
        width: auto;

        height: 100%;

        min-width: 100%;

        object-fit: cover;
    }


    .scroll-house-content .page-name
    {
        font-size: 32px;

        letter-spacing: 0.5px;
    }


    .full-row
    {
        padding: 50px 15px;
    }


    .contact-card
    {
        padding: 32px 25px;

        border-radius: 15px;

        margin-bottom: 25px;
    }


    .contact-card h3
    {
        font-size: 24px;
    }


    .contact-card ul li
    {
        padding: 18px 0;
    }


    .contact-form-card
    {
        padding: 32px 20px 35px;

        border-radius: 15px;
    }


    .contact-form-card h2
    {
        font-size: 25px;

        margin-bottom: 28px !important;
    }


    .contact-form-card .form-control
    {
        height: 52px;
    }


    .contact-form-card textarea.form-control
    {
        height: 125px;
    }


    .contact-form-card .btn-primary
    {
        width: 100%;

        height: 52px;
    }


    .contact-map
    {
        height: 350px;

        margin-bottom: 45px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px)
{

    .scroll-house-banner
    {
        width: calc(100% - 20px);

        margin-left: 10px;

        margin-right: 10px;

        height: 300px;
    }


    .scroll-house-content .page-name
    {
        font-size: 27px;
    }


    .contact-card
    {
        padding: 28px 20px;
    }


    .contact-address span
    {
        font-size: 13px;
    }


    .contact-form-card
    {
        padding: 28px 16px 30px;
    }


    .contact-form-card h2
    {
        font-size: 23px;
    }


    .contact-map
    {
        margin-bottom: 35px;
    }

}

</style>

</head>


<body>


<div id="page-wrapper">


    <div class="row">


        <!-- =================================================
             AGENT HEADER
        ================================================== -->

        <?php include("header.php"); ?>


        <!-- =================================================
             CONTACT BANNER
        ================================================== -->

        <div
            class="scroll-house-banner"
            id="houseBanner"
        >


            <img
                src="../images/contactus.jpg"
                alt="Contact Us"
                class="scroll-house-image"
                id="houseImage"
            >


            <div class="scroll-house-content">


                <div class="container">


                    <div class="row">


                        <div class="col-md-12">


                            <h2
                                class="page-name text-uppercase mt-1 mb-0"
                            >

                                <b>
                                    Contact Us
                                </b>

                            </h2>


                        </div>


                    </div>


                </div>


            </div>


        </div>



        <!-- =================================================
             CONTACT SECTION
        ================================================== -->

        <div class="full-row">


            <div class="container">


                <div class="row contact-main-row">


                    <!-- =================================================
                         CONTACT INFORMATION
                    ================================================== -->

                    <div
                        class="col-lg-4 mb-5 mb-lg-0"
                    >


                        <div class="contact-card">


                            <div class="contact-info">


                                <h3>
                                    Contacts
                                </h3>


                                <ul>


                                    <!-- ADDRESS -->

                                    <li>


                                        <i
                                            class="fas fa-map-marker-alt text-white"
                                        ></i>


                                        <div
                                            class="contact-address"
                                        >


                                            <h5>
                                                Address
                                            </h5>


                                            <span>

                                                BrokerDesk Real Estate Office<br>

                                                204, Shivalik Avenue,<br>

                                                C.G. Road, Navrangpura,<br>

                                                Ahmedabad, Gujarat – 380009<br>

                                                India

                                            </span>


                                        </div>


                                    </li>



                                    <!-- PHONE -->

                                    <li>


                                        <i
                                            class="fas fa-phone-alt text-white"
                                        ></i>


                                        <div
                                            class="contact-address"
                                        >


                                            <h5>
                                                Call Us
                                            </h5>


                                            <span>
                                                6356253237
                                            </span>


                                            <span>
                                                9876543210
                                            </span>


                                        </div>


                                    </li>



                                    <!-- EMAIL -->

                                    <li>


                                        <i
                                            class="fas fa-envelope text-white"
                                        ></i>


                                        <div
                                            class="contact-address"
                                        >


                                            <h5>
                                                Email Address
                                            </h5>


                                            <span>
                                                kashvi@gmail.com
                                            </span>


                                            <span>
                                                dipali@homex.com
                                            </span>


                                        </div>


                                    </li>


                                </ul>


                            </div>


                        </div>


                    </div>



                    <!-- =================================================
                         SPACE BETWEEN COLUMNS
                    ================================================== -->

                    <div
                        class="col-lg-1 d-none d-lg-block"
                    ></div>



                    <!-- =================================================
                         CONTACT FORM
                    ================================================== -->

                    <div
                        class="col-md-12 col-lg-7"
                    >


                        <div
                            class="contact-form-card"
                        >


                            <h2>
                                Get In Touch
                            </h2>


                            <?php echo $msg; ?>


                            <?php echo $error; ?>


                            <form
                                class="w-100"
                                action=""
                                method="post"
                            >


                                <div class="row">


                                    <!-- NAME -->

                                    <div
                                        class="form-group col-lg-6"
                                    >

                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            placeholder="Your Name*"
                                        >

                                    </div>



                                    <!-- EMAIL -->

                                    <div
                                        class="form-group col-lg-6"
                                    >

                                        <input
                                            type="text"
                                            name="email"
                                            class="form-control"
                                            placeholder="Email Address*"
                                        >

                                    </div>



                                    <!-- PHONE -->

                                    <div
                                        class="form-group col-lg-6"
                                    >

                                        <input
                                            type="text"
                                            name="phone"
                                            class="form-control"
                                            placeholder="Phone"
                                            maxlength="10"
                                        >

                                    </div>



                                    <!-- SUBJECT -->

                                    <div
                                        class="form-group col-lg-6"
                                    >

                                        <input
                                            type="text"
                                            name="subject"
                                            class="form-control"
                                            placeholder="Subject"
                                        >

                                    </div>



                                    <!-- MESSAGE -->

                                    <div
                                        class="col-lg-12"
                                    >


                                        <div
                                            class="form-group"
                                        >


                                            <textarea
                                                name="message"
                                                class="form-control"
                                                rows="5"
                                                placeholder="Type Comments..."
                                            ></textarea>


                                        </div>


                                    </div>


                                </div>



                                <button
                                    type="submit"
                                    value="send message"
                                    name="send"
                                    class="btn btn-primary"
                                >

                                    Send Message

                                </button>


                            </form>


                        </div>


                    </div>


                </div>


            </div>


        </div>



        <!-- =================================================
             MAP
        ================================================== -->

        <iframe
            class="contact-map"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29921.88989279091!2d72.89392697798161!3d20.373147326844283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be0d1d69db97345%3A0x8bc4433aecadadfd!2sROFEL%20ARTS%20%26%20COMMERCE%20COLLEGE!5e0!3m2!1sen!2sin!4v1585740130321!5m2!1sen!2sin"
            width="100%"
            height="450"
            frameborder="0"
            allowfullscreen=""
            aria-hidden="false"
            tabindex="0">
        </iframe>



        <!-- =================================================
             AGENT FOOTER
        ================================================== -->

        <?php include("footer.php"); ?>


        <!-- =================================================
             SCROLL TO TOP
        ================================================== -->

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

<script src="../js/jquery.cookie.js"></script>

<script src="../js/custom.js"></script>



<!-- =========================================================
     HERO IMAGE SCROLL EFFECT
========================================================= -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function()
    {

        const banner =
            document.getElementById("houseBanner");

        const image =
            document.getElementById("houseImage");


        if(!banner || !image)
        {
            return;
        }


        function moveHouseImage()
        {

            const imageHeight =
                image.offsetHeight;


            const bannerHeight =
                banner.offsetHeight;


            const maximumMovement =
                Math.max(
                    0,
                    imageHeight - bannerHeight
                );


            const rect =
                banner.getBoundingClientRect();


            let progress =
                (
                    window.innerHeight -
                    rect.top
                ) /
                (
                    window.innerHeight +
                    rect.height
                );


            progress =
                Math.max(
                    0,
                    Math.min(
                        1,
                        progress
                    )
                );


            const moveY =
                -(maximumMovement * progress);


            image.style.transform =
                "translateY(" +
                moveY +
                "px)";

        }


        window.addEventListener(
            "scroll",
            moveHouseImage,
            {
                passive: true
            }
        );


        window.addEventListener(
            "resize",
            moveHouseImage
        );


        image.addEventListener(
            "load",
            moveHouseImage
        );


        moveHouseImage();

    }
);

</script>


</body>

</html>