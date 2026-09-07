<?php
include("config.php");
?>

<header id="header" class="transparent-header-modern fixed-header-bg-white w-100">

    <div class="top-header bg-secondary">

        <div class="container">

            <div class="row">

                <div class="col-md-8">

                    <ul class="top-contact list-text-white d-table">

                        <li>
                            <a href="#">
                                <i class="fas fa-phone-alt text-primary mr-1"></i>
                                +91 98765 43210
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fas fa-envelope text-primary mr-1"></i>
                                helpline@brokerdesk.com
                            </a>
                        </li>

                    </ul>

                </div>


                <div class="col-md-4">

                    <div class="top-contact float-right">

                        <ul class="list-text-white d-table">

                            <li>

                                <i class="fas fa-user text-primary mr-1"></i>

                                <?php
                                if(isset($_SESSION['uemail']))
                                {
                                ?>

                                    <a href="logout.php">
                                        Logout
                                    </a>

                                    &nbsp;&nbsp;

                                <?php
                                }
                                else
                                {
                                ?>

                                    <a href="login.php">
                                        Login
                                    </a>

                                    &nbsp;&nbsp;

                                <?php
                                }
                                ?>

                                |

                            </li>


                            <li>

                                <i class="fas fa-user text-primary mr-1"></i>

                                <a href="register.php">
                                    Register
                                </a>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="main-nav secondary-nav hover-primary-nav py-2">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <nav class="navbar navbar-expand-lg navbar-light p-0">


                        <!-- BROKERDESK LOGO -->

                        <a
                            class="navbar-brand position-relative"
                            href="index.php"
                        >

                            <img
                                class="nav-logo brokerdesk-user-logo"
                                src="images/logo/brokerdesk-logo.png"
                                alt="BROKERDESK"
                            >

                        </a>


                        <!-- MOBILE MENU BUTTON -->

                        <button
                            class="navbar-toggler"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >

                            <span class="navbar-toggler-icon"></span>

                        </button>


                        <div
                            class="collapse navbar-collapse"
                            id="navbarSupportedContent"
                        >


                            <ul class="navbar-nav mr-auto">


                                <!-- Home -->

                                <li class="nav-item dropdown">

                                    <a
                                        class="nav-link"
                                        href="index.php"
                                        role="button"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        Home
                                    </a>

                                </li>


                                <!-- About -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="about.php"
                                    >
                                        About
                                    </a>

                                </li>


                                <!-- Agent -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="agent.php"
                                    >
                                        Agent
                                    </a>

                                </li>


                                <!-- Properties -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="property.php"
                                    >
                                        Properties
                                    </a>

                                </li>


                                <!-- Contact -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="contact.php"
                                    >
                                        Contact
                                    </a>

                                </li>


                                <?php

                                if(isset($_SESSION['uemail']))
                                {

                                ?>


                                <!-- My Account -->

                                <li class="nav-item dropdown">

                                    <a
                                        class="nav-link dropdown-toggle"
                                        href="#"
                                        role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        My Account
                                    </a>


                                    <ul class="dropdown-menu">


                                        <!-- Feedback -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="profile.php"
                                            >
                                                Feedback
                                            </a>

                                        </li>


                                        <!-- Property Request -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="request.php"
                                            >
                                                Property Request
                                            </a>

                                        </li>


                                        <!-- Your Property -->

                                        <!--

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="feature.php"
                                            >
                                                Your Property
                                            </a>

                                        </li>

                                        -->


                                        <!-- Logout -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="logout.php"
                                            >
                                                Logout
                                            </a>

                                        </li>


                                    </ul>

                                </li>


                                <?php

                                }
                                else
                                {

                                ?>


                                <!-- Login / Register -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="login.php"
                                    >
                                        Login/Register
                                    </a>

                                </li>


                                <?php

                                }

                                ?>


                            </ul>


                            <!-- Submit Property Button

                            <a
                                href="propertyadd.php"
                                class="btn btn-primary"
                            >
                                Submit Property
                            </a> -->


                        </div>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</header>


<style>

/* =====================================================
   BROKERDESK USER LOGO
===================================================== */

.brokerdesk-user-logo
{
    display: block;
    width: 170px;
    height: 62px;
    object-fit: contain;
    object-position: center;
}


/* =====================================================
   TABLET
===================================================== */

@media (max-width: 991px)
{
    .brokerdesk-user-logo
    {
        width: 155px;
        height: 58px;
    }
}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 575px)
{
    .brokerdesk-user-logo
    {
        width: 140px;
        height: 52px;
    }
}

</style>