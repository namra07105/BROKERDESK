<?php

session_start();

require("config.php");


/* =========================================================
   ADMIN LOGIN CHECK
========================================================= */

if(!isset($_SESSION['auser']))
{
    header("location:index.php");
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


/* =========================================================
   GET PROPERTY
========================================================= */

$propertyQuery = mysqli_query(
    $con,
    "SELECT * FROM property WHERE pid='$pid' LIMIT 1"
);

if(!$propertyQuery)
{
    die("Database Error: " . mysqli_error($con));
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

if(isset($_POST['update_property']))
{

    /* =====================================================
       BASIC PROPERTY DETAILS
    ===================================================== */

    $title   = mysqli_real_escape_string(
        $con,
        trim($_POST['title'])
    );

    $content = mysqli_real_escape_string(
        $con,
        $_POST['content']
    );

    $ptype   = mysqli_real_escape_string(
        $con,
        $_POST['ptype']
    );

    $bhk     = mysqli_real_escape_string(
        $con,
        $_POST['bhk']
    );

    $bed     = mysqli_real_escape_string(
        $con,
        $_POST['bed']
    );

    $balc    = mysqli_real_escape_string(
        $con,
        $_POST['balc']
    );

    $hall    = mysqli_real_escape_string(
        $con,
        $_POST['hall']
    );

    $stype   = mysqli_real_escape_string(
        $con,
        $_POST['stype']
    );

    $bath    = mysqli_real_escape_string(
        $con,
        $_POST['bath']
    );

    $kitc    = mysqli_real_escape_string(
        $con,
        $_POST['kitc']
    );

    $floor   = mysqli_real_escape_string(
        $con,
        $_POST['floor']
    );

    $price   = mysqli_real_escape_string(
        $con,
        $_POST['price']
    );

    $city    = mysqli_real_escape_string(
        $con,
        $_POST['city']
    );

    $asize   = mysqli_real_escape_string(
        $con,
        $_POST['asize']
    );

    $loc     = mysqli_real_escape_string(
        $con,
        $_POST['loc']
    );

    $state   = mysqli_real_escape_string(
        $con,
        $_POST['state']
    );

    $status  = mysqli_real_escape_string(
        $con,
        $_POST['status']
    );

    $feature = mysqli_real_escape_string(
        $con,
        $_POST['feature']
    );

    $totalfloor = mysqli_real_escape_string(
        $con,
        $_POST['totalfl']
    );


    /* =====================================================
       UPDATE NORMAL PROPERTY INFORMATION
    ===================================================== */

    $updateSql = "
        UPDATE property SET

            title='$title',
            pcontent='$content',
            type='$ptype',
            bhk='$bhk',
            bedroom='$bed',
            bathroom='$bath',
            balcony='$balc',
            kitchen='$kitc',
            hall='$hall',
            stype='$stype',
            floor='$floor',
            size='$asize',
            price='$price',
            location='$loc',
            city='$city',
            state='$state',
            feature='$feature',
            status='$status',
            totalfloor='$totalfloor'

        WHERE pid='$pid'
    ";


    $updateResult = mysqli_query(
        $con,
        $updateSql
    );


    if(!$updateResult)
    {
        $error =
            "<div class='alert alert-danger'>
                Property details could not be updated.
                <br>
                " . htmlspecialchars(mysqli_error($con)) . "
            </div>";
    }


    /* =====================================================
       IMAGE UPDATE
       
       IMPORTANT:
       Images are OPTIONAL.
       If no new image is selected,
       the old image remains unchanged.
    ===================================================== */

    if($updateResult)
    {

        $imageFields = array(
            'aimage'  => 'pimage',
            'aimage1' => 'pimage1',
            'aimage2' => 'pimage2',
            'aimage3' => 'pimage3',
            'aimage4' => 'pimage4',
            'aimage5' => 'pimage5',
            'aimage6' => 'pimage6',
            'aimage7' => 'pimage7',
            'aimage8' => 'pimage8'
        );


        $imageUpdates = array();


        foreach($imageFields as $inputName => $databaseField)
        {

            if(
                isset($_FILES[$inputName]) &&
                $_FILES[$inputName]['error'] == UPLOAD_ERR_OK &&
                !empty($_FILES[$inputName]['name'])
            )
            {

                $originalName =
                    $_FILES[$inputName]['name'];


                $tmpName =
                    $_FILES[$inputName]['tmp_name'];


                $extension =
                    strtolower(
                        pathinfo(
                            $originalName,
                            PATHINFO_EXTENSION
                        )
                    );


                $allowedExtensions = array(
                    'jpg',
                    'jpeg',
                    'png',
                    'webp'
                );


                if(!in_array(
                    $extension,
                    $allowedExtensions
                ))
                {
                    $error =
                        "<div class='alert alert-danger'>
                            Only JPG, JPEG, PNG and WEBP images are allowed.
                        </div>";

                    break;
                }


                /*
                 * Generate a unique filename
                 * so existing files are not accidentally overwritten.
                 */

                $newFileName =
                    'property_' .
                    $pid .
                    '_' .
                    $databaseField .
                    '_' .
                    time() .
                    '_' .
                    rand(1000,9999) .
                    '.' .
                    $extension;


                $uploadPath =
                    "property/" . $newFileName;


                if(
                    move_uploaded_file(
                        $tmpName,
                        $uploadPath
                    )
                )
                {

                    $imageUpdates[] =
                        $databaseField .
                        "='" .
                        mysqli_real_escape_string(
                            $con,
                            $newFileName
                        ) .
                        "'";

                }
                else
                {

                    $error =
                        "<div class='alert alert-danger'>
                            Failed to upload one of the selected images.
                        </div>";

                    break;
                }

            }

        }


        /* =================================================
           SAVE NEW IMAGE NAMES
        ================================================= */

        if(
            empty($error) &&
            count($imageUpdates) > 0
        )
        {

            $imageSql = "
                UPDATE property
                SET " .
                implode(
                    ", ",
                    $imageUpdates
                ) .
                "
                WHERE pid='$pid'
            ";


            $imageResult =
                mysqli_query(
                    $con,
                    $imageSql
                );


            if(!$imageResult)
            {
                $error =
                    "<div class='alert alert-danger'>
                        Images could not be updated.
                    </div>";
            }

        }


        /* =================================================
           SUCCESS
        ================================================= */

        if(empty($error))
        {

            $msg =
                "<div class='alert alert-success'>
                    Property Updated Successfully.
                </div>";

        }

    }

}


/* =========================================================
   REFRESH PROPERTY DATA AFTER UPDATE
========================================================= */

$propertyQuery = mysqli_query(
    $con,
    "SELECT * FROM property WHERE pid='$pid' LIMIT 1"
);


if(
    $propertyQuery &&
    mysqli_num_rows($propertyQuery) > 0
)
{
    $property = mysqli_fetch_assoc(
        $propertyQuery
    );
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, viewport-fit=cover"
    >

    <title>Property Edit - BROKERDESK</title>


    <!-- =====================================================
         FAVICON
    ====================================================== -->

    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="assets/img/favicon.png"
    >


    <!-- =====================================================
         BOOTSTRAP CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/bootstrap.min.css"
    >


    <!-- =====================================================
         FONT AWESOME
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/font-awesome.min.css"
    >


    <!-- =====================================================
         FEATHER ICON
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/feathericon.min.css"
    >


    <!-- =====================================================
         MAIN CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    <link rel="stylesheet" type="text/css" href="../css/responsive-fix.css">
    <link rel="stylesheet" type="text/css" href="assets/css/admin-mobile.css">
    >


    <!-- =====================================================
         EDIT PROPERTY STYLE
    ====================================================== -->

    <style>

        /* =====================================================
           CARD
        ===================================================== */

        .edit-property-card
        {
            border: none;

            border-radius: 6px;

            box-shadow:
                0 2px 15px rgba(0,0,0,0.06);

            margin-bottom: 30px;
        }


        .edit-property-card .card-header
        {
            background: #ffffff;

            border-bottom: 1px solid #eeeeee;

            padding: 20px 25px;
        }


        .edit-property-card .card-body
        {
            padding: 25px;
        }


        /* =====================================================
           SECTION TITLE
        ===================================================== */

        .edit-section-title
        {
            font-size: 18px;

            font-weight: 600;

            color: #333333;

            margin: 5px 0 25px 0;

            padding-bottom: 12px;

            border-bottom: 1px solid #eeeeee;
        }


        .edit-section-title i
        {
            margin-right: 8px;

            color: #17a2b8;
        }


        /* =====================================================
           FORM LABEL
        ===================================================== */

        .edit-property-card label
        {
            font-weight: 500;

            color: #555555;
        }


        .edit-property-card .form-control
        {
            border-radius: 4px;

            min-height: 42px;
        }


        .edit-property-card textarea.form-control
        {
            min-height: 100px;
        }


        /* =====================================================
           PROPERTY ID / UID
        ===================================================== */

        .readonly-field
        {
            background: #f5f5f5 !important;

            cursor: not-allowed;
        }


        /* =====================================================
           IMAGE BOX
        ===================================================== */

        .edit-image-box
        {
            border: 1px solid #e6e6e6;

            border-radius: 6px;

            padding: 15px;

            margin-bottom: 20px;

            background: #ffffff;
        }


        .edit-image-title
        {
            font-weight: 600;

            color: #444444;

            margin-bottom: 12px;
        }


        .edit-current-image
        {
            width: 180px;

            height: 125px;

            object-fit: cover;

            border-radius: 5px;

            border: 1px solid #dddddd;

            display: block;

            margin-bottom: 12px;
        }


        .edit-no-image
        {
            width: 180px;

            height: 125px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f3f3f3;

            border: 1px solid #dddddd;

            border-radius: 5px;

            color: #aaaaaa;

            font-size: 35px;

            margin-bottom: 12px;
        }


        .image-help-text
        {
            color: #999999;

            font-size: 12px;

            margin-top: 7px;

            display: block;
        }


        /* =====================================================
           BUTTON AREA
        ===================================================== */

        .edit-button-area
        {
            border-top: 1px solid #eeeeee;

            margin-top: 20px;

            padding-top: 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            flex-wrap: wrap;

            gap: 10px;
        }


        .edit-update-btn
        {
            padding: 11px 25px;

            font-size: 14px;

            font-weight: 600;
        }


        .edit-back-btn
        {
            padding: 11px 20px;

            font-size: 14px;
        }


        /* =====================================================
           REQUIRED STAR
        ====================================================== */

        .required-star
        {
            color: #dc3545;
        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media(max-width:767px)
        {

            .edit-property-card .card-body
            {
                padding: 18px;
            }


            .edit-property-card .card-header
            {
                padding: 18px;
            }


            .edit-current-image,
            .edit-no-image
            {
                width: 150px;

                height: 105px;
            }


            .edit-button-area
            {
                display: block;
            }


            .edit-update-btn,
            .edit-back-btn
            {
                width: 100%;

                margin-bottom: 10px;
            }

        }

    </style>

</head>


<body>


<!-- =========================================================
     MAIN WRAPPER
========================================================= -->

<div class="main-wrapper">


    <!-- =====================================================
         ADMIN HEADER
         EXISTING HEADER — NOT CHANGED
    ====================================================== -->

    <?php include("header.php"); ?>


    <!-- =====================================================
         PAGE WRAPPER
    ====================================================== -->

    <div class="page-wrapper">

        <div class="content container-fluid">


            <!-- =================================================
                 PAGE HEADER
            ================================================== -->

            <div class="page-header">

                <div class="row">

                    <div class="col">

                        <h3 class="page-title">
                            Property
                        </h3>


                        <!--<ul class="breadcrumb">

                            <li class="breadcrumb-item">

                                <a href="dashboard.php">
                                    
                                </a>

                            </li>


                            <li class="breadcrumb-item">

                                <a href="propertyview.php">
                                    
                                </a>

                            </li>


                            <li class="breadcrumb-item active">

                                

                            </li>

                        </ul>-->

                    </div>

                </div>

            </div>


            <!-- =================================================
                 EDIT PROPERTY CARD
            ================================================== -->

            <div class="row">

                <div class="col-md-12">

                    <div class="card edit-property-card">


                        <!-- =================================================
                             CARD HEADER
                        ================================================== -->

                        <div class="card-header">

                            <h4 class="card-title mb-0">

                                Edit Property

                            </h4>

                        </div>


                        <!-- =================================================
                             FORM
                        ================================================== -->

                        <form
                            method="post"
                            enctype="multipart/form-data"
                        >


                            <div class="card-body">


                                <!-- =================================================
                                     SUCCESS / ERROR
                                ================================================== -->

                                <?php

                                echo $error;

                                echo $msg;

                                ?>


                                <!-- =================================================
                                     PROPERTY BASIC DETAILS
                                ================================================== -->

                                <h4 class="edit-section-title">

                                    <i class="fa fa-home"></i>

                                    Property Details

                                </h4>


                                <div class="row">


                                    <!-- TITLE -->

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>

                                                Property Title

                                                <span class="required-star">
                                                    *
                                                </span>

                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                name="title"
                                                required
                                                value="<?php echo htmlspecialchars($property['title']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- DESCRIPTION -->

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>
                                                Property Description
                                            </label>


                                            <textarea
                                                class="tinymce form-control"
                                                name="content"
                                                rows="8"
                                            ><?php echo htmlspecialchars($property['pcontent']); ?></textarea>

                                        </div>

                                    </div>


                                </div>


                                <!-- =================================================
                                     PROPERTY TYPE / BHK
                                ================================================== -->

                                <div class="row">


                                    <!-- PROPERTY TYPE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Property Type
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
                                                    if($property['type'] == 'bunglow')
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Bungalow
                                                </option>


                                                <option
                                                    value="office"
                                                    <?php
                                                    if($property['type'] == 'office')
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Office
                                                </option>


                                                <option
                                                    value="villa"
                                                    <?php
                                                    if($property['type'] == 'villa')
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Villa
                                                </option>


                                                <option
                                                    value="appartment"
                                                    <?php
                                                    if(
                                                        $property['type'] == 'appartment' ||
                                                        $property['type'] == 'apartment'
                                                    )
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Apartment
                                                </option>


                                            </select>

                                        </div>

                                    </div>


                                    <!-- BHK -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                BHK
                                            </label>


                                            <select
                                                class="form-control"
                                                name="bhk"
                                                required
                                            >

                                                <option value="">
                                                    Select BHK
                                                </option>


                                                <?php

                                                $bhkOptions = array(
                                                    '-',
                                                    '1 BHK',
                                                    '2 BHK',
                                                    '3 BHK',
                                                    '4 BHK',
                                                    '5 BHK',
                                                    '1,2 BHK',
                                                    '2,3 BHK',
                                                    '2,3,4 BHK'
                                                );


                                                foreach($bhkOptions as $bhkOption)
                                                {

                                                ?>

                                                    <option
                                                        value="<?php echo htmlspecialchars($bhkOption); ?>"
                                                        <?php

                                                        if(
                                                            $property['bhk'] ==
                                                            $bhkOption
                                                        )
                                                        {
                                                            echo 'selected';
                                                        }

                                                        ?>
                                                    >

                                                        <?php
                                                        echo htmlspecialchars(
                                                            $bhkOption
                                                        );
                                                        ?>

                                                    </option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- SELLING TYPE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Selling Type
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
                                                    if($property['stype'] == 'rent')
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Rent
                                                </option>


                                                <option
                                                    value="sale"
                                                    <?php
                                                    if($property['stype'] == 'sale')
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Sale
                                                </option>


                                            </select>

                                        </div>

                                    </div>


                                    <!-- BEDROOM -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Bedrooms
                                            </label>


                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                name="bed"
                                                value="<?php echo htmlspecialchars($property['bedroom']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- BATHROOM -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Bathrooms
                                            </label>


                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                name="bath"
                                                value="<?php echo htmlspecialchars($property['bathroom']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- BALCONY -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Balcony
                                            </label>


                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                name="balc"
                                                value="<?php echo htmlspecialchars($property['balcony']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- KITCHEN -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Kitchen
                                            </label>


                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                name="kitc"
                                                value="<?php echo htmlspecialchars($property['kitchen']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- HALL -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Hall
                                            </label>


                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                name="hall"
                                                value="<?php echo htmlspecialchars($property['hall']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- FLOOR -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Floor
                                            </label>


                                            <select
                                                class="form-control"
                                                name="floor"
                                                required
                                            >

                                                <option value="">
                                                    Select Floor
                                                </option>


                                                <option
                                                    value="-"
                                                    <?php
                                                    if($property['floor'] == '-')
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    -
                                                </option>


                                                <?php

                                                $floorOptions = array(
                                                    'Ground Floor',
                                                    '1st Floor',
                                                    '2nd Floor',
                                                    '3rd Floor',
                                                    '4th Floor',
                                                    '5th Floor',
                                                    '6th Floor',
                                                    '7th Floor',
                                                    '8th Floor',
                                                    '9th Floor',
                                                    '10th Floor',
                                                    '11th Floor',
                                                    '12th Floor',
                                                    '13th Floor',
                                                    '14th Floor',
                                                    '15th Floor'
                                                );


                                                foreach($floorOptions as $floorOption)
                                                {

                                                ?>

                                                    <option
                                                        value="<?php echo htmlspecialchars($floorOption); ?>"
                                                        <?php

                                                        if(
                                                            $property['floor'] ==
                                                            $floorOption
                                                        )
                                                        {
                                                            echo 'selected';
                                                        }

                                                        ?>
                                                    >

                                                        <?php
                                                        echo htmlspecialchars(
                                                            $floorOption
                                                        );
                                                        ?>

                                                    </option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>

                                    </div>


                                </div>


                                <!-- =================================================
                                     PRICE & LOCATION
                                ================================================== -->

                                <h4 class="edit-section-title mt-4">

                                    <i class="fa fa-map-marker"></i>

                                    Price & Location

                                </h4>


                                <div class="row">


                                    <!-- PRICE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Price
                                                <span class="required-star">*</span>
                                            </label>


                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                name="price"
                                                required
                                                value="<?php echo htmlspecialchars($property['price']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- AREA -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Area Size
                                                <span class="required-star">*</span>
                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                name="asize"
                                                required
                                                value="<?php echo htmlspecialchars($property['size']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- ADDRESS -->

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>
                                                Address
                                                <span class="required-star">*</span>
                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                name="loc"
                                                required
                                                value="<?php echo htmlspecialchars($property['location']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- CITY -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                City
                                                <span class="required-star">*</span>
                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                name="city"
                                                required
                                                value="<?php echo htmlspecialchars($property['city']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- STATE -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                State
                                                <span class="required-star">*</span>
                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                name="state"
                                                required
                                                value="<?php echo htmlspecialchars($property['state']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- TOTAL FLOOR -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Total Floors
                                            </label>


                                            <select
                                                class="form-control"
                                                name="totalfl"
                                                required
                                            >

                                                <option value="">
                                                    Select Total Floors
                                                </option>


                                                <option
                                                    value="-"
                                                    <?php
                                                    if($property['totalfloor'] == '-')
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    -
                                                </option>


                                                <?php

                                                for(
                                                    $i = 1;
                                                    $i <= 30;
                                                    $i++
                                                )
                                                {

                                                    $floorText =
                                                        $i . ' Floor';

                                                ?>

                                                    <option
                                                        value="<?php echo htmlspecialchars($floorText); ?>"
                                                        <?php

                                                        if(
                                                            $property['totalfloor'] ==
                                                            $floorText
                                                        )
                                                        {
                                                            echo 'selected';
                                                        }

                                                        ?>
                                                    >

                                                        <?php
                                                        echo $floorText;
                                                        ?>

                                                    </option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>

                                    </div>


                                </div>


                                <!-- =================================================
                                     FEATURES
                                ================================================== -->

                                <h4 class="edit-section-title mt-4">

                                    <i class="fa fa-list"></i>

                                    Property Features

                                </h4>


                                <div class="form-group">

                                    <label>
                                        Features
                                    </label>


                                    <textarea
                                        class="tinymce form-control"
                                        name="feature"
                                        rows="8"
                                    ><?php echo htmlspecialchars($property['feature']); ?></textarea>

                                </div>


                                <!-- =================================================
                                     STATUS / OWNER
                                ================================================== -->

                                <h4 class="edit-section-title mt-4">

                                    <i class="fa fa-info-circle"></i>

                                    Status & Ownership

                                </h4>


                                <div class="row">


                                    <!-- STATUS -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Property Status
                                                <span class="required-star">*</span>
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
                                                    if(
                                                        strtolower(
                                                            trim(
                                                                $property['status']
                                                            )
                                                        ) == 'available'
                                                    )
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Available
                                                </option>


                                                <option
                                                    value="sold out"
                                                    <?php
                                                    if(
                                                        strtolower(
                                                            trim(
                                                                $property['status']
                                                            )
                                                        ) == 'sold out'
                                                    )
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Sold Out
                                                </option>


                                                <option
                                                    value="pending"
                                                    <?php
                                                    if(
                                                        strtolower(
                                                            trim(
                                                                $property['status']
                                                            )
                                                        ) == 'pending'
                                                    )
                                                    {
                                                        echo 'selected';
                                                    }
                                                    ?>
                                                >
                                                    Pending
                                                </option>


                                            </select>

                                        </div>

                                    </div>


                                    <!-- PROPERTY ID -->

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label>
                                                Property ID
                                            </label>


                                            <input
                                                type="text"
                                                class="form-control readonly-field"
                                                readonly
                                                value="<?php echo htmlspecialchars($property['pid']); ?>"
                                            >

                                        </div>

                                    </div>


                                    <!-- UID -->

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label>
                                                Agent UID
                                            </label>


                                            <input
                                                type="text"
                                                class="form-control readonly-field"
                                                readonly
                                                value="<?php echo htmlspecialchars($property['uid']); ?>"
                                            >

                                        </div>

                                    </div>


                                </div>


                                <!-- =================================================
                                     PROPERTY IMAGES
                                ================================================== -->

                                <h4 class="edit-section-title mt-4">

                                    <i class="fa fa-picture-o"></i>

                                    Property Images

                                </h4>


                                <div class="row">


                                    <?php

                                    $imageFields = array(
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


                                    $counter = 0;


                                    foreach(
                                        $imageFields as $databaseField => $imageLabel
                                    )
                                    {

                                        $inputName =
                                            str_replace(
                                                'pimage',
                                                'aimage',
                                                $databaseField
                                            );


                                    ?>

                                        <div class="col-xl-4 col-lg-4 col-md-6">

                                            <div class="edit-image-box">


                                                <div class="edit-image-title">

                                                    <?php
                                                    echo $imageLabel;
                                                    ?>

                                                </div>


                                                <?php

                                                if(
                                                    !empty(
                                                        $property[$databaseField]
                                                    )
                                                )

                                                {

                                                ?>

                                                    <img
                                                        src="property/<?php echo htmlspecialchars($property[$databaseField]); ?>"
                                                        alt="<?php echo htmlspecialchars($imageLabel); ?>"
                                                        class="edit-current-image"
                                                    >

                                                <?php

                                                }

                                                else

                                                {

                                                ?>

                                                    <div class="edit-no-image">

                                                        <i class="fa fa-image"></i>

                                                    </div>

                                                <?php

                                                }

                                                ?>


                                                <input
                                                    class="form-control"
                                                    name="<?php echo htmlspecialchars($inputName); ?>"
                                                    type="file"
                                                    accept=".jpg,.jpeg,.png,.webp"
                                                >


                                                <span class="image-help-text">

                                                    Leave empty to keep the current image.

                                                </span>


                                            </div>

                                        </div>


                                    <?php

                                        $counter++;

                                    }

                                    ?>


                                </div>


                                <!-- =================================================
                                     BUTTONS
                                ================================================== -->

                                <div class="edit-button-area">


                                    <a
                                        href="propertyview.php"
                                        class="btn btn-secondary edit-back-btn"
                                    >

                                        <i class="fa fa-arrow-left mr-1"></i>

                                        Back to Properties

                                    </a>


                                    <button
                                        type="submit"
                                        name="update_property"
                                        class="btn btn-primary edit-update-btn"
                                    >

                                        <i class="fa fa-save mr-1"></i>

                                        Update Property

                                    </button>


                                </div>


                            </div>


                        </form>


                    </div>

                </div>

            </div>


        </div>

    </div>


</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->


<!-- jQuery -->

<script src="assets/js/jquery-3.2.1.min.js"></script>


<!-- TinyMCE -->

<script src="assets/plugins/tinymce/tinymce.min.js"></script>

<script src="assets/plugins/tinymce/init-tinymce.min.js"></script>


<!-- Bootstrap -->

<script src="assets/js/popper.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script>


<!-- Slimscroll -->

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<!-- Custom JS -->

<script src="assets/js/script.js"></script>


</body>

</html>