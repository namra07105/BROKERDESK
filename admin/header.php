<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require("config.php");

if (!isset($_SESSION['auser'])) {
    header("location:index.php");
    exit;
}

$adminName = htmlspecialchars($_SESSION['auser'], ENT_QUOTES, 'UTF-8');

?>

<div class="header brokerdesk-admin-header">

    <!-- Mobile Menu Toggle -->
    <a href="javascript:void(0);" class="mobile_btn" id="mobile_btn" aria-label="Open menu">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Logo -->
    <div class="header-left">

        <a href="dashboard.php" class="logo">
            <img
                src="assets/img/brokerdesk-logo.png"
                alt="BROKERDESK"
                class="admin-logo-lg"
            >
        </a>

        <a href="dashboard.php" class="logo logo-small">
            <img
                src="assets/img/brokerdesk-logo.png"
                alt="BROKERDESK"
                class="admin-logo-sm"
            >
        </a>

    </div>
    <!-- /Logo -->

    <a href="javascript:void(0);" id="toggle_btn" aria-label="Toggle sidebar">
        <i class="fe fe-text-align-left"></i>
    </a>

    <!-- Header Right Menu -->
    <ul class="nav user-menu">

        <li class="nav-item admin-username-item">
            <span class="admin-username" title="<?php echo $adminName; ?>">
                <?php echo $adminName; ?>
            </span>
        </li>

        <li class="nav-item dropdown app-dropdown">

            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-label="Account menu">

                <span class="user-img">
                    <img
                        class="rounded-circle"
                        src="assets/img/profiles/k.png"
                        width="32"
                        height="32"
                        alt="Administrator"
                    >
                </span>

            </a>

            <div class="dropdown-menu dropdown-menu-right">

                <div class="user-header">

                    <div class="avatar avatar-sm">
                        <img
                            src="assets/img/profiles/k.png"
                            alt="User Image"
                            class="avatar-img rounded-circle"
                        >
                    </div>

                    <div class="user-text">
                        <h6><?php echo $adminName; ?></h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>

                </div>

                <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>

            </div>

        </li>

    </ul>
    <!-- /Header Right Menu -->

</div>


<!-- Sidebar -->
<div class="sidebar" id="sidebar">

    <div class="sidebar-inner slimscroll">

        <div id="sidebar-menu" class="sidebar-menu">

            <ul>

                <li class="menu-title">
                    <span>Main</span>
                </li>

                <li>
                    <a href="dashboard.php">
                        <i class="fe fe-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">
                    <span>Authentication</span>
                </li>

                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-user"></i>
                        <span> Authentication </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="index.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Users</span>
                </li>

                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-user"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="adminlist.php">Admin</a></li>
                        <li><a href="userlist.php">Users</a></li>
                        <li><a href="useragent.php">Agent</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Property</span>
                </li>

                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-user"></i>
                        <span> Property</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="propertyadd.php">Add Property</a></li>
                        <li><a href="propertyview.php">View Property</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>State & City</span>
                </li>

                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-user"></i>
                        <span>State & City</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="stateadd.php">State</a></li>
                        <li><a href="cityadd.php">City</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Query</span>
                </li>

                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-user"></i>
                        <span> Query </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="request_view.php">Property Requests</a></li>
                        <li><a href="contactview.php">Contact Details</a></li>
                        <li><a href="feedbackview.php">Feedback</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>About</span>
                </li>

                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-user"></i>
                        <span> About </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li><a href="aboutadd.php">About</a></li>
                        <li><a href="aboutview.php">View About</a></li>
                    </ul>
                </li>

            </ul>

        </div>

    </div>

</div>
<!-- /Sidebar -->
