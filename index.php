<?php 

ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

include("config.php");

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

<meta
    name="description"
    content="BROKERDESK - Find your dream property"
>

<meta
    name="keywords"
    content="real estate, property, home, house, rent, sale, broker"
>

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
    <link rel="stylesheet" type="text/css" href="css/responsive-fix.css">
>


<title>BROKERDESK - Real Estate</title>


<style>

/* =========================================================
   GLOBAL
========================================================= */

:root
{
    --blue: #1976d2;
    --blue-dark: #1565c0;
    --blue-light: #e3f2fd;
    --dark: #1f2937;
    --text: #5f6b76;
    --light-bg: #f6f8fb;
    --border: #e6ebf0;
}


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
    background: #ffffff;
    color: var(--text);
}


/* =========================================================
   PAGE WRAPPER
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
    margin: 0 !important;
    display: block;
}


/* =========================================================
   HERO
========================================================= */

.home-hero
{
    width: 100%;
    min-height: 620px;

    position: relative;

    display: flex;
    align-items: center;

    overflow: hidden;

    background-image:
        url('images/indeximg.jpg');

    background-size: cover;

    background-position: center center;

    background-repeat: no-repeat;
}


.home-hero::before
{
    content: "";

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(0,0,0,0.76) 0%,
            rgba(0,0,0,0.55) 45%,
            rgba(0,0,0,0.25) 100%
        );

    z-index: 1;
}


.home-hero .container
{
    position: relative;
    z-index: 2;
}


.hero-content
{
    max-width: 1100px;
    padding: 80px 0;
}


.hero-tag
{
    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 8px 16px;

    margin-bottom: 20px;

    border-radius: 30px;

    background: rgba(25,118,210,0.92);

    color: #ffffff;

    font-size: 13px;

    font-weight: 600;

    letter-spacing: 0.4px;
}


.hero-tag i
{
    font-size: 12px;
}


.hero-title
{
    margin: 0;

    color: #ffffff;

    font-size: 58px;

    line-height: 1.1;

    font-weight: 700;

    letter-spacing: -1px;
}


.hero-title span
{
    color: #64b5f6;
}


.hero-description
{
    max-width: 650px;

    margin: 20px 0 32px;

    color: rgba(255,255,255,0.88);

    font-size: 17px;

    line-height: 1.7;
}


/* =========================================================
   SEARCH PROPERTIES
========================================================= */

.hero-search
{
    width: 100%;

    max-width: 1080px;

    padding: 24px;

    margin-top: 28px;

    position: relative;

    background: rgba(255,255,255,0.98);

    border: 1px solid rgba(255,255,255,0.5);

    border-radius: 16px;

    box-shadow:
        0 20px 55px rgba(0,0,0,0.28);

    backdrop-filter: blur(12px);
}


/* Blue top accent */

.hero-search::before
{
    content: "";

    position: absolute;

    top: 0;

    left: 24px;

    right: 24px;

    height: 3px;

    border-radius:
        0 0 10px 10px;

    background:
        linear-gradient(
            90deg,
            #1976d2,
            #42a5f5
        );
}


/* =========================================================
   SEARCH TITLE
========================================================= */

.hero-search-title
{
    display: flex;

    align-items: center;

    gap: 9px;

    margin-bottom: 18px;

    color: #1f2937;

    font-size: 16px;

    font-weight: 700;
}


.hero-search-title i
{
    width: 34px;

    height: 34px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #e3f2fd;

    color: #1976d2 !important;

    font-size: 14px;
}


/* =========================================================
   SEARCH FORM
========================================================= */

.hero-search .row
{
    margin-left: -6px;

    margin-right: -6px;
}


.hero-search .row > div
{
    padding-left: 6px;

    padding-right: 6px;
}


.hero-search .form-group
{
    margin-bottom: 0;

    position: relative;
}


/* =========================================================
   SEARCH INPUTS
========================================================= */

.hero-search .form-control
{
    width: 100%;

    height: 54px;

    padding: 0 16px;

    border: 1px solid #dce3ea;

    border-radius: 9px;

    background: #ffffff;

    color: #273444;

    font-size: 14px;

    font-weight: 500;

    box-shadow:
        0 3px 10px rgba(0,0,0,0.03);

    transition:
        border-color 0.25s ease,
        box-shadow 0.25s ease,
        transform 0.25s ease;
}


.hero-search .form-control::placeholder
{
    color: #9aa4ae;

    font-weight: 400;
}


.hero-search .form-control:hover
{
    border-color: #b9c8d6;
}


.hero-search .form-control:focus
{
    border-color: #1976d2;

    outline: none;

    box-shadow:
        0 0 0 3px rgba(25,118,210,0.10),
        0 5px 15px rgba(25,118,210,0.08);

    transform: translateY(-1px);
}


.hero-search select.form-control
{
    cursor: pointer;

    appearance: auto;
}


/* =========================================================
   SEARCH BUTTON
========================================================= */

.hero-search .btn
{
    width: 100%;

    height: 54px;

    border: none;

    border-radius: 9px;

    background:
        linear-gradient(
            135deg,
            #1976d2,
            #1565c0
        );

    color: #ffffff;

    font-size: 14px;

    font-weight: 700;

    letter-spacing: 0.2px;

    box-shadow:
        0 7px 18px rgba(25,118,210,0.25);

    transition:
        all 0.25s ease;
}


.hero-search .btn:hover
{
    background:
        linear-gradient(
            135deg,
            #1565c0,
            #0d47a1
        );

    color: #ffffff;

    transform: translateY(-2px);

    box-shadow:
        0 10px 24px rgba(25,118,210,0.32);
}


.hero-search .btn:active
{
    transform: translateY(0);
}


/* =========================================================
   HOME SECTIONS
========================================================= */

.home-section
{
    padding: 85px 0;
}


.home-section.gray
{
    background: var(--light-bg);
}


/* =========================================================
   SECTION HEADING
========================================================= */

.section-heading
{
    text-align: center;

    margin-bottom: 50px;
}


.section-heading h2
{
    margin: 0;

    color: var(--dark);

    font-size: 34px;

    font-weight: 700;
}


.section-heading h2::after
{
    content: "";

    display: block;

    width: 55px;

    height: 3px;

    margin: 14px auto 0;

    border-radius: 10px;

    background: var(--blue);
}


.section-heading p
{
    max-width: 650px;

    margin: 15px auto 0;

    color: #89929b;

    font-size: 14px;

    line-height: 1.7;
}


/* =========================================================
   SERVICE CARDS
========================================================= */

.service-card
{
    height: 100%;

    padding: 32px 25px;

    text-align: center;

    background: #ffffff;

    border: 1px solid var(--border);

    border-radius: 12px;

    box-shadow:
        0 5px 20px rgba(0,0,0,0.04);

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease,
        border-color 0.3s ease;
}


.service-card:hover
{
    transform: translateY(-8px);

    border-color: #c9e2ff;

    box-shadow:
        0 15px 35px rgba(25,118,210,0.12);
}


.service-icon
{
    width: 70px;

    height: 70px;

    margin: 0 auto 20px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: var(--blue-light);

    color: var(--blue);

    font-size: 30px;

    transition: all 0.3s ease;
}


.service-card:hover .service-icon
{
    background: var(--blue);

    color: #ffffff;

    transform: scale(1.05);
}


.service-card h5
{
    margin-bottom: 12px;

    color: var(--dark);

    font-size: 17px;

    font-weight: 700;
}


.service-card h5 a
{
    color: inherit;

    text-decoration: none;
}


.service-card p
{
    margin: 0;

    color: #7a848d;

    font-size: 13px;

    line-height: 1.7;
}


/* =========================================================
   WHY CHOOSE US
========================================================= */

.why-section
{
    position: relative;

    padding: 90px 0;

    background-image:
        url('images/haddyliving.jpg');

    background-size: cover;

    background-position: center;

    background-repeat: no-repeat;

    overflow: hidden;
}


.why-section::before
{
    content: "";

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(20,30,40,0.92),
            rgba(20,30,40,0.72)
        );
}


.why-section .container
{
    position: relative;

    z-index: 2;
}


.why-content
{
    max-width: 700px;
}


.why-title
{
    margin-bottom: 35px;

    color: #ffffff;

    font-size: 35px;

    font-weight: 700;
}


.why-title::after
{
    content: "";

    display: block;

    width: 55px;

    height: 3px;

    margin-top: 13px;

    background: #64b5f6;

    border-radius: 10px;
}


.why-item
{
    display: flex;

    gap: 20px;

    margin-bottom: 28px;
}


.why-icon
{
    width: 55px;

    height: 55px;

    min-width: 55px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: rgba(25,118,210,0.95);

    color: #ffffff;

    font-size: 23px;
}


.why-item h5
{
    margin: 0 0 8px;

    color: #ffffff;

    font-size: 17px;

    font-weight: 700;
}


.why-item p
{
    margin: 0;

    color: rgba(255,255,255,0.78);

    font-size: 13px;

    line-height: 1.7;
}


/* =========================================================
   HOW IT WORKS
========================================================= */

.step-card
{
    position: relative;

    height: 100%;

    padding: 30px 25px;

    text-align: center;

    background: #ffffff;

    border: 1px solid var(--border);

    border-radius: 12px;

    transition: all 0.3s ease;
}


.step-card:hover
{
    transform: translateY(-6px);

    box-shadow:
        0 12px 30px rgba(0,0,0,0.08);
}


.step-number
{
    width: 52px;

    height: 52px;

    margin: 0 auto 20px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: var(--blue);

    color: #ffffff;

    font-size: 18px;

    font-weight: 700;

    box-shadow:
        0 6px 15px rgba(25,118,210,0.25);
}


.step-icon
{
    margin-bottom: 18px;

    color: var(--blue);

    font-size: 38px;
}


.step-card h5
{
    margin-bottom: 12px;

    color: var(--dark);

    font-size: 17px;

    font-weight: 700;
}


.step-card p
{
    margin: 0;

    color: #7b858e;

    font-size: 13px;

    line-height: 1.7;
}


/* =========================================================
   STATISTICS
========================================================= */

.stats-section
{
    position: relative;

    padding: 75px 0;

    background-image:
        url('images/counterbg.jpg');

    background-size: cover;

    background-position: center;

    background-repeat: no-repeat;
}


.stats-section::before
{
    content: "";

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(15,30,45,0.91),
            rgba(15,30,45,0.82)
        );
}


.stats-section .container
{
    position: relative;

    z-index: 2;
}


.stat-box
{
    text-align: center;

    padding: 10px 15px;
}


.stat-icon
{
    width: 65px;

    height: 65px;

    margin: 0 auto;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: rgba(25,118,210,0.18);

    color: #64b5f6;

    font-size: 27px;

    border: 1px solid rgba(100,181,246,0.25);
}


.stat-number
{
    margin: 20px 0 8px;

    color: #ffffff;

    font-size: 38px;

    font-weight: 700;
}


.stat-label
{
    color: rgba(255,255,255,0.78);

    font-size: 13px;

    font-weight: 500;
}


/* =========================================================
   CTA
========================================================= */

.cta-section
{
    padding: 75px 0;

    background: #ffffff;
}


.cta-box
{
    position: relative;

    overflow: hidden;

    padding: 45px 50px;

    border-radius: 14px;

    background:
        linear-gradient(
            135deg,
            #1976d2,
            #1565c0
        );

    box-shadow:
        0 15px 35px rgba(25,118,210,0.20);
}


.cta-box::after
{
    content: "";

    position: absolute;

    width: 250px;

    height: 250px;

    right: -90px;

    top: -100px;

    border-radius: 50%;

    background: rgba(255,255,255,0.08);
}


.cta-content
{
    position: relative;

    z-index: 2;
}


.cta-box h3
{
    margin: 0 0 10px;

    color: #ffffff;

    font-size: 28px;

    font-weight: 700;
}


.cta-box p
{
    margin: 0;

    max-width: 650px;

    color: rgba(255,255,255,0.85);

    font-size: 14px;

    line-height: 1.7;
}


.cta-button
{
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px 24px;

    border-radius: 7px;

    background: #ffffff;

    color: var(--blue);

    font-size: 14px;

    font-weight: 700;

    text-decoration: none;

    transition: all 0.25s ease;
}


.cta-button:hover
{
    color: var(--blue-dark);

    text-decoration: none;

    transform: translateY(-2px);

    box-shadow:
        0 7px 20px rgba(0,0,0,0.15);
}


/* =========================================================
   SCROLL TO TOP
========================================================= */

#scroll
{
    background: var(--blue) !important;

    border-radius: 5px;
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

    .home-hero
    {
        min-height: 580px;
    }


    .hero-title
    {
        font-size: 48px;
    }


    .hero-search
    {
        max-width: 100%;
    }


    .home-section
    {
        padding: 70px 0;
    }


    .section-heading h2
    {
        font-size: 30px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767.98px)
{

    .home-hero
    {
        min-height: 650px;

        background-position: center center;
    }


    .hero-content
    {
        padding: 60px 15px;
    }


    .hero-title
    {
        font-size: 40px;

        line-height: 1.15;
    }


    .hero-description
    {
        font-size: 14px;

        margin-bottom: 25px;
    }


    .hero-search
    {
        padding: 20px;

        margin-top: 20px;

        border-radius: 14px;
    }


    .hero-search::before
    {
        left: 20px;

        right: 20px;
    }


    .hero-search .form-group
    {
        margin-bottom: 10px;
    }


    .hero-search .form-control,
    .hero-search .btn
    {
        height: 50px;
    }


    .home-section
    {
        padding: 60px 0;
    }


    .section-heading
    {
        margin-bottom: 35px;
    }


    .section-heading h2
    {
        font-size: 28px;
    }


    .service-card
    {
        margin-bottom: 20px;
    }


    .why-section
    {
        padding: 65px 0;
    }


    .why-title
    {
        font-size: 30px;
    }


    .stat-box
    {
        margin-bottom: 35px;
    }


    .cta-box
    {
        padding: 35px 25px;

        text-align: center;
    }


    .cta-box h3
    {
        font-size: 24px;
    }


    .cta-button
    {
        margin-top: 25px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 575.98px)
{

    .home-hero
    {
        min-height: 700px;
    }


    .hero-title
    {
        font-size: 34px;
    }


    .hero-tag
    {
        font-size: 11px;
    }


    .hero-description
    {
        font-size: 13px;
    }


    .hero-search
    {
        padding: 17px;

        margin-top: 18px;
    }


    .hero-search-title
    {
        font-size: 15px;

        margin-bottom: 14px;
    }


    .hero-search-title i
    {
        width: 29px;

        height: 29px;
    }


    .hero-search .form-control,
    .hero-search .btn
    {
        height: 48px;
    }


    .section-heading h2
    {
        font-size: 25px;
    }


    .service-card
    {
        padding: 28px 22px;
    }


    .why-item
    {
        gap: 13px;
    }


    .why-icon
    {
        width: 48px;

        min-width: 48px;

        height: 48px;

        font-size: 19px;
    }


    .why-item h5
    {
        font-size: 15px;
    }


    .why-item p
    {
        font-size: 12px;
    }


    .stat-number
    {
        font-size: 32px;
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
     HERO
====================================================== -->

<section class="home-hero">

<div class="container">

<div class="hero-content">


<div class="hero-tag">

<i class="fas fa-home"></i>

FIND YOUR PERFECT PROPERTY

</div>


<h1 class="hero-title">

Find Your
<span>Dream House</span>

</h1>


<p class="hero-description">

Discover properties that match your needs,
location, budget and lifestyle. Explore
available homes and connect with trusted
real estate professionals.

</p>


<!-- =================================================
     SEARCH PROPERTIES
================================================== -->

<div class="hero-search">


<span class="hero-search-title">

<i class="fas fa-search"></i>

Search Properties

</span>


<form
    method="post"
    action="propertygrid.php"
>

<div class="row">


<!-- PROPERTY TYPE -->

<div class="col-md-6 col-lg-3">

<div class="form-group">

<select
    class="form-control"
    name="type"
>

<option value="">
    Select Property Type
</option>

<option value="appartment">
    Apartment
</option>

<option value="bunglow">
    Bungalow
</option>

<option value="villa">
    Villa
</option>

<option value="office">
    Office
</option>

</select>

</div>

</div>


<!-- SALE / RENT -->

<div class="col-md-6 col-lg-2">

<div class="form-group">

<select
    class="form-control"
    name="stype"
>

<option value="">
    Sale / Rent
</option>

<option value="rent">
    Rent
</option>

<option value="sale">
    Sale
</option>

</select>

</div>

</div>


<!-- CITY -->

<div class="col-md-8 col-lg-5">

<div class="form-group">

<input
    type="text"
    class="form-control"
    name="city"
    placeholder="Enter City"
    required
>

</div>

</div>


<!-- SEARCH BUTTON -->

<div class="col-md-4 col-lg-2">

<div class="form-group">

<button
    type="submit"
    name="filter"
    class="btn"
>

<i
    class="fas fa-search"
    style="margin-right:6px;"
></i>

Search

</button>

</div>

</div>


</div>

</form>

</div>


</div>

</div>

</section>


<!-- =====================================================
     WHAT WE DO
====================================================== -->

<section class="home-section gray">

<div class="container">


<div class="section-heading">

<h2>
What We Do
</h2>

<p>
Everything you need to discover,
explore and connect with properties
in one convenient platform.
</p>

</div>


<div class="row">


<div class="col-lg-3 col-md-6">

<div class="service-card">

<div class="service-icon">

<i class="flaticon-rent"></i>

</div>

<h5>

<a href="#">
Selling Service
</a>

</h5>

<p>

Explore properties available
for sale and find a home that
matches your requirements.

</p>

</div>

</div>


<div class="col-lg-3 col-md-6">

<div class="service-card">

<div class="service-icon">

<i class="flaticon-for-rent"></i>

</div>

<h5>

<a href="#">
Rental Service
</a>

</h5>

<p>

Find rental properties based
on your preferred location,
budget and requirements.

</p>

</div>

</div>


<div class="col-lg-3 col-md-6">

<div class="service-card">

<div class="service-icon">

<i class="flaticon-list"></i>

</div>

<h5>

<a href="#">
Property Listing
</a>

</h5>

<p>

Browse detailed property
listings with price, location,
BHK, size, features and images.

</p>

</div>

</div>


<div class="col-lg-3 col-md-6">

<div class="service-card">

<div class="service-icon">

<i class="flaticon-diagram"></i>

</div>

<h5>

<a href="#">
Property Request
</a>

</h5>

<p>

Submit your requirements and
communicate what type of property
you are looking for.

</p>

</div>

</div>


</div>

</div>

</section>


<!-- =====================================================
     WHY CHOOSE US
====================================================== -->

<section class="why-section">

<div class="container">

<div class="why-content">


<h2 class="why-title">
Why Choose Us
</h2>


<div class="why-item">

<div class="why-icon">

<i class="fas fa-search"></i>

</div>

<div>

<h5>
Easy Property Search
</h5>

<p>

Find properties that match
your needs with an organized
and convenient search experience.
Explore listings based on type,
location, price, BHK, size and
other requirements.

</p>

</div>

</div>


<div class="why-item">

<div class="why-icon">

<i class="fas fa-building"></i>

</div>

<div>

<h5>
Detailed Property Information
</h5>

<p>

Get a better understanding of
each property through detailed
information including price,
location, BHK, bedrooms,
bathrooms, size, features and
multiple property images.

</p>

</div>

</div>


<div class="why-item">

<div class="why-icon">

<i class="fas fa-user-tie"></i>

</div>

<div>

<h5>
Connect With Real Estate Agents
</h5>

<p>

Connect with registered real-estate
agents and explore their available
information to get assistance in
finding a property that matches
your requirements.

</p>

</div>

</div>


</div>

</div>

</section>


<!-- =====================================================
     HOW IT WORKS
====================================================== -->

<section class="home-section">

<div class="container">


<div class="section-heading">

<h2>
How It Works
</h2>

<p>
Find your next property in just
three simple steps.
</p>

</div>


<div class="row">


<div class="col-md-4">

<div class="step-card">

<div class="step-number">
1
</div>

<div class="step-icon">

<i class="flaticon-search"></i>

</div>

<h5>
Search Properties
</h5>

<p>

Explore available properties
based on your preferred property
type, location, price, BHK,
size and other requirements.

</p>

</div>

</div>


<div class="col-md-4">

<div class="step-card">

<div class="step-number">
2
</div>

<div class="step-icon">

<i class="flaticon-house"></i>

</div>

<h5>
View Property Details
</h5>

<p>

Open a property listing to view
important details, features,
price, location and multiple
images before making a decision.

</p>

</div>

</div>


<div class="col-md-4">

<div class="step-card">

<div class="step-number">
3
</div>

<div class="step-icon">

<i class="flaticon-handshake"></i>

</div>

<h5>
Connect & Request
</h5>

<p>

Connect with registered agents
or submit your property requirements
and take the next step toward
finding the right property.

</p>

</div>

</div>


</div>

</div>

</section>


<!-- =====================================================
     STATISTICS
====================================================== -->

<section class="stats-section">

<div class="container">

<div class="row">


<!-- TOTAL PROPERTIES -->

<div class="col-md-3 col-6">

<div class="stat-box">

<div class="stat-icon">

<i class="fas fa-home"></i>

</div>


<?php

$query =
mysqli_query(
    $con,
    "SELECT count(pid) FROM property"
);

$total = 0;

if($query)
{
    $row =
    mysqli_fetch_array($query);

    $total =
    intval($row[0]);
}

?>


<div
    class="stat-number"
    data-stop="<?php echo $total; ?>"
>

<?php echo $total; ?>

</div>


<div class="stat-label">
Property Available
</div>

</div>

</div>


<!-- SALE -->

<div class="col-md-3 col-6">

<div class="stat-box">

<div class="stat-icon">

<i class="fas fa-tag"></i>

</div>


<?php

$query =
mysqli_query(
    $con,
    "SELECT count(pid)
     FROM property
     WHERE stype='sale'"
);

$totalSale = 0;

if($query)
{
    $row =
    mysqli_fetch_array($query);

    $totalSale =
    intval($row[0]);
}

?>


<div
    class="stat-number"
    data-stop="<?php echo $totalSale; ?>"
>

<?php echo $totalSale; ?>

</div>


<div class="stat-label">
Sale Properties
</div>

</div>

</div>


<!-- RENT -->

<div class="col-md-3 col-6">

<div class="stat-box">

<div class="stat-icon">

<i class="fas fa-key"></i>

</div>


<?php

$query =
mysqli_query(
    $con,
    "SELECT count(pid)
     FROM property
     WHERE stype='rent'"
);

$totalRent = 0;

if($query)
{
    $row =
    mysqli_fetch_array($query);

    $totalRent =
    intval($row[0]);
}

?>


<div
    class="stat-number"
    data-stop="<?php echo $totalRent; ?>"
>

<?php echo $totalRent; ?>

</div>


<div class="stat-label">
Rental Properties
</div>

</div>

</div>


<!-- USERS -->

<div class="col-md-3 col-6">

<div class="stat-box">

<div class="stat-icon">

<i class="fas fa-users"></i>

</div>


<?php

$query =
mysqli_query(
    $con,
    "SELECT count(uid)
     FROM user"
);

$totalUsers = 0;

if($query)
{
    $row =
    mysqli_fetch_array($query);

    $totalUsers =
    intval($row[0]);
}

?>


<div
    class="stat-number"
    data-stop="<?php echo $totalUsers; ?>"
>

<?php echo $totalUsers; ?>

</div>


<div class="stat-label">
Registered Users
</div>

</div>

</div>


</div>

</div>

</section>


<!-- =====================================================
     CTA
====================================================== -->

<section class="cta-section">

<div class="container">

<div class="cta-box">

<div class="row align-items-center">


<div class="col-lg-8">

<div class="cta-content">

<h3>
Looking for your dream property?
</h3>

<p>

Explore our property listings,
find the right location and connect
with real estate professionals.

</p>

</div>

</div>


<div class="col-lg-4 text-lg-right">

<a
    href="property.php"
    class="cta-button"
>

Explore Properties

<i class="fas fa-arrow-right"></i>

</a>

</div>


</div>

</div>

</div>

</section>


<!-- =====================================================
     FOOTER
====================================================== -->

<?php include("include/footer.php"); ?>


<!-- SCROLL TO TOP -->

<a
    href="#"
    class="bg-primary text-white"
    id="scroll"
>

<i class="fas fa-angle-up"></i>

</a>


</div>

</div>


<!-- =====================================================
     JAVASCRIPT
====================================================== -->

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

<script src="js/YouTubePopUp.jquery.js"></script>

<script src="js/validate.js"></script>

<script src="js/jquery.cookie.js"></script>

<script src="js/custom.js"></script>


<!-- =====================================================
     STAT COUNTER
====================================================== -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function()
    {

        const counters =
            document.querySelectorAll(
                ".stat-number"
            );


        counters.forEach(
            function(counter)
            {

                const target =
                    parseInt(
                        counter.getAttribute(
                            "data-stop"
                        )
                    ) || 0;


                let started = false;


                function animateCounter()
                {

                    if(started)
                    {
                        return;
                    }


                    const rect =
                        counter.getBoundingClientRect();


                    if(
                        rect.top <
                        window.innerHeight &&
                        rect.bottom > 0
                    )
                    {

                        started = true;

                        let current = 0;

                        const duration = 1200;

                        const increment =
                            target > 0
                            ?
                            Math.max(
                                1,
                                Math.ceil(
                                    target / 50
                                )
                            )
                            :
                            1;


                        const timer =
                            setInterval(
                                function()
                                {

                                    current +=
                                        increment;


                                    if(
                                        current >= target
                                    )
                                    {

                                        current =
                                            target;

                                        clearInterval(
                                            timer
                                        );

                                    }


                                    counter.textContent =
                                        current;

                                },
                                duration / 50
                            );

                    }

                }


                animateCounter();


                window.addEventListener(
                    "scroll",
                    animateCounter,
                    {
                        passive: true
                    }
                );

            }
        );

    }
);

</script>


<!-- =====================================================
     HERO PARALLAX
====================================================== -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function()
    {

        const hero =
            document.querySelector(
                ".home-hero"
            );


        if(!hero)
        {
            return;
        }


        function moveHero()
        {

            const rect =
                hero.getBoundingClientRect();


            let progress =
                -rect.top /
                hero.offsetHeight;


            progress =
                Math.max(
                    0,
                    Math.min(
                        1,
                        progress
                    )
                );


            const moveY =
                progress * 90;


            hero.style.backgroundPosition =
                "center " +
                moveY +
                "px";

        }


        window.addEventListener(
            "scroll",
            moveHero,
            {
                passive: true
            }
        );


        window.addEventListener(
            "resize",
            moveHero
        );


        moveHero();

    }
);

</script>


</body>

</html>