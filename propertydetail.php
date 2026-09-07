<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();

include("config.php");

$error = "";
$msg = "";

/* GET SELECTED PROPERTY ID */

if (!isset($_GET['pid']) || empty($_GET['pid'])) {
    die("Property not found.");
}

$pid = intval($_GET['pid']);

if ($pid <= 0) {
    die("Invalid property ID.");
}


/* GET SELECTED PROPERTY */

$sql = "SELECT * FROM property WHERE pid = '$pid' LIMIT 1";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Database Error: " . mysqli_error($con));
}

if (mysqli_num_rows($result) == 0) {
    die("Property not found.");
}

$row = mysqli_fetch_assoc($result);


/* PROPERTY INFORMATION */

$property_id = isset($row['pid']) ? $row['pid'] : '';

$property_name = isset($row['title'])
    ? $row['title']
    : '';

$property_content = isset($row['pcontent'])
    ? $row['pcontent']
    : '';

$property_type = isset($row['type'])
    ? $row['type']
    : '';

$property_stype = isset($row['stype'])
    ? $row['stype']
    : '';

$property_bhk = isset($row['bhk'])
    ? $row['bhk']
    : '';

$property_bedroom = isset($row['bedroom'])
    ? $row['bedroom']
    : '';

$property_bathroom = isset($row['bathroom'])
    ? $row['bathroom']
    : '';

$property_balcony = isset($row['balcony'])
    ? $row['balcony']
    : '';

$property_kitchen = isset($row['kitchen'])
    ? $row['kitchen']
    : '';

$property_hall = isset($row['hall'])
    ? $row['hall']
    : '';

$property_floor = isset($row['floor'])
    ? $row['floor']
    : '';

$property_sqft = isset($row['size'])
    ? $row['size']
    : '';

$property_price = isset($row['price'])
    ? $row['price']
    : '';


/* INDIAN PRICE FORMAT */

function formatIndianPrice($price)
{
    if ($price === '' || $price === null) {
        return '';
    }

    $price = (float) $price;
    $number = number_format($price, 0, '.', '');

    if (strlen($number) <= 3) {
        return $number;
    }

    $lastThree = substr($number, -3);
    $remaining = substr($number, 0, -3);
    $remaining = preg_replace(
        '/\B(?=(\d{2})+(?!\d))/',
        ',',
        $remaining
    );

    return $remaining . ',' . $lastThree;
}


$property_address = isset($row['location'])
    ? $row['location']
    : '';

$property_city = isset($row['city'])
    ? $row['city']
    : '';

$property_state = isset($row['state'])
    ? $row['state']
    : '';

$property_feature = isset($row['feature'])
    ? $row['feature']
    : '';

$property_status = isset($row['status'])
    ? $row['status']
    : '';

$property_totalfloor = isset($row['totalfloor'])
    ? $row['totalfloor']
    : '';


/* GET ALL PROPERTY IMAGES */

$property_images = array();

$image_fields = array(
    'pimage',
    'pimage1',
    'pimage2',
    'pimage3',
    'pimage4',
    'pimage5',
    'pimage6',
    'pimage7',
    'pimage8',
    'pimage9',
    'pimage10'
);

foreach ($image_fields as $image_field) {

    if (
        isset($row[$image_field]) &&
        trim($row[$image_field]) != ''
    ) {

        $image_name = trim($row[$image_field]);

        if (!in_array($image_name, $property_images)) {
            $property_images[] = $image_name;
        }
    }
}


/* MAIN IMAGE */

$main_image = '';

if (count($property_images) > 0) {
    $main_image = $property_images[0];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge"
>

<meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
>

<meta
    name="description"
    content="Property Details"
>

<meta
    name="keywords"
    content="real estate, property, property details"
>

<meta
    name="author"
    content="BrokerDesk"
>

<link
    rel="shortcut icon"
    href="images/favicon.ico"
>


<!-- FONTS -->

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
    id="color-change"
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


<style>

/* PROPERTY BANNER */

.page-banner {
    width: 100%;
    min-height: 420px;

    background-image:
        url('images/propertydetail.jpg') !important;

    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;

    /* CHANGED: banner scrolls with page */
    background-attachment: scroll;

    position: relative;
}

.page-banner::before {
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

.page-banner .container {
    position: relative;
    z-index: 1;
}


/* FEATURED PROPERTY */

.property-featured-box {
    width: 100%;
    background: #ffffff;
}


/* FEATURED PROPERTY HEADING */

.featured-property-heading {
    position: relative;
    padding-bottom: 18px;
    margin-bottom: 28px;
    font-family: 'Comfortaa', cursive;
    font-weight: 400;
}

.featured-property-heading::before {
    content: "";

    position: absolute;

    left: 0;
    bottom: 0;

    width: 110px;
    height: 2px;

    background: #19c88b;
}

.featured-property-heading::after {
    content: "";

    position: absolute;

    left: 0;
    bottom: -7px;

    width: 55px;
    height: 2px;

    background: #19c88b;
}


/* FEATURED PROPERTY MAIN IMAGE */
/* NOT SCROLLABLE */

.property-main-image {
    width: 100%;
    height: 500px;

    overflow: hidden;

    background: #f1f1f1;

    position: relative;
}

.property-main-image img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    display: block;
}


/* PREVIOUS / NEXT BUTTONS */

.property-slider-btn {
    position: absolute;

    top: 50%;

    transform: translateY(-50%);

    width: 45px;
    height: 45px;

    border: none;
    border-radius: 50%;

    background: rgba(0, 0, 0, 0.65);

    color: #ffffff;

    font-size: 22px;

    cursor: pointer;

    z-index: 5;

    display: flex;

    align-items: center;
    justify-content: center;

    transition: 0.2s ease;
}

.property-slider-btn:hover {
    background: #19c88b;
    color: #ffffff;
}

.property-prev {
    left: 18px;
}

.property-next {
    right: 18px;
}


/* IMAGE COUNTER */

.property-image-count {
    position: absolute;

    right: 18px;
    bottom: 18px;

    background: rgba(0, 0, 0, 0.70);

    color: #ffffff;

    padding: 8px 14px;

    border-radius: 4px;

    font-size: 14px;

    z-index: 5;
}


/* IMAGE GALLERY */

.property-gallery {
    display: flex;
    flex-wrap: wrap;

    gap: 10px;

    padding: 15px 0;
}

.property-thumbnail {
    width: 95px;
    height: 75px;

    object-fit: cover;

    cursor: pointer;

    border: 2px solid transparent;

    transition:
        border-color 0.2s ease,
        opacity 0.2s ease;
}

.property-thumbnail:hover {
    border-color: #19c88b;
    opacity: 0.85;
}

.property-thumbnail.active {
    border-color: #19c88b;
}


/* PROPERTY TITLE */

.property-title {
    font-family: 'Comfortaa', cursive;
    font-weight: 700;
}


/* PROPERTY INFORMATION */

.property-info-box {
    padding: 25px;

    background: #ffffff;

    box-shadow:
        0 1px 8px rgba(0,0,0,0.08);
}

.property-info-row {
    display: flex;
    flex-wrap: wrap;

    margin-left: -10px;
    margin-right: -10px;
}

.property-info-item {
    width: 50%;
    padding: 10px;
}

.property-info-item strong {
    display: block;
    margin-bottom: 5px;
}


/* SIDEBAR */

.property-summary-box {
    background: #f8f9fa;

    border: 1px solid #eeeeee;

    padding: 25px;

    border-radius: 4px;
}

.property-summary-box p {
    padding: 12px 0;

    margin: 0;

    border-bottom: 1px solid #e5e5e5;
}

.property-summary-box p:last-child {
    border-bottom: none;
}


/* PROPERTY DESCRIPTION */

.property-description {
    line-height: 1.8;

    color: #777777;

    margin-top: 25px;
}


/* RECENT PROPERTY */

.property_list_widget {
    list-style: none;

    padding: 0;
    margin: 0;
}

.property_list_widget li {
    display: flex;

    align-items: flex-start;

    gap: 12px;

    padding: 14px 0;

    border-bottom: 1px solid #eeeeee;
}

.property_list_widget li img {
    width: 80px;
    height: 70px;

    object-fit: cover;

    flex-shrink: 0;
}

.recent-property-content {
    flex: 1;
}

.recent-property-title {
    display: block;

    color: #18233f;

    font-size: 16px;

    font-weight: 500;

    margin-bottom: 6px;
}

.recent-property-title:hover {
    color: #19c88b;
    text-decoration: none;
}


/* MOBILE */

/* PROPERTY-WISE REQUEST BUTTON */

.property-summary-box .btn-primary {
    background: #1976d2;
    border-color: #1976d2;
    padding: 12px 18px;
    font-weight: 600;
}

.property-summary-box .btn-primary:hover {
    background: #1565c0;
    border-color: #1565c0;
}


@media (max-width: 767px) {

    .property-main-image {
        height: 350px;
    }

    .property-main-image img {
        width: 100%;
        height: 100%;

        object-fit: cover;

        object-position: center center;
    }

    .property-thumbnail {
        width: 75px;
        height: 60px;
    }

    .property-info-item {
        width: 100%;
    }

    .page-banner {
        min-height: 300px;

        background-attachment: scroll;
    }

    .property-slider-btn {
        width: 38px;
        height: 38px;

        font-size: 18px;
    }

    .property-prev {
        left: 10px;
    }

    .property-next {
        right: 10px;
    }

}

</style>


<title>
    <?php echo htmlspecialchars($property_name); ?>
    - Property Details
</title>

</head>


<body>

<div id="page-wrapper">

<div class="row">


<!-- HEADER -->

<?php include("include/header.php"); ?>


<!-- PROPERTY DETAILS BANNER -->

<div class="banner-full-row page-banner">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <h2
                    class="page-name text-uppercase mt-1 mb-0"
                    style="color:#d6d6d6;"
                >

                    <b>
                        Property Details
                    </b>

                </h2>

            </div>

        </div>

    </div>

</div>


<!-- PROPERTY DETAILS -->

<div class="full-row">

<div class="container">

<div class="row">


<!-- MAIN PROPERTY AREA -->

<div class="col-lg-8">

<div class="property-featured-box">


<!-- FEATURED PROPERTY HEADING -->

<h2
    class="property-title text-secondary featured-property-heading"
>
    Featured Property
</h2>


<!-- MAIN PROPERTY IMAGE -->

<?php if ($main_image != '') { ?>

<div class="property-main-image">

    <img
        id="mainPropertyImage"
        src="admin/property/<?php echo htmlspecialchars($main_image); ?>"
        alt="<?php echo htmlspecialchars($property_name); ?>"
    >


    <?php if (count($property_images) > 1) { ?>

        <!-- PREVIOUS -->

        <button
            type="button"
            class="property-slider-btn property-prev"
            onclick="previousPropertyImage()"
        >
            <i class="fas fa-chevron-left"></i>
        </button>


        <!-- NEXT -->

        <button
            type="button"
            class="property-slider-btn property-next"
            onclick="nextPropertyImage()"
        >
            <i class="fas fa-chevron-right"></i>
        </button>

    <?php } ?>


    <!-- IMAGE COUNTER -->

    <div class="property-image-count">

        <span id="imageCurrentNumber">
            1
        </span>

        /
        <?php echo count($property_images); ?>

    </div>

</div>

<?php } else { ?>

<div class="property-main-image">

    <div
        class="d-flex align-items-center justify-content-center h-100"
    >

        <span class="text-secondary">
            No Property Image Available
        </span>

    </div>

</div>

<?php } ?>


<!-- ALL PROPERTY PHOTOS -->

<?php if (count($property_images) > 1) { ?>

<div class="property-gallery">

    <?php foreach (
        $property_images
        as $index => $gallery_image
    ) { ?>

        <img
            src="admin/property/<?php echo htmlspecialchars($gallery_image); ?>"
            alt="Property Photo <?php echo $index + 1; ?>"
            class="property-thumbnail <?php echo $index == 0 ? 'active' : ''; ?>"
            onclick="changePropertyImage(<?php echo $index; ?>)"
        >

    <?php } ?>

</div>

<?php } ?>


<!-- PROPERTY TITLE -->

<h2
    class="text-secondary text-capitalize mt-4 mb-3"
>

    <?php
    echo htmlspecialchars($property_name);
    ?>

</h2>


<!-- PROPERTY ADDRESS -->

<?php if ($property_address != '') { ?>

<div class="mb-4">

    <i
        class="fas fa-map-marker-alt text-primary mr-2"
    ></i>

    <span class="text-secondary">

        <?php
        echo htmlspecialchars($property_address);
        ?>

    </span>

</div>

<?php } ?>


<!-- PROPERTY DESCRIPTION -->

<?php if ($property_content != '') { ?>

<div class="property-description">

    <h4 class="text-secondary mb-3">
        Description
    </h4>

    <?php
    echo $property_content;
    ?>

</div>

<?php } ?>


<!-- PROPERTY INFORMATION -->

<div class="property-info-box mt-4">

<h4 class="text-secondary mb-4">
    Property Information
</h4>


<div class="property-info-row">


<!-- TYPE -->

<?php if ($property_type != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Property Type
    </strong>

    <span class="text-muted text-capitalize">

        <?php
        echo htmlspecialchars($property_type);
        ?>

    </span>

</div>

<?php } ?>


<!-- STATUS -->

<?php if ($property_stype != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Status
    </strong>

    <span class="text-muted text-capitalize">

        <?php
        echo htmlspecialchars($property_stype);
        ?>

    </span>

</div>

<?php } ?>


<!-- PRICE -->

<?php if ($property_price != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Price
    </strong>

    <span class="text-muted">

        ₹<?php
        echo htmlspecialchars(
            formatIndianPrice($property_price)
        );
        ?>

    </span>

</div>

<?php } ?>


<!-- AREA -->

<?php if ($property_sqft != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Area
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_sqft);
        ?>

        Sqft

    </span>

</div>

<?php } ?>


<!-- BHK -->

<?php if ($property_bhk != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        BHK
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_bhk);
        ?>

    </span>

</div>

<?php } ?>


<!-- BEDROOM -->

<?php if ($property_bedroom != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Bedroom
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_bedroom);
        ?>

    </span>

</div>

<?php } ?>


<!-- BATHROOM -->

<?php if ($property_bathroom != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Bathroom
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_bathroom);
        ?>

    </span>

</div>

<?php } ?>


<!-- BALCONY -->

<?php if ($property_balcony != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Balcony
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_balcony);
        ?>

    </span>

</div>

<?php } ?>


<!-- KITCHEN -->

<?php if ($property_kitchen != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Kitchen
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_kitchen);
        ?>

    </span>

</div>

<?php } ?>


<!-- HALL -->

<?php if ($property_hall != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Hall
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_hall);
        ?>

    </span>

</div>

<?php } ?>


<!-- FLOOR -->

<?php if ($property_floor != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Floor
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_floor);
        ?>

    </span>

</div>

<?php } ?>


<!-- TOTAL FLOOR -->

<?php if ($property_totalfloor != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        Total Floors
    </strong>

    <span class="text-muted">

        <?php
        echo htmlspecialchars($property_totalfloor);
        ?>

    </span>

</div>

<?php } ?>


<!-- CITY -->

<?php if ($property_city != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        City
    </strong>

    <span class="text-muted text-capitalize">

        <?php
        echo htmlspecialchars($property_city);
        ?>

    </span>

</div>

<?php } ?>


<!-- STATE -->

<?php if ($property_state != '') { ?>

<div class="property-info-item">

    <strong class="text-secondary">
        State
    </strong>

    <span class="text-muted text-capitalize">

        <?php
        echo htmlspecialchars($property_state);
        ?>

    </span>

</div>

<?php } ?>


</div>

</div>


<!-- FEATURES -->

<?php if ($property_feature != '') { ?>

<div class="property-info-box mt-4">

    <h4 class="text-secondary mb-4">
        Features
    </h4>

    <div class="text-muted">

        <?php
        echo html_entity_decode(
            $property_feature,
            ENT_QUOTES,
            'UTF-8'
        );
        ?>

    </div>

</div>

<?php } ?>


</div>

</div>


<!-- RIGHT SIDEBAR -->

<div class="col-lg-4">


<!-- PROPERTY SUMMARY -->

<div class="sidebar-widget">

<h4
    class="double-down-line-left text-secondary position-relative pb-4 mb-4"
>
    Property Summary
</h4>


<div class="property-summary-box">


<?php if ($property_name != '') { ?>

<h5 class="text-secondary text-capitalize mb-3">

    <?php
    echo htmlspecialchars($property_name);
    ?>

</h5>

<?php } ?>


<?php if ($property_price != '') { ?>

<p>

    <strong>
        Price:
    </strong>

    ₹<?php
    echo htmlspecialchars(
        formatIndianPrice($property_price)
    );
    ?>

</p>

<?php } ?>


<?php if ($property_sqft != '') { ?>

<p>

    <strong>
        Area:
    </strong>

    <?php
    echo htmlspecialchars($property_sqft);
    ?>

    Sqft

</p>

<?php } ?>


<?php if ($property_type != '') { ?>

<p class="text-capitalize">

    <strong>
        Type:
    </strong>

    <?php
    echo htmlspecialchars($property_type);
    ?>

</p>

<?php } ?>


<?php if ($property_stype != '') { ?>

<p class="text-capitalize">

    <strong>
        Status:
    </strong>

    <?php
    echo htmlspecialchars($property_stype);
    ?>

</p>

<?php } ?>


<?php if ($property_city != '') { ?>

<p>

    <strong>
        City:
    </strong>

    <?php
    echo htmlspecialchars($property_city);
    ?>

</p>

<?php } ?>


<?php if ($property_state != '') { ?>

<p>

    <strong>
        State:
    </strong>

    <?php
    echo htmlspecialchars($property_state);
    ?>

</p>

<?php } ?>


</div>

</div>


<!-- PROPERTY-WISE REQUEST -->

<div class="sidebar-widget mt-4">

    <div class="property-summary-box text-center">

        <h5 class="text-secondary mb-3">
            Interested in this Property?
        </h5>

        <p class="text-muted mb-3" style="border-bottom:none;">
            Send a request for this property directly to the concerned Admin or Agent.
        </p>

        <a
            href="request.php?pid=<?php echo $property_id; ?>"
            class="btn btn-primary btn-block"
        >
            <i class="fas fa-paper-plane mr-2"></i>
            Send Property Request
        </a>

    </div>

</div>


<!-- RECENT PROPERTY ADD -->

<div class="sidebar-widget mt-5">

<h4
    class="double-down-line-left text-secondary position-relative pb-4 mb-4"
>
    Recent Property Add
</h4>


<ul class="property_list_widget">


<?php

$recent_query = mysqli_query(
    $con,
    "SELECT * FROM property
     WHERE pid != '$pid'
     ORDER BY date DESC
     LIMIT 6"
);

if ($recent_query) {

    while (
        $recent =
        mysqli_fetch_assoc($recent_query)
    ) {

        $recent_image = '';

        if (
            isset($recent['pimage']) &&
            trim($recent['pimage']) != ''
        ) {

            $recent_image =
                $recent['pimage'];

        }

?>


<li>


<?php if ($recent_image != '') { ?>

<img
    src="admin/property/<?php echo htmlspecialchars($recent_image); ?>"
    alt="Property"
>

<?php } ?>


<div class="recent-property-content">


<a
    class="recent-property-title"
    href="propertydetail.php?pid=<?php echo $recent['pid']; ?>"
>

<?php

if (
    isset($recent['title'])
) {

    echo htmlspecialchars(
        $recent['title']
    );

}
else {

    echo "Property";

}

?>

</a>


<?php if (
    isset($recent['location']) &&
    trim($recent['location']) != ''
) { ?>

<span class="font-14">

    <i
        class="fas fa-map-marker-alt icon-primary icon-small"
    ></i>

    <?php
    echo htmlspecialchars(
        $recent['location']
    );
    ?>

</span>

<?php } ?>


</div>


</li>


<?php

    }

}

?>


</ul>

</div>


</div>


</div>

</div>

</div>


<!-- FOOTER -->

<?php include("include/footer.php"); ?>


<!-- SCROLL TO TOP -->

<a
    href="#"
    class="bg-secondary text-white hover-text-secondary"
    id="scroll"
>
    <i class="fas fa-angle-up"></i>
</a>


</div>

</div>


<!-- JAVASCRIPT -->

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

<script src="js/jquery.cookie.js"></script>

<script src="js/custom.js"></script>


<!-- PROPERTY DETAIL BANNER SCROLL -->

<script>

window.addEventListener("scroll", function () {

    const banner =
        document.querySelector(".page-banner");

    if (!banner) {
        return;
    }

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
            Math.min(1, progress)
        );

    const moveY =
        -(progress * 150);

    banner.style.backgroundPosition =
        "center " + moveY + "px";

});

</script>


<!-- PROPERTY IMAGE GALLERY -->

<script>

var propertyImages = <?php
    echo json_encode($property_images);
?>;

var currentPropertyImage = 0;


/* CHANGE PROPERTY IMAGE */

function changePropertyImage(index)
{

    if (
        !propertyImages ||
        propertyImages.length === 0
    ) {
        return;
    }


    if (
        index < 0 ||
        index >= propertyImages.length
    ) {
        return;
    }


    currentPropertyImage = index;


    var mainImage =
        document.getElementById(
            "mainPropertyImage"
        );


    if (!mainImage) {
        return;
    }


    mainImage.src =
        "admin/property/" +
        propertyImages[index];


    var counter =
        document.getElementById(
            "imageCurrentNumber"
        );


    if (counter) {

        counter.innerHTML =
            index + 1;

    }


    var thumbnails =
        document.querySelectorAll(
            ".property-thumbnail"
        );


    thumbnails.forEach(
        function(
            thumbnail,
            thumbnailIndex
        )
        {

            thumbnail.classList.remove(
                "active"
            );


            if (
                thumbnailIndex === index
            ) {

                thumbnail.classList.add(
                    "active"
                );

            }

        }
    );

}


/* NEXT PHOTO */

function nextPropertyImage()
{

    if (
        !propertyImages ||
        propertyImages.length <= 1
    ) {
        return;
    }


    currentPropertyImage++;


    if (
        currentPropertyImage >=
        propertyImages.length
    ) {

        currentPropertyImage = 0;

    }


    changePropertyImage(
        currentPropertyImage
    );

}


/* PREVIOUS PHOTO */

function previousPropertyImage()
{

    if (
        !propertyImages ||
        propertyImages.length <= 1
    ) {
        return;
    }


    currentPropertyImage--;


    if (
        currentPropertyImage < 0
    ) {

        currentPropertyImage =
            propertyImages.length - 1;

    }


    changePropertyImage(
        currentPropertyImage
    );

}


/* KEYBOARD CONTROLS */

document.addEventListener(
    "keydown",
    function(event)
    {

        if (
            event.key ===
            "ArrowLeft"
        ) {

            previousPropertyImage();

        }


        if (
            event.key ===
            "ArrowRight"
        ) {

            nextPropertyImage();

        }

    }
);

</script>


</body>

</html>