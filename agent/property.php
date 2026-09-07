<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta name="description" content="Homex template">
<meta name="keywords" content="">
<meta name="author" content="Unicoder">

<link rel="shortcut icon" href="../images/favicon.ico">

<!-- Fonts
========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!-- Css Link
========================================================-->
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../css/layerslider.css">
<link rel="stylesheet" type="text/css" href="../css/color.css" id="color-change">
<link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive-fix.css">


<style>

/* =========================================================
   PROPERTY GRID LAYOUT
========================================================= */

.property-grid-page .property-card {
    height: 100%;
}

.property-grid-page .featured-thumb {
    height: 100%;
    margin-bottom: 30px !important;
}

.property-grid-page .featured-thumb .overlay-black {
    height: 250px;
    overflow: hidden;
}

.property-grid-page .featured-thumb .overlay-black > img {
    width: 100%;
    height: 250px;
    display: block;
    object-fit: cover;
}


/* =========================================================
   PROPERTY INFORMATION BOX
========================================================= */

.property-grid-page .featured-thumb-data {
    min-height: 190px;
}

.property-grid-page .featured-thumb-data .p-4 {
    min-height: 110px;
}


/* =========================================================
   PROPERTY LOCATION
========================================================= */

.property-grid-page .featured-thumb-data .location {
    display: flex;
    align-items: flex-start;
    line-height: 1.6;
    word-break: break-word;
}

.property-grid-page .featured-thumb-data .location i {
    flex-shrink: 0;
    margin-top: 4px;
    margin-right: 7px;
}


/* =========================================================
   PROPERTY META
========================================================= */

.property-grid-page .featured-thumb-data .property-meta {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 15px;
    flex-wrap: wrap;
}

.property-grid-page .featured-thumb-data .property-owner {
    min-width: 0;
    word-break: break-word;
}


/* =========================================================
   SIDEBAR
========================================================= */

.property-grid-page .sidebar-widget {
    width: 100%;
}


/* =========================================================
   RECENT PROPERTY LIST
========================================================= */

.property-grid-page .property_list_widget li {
    position: relative;
    min-height: 80px;
    overflow: hidden;
    padding-left: 84px;
}

.property-grid-page .property_list_widget li img {
    width: 72px;
    height: 72px;
    object-fit: cover;
    position: absolute;
    left: 0;
    top: 0;
    margin: 0;
}

.property-grid-page .property_list_widget li h6 {
    margin: 0 0 5px 0;
    padding: 0;
    line-height: 1.4;
}

.property-grid-page .property_list_widget li .font-14 {
    display: block;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    word-break: break-word;
}

.property-grid-page .property_list_widget li .font-14 i {
    margin-right: 4px;
}


/* =========================================================
   FEATURED PROPERTY HEADING
========================================================= */

.featured-property-heading {
    margin-bottom: 30px;
}

.featured-property-heading p {
    margin-bottom: 0;
    color: #777;
}


/* =========================================================
   FILTER BOX
========================================================= */

.property-filter-box {
    margin-bottom: 35px;
}

.property-filter-box .form-control {
    height: 45px;
}


/* =========================================================
   NO PROPERTY MESSAGE
========================================================= */

.no-property-message {
    width: 100%;
    padding: 50px 20px;
    text-align: center;
    background: #f8f8f8;
    margin-bottom: 30px;
}

.no-property-message i {
    font-size: 40px;
    margin-bottom: 15px;
    color: #aaa;
}

.no-property-message h4 {
    margin-bottom: 8px;
}

.no-property-message p {
    margin-bottom: 0;
    color: #777;
}


/* =========================================================
   SCROLLABLE PROPERTY HOUSE IMAGE
========================================================= */

.scroll-house-banner {
    width: calc(100% - 40px);
    height: 420px;
    margin-left: 20px;
    margin-right: 20px;
    overflow: hidden;
    position: relative;
    background: #000;
}

.scroll-house-image {
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
}

.scroll-house-content {
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

.scroll-house-banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.25);
    z-index: 1;
}

.scroll-house-content .container {
    position: relative;
    z-index: 3;
}

.scroll-house-content .breadcrumb-item + .breadcrumb-item::before {
    display: none !important;
}

.scroll-house-content .breadcrumb {
    display: none !important;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 991.98px) {

    .property-grid-page .featured-thumb .overlay-black,
    .property-grid-page .featured-thumb .overlay-black > img {
        height: 260px;
    }

}

@media (max-width: 767px) {

    .scroll-house-banner {
        width: calc(100% - 30px);
        height: 350px;
        margin-left: 15px;
        margin-right: 15px;
    }

    .scroll-house-image {
        width: auto;
        height: 100%;
        min-width: 100%;
        object-fit: cover;
    }

}

@media (max-width: 575.98px) {

    .scroll-house-banner {
        width: calc(100% - 20px);
        margin-left: 10px;
        margin-right: 10px;
    }

    .property-grid-page .featured-thumb .overlay-black,
    .property-grid-page .featured-thumb .overlay-black > img {
        height: 240px;
    }

    .property-grid-page .featured-thumb-data {
        min-height: auto;
    }

    .property-grid-page .property_list_widget li {
        padding-left: 80px;
    }

}

</style>


<title>BrokerDesk - Properties</title>

</head>

<body>


<div id="page-wrapper">

<div class="row">


<!-- =====================================================
     HEADER
===================================================== -->

<?php include("header.php"); ?>


<!-- =====================================================
     BANNER
====================================================== -->

<div class="scroll-house-banner" id="houseBanner">

    <img
        src="../images/propertyimage.jpg"
        alt="Properties"
        class="scroll-house-image"
        id="houseImage"
    >

    <div class="scroll-house-content">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <h2
                        class="page-name float-left text-uppercase mt-1 mb-0"
                        style="color: #d6d6d6;"
                    >

                        <b>Properties</b>

                    </h2>

                </div>

                <div class="col-md-6">

                    <nav
                        aria-label="breadcrumb"
                        class="float-left float-md-right"
                    >

                        <ol class="breadcrumb bg-transparent m-0 p-0">

                            <li class="breadcrumb-item text-white">
                                <a href="#"></a>
                            </li>

                            <li class="breadcrumb-item active"></li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Banner End -->


<!-- =====================================================
     PROPERTY GRID
====================================================== -->

<div class="full-row property-grid-page">

<div class="container">


<!-- =====================================================
     SEARCH / FILTER
====================================================== -->

<div class="property-filter-box">

    <form
        action="property.php"
        method="get"
    >

        <div class="row">


            <!-- Property Type -->

            <div class="col-md-3 mb-3">

                <select
                    name="type"
                    class="form-control"
                >

                    <option value="">
                        Property Type
                    </option>

                    <?php

                    $typeQuery = mysqli_query(
                        $con,
                        "SELECT DISTINCT type
                         FROM property
                         WHERE type IS NOT NULL
                         AND type != ''
                         ORDER BY type ASC"
                    );

                    while($typeRow = mysqli_fetch_assoc($typeQuery))
                    {

                        $selected =
                            (isset($_GET['type']) &&
                             $_GET['type'] == $typeRow['type'])
                            ? 'selected'
                            : '';

                    ?>

                        <option
                            value="<?php echo htmlspecialchars($typeRow['type']); ?>"
                            <?php echo $selected; ?>
                        >
                            <?php echo htmlspecialchars($typeRow['type']); ?>
                        </option>

                    <?php
                    }

                    ?>

                </select>

            </div>


            <!-- Sale / Rent -->

            <div class="col-md-3 mb-3">

                <select
                    name="stype"
                    class="form-control"
                >

                    <option value="">
                        Sale / Rent
                    </option>

                    <?php

                    $stypeQuery = mysqli_query(
                        $con,
                        "SELECT DISTINCT stype
                         FROM property
                         WHERE stype IS NOT NULL
                         AND stype != ''
                         ORDER BY stype ASC"
                    );

                    while($stypeRow = mysqli_fetch_assoc($stypeQuery))
                    {

                        $selected =
                            (isset($_GET['stype']) &&
                             $_GET['stype'] == $stypeRow['stype'])
                            ? 'selected'
                            : '';

                    ?>

                        <option
                            value="<?php echo htmlspecialchars($stypeRow['stype']); ?>"
                            <?php echo $selected; ?>
                        >
                            <?php echo htmlspecialchars($stypeRow['stype']); ?>
                        </option>

                    <?php
                    }

                    ?>

                </select>

            </div>


            <!-- City -->

            <div class="col-md-3 mb-3">

                <select
                    name="city"
                    class="form-control"
                >

                    <option value="">
                        All Cities
                    </option>

                    <?php

                    $cityQuery = mysqli_query(
                        $con,
                        "SELECT DISTINCT city
                         FROM property
                         WHERE city IS NOT NULL
                         AND city != ''
                         ORDER BY city ASC"
                    );

                    while($cityRow = mysqli_fetch_assoc($cityQuery))
                    {

                        $selected =
                            (isset($_GET['city']) &&
                             $_GET['city'] == $cityRow['city'])
                            ? 'selected'
                            : '';

                    ?>

                        <option
                            value="<?php echo htmlspecialchars($cityRow['city']); ?>"
                            <?php echo $selected; ?>
                        >
                            <?php echo htmlspecialchars($cityRow['city']); ?>
                        </option>

                    <?php
                    }

                    ?>

                </select>

            </div>


            <!-- State -->

            <div class="col-md-3 mb-3">

                <select
                    name="state"
                    class="form-control"
                >

                    <option value="">
                        All States
                    </option>

                    <?php

                    $stateQuery = mysqli_query(
                        $con,
                        "SELECT DISTINCT state
                         FROM property
                         WHERE state IS NOT NULL
                         AND state != ''
                         ORDER BY state ASC"
                    );

                    while($stateRow = mysqli_fetch_assoc($stateQuery))
                    {

                        $selected =
                            (isset($_GET['state']) &&
                             $_GET['state'] == $stateRow['state'])
                            ? 'selected'
                            : '';

                    ?>

                        <option
                            value="<?php echo htmlspecialchars($stateRow['state']); ?>"
                            <?php echo $selected; ?>
                        >
                            <?php echo htmlspecialchars($stateRow['state']); ?>
                        </option>

                    <?php
                    }

                    ?>

                </select>

            </div>


            <!-- Buttons -->

            <div class="col-md-12 mt-2">

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="fas fa-search mr-1"></i>

                    Search Property

                </button>


                <a
                    href="property.php"
                    class="btn btn-secondary ml-2"
                >

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>


<div class="row">


<!-- =================================================
     PROPERTY LIST
================================================= -->

<div class="col-lg-8">

<div class="row">


<?php


/* =====================================================
   CHECK FILTER
===================================================== */

$hasFilter = false;

$type  = isset($_GET['type'])  ? trim($_GET['type'])  : '';
$stype = isset($_GET['stype']) ? trim($_GET['stype']) : '';
$city  = isset($_GET['city'])  ? trim($_GET['city'])  : '';
$state = isset($_GET['state']) ? trim($_GET['state']) : '';


if(
    $type != '' ||
    $stype != '' ||
    $city != '' ||
    $state != ''
)
{
    $hasFilter = true;
}


/* =====================================================
   BUILD QUERY
===================================================== */

if($hasFilter)
{

    $conditions = array();


    if($type != '')
    {
        $type = mysqli_real_escape_string($con, $type);

        $conditions[] = "type='$type'";
    }


    if($stype != '')
    {
        $stype = mysqli_real_escape_string($con, $stype);

        $conditions[] = "stype='$stype'";
    }


    if($city != '')
    {
        $city = mysqli_real_escape_string($con, $city);

        $conditions[] = "city='$city'";
    }


    if($state != '')
    {
        $state = mysqli_real_escape_string($con, $state);

        $conditions[] = "state='$state'";
    }


    $where = "";

    if(count($conditions) > 0)
    {
        $where = "WHERE " . implode(" AND ", $conditions);
    }


    $sql = "
        SELECT *
        FROM property
        $where
        ORDER BY pid DESC
    ";


    $result = mysqli_query($con, $sql);


    ?>

    <!-- Search Result Heading -->

    <div class="col-md-12">

        <div class="featured-property-heading">

            <h3 class="double-down-line-left text-secondary position-relative pb-4">

                Search Results

            </h3>

            <?php

            if($result)
            {

                $totalResults = mysqli_num_rows($result);

            ?>

                <p>
                    <?php echo $totalResults; ?>
                    property result<?php echo ($totalResults != 1) ? 's' : ''; ?>
                    found.
                </p>

            <?php

            }

            ?>

        </div>

    </div>


    <?php


    if($result && mysqli_num_rows($result) > 0)
    {

        while($row = mysqli_fetch_array($result))
        {

            ?>


            <!-- =================================================
                 PROPERTY CARD
            ================================================== -->

            <div class="col-md-6 property-card">

                <div class="featured-thumb hover-zoomer mb-4">


                    <!-- Property Image -->

                    <div class="overlay-black overflow-hidden position-relative">

                        <img
                            src="../admin/property/<?php echo htmlspecialchars($row['18']); ?>"
                            alt="pimage"
                        >


                        <!-- Sale / Rent -->

                        <div class="sale bg-secondary text-white">

                            For <?php echo htmlspecialchars($row['5']); ?>

                        </div>


                        <!-- Price -->

                        <div class="price text-primary text-capitalize">

                            $<?php echo htmlspecialchars($row['13']); ?>

                            <span class="text-white">

                                <?php echo htmlspecialchars($row['12']); ?> Sqft

                            </span>

                        </div>

                    </div>



                    <!-- =================================================
                         PROPERTY DETAILS
                    ================================================== -->

                    <div class="featured-thumb-data shadow-one">

                        <div class="p-4">


                            <!-- Property Name -->

                            <h5 class="text-secondary hover-text-primary mb-2 text-capitalize">

                                <a
                                    href="propertydetail.php?pid=<?php echo $row['0']; ?>"
                                >

                                    <?php echo htmlspecialchars($row['1']); ?>

                                </a>

                            </h5>



                            <!-- Property Location -->

                            <span class="location text-capitalize">

                                <i class="fas fa-map-marker-alt text-primary"></i>

                                <span>

                                    <?php

                                    echo htmlspecialchars($row['14']);

                                    if(!empty($row['city']))
                                    {
                                        echo ', ' . htmlspecialchars($row['city']);
                                    }

                                    if(!empty($row['state']))
                                    {
                                        echo ', ' . htmlspecialchars($row['state']);
                                    }

                                    ?>

                                </span>

                            </span>


                        </div>



                        <!-- =================================================
                             PROPERTY META
                        ================================================== -->

                        <div class="px-4 pb-4 d-inline-block w-100">


                            <div class="float-left text-capitalize">

                                <i class="fas fa-user text-primary mr-1"></i>

                                By :

                                <?php

                                if(
                                    isset($row['uname']) &&
                                    $row['uname'] !== ''
                                )
                                {
                                    echo htmlspecialchars($row['uname']);
                                }
                                else
                                {
                                    echo 'Admin';
                                }

                                ?>

                            </div>



                            <div class="float-right">

                                <i class="far fa-calendar-alt text-primary mr-1"></i>

                                <?php

                                if(!empty($row['date']))
                                {
                                    echo htmlspecialchars($row['date']);
                                }
                                else
                                {
                                    echo 'Recently Added';
                                }

                                ?>

                            </div>


                        </div>


                    </div>


                </div>

            </div>


            <?php

        }

    }
    else
    {

        ?>

        <div class="col-md-12">

            <div class="no-property-message">

                <i class="fas fa-home"></i>

                <h4>
                    No Property Available
                </h4>

                <p>
                    No property matches your selected location or filters.
                </p>

            </div>

        </div>

        <?php

    }

}


/* =====================================================
   NO FILTER
   SHOW FEATURED PROPERTIES
===================================================== */

else
{

    ?>


    <!-- =================================================
         FEATURED PROPERTY HEADING
    ================================================== -->

    <div class="col-md-12">

        <div class="featured-property-heading">

            <h3 class="double-down-line-left text-secondary position-relative pb-4">

                Featured Properties

            </h3>

            <p>
                Explore the latest properties available on BrokerDesk.
            </p>

        </div>

    </div>


    <?php


    /*
     * First try to show Available properties.
     */

    $result = mysqli_query(
        $con,
        "SELECT *
         FROM property
         WHERE LOWER(TRIM(status))='available'
         ORDER BY pid DESC
         LIMIT 6"
    );


    /*
     * If there are no Available properties,
     * show latest properties instead.
     */

    if(!$result || mysqli_num_rows($result) == 0)
    {

        $result = mysqli_query(
            $con,
            "SELECT *
             FROM property
             ORDER BY pid DESC
             LIMIT 6"
        );

    }


    if($result && mysqli_num_rows($result) > 0)
    {

        while($row = mysqli_fetch_array($result))
        {

            ?>


            <!-- =================================================
                 FEATURED PROPERTY CARD
            ================================================== -->

            <div class="col-md-6 property-card">

                <div class="featured-thumb hover-zoomer mb-4">


                    <!-- Property Image -->

                    <div class="overlay-black overflow-hidden position-relative">

                        <img
                            src="../admin/property/<?php echo htmlspecialchars($row['18']); ?>"
                            alt="pimage"
                        >


                        <!-- Sale / Rent -->

                        <div class="sale bg-secondary text-white">

                            For <?php echo htmlspecialchars($row['5']); ?>

                        </div>


                        <!-- Price -->

                        <div class="price text-primary text-capitalize">

                            $<?php echo htmlspecialchars($row['13']); ?>

                            <span class="text-white">

                                <?php echo htmlspecialchars($row['12']); ?> Sqft

                            </span>

                        </div>

                    </div>



                    <!-- =================================================
                         PROPERTY DETAILS
                    ================================================== -->

                    <div class="featured-thumb-data shadow-one">

                        <div class="p-4">


                            <!-- Property Name -->

                            <h5 class="text-secondary hover-text-primary mb-2 text-capitalize">

                                <a
                                    href="propertydetail.php?pid=<?php echo $row['0']; ?>"
                                >

                                    <?php echo htmlspecialchars($row['1']); ?>

                                </a>

                            </h5>



                            <!-- Property Location -->

                            <span class="location text-capitalize">

                                <i class="fas fa-map-marker-alt text-primary"></i>

                                <span>

                                    <?php

                                    echo htmlspecialchars($row['14']);

                                    if(!empty($row['city']))
                                    {
                                        echo ', ' . htmlspecialchars($row['city']);
                                    }

                                    if(!empty($row['state']))
                                    {
                                        echo ', ' . htmlspecialchars($row['state']);
                                    }

                                    ?>

                                </span>

                            </span>


                        </div>



                        <!-- =================================================
                             PROPERTY META
                        ================================================== -->

                        <div class="px-4 pb-4 d-inline-block w-100">


                            <div class="float-left text-capitalize">

                                <i class="fas fa-user text-primary mr-1"></i>

                                By :

                                <?php

                                if(
                                    isset($row['uname']) &&
                                    $row['uname'] !== ''
                                )
                                {
                                    echo htmlspecialchars($row['uname']);
                                }
                                else
                                {
                                    echo 'Admin';
                                }

                                ?>

                            </div>



                            <div class="float-right">

                                <i class="far fa-calendar-alt text-primary mr-1"></i>

                                <?php

                                if(!empty($row['date']))
                                {
                                    echo htmlspecialchars($row['date']);
                                }
                                else
                                {
                                    echo 'Recently Added';
                                }

                                ?>

                            </div>


                        </div>


                    </div>


                </div>

            </div>


            <?php

        }

    }
    else
    {

        ?>

        <div class="col-md-12">

            <div class="no-property-message">

                <i class="fas fa-home"></i>

                <h4>
                    No Property Available
                </h4>

                <p>
                    Properties will appear here when they are added.
                </p>

            </div>

        </div>

        <?php

    }

}


?>


</div>

</div>



<!-- =================================================
     SIDEBAR
================================================== -->

<div class="col-lg-4">


<!-- =================================================
     INSTALLMENT CALCULATOR
================================================= -->

<div class="sidebar-widget">

    <h4 class="double-down-line-left text-secondary position-relative pb-4 my-4">

        Instalment Calculator

    </h4>


    <form
        class="d-inline-block w-100"
        action="calc.php"
        method="post"
    >


        <!-- Property Amount -->

        <label class="sr-only">

            Property Amount

        </label>


        <div class="input-group mb-2 mr-sm-2">

            <div class="input-group-prepend">

                <div class="input-group-text">

                    $

                </div>

            </div>


            <input
                type="text"
                class="form-control"
                name="amount"
                placeholder="Property Price"
            >

        </div>



        <!-- Duration -->

        <label class="sr-only">

            Month

        </label>


        <div class="input-group mb-2 mr-sm-2">

            <div class="input-group-prepend">

                <div class="input-group-text">

                    <i class="far fa-calendar-alt"></i>

                </div>

            </div>


            <input
                type="text"
                class="form-control"
                name="month"
                placeholder="Duration Year"
            >

        </div>



        <!-- Interest -->

        <label class="sr-only">

            Interest Rate

        </label>


        <div class="input-group mb-2 mr-sm-2">

            <div class="input-group-prepend">

                <div class="input-group-text">

                    %

                </div>

            </div>


            <input
                type="text"
                class="form-control"
                name="interest"
                placeholder="Interest Rate"
            >

        </div>



        <!-- Calculate Button -->

        <button
            type="submit"
            value="submit"
            name="calc"
            class="btn btn-primary mt-4"
        >

            Calculate Instalment

        </button>


    </form>

</div>



<!-- =================================================
     RECENT PROPERTY ADD
================================================== -->

<div class="sidebar-widget mt-5">

    <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">

        Recent Property Add

    </h4>


    <ul class="property_list_widget">


    <?php

    $query = mysqli_query(
        $con,
        "SELECT *
         FROM `property`
         ORDER BY date DESC
         LIMIT 6"
    );


    while($row = mysqli_fetch_array($query))
    {

        ?>


        <li>


            <!-- Recent Property Image -->

            <img
                src="../admin/property/<?php echo htmlspecialchars($row['18']); ?>"
                alt="pimage"
            >



            <!-- Recent Property Name -->

            <h6 class="text-secondary hover-text-primary text-capitalize">

                <a
                    href="propertydetail.php?pid=<?php echo $row['0']; ?>"
                >

                    <?php echo htmlspecialchars($row['1']); ?>

                </a>

            </h6>



            <!-- Recent Property Address -->

            <span class="font-14">

                <i class="fas fa-map-marker-alt icon-primary icon-small"></i>

                <?php

                echo htmlspecialchars($row['14']);

                if(!empty($row['city']))
                {
                    echo ', ' . htmlspecialchars($row['city']);
                }

                ?>

            </span>


        </li>


        <?php

    }

    ?>


    </ul>


</div>


</div>


</div>

</div>

</div>


<!-- =================================================
     FOOTER
================================================= -->

<?php include("footer.php"); ?>


<!-- =================================================
     SCROLL TO TOP
================================================= -->

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
     JS LINK
============================================================-->

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
     PROPERTY HOUSE IMAGE SCROLL EFFECT
========================================================= -->

<script>

window.addEventListener("scroll", function () {

    const banner = document.getElementById("houseBanner");

    const image = document.getElementById("houseImage");


    if (!banner || !image) {
        return;
    }


    const imageHeight = image.offsetHeight;

    const bannerHeight = banner.offsetHeight;


    const maxMove = Math.max(
        0,
        imageHeight - bannerHeight
    );


    const bannerRect = banner.getBoundingClientRect();


    let progress =
        (window.innerHeight - bannerRect.top) /
        (window.innerHeight + bannerRect.height);


    const percentage = Math.max(
        0,
        Math.min(1, progress)
    );


    const moveY =
        -(maxMove * percentage);


    image.style.transform =
        "translateY(" + moveY + "px)";

});

</script>


</body>

</html>