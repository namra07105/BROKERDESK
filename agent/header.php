<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../config.php");

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

                                    <!-- Agent Login -->

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

                                <a href="../register.php">
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


                        <!-- =====================================================
                             BROKERDESK LOGO
                             Agent logo goes to Agent Dashboard
                        ====================================================== -->

                        <a
                            class="navbar-brand position-relative"
                            href="dashboard.php"
                        >

                            <img
                                class="nav-logo brokerdesk-agent-logo"
                                src="../images/logo/brokerdesk-logo.png"
                                alt="BROKERDESK"
                            >

                        </a>


                        <!-- =====================================================
                             MOBILE BUTTON
                        ====================================================== -->

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


                        <!-- =====================================================
                             NAVIGATION
                        ====================================================== -->

                        <div
                            class="collapse navbar-collapse"
                            id="navbarSupportedContent"
                        >

                            <ul class="navbar-nav mr-auto">


                                <!-- =================================================
                                     HOME
                                ================================================== -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="dashboard.php"
                                        role="button"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        Home
                                    </a>

                                </li>


                                <!-- =================================================
                                     ABOUT
                                ================================================== -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="aboutus.php"
                                    >
                                        About
                                    </a>

                                </li>


                                <!-- =================================================
                                     AGENT
                                ================================================== -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="agent.php"
                                    >
                                        Agent
                                    </a>

                                </li>


                                <!-- =================================================
                                     PROPERTIES
                                ================================================== -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="property.php"
                                    >
                                        Properties
                                    </a>

                                </li>


                                <!-- =================================================
                                     CONTACT
                                ================================================== -->

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


                                <!-- =================================================
                                     MY ACCOUNT
                                ================================================== -->

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


                                        <!-- =================================================
                                             DASHBOARD
                                        ================================================== -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="dashboard.php"
                                            >
                                                Dashboard
                                            </a>

                                        </li>


                                        <!-- =================================================
                                             MY PROPERTIES
                                        ================================================== -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="propertyview.php"
                                            >
                                                My Properties
                                            </a>

                                        </li>


                                        <!-- =================================================
                                             ADD PROPERTY
                                        ================================================== -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="propertyadd.php"
                                            >
                                                Add Property
                                            </a>

                                        </li>


                                        <!-- =================================================
                                             PROPERTY REQUEST
                                        ================================================== -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="request.php"
                                            >
                                                Property Request
                                            </a>

                                        </li>


                                        <!-- =================================================
                                             FEEDBACK
                                        ================================================== -->

                                        <li class="nav-item">

                                            <a
                                                class="nav-link"
                                                href="feedback.php"
                                            >
                                                Feedback
                                            </a>

                                        </li>


                                        <!-- =================================================
                                             LOGOUT
                                        ================================================== -->

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


                                <!-- =================================================
                                     AGENT LOGIN
                                ================================================== -->

                                <li class="nav-item">

                                    <a
                                        class="nav-link"
                                        href="login.php"
                                    >
                                        Agent Login
                                    </a>

                                </li>


                                <?php

                                }

                                ?>


                            </ul>


                            <!-- =====================================================
                                 SUBMIT PROPERTY
                            ====================================================== -->


                        </div>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</header>


<style>

/* =====================================================
   BROKERDESK AGENT LOGO
===================================================== */

.brokerdesk-agent-logo
{
    display: block;

    width: 170px;

    height: 62px;

    object-fit: contain;

    object-position: center;

    background: #ffffff;
}


/* =====================================================
   RESPONSIVE LOGO
===================================================== */

@media (max-width: 991px)
{
    .brokerdesk-agent-logo
    {
        width: 155px;

        height: 58px;
    }
}


@media (max-width: 575px)
{
    .brokerdesk-agent-logo
    {
        width: 140px;

        height: 52px;
    }
}

</style>