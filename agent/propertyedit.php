<?php

session_start();

include("../config.php");


/* =========================================================
   AGENT LOGIN CHECK
========================================================= */

if(!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
    header("Location: login.php");
    exit;
}

$uid = intval($_SESSION['uid']);


/* =========================================================
   CHECK AGENT ACCOUNT
========================================================= */

$agentQuery = mysqli_query(
    $con,
    "SELECT * FROM user WHERE uid='$uid' LIMIT 1"
);

if(!$agentQuery)
{
    die("Database Error: " . mysqli_error($con));
}

if(mysqli_num_rows($agentQuery) == 0)
{
    session_destroy();

    header("Location: login.php");
    exit;
}

$agent = mysqli_fetch_assoc($agentQuery);

if(strtolower(trim($agent['utype'])) != 'agent')
{
    header("location:../index.php");
    exit;
}


/* =========================================================
   GET PROPERTY ID
========================================================= */

if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("location:propertyview.php");
    exit;
}

$pid = intval($_GET['id']);

if($pid <= 0)
{
    header("location:propertyview.php");
    exit;
}


/* =========================================================
   GET PROPERTY
   IMPORTANT:
   PROPERTY MUST BELONG TO LOGGED-IN AGENT
========================================================= */

$propertyQuery = mysqli_query(
    $con,
    "SELECT * FROM property
     WHERE pid='$pid'
     AND uid='$uid'
     LIMIT 1"
);

if(!$propertyQuery)
{
    die("Property Database Error: " . mysqli_error($con));
}

if(mysqli_num_rows($propertyQuery) == 0)
{
    header("location:propertyview.php");
    exit;
}

$property = mysqli_fetch_assoc($propertyQuery);


/* =========================================================
   VARIABLES
========================================================= */

$error = "";
$msg = "";


/* =========================================================
   UPDATE PROPERTY
========================================================= */

if(isset($_POST['update']))
{

    /* =====================================================
       PROPERTY DETAILS
    ===================================================== */

    $title = isset($_POST['title'])
        ? trim($_POST['title'])
        : '';

    $content = isset($_POST['content'])
        ? $_POST['content']
        : '';

    $ptype = isset($_POST['ptype'])
        ? trim($_POST['ptype'])
        : '';

    $bhk = isset($_POST['bhk'])
        ? trim($_POST['bhk'])
        : '';

    $bed = isset($_POST['bed'])
        ? trim($_POST['bed'])
        : '';

    $balc = isset($_POST['balc'])
        ? trim($_POST['balc'])
        : '';

    $hall = isset($_POST['hall'])
        ? trim($_POST['hall'])
        : '';

    $stype = isset($_POST['stype'])
        ? trim($_POST['stype'])
        : '';

    $bath = isset($_POST['bath'])
        ? trim($_POST['bath'])
        : '';

    $kitc = isset($_POST['kitc'])
        ? trim($_POST['kitc'])
        : '';

    $floor = isset($_POST['floor'])
        ? trim($_POST['floor'])
        : '';

    $price = isset($_POST['price'])
        ? trim($_POST['price'])
        : '';

    $city = isset($_POST['city'])
        ? trim($_POST['city'])
        : '';

    $asize = isset($_POST['asize'])
        ? trim($_POST['asize'])
        : '';

    $loc = isset($_POST['loc'])
        ? trim($_POST['loc'])
        : '';

    $state = isset($_POST['state'])
        ? trim($_POST['state'])
        : '';

    $status = isset($_POST['status'])
        ? trim($_POST['status'])
        : '';

    $feature = isset($_POST['feature'])
        ? $_POST['feature']
        : '';

    $totalfloor = isset($_POST['totalfl'])
        ? trim($_POST['totalfl'])
        : '';


    /* =====================================================
       BASIC VALIDATION
    ===================================================== */

    if(
        empty($title) ||
        empty($ptype) ||
        empty($bhk) ||
        empty($stype) ||
        empty($price) ||
        empty($asize) ||
        empty($loc) ||
        empty($city) ||
        empty($state) ||
        empty($status)
    )
    {
        $error =
        "<p class='alert alert-warning'>
            Please fill all required fields.
        </p>";
    }
    else
    {

        /* =================================================
           ESCAPE VALUES
        ================================================= */

        $titleEsc = mysqli_real_escape_string($con, $title);
        $contentEsc = mysqli_real_escape_string($con, $content);
        $ptypeEsc = mysqli_real_escape_string($con, $ptype);
        $bhkEsc = mysqli_real_escape_string($con, $bhk);
        $bedEsc = mysqli_real_escape_string($con, $bed);
        $balcEsc = mysqli_real_escape_string($con, $balc);
        $hallEsc = mysqli_real_escape_string($con, $hall);
        $stypeEsc = mysqli_real_escape_string($con, $stype);
        $bathEsc = mysqli_real_escape_string($con, $bath);
        $kitcEsc = mysqli_real_escape_string($con, $kitc);
        $floorEsc = mysqli_real_escape_string($con, $floor);
        $priceEsc = mysqli_real_escape_string($con, $price);
        $cityEsc = mysqli_real_escape_string($con, $city);
        $asizeEsc = mysqli_real_escape_string($con, $asize);
        $locEsc = mysqli_real_escape_string($con, $loc);
        $stateEsc = mysqli_real_escape_string($con, $state);
        $statusEsc = mysqli_real_escape_string($con, $status);
        $featureEsc = mysqli_real_escape_string($con, $feature);
        $totalfloorEsc = mysqli_real_escape_string($con, $totalfloor);


        /* =================================================
           EXISTING IMAGE NAMES
        ================================================= */

        $imageFields = array(
            'pimage',
            'pimage1',
            'pimage2',
            'pimage3',
            'pimage4',
            'pimage5',
            'pimage6',
            'pimage7',
            'pimage8'
        );

        $imageNames = array();

        foreach($imageFields as $field)
        {
            $imageNames[$field] = isset($property[$field])
                ? $property[$field]
                : '';
        }


        /* =================================================
           IMAGE UPLOAD
        ================================================= */

        $uploadPath = "../admin/property/";

        $allowedExtensions = array(
            'jpg',
            'jpeg',
            'png',
            'webp'
        );

        $uploadError = false;


        foreach($imageFields as $field)
        {

            if(
                isset($_FILES[$field]) &&
                isset($_FILES[$field]['error']) &&
                $_FILES[$field]['error'] != UPLOAD_ERR_NO_FILE
            )
            {

                if($_FILES[$field]['error'] != UPLOAD_ERR_OK)
                {
                    $error =
                    "<p class='alert alert-warning'>
                        There was a problem uploading " .
                        htmlspecialchars($field) .
                        ".
                    </p>";

                    $uploadError = true;
                    break;
                }


                $originalName = $_FILES[$field]['name'];

                $extension = strtolower(
                    pathinfo(
                        $originalName,
                        PATHINFO_EXTENSION
                    )
                );


                if(!in_array($extension, $allowedExtensions))
                {
                    $error =
                    "<p class='alert alert-warning'>
                        Invalid image format for " .
                        htmlspecialchars($field) .
                        ".
                        Please use JPG, JPEG, PNG or WEBP.
                    </p>";

                    $uploadError = true;
                    break;
                }


                /* =========================================
                   CREATE UNIQUE FILE NAME
                ========================================= */

                $newFileName =
                    'property_' .
                    $pid .
                    '_' .
                    $field .
                    '_' .
                    time() .
                    '_' .
                    rand(1000,9999) .
                    '.' .
                    $extension;


                $destination = $uploadPath . $newFileName;


                if(move_uploaded_file(
                    $_FILES[$field]['tmp_name'],
                    $destination
                ))
                {
                    $imageNames[$field] = $newFileName;
                }
                else
                {
                    $error =
                    "<p class='alert alert-warning'>
                        Unable to upload " .
                        htmlspecialchars($field) .
                        ".
                    </p>";

                    $uploadError = true;
                    break;
                }
            }
        }


        /* =================================================
           UPDATE DATABASE
        ================================================= */

        if(!$uploadError)
        {

            $sql = "UPDATE property SET

                title='$titleEsc',
                pcontent='$contentEsc',
                type='$ptypeEsc',
                bhk='$bhkEsc',
                stype='$stypeEsc',
                bedroom='$bedEsc',
                bathroom='$bathEsc',
                balcony='$balcEsc',
                kitchen='$kitcEsc',
                hall='$hallEsc',
                floor='$floorEsc',
                size='$asizeEsc',
                price='$priceEsc',
                location='$locEsc',
                city='$cityEsc',
                state='$stateEsc',
                feature='$featureEsc',

                pimage='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage']
                ) . "',

                pimage1='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage1']
                ) . "',

                pimage2='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage2']
                ) . "',

                pimage3='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage3']
                ) . "',

                pimage4='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage4']
                ) . "',

                pimage5='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage5']
                ) . "',

                pimage6='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage6']
                ) . "',

                pimage7='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage7']
                ) . "',

                pimage8='" . mysqli_real_escape_string(
                    $con,
                    $imageNames['pimage8']
                ) . "',

                status='$statusEsc',
                totalfloor='$totalfloorEsc',
                uploaded_by='agent'

                WHERE pid='$pid'
                AND uid='$uid'";


            $result = mysqli_query($con, $sql);


            if($result)
            {

                $msg =
                "<p class='alert alert-success'>
                    Property Updated Successfully.
                </p>";


                /* =========================================
                   REFRESH PROPERTY DATA
                ========================================= */

                $refreshQuery = mysqli_query(
                    $con,
                    "SELECT * FROM property
                     WHERE pid='$pid'
                     AND uid='$uid'
                     LIMIT 1"
                );


                if($refreshQuery &&
                   mysqli_num_rows($refreshQuery) > 0)
                {
                    $property =
                        mysqli_fetch_assoc($refreshQuery);
                }

            }
            else
            {
                $error =
                "<p class='alert alert-warning'>
                    Property could not be updated.
                    Please try again.
                </p>";
            }
        }
    }
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

    <title>Edit Property - BROKERDESK</title>


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
         CSS - SAME AS AGENT PROPERTY VIEW / ADD
    ====================================================== -->

    <link
        rel="stylesheet"
        href="../css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        href="../css/bootstrap-slider.css"
    >

    <link
        rel="stylesheet"
        href="../css/jquery-ui.css"
    >

    <link
        rel="stylesheet"
        href="../css/layerslider.css"
    >

    <link
        rel="stylesheet"
        href="../css/color.css"
    >

    <link
        rel="stylesheet"
        href="../css/owl.carousel.min.css"
    >

    <link
        rel="stylesheet"
        href="../css/font-awesome.min.css"
    >

    <link
        rel="stylesheet"
        href="../fonts/flaticon/flaticon.css"
    >

    <link
        rel="stylesheet"
        href="../css/style.css"
    <link rel="stylesheet" type="text/css" href="../css/responsive-fix.css">
    >


    <!-- =====================================================
         EDIT PROPERTY CSS
    ====================================================== -->

    <style>

        .agent-property-edit
        {
            background: #f5f6f7;
            padding: 50px 0 70px 0;
            min-height: 600px;
        }


        .agent-property-card
        {
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            padding: 30px;
        }


        .agent-page-title
        {
            font-family: "Comfortaa", sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #333333;
            margin-bottom: 8px;
        }


        .agent-page-subtitle
        {
            color: #777777;
            font-size: 14px;
            margin-bottom: 30px;
        }


        .agent-section-title
        {
            font-family: "Comfortaa", sans-serif;
            font-size: 19px;
            font-weight: 600;
            color: #333333;
            padding-bottom: 15px;
            margin-top: 10px;
            margin-bottom: 25px;
            border-bottom: 1px solid #eeeeee;
        }


        .agent-section-title i
        {
            margin-right: 8px;
        }


        .agent-required
        {
            color: #dc3545;
        }


        .agent-property-id
        {
            background: #f5f5f5 !important;
            color: #777777;
            cursor: not-allowed;
        }


        .agent-current-image
        {
            display: block;
            width: 170px;
            height: 115px;
            object-fit: cover;
            border-radius: 5px;
            margin-top: 12px;
            border: 1px solid #eeeeee;
        }


        .agent-no-current-image
        {
            width: 170px;
            height: 115px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
            color: #aaa;
            border-radius: 5px;
            margin-top: 12px;
            font-size: 30px;
        }


        .agent-new-preview
        {
            display: none;
            width: 170px;
            height: 115px;
            object-fit: cover;
            border-radius: 5px;
            margin-top: 12px;
            border: 1px solid #eeeeee;
        }


        .agent-image-note
        {
            display: block;
            margin-top: 7px;
            font-size: 12px;
            color: #999999;
        }


        .agent-form-label
        {
            font-weight: 600;
            color: #555555;
        }


        .agent-button-area
        {
            border-top: 1px solid #eeeeee;
            margin-top: 30px;
            padding-top: 25px;
        }


        .agent-back-button
        {
            margin-right: 8px;
        }


        @media(max-width:767px)
        {

            .agent-property-edit
            {
                padding: 30px 0 50px 0;
            }


            .agent-property-card
            {
                padding: 20px;
            }


            .agent-page-title
            {
                font-size: 23px;
            }


            .agent-current-image,
            .agent-no-current-image,
            .agent-new-preview
            {
                width: 150px;
                height: 105px;
            }

        }

    </style>

</head>


<body>


<div id="page-wrapper">

    <div class="row">


        <!-- =====================================================
             AGENT HEADER
        ===================================================== -->

        <?php include("header.php"); ?>


        <!-- =====================================================
             PAGE CONTENT
        ===================================================== -->

        <div class="full-row agent-property-edit">

            <div class="container">


                <!-- =================================================
                     PAGE HEADER
                ================================================= -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="mb-4">

                            <h3 class="agent-page-title">
                                Edit Property
                            </h3>

                            <p class="agent-page-subtitle">
                                Update your property details and images.
                            </p>

                            <!--<ul class="breadcrumb">

                                <li class="breadcrumb-item">

                                    <a href="dashboard.php">
                                        Dashboard
                                    </a>

                                </li>

                                <li class="breadcrumb-item">

                                    <a href="propertyview.php">
                                        My Properties
                                    </a>

                                </li>

                                <li class="breadcrumb-item active">
                                    Edit Property
                                </li>

                            </ul>-->

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     EDIT FORM
                ================================================= -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="agent-property-card">


                            <h4 class="mb-4">
                                Edit Property Details
                            </h4>


                            <?php echo $error; ?>

                            <?php echo $msg; ?>


                            <form
                                method="post"
                                enctype="multipart/form-data"
                            >


                                <!-- =================================================
                                     PROPERTY INFORMATION
                                ================================================= -->

                                <h5 class="agent-section-title">

                                    <i class="fa fa-home"></i>

                                    Property Information

                                </h5>


                                <div class="row">


                                    <!-- PROPERTY ID -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Property ID
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control agent-property-id"
                                                value="<?php echo intval($property['pid']); ?>"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <!-- TITLE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Property Title
                                                <span class="agent-required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="title"
                                                value="<?php echo htmlspecialchars($property['title'] ?? ''); ?>"
                                                required
                                                placeholder="Enter property title"
                                            >

                                        </div>

                                    </div>


                                    <!-- PROPERTY TYPE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Property Type
                                                <span class="agent-required">*</span>
                                            </label>

                                            <select
                                                class="form-control"
                                                name="ptype"
                                                required
                                            >

                                                <option value="">
                                                    Select Type
                                                </option>

                                                <option
                                                    value="bunglow"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['type'] ?? '')) == 'bunglow'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Bunglow
                                                </option>

                                                <option
                                                    value="office"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['type'] ?? '')) == 'office'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Office
                                                </option>

                                                <option
                                                    value="villa"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['type'] ?? '')) == 'villa'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Villa
                                                </option>

                                                <option
                                                    value="appartment"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['type'] ?? '')) == 'appartment'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Apartment
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- SELLING TYPE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Selling Type
                                                <span class="agent-required">*</span>
                                            </label>

                                            <select
                                                class="form-control"
                                                name="stype"
                                                required
                                            >

                                                <option value="">
                                                    Select Selling Type
                                                </option>

                                                <option
                                                    value="rent"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['stype'] ?? '')) == 'rent'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Rent
                                                </option>

                                                <option
                                                    value="sale"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['stype'] ?? '')) == 'sale'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Sale
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- BHK -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                BHK
                                                <span class="agent-required">*</span>
                                            </label>

                                            <select
                                                class="form-control"
                                                name="bhk"
                                                required
                                            >

                                                <option value="">
                                                    Select BHK
                                                </option>

                                                <option
                                                    value="-"
                                                    <?php echo (($property['bhk'] ?? '') == '-') ? 'selected' : ''; ?>
                                                >
                                                    -
                                                </option>

                                                <option
                                                    value="1 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '1 BHK') ? 'selected' : ''; ?>
                                                >
                                                    1 BHK
                                                </option>

                                                <option
                                                    value="2 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '2 BHK') ? 'selected' : ''; ?>
                                                >
                                                    2 BHK
                                                </option>

                                                <option
                                                    value="3 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '3 BHK') ? 'selected' : ''; ?>
                                                >
                                                    3 BHK
                                                </option>

                                                <option
                                                    value="4 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '4 BHK') ? 'selected' : ''; ?>
                                                >
                                                    4 BHK
                                                </option>

                                                <option
                                                    value="5 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '5 BHK') ? 'selected' : ''; ?>
                                                >
                                                    5 BHK
                                                </option>

                                                <option
                                                    value="1,2 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '1,2 BHK') ? 'selected' : ''; ?>
                                                >
                                                    1,2 BHK
                                                </option>

                                                <option
                                                    value="2,3 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '2,3 BHK') ? 'selected' : ''; ?>
                                                >
                                                    2,3 BHK
                                                </option>

                                                <option
                                                    value="2,3,4 BHK"
                                                    <?php echo (($property['bhk'] ?? '') == '2,3,4 BHK') ? 'selected' : ''; ?>
                                                >
                                                    2,3,4 BHK
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- BEDROOM -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Bedroom
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="bed"
                                                value="<?php echo htmlspecialchars($property['bedroom'] ?? ''); ?>"
                                                placeholder="Enter bedroom count"
                                            >

                                        </div>

                                    </div>


                                    <!-- BATHROOM -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Bathroom
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="bath"
                                                value="<?php echo htmlspecialchars($property['bathroom'] ?? ''); ?>"
                                                placeholder="Enter bathroom count"
                                            >

                                        </div>

                                    </div>


                                    <!-- BALCONY -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Balcony
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="balc"
                                                value="<?php echo htmlspecialchars($property['balcony'] ?? ''); ?>"
                                                placeholder="Enter balcony count"
                                            >

                                        </div>

                                    </div>


                                    <!-- KITCHEN -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Kitchen
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="kitc"
                                                value="<?php echo htmlspecialchars($property['kitchen'] ?? ''); ?>"
                                                placeholder="Enter kitchen details"
                                            >

                                        </div>

                                    </div>


                                    <!-- HALL -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Hall
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="hall"
                                                value="<?php echo htmlspecialchars($property['hall'] ?? ''); ?>"
                                                placeholder="Enter hall details"
                                            >

                                        </div>

                                    </div>


                                </div>


                                <!-- =================================================
                                     DESCRIPTION
                                ================================================= -->

                                <h5 class="agent-section-title mt-4">

                                    <i class="fa fa-align-left"></i>

                                    Description

                                </h5>


                                <div class="form-group">

                                    <label class="agent-form-label">
                                        Property Description
                                    </label>

                                    <textarea
                                        class="tinymce form-control"
                                        name="content"
                                        rows="10"
                                    ><?php echo htmlspecialchars($property['pcontent'] ?? ''); ?></textarea>

                                </div>


                                <!-- =================================================
                                     PRICE & LOCATION
                                ================================================= -->

                                <h5 class="agent-section-title mt-4">

                                    <i class="fa fa-map-marker"></i>

                                    Price & Location

                                </h5>


                                <div class="row">


                                    <!-- PRICE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Price
                                                <span class="agent-required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="price"
                                                value="<?php echo htmlspecialchars($property['price'] ?? ''); ?>"
                                                required
                                                placeholder="Enter property price"
                                            >

                                        </div>

                                    </div>


                                    <!-- AREA -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Area Size
                                                <span class="agent-required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="asize"
                                                value="<?php echo htmlspecialchars($property['size'] ?? ''); ?>"
                                                required
                                                placeholder="Example: 1500 Sq Ft"
                                            >

                                        </div>

                                    </div>


                                    <!-- ADDRESS -->

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Address
                                                <span class="agent-required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="loc"
                                                value="<?php echo htmlspecialchars($property['location'] ?? ''); ?>"
                                                required
                                                placeholder="Enter complete property address"
                                            >

                                        </div>

                                    </div>


                                    <!-- CITY -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                City
                                                <span class="agent-required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="city"
                                                value="<?php echo htmlspecialchars($property['city'] ?? ''); ?>"
                                                required
                                                placeholder="Enter city"
                                            >

                                        </div>

                                    </div>


                                    <!-- STATE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                State
                                                <span class="agent-required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="state"
                                                value="<?php echo htmlspecialchars($property['state'] ?? ''); ?>"
                                                required
                                                placeholder="Enter state"
                                            >

                                        </div>

                                    </div>


                                    <!-- FLOOR -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Floor
                                            </label>

                                            <select
                                                class="form-control"
                                                name="floor"
                                            >

                                                <option value="-">
                                                    -
                                                </option>

                                                <option
                                                    value="1st Floor"
                                                    <?php echo (($property['floor'] ?? '') == '1st Floor') ? 'selected' : ''; ?>
                                                >
                                                    1st Floor
                                                </option>

                                                <option
                                                    value="2nd Floor"
                                                    <?php echo (($property['floor'] ?? '') == '2nd Floor') ? 'selected' : ''; ?>
                                                >
                                                    2nd Floor
                                                </option>

                                                <option
                                                    value="3rd Floor"
                                                    <?php echo (($property['floor'] ?? '') == '3rd Floor') ? 'selected' : ''; ?>
                                                >
                                                    3rd Floor
                                                </option>

                                                <option
                                                    value="4th Floor"
                                                    <?php echo (($property['floor'] ?? '') == '4th Floor') ? 'selected' : ''; ?>
                                                >
                                                    4th Floor
                                                </option>

                                                <option
                                                    value="5th Floor"
                                                    <?php echo (($property['floor'] ?? '') == '5th Floor') ? 'selected' : ''; ?>
                                                >
                                                    5th Floor
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- TOTAL FLOOR -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Total Floor
                                            </label>

                                            <select
                                                class="form-control"
                                                name="totalfl"
                                            >

                                                <option value="-">
                                                    -
                                                </option>

                                                <?php

                                                for($i = 1; $i <= 15; $i++)
                                                {

                                                    $floorValue = $i . " Floor";

                                                    $selected =
                                                        (($property['totalfloor'] ?? '') == $floorValue)
                                                        ? 'selected'
                                                        : '';

                                                    echo
                                                    '<option value="' .
                                                    htmlspecialchars($floorValue) .
                                                    '" ' .
                                                    $selected .
                                                    '>' .
                                                    htmlspecialchars($floorValue) .
                                                    '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>

                                    </div>


                                </div>


                                <!-- =================================================
                                     FEATURES
                                ================================================= -->

                                <h5 class="agent-section-title mt-4">

                                    <i class="fa fa-list"></i>

                                    Features

                                </h5>


                                <div class="form-group">

                                    <label class="agent-form-label">
                                        Property Features
                                    </label>

                                    <textarea
                                        class="tinymce form-control"
                                        name="feature"
                                        rows="10"
                                    ><?php echo htmlspecialchars($property['feature'] ?? ''); ?></textarea>

                                </div>


                                <!-- =================================================
                                     STATUS
                                ================================================= -->

                                <h5 class="agent-section-title mt-4">

                                    <i class="fa fa-check-circle"></i>

                                    Property Status

                                </h5>


                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="agent-form-label">
                                                Status
                                                <span class="agent-required">*</span>
                                            </label>

                                            <select
                                                class="form-control"
                                                name="status"
                                                required
                                            >

                                                <option value="">
                                                    Select Status
                                                </option>

                                                <option
                                                    value="available"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['status'] ?? '')) == 'available'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Available
                                                </option>

                                                <option
                                                    value="sold out"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['status'] ?? '')) == 'sold out'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Sold Out
                                                </option>

                                                <option
                                                    value="pending"
                                                    <?php
                                                    echo (
                                                        strtolower(trim($property['status'] ?? '')) == 'pending'
                                                    )
                                                    ? 'selected'
                                                    : '';
                                                    ?>
                                                >
                                                    Pending
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>


                                <!-- =================================================
                                     PROPERTY IMAGES
                                ================================================= -->

                                <h5 class="agent-section-title mt-4">

                                    <i class="fa fa-picture-o"></i>

                                    Property Images

                                </h5>


                                <p class="text-muted mb-4">
                                    Select a new image only if you want to replace the existing one.
                                    Otherwise, leave the field empty and the current image will remain.
                                </p>


                                <div class="row">


                                    <?php

                                    $imageLabels = array(
                                        'pimage'  => 'Image',
                                        'pimage1' => 'Image 1',
                                        'pimage2' => 'Image 2',
                                        'pimage3' => 'Image 3',
                                        'pimage4' => 'Image 4',
                                        'pimage5' => 'Image 5',
                                        'pimage6' => 'Image 6',
                                        'pimage7' => 'Image 7',
                                        'pimage8' => 'Image 8'
                                    );


                                    foreach($imageLabels as $field => $label)
                                    {

                                        $currentImage =
                                            isset($property[$field])
                                            ? trim($property[$field])
                                            : '';

                                    ?>

                                        <div class="col-xl-4 col-md-6">

                                            <div class="form-group">

                                                <label class="agent-form-label">

                                                    <?php
                                                    echo htmlspecialchars($label);
                                                    ?>

                                                </label>


                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    name="<?php echo htmlspecialchars($field); ?>"
                                                    accept="image/jpeg,image/jpg,image/png,image/webp"
                                                >


                                                <?php

                                                if(!empty($currentImage))
                                                {

                                                ?>

                                                    <img
                                                        src="../admin/property/<?php echo htmlspecialchars($currentImage); ?>"
                                                        alt="<?php echo htmlspecialchars($label); ?>"
                                                        class="agent-current-image"
                                                    >

                                                <?php

                                                }
                                                else
                                                {

                                                ?>

                                                    <div class="agent-no-current-image">

                                                        <i class="fa fa-image"></i>

                                                    </div>

                                                <?php

                                                }

                                                ?>


                                                <img
                                                    id="preview_<?php echo htmlspecialchars($field); ?>"
                                                    class="agent-new-preview"
                                                    src=""
                                                    alt="New Image Preview"
                                                >


                                                <small class="agent-image-note">
                                                    Optional — leave empty to keep current image.
                                                </small>

                                            </div>

                                        </div>

                                    <?php

                                    }

                                    ?>

                                </div>


                                <!-- =================================================
                                     BUTTONS
                                ================================================= -->

                                <div class="agent-button-area">

                                    <a
                                        href="propertyview.php"
                                        class="btn btn-secondary agent-back-button"
                                    >

                                        <i class="fa fa-arrow-left mr-1"></i>

                                        Back to My Properties

                                    </a>


                                    <button
                                        type="submit"
                                        name="update"
                                        class="btn btn-primary"
                                    >

                                        <i class="fa fa-save mr-1"></i>

                                        Update Property

                                    </button>

                                </div>


                            </form>


                        </div>

                    </div>

                </div>


            </div>

        </div>


        <!-- =====================================================
             FOOTER
        ===================================================== -->

        <?php include("footer.php"); ?>


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


<!-- =========================================================
     TINYMCE
========================================================= -->

<script src="../admin/assets/plugins/tinymce/tinymce.min.js"></script>

<script src="../admin/assets/plugins/tinymce/init-tinymce.min.js"></script>


<!-- =========================================================
     IMAGE PREVIEW
========================================================= -->

<script>

document
.querySelectorAll('input[type="file"]')
.forEach(function(input)
{

    input.addEventListener('change', function()
    {

        var preview =
            document.getElementById(
                'preview_' + this.name
            );


        if(
            preview &&
            this.files &&
            this.files[0]
        )
        {

            preview.src =
                URL.createObjectURL(
                    this.files[0]
                );

            preview.style.display =
                'block';

        }

    });

});

</script>


<script src="../js/custom.js"></script>


</body>

</html>