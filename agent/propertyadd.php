<?php

session_start();

include("../config.php");


/* =========================================================
   AGENT LOGIN CHECK
========================================================= */

if(!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
    header("location:../login.php");
    exit;
}

$uid = intval($_SESSION['uid']);


/* =========================================================
   CHECK AGENT ACCOUNT
========================================================= */

$agentQuery = mysqli_query(
    $con,
    "SELECT * FROM user WHERE uid='$uid'"
);

if(!$agentQuery)
{
    die("Database Error: " . mysqli_error($con));
}

if(mysqli_num_rows($agentQuery) == 0)
{
    session_destroy();

    header("location:../login.php");
    exit;
}

$agent = mysqli_fetch_assoc($agentQuery);

if(strtolower(trim($agent['utype'])) != 'agent')
{
    header("location:../index.php");
    exit;
}


/* =========================================================
   VARIABLES
========================================================= */

$error = "";
$msg = "";


/* =========================================================
   ADD PROPERTY
========================================================= */

if(isset($_POST['add']))
{

    /* =====================================================
       PROPERTY DETAILS
    ===================================================== */

    $title   = $_POST['title'];
    $content = $_POST['content'];
    $ptype   = $_POST['ptype'];
    $bhk     = $_POST['bhk'];
    $bed     = $_POST['bed'];
    $balc    = $_POST['balc'];
    $hall    = $_POST['hall'];
    $stype   = $_POST['stype'];
    $bath    = $_POST['bath'];
    $kitc    = $_POST['kitc'];
    $floor   = $_POST['floor'];
    $price   = $_POST['price'];
    $city    = $_POST['city'];
    $asize   = $_POST['asize'];
    $loc     = $_POST['loc'];
    $state   = $_POST['state'];
    $status  = $_POST['status'];
    $feature = $_POST['feature'];

    $totalfloor = $_POST['totalfl'];


    /* =====================================================
       IMAGES
    ===================================================== */

    $aimage  = $_FILES['aimage']['name'];
    $aimage1 = $_FILES['aimage1']['name'];
    $aimage2 = $_FILES['aimage2']['name'];
    $aimage3 = $_FILES['aimage3']['name'];
    $aimage4 = $_FILES['aimage4']['name'];
    $aimage5 = $_FILES['aimage5']['name'];
    $aimage6 = $_FILES['aimage6']['name'];
    $aimage7 = $_FILES['aimage7']['name'];
    $aimage8 = $_FILES['aimage8']['name'];


    /* =====================================================
       TEMPORARY FILE NAMES
    ===================================================== */

    $temp_name  = $_FILES['aimage']['tmp_name'];
    $temp_name1 = $_FILES['aimage1']['tmp_name'];
    $temp_name2 = $_FILES['aimage2']['tmp_name'];
    $temp_name3 = $_FILES['aimage3']['tmp_name'];
    $temp_name4 = $_FILES['aimage4']['tmp_name'];
    $temp_name5 = $_FILES['aimage5']['tmp_name'];
    $temp_name6 = $_FILES['aimage6']['tmp_name'];
    $temp_name7 = $_FILES['aimage7']['tmp_name'];
    $temp_name8 = $_FILES['aimage8']['tmp_name'];


    /* =====================================================
       UPLOAD LOCATION
    ===================================================== */

    $uploadPath = "../admin/property/";


    /* =====================================================
       MOVE IMAGES
    ===================================================== */

    move_uploaded_file(
        $temp_name,
        $uploadPath . $aimage
    );

    move_uploaded_file(
        $temp_name1,
        $uploadPath . $aimage1
    );

    move_uploaded_file(
        $temp_name2,
        $uploadPath . $aimage2
    );

    move_uploaded_file(
        $temp_name3,
        $uploadPath . $aimage3
    );

    move_uploaded_file(
        $temp_name4,
        $uploadPath . $aimage4
    );

    move_uploaded_file(
        $temp_name5,
        $uploadPath . $aimage5
    );

    move_uploaded_file(
        $temp_name6,
        $uploadPath . $aimage6
    );

    move_uploaded_file(
        $temp_name7,
        $uploadPath . $aimage7
    );

    move_uploaded_file(
        $temp_name8,
        $uploadPath . $aimage8
    );


    /* =====================================================
       INSERT PROPERTY
       
       UID COMES FROM LOGGED-IN AGENT SESSION
       NOT FROM FORM INPUT
    ===================================================== */

    $sql = "INSERT INTO property
    (
        title,
        pcontent,
        type,
        bhk,
        stype,
        bedroom,
        bathroom,
        balcony,
        kitchen,
        hall,
        floor,
        size,
        price,
        location,
        city,
        state,
        feature,
        pimage,
        pimage1,
        pimage2,
        pimage3,
        pimage4,
        pimage5,
        pimage6,
        pimage7,
        pimage8,
        uid,
        uploaded_by,
        status,
        totalfloor
    )
    VALUES
    (
        '$title',
        '$content',
        '$ptype',
        '$bhk',
        '$stype',
        '$bed',
        '$bath',
        '$balc',
        '$kitc',
        '$hall',
        '$floor',
        '$asize',
        '$price',
        '$loc',
        '$city',
        '$state',
        '$feature',
        '$aimage',
        '$aimage1',
        '$aimage2',
        '$aimage3',
        '$aimage4',
        '$aimage5',
        '$aimage6',
        '$aimage7',
        '$aimage8',
        '$uid',
        'agent',
        '$status',
        '$totalfloor'
    )";


    $result = mysqli_query($con, $sql);


    if($result)
    {
        $msg =
        "<p class='alert alert-success'>
            Property Inserted Successfully
        </p>";
    }
    else
    {
        $error =
        "<p class='alert alert-warning'>
            Property Not Inserted Some Error
        </p>";
    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=0"
    >

    <title>Agent - Add Property</title>


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
         CSS - SAME AS AGENT PROPERTY VIEW
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
    >


    <!-- =====================================================
         AGENT PROPERTY CSS
    ====================================================== -->

    <style>

        .agent-property-add
        {
            background: #f5f6f7;

            padding: 50px 0;
        }


        .agent-property-card
        {
            background: #ffffff;

            border-radius: 4px;

            box-shadow:
                0 2px 12px rgba(0,0,0,0.06);

            padding: 30px;
        }


        .agent-property-card h4
        {
            color: #333333;

            font-family: "Comfortaa", sans-serif;

            font-weight: 600;

            margin-bottom: 25px;
        }


        .agent-image-preview
        {
            display: none;

            width: 180px;

            height: 150px;

            object-fit: cover;

            margin-top: 10px;

            border-radius: 4px;
        }


        @media(max-width:767px)
        {

            .agent-property-add
            {
                padding: 30px 0;
            }


            .agent-property-card
            {
                padding: 20px;
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

        <div class="full-row agent-property-add">

            <div class="container">


                <!-- =================================================
                     PAGE HEADER
                ================================================= -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="mb-4">

                            <h3 class="page-title">
                                Add Property
                            </h3>

                            <ul class="breadcrumb">

                                <li class="breadcrumb-item">

                                    <a href="dashboard.php">
                                        Dashboard
                                    </a>

                                </li>

                                <li class="breadcrumb-item active">
                                    Add Property
                                </li>

                            </ul>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     PROPERTY FORM
                ================================================= -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="agent-property-card">


                            <h4>
                                Add Property Details
                            </h4>


                            <?php echo $error; ?>

                            <?php echo $msg; ?>


                            <form
                                method="post"
                                enctype="multipart/form-data"
                            >


                                <!-- =================================================
                                     PROPERTY DETAIL
                                ================================================= -->

                                <h5 class="card-title mb-4">
                                    Property Detail
                                </h5>


                                <div class="row">


                                    <!-- TITLE -->

                                    <div class="col-xl-12">

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-2 col-form-label"
                                            >
                                                Title
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="title"
                                                    required
                                                    placeholder="Enter Title"
                                                >

                                            </div>

                                        </div>


                                        <!-- CONTENT -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-2 col-form-label"
                                            >
                                                Content
                                            </label>

                                            <div class="col-lg-9">

                                                <textarea
                                                    class="tinymce form-control"
                                                    name="content"
                                                    rows="10"
                                                    cols="30"
                                                ></textarea>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- LEFT -->

                                    <div class="col-xl-6">


                                        <!-- PROPERTY TYPE -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Property Type
                                            </label>

                                            <div class="col-lg-9">

                                                <select
                                                    class="form-control"
                                                    required
                                                    name="ptype"
                                                >

                                                    <option value="">
                                                        Select Type
                                                    </option>

                                                    <option value="bunglow">
                                                        Bunglow
                                                    </option>

                                                    <option value="office">
                                                        Office
                                                    </option>

                                                    <option value="villa">
                                                        Villa
                                                    </option>

                                                    <option value="appartment">
                                                        Apartment
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- SELLING TYPE -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Selling Type
                                            </label>

                                            <div class="col-lg-9">

                                                <select
                                                    class="form-control"
                                                    required
                                                    name="stype"
                                                >

                                                    <option value="">
                                                        Select Status
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


                                        <!-- BATHROOM -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Bathroom
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="bath"
                                                    required
                                                    placeholder="Enter Bathroom"
                                                >

                                            </div>

                                        </div>


                                        <!-- KITCHEN -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Kitchen
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="kitc"
                                                    required
                                                    placeholder="Enter Kitchen"
                                                >

                                            </div>

                                        </div>


                                    </div>


                                    <!-- RIGHT -->

                                    <div class="col-xl-6">


                                        <!-- BHK -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                BHK
                                            </label>

                                            <div class="col-lg-9">

                                                <select
                                                    class="form-control"
                                                    required
                                                    name="bhk"
                                                >

                                                    <option value="">
                                                        Select BHK
                                                    </option>

                                                    <option value="-">
                                                        -
                                                    </option>

                                                    <option value="1 BHK">
                                                        1 BHK
                                                    </option>

                                                    <option value="2 BHK">
                                                        2 BHK
                                                    </option>

                                                    <option value="3 BHK">
                                                        3 BHK
                                                    </option>

                                                    <option value="4 BHK">
                                                        4 BHK
                                                    </option>

                                                    <option value="5 BHK">
                                                        5 BHK
                                                    </option>

                                                    <option value="1,2 BHK">
                                                        1,2 BHK
                                                    </option>

                                                    <option value="2,3 BHK">
                                                        2,3 BHK
                                                    </option>

                                                    <option value="2,3,4 BHK">
                                                        2,3,4 BHK
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- BEDROOM -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Bedroom
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="bed"
                                                    required
                                                    placeholder="Enter Bedroom"
                                                >

                                            </div>

                                        </div>


                                        <!-- BALCONY -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Balcony
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="balc"
                                                    required
                                                    placeholder="Enter Balcony"
                                                >

                                            </div>

                                        </div>


                                        <!-- HALL -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Hall
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="hall"
                                                    required
                                                    placeholder="Enter Hall"
                                                >

                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <!-- =================================================
                                     PRICE & LOCATION
                                ================================================= -->

                                <h4 class="card-title mt-4">
                                    Price & Location
                                </h4>


                                <div class="row">


                                    <!-- LEFT -->

                                    <div class="col-xl-6">


                                        <!-- FLOOR -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Floor
                                            </label>

                                            <div class="col-lg-9">

                                                <select
                                                    class="form-control"
                                                    required
                                                    name="floor"
                                                >

                                                    <option value="">
                                                        Select Floor
                                                    </option>

                                                    <option value="-">
                                                        -
                                                    </option>

                                                    <option value="1st Floor">
                                                        1st Floor
                                                    </option>

                                                    <option value="2nd Floor">
                                                        2nd Floor
                                                    </option>

                                                    <option value="3rd Floor">
                                                        3rd Floor
                                                    </option>

                                                    <option value="4th Floor">
                                                        4th Floor
                                                    </option>

                                                    <option value="5th Floor">
                                                        5th Floor
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- PRICE -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Price
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="price"
                                                    required
                                                    placeholder="Enter Price"
                                                >

                                            </div>

                                        </div>


                                        <!-- CITY -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                City
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="city"
                                                    required
                                                    placeholder="Enter City"
                                                >

                                            </div>

                                        </div>


                                        <!-- STATE -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                State
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="state"
                                                    required
                                                    placeholder="Enter State"
                                                >

                                            </div>

                                        </div>


                                    </div>


                                    <!-- RIGHT -->

                                    <div class="col-xl-6">


                                        <!-- TOTAL FLOOR -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Total Floor
                                            </label>

                                            <div class="col-lg-9">

                                                <select
                                                    class="form-control"
                                                    required
                                                    name="totalfl"
                                                >

                                                    <option value="">
                                                        Select Floor
                                                    </option>

                                                    <option value="-">
                                                        -
                                                    </option>

                                                    <option value="1 Floor">
                                                        1 Floor
                                                    </option>

                                                    <option value="2 Floor">
                                                        2 Floor
                                                    </option>

                                                    <option value="3 Floor">
                                                        3 Floor
                                                    </option>

                                                    <option value="4 Floor">
                                                        4 Floor
                                                    </option>

                                                    <option value="5 Floor">
                                                        5 Floor
                                                    </option>

                                                    <option value="6 Floor">
                                                        6 Floor
                                                    </option>

                                                    <option value="7 Floor">
                                                        7 Floor
                                                    </option>

                                                    <option value="8 Floor">
                                                        8 Floor
                                                    </option>

                                                    <option value="9 Floor">
                                                        9 Floor
                                                    </option>

                                                    <option value="10 Floor">
                                                        10 Floor
                                                    </option>

                                                    <option value="11 Floor">
                                                        11 Floor
                                                    </option>

                                                    <option value="12 Floor">
                                                        12 Floor
                                                    </option>

                                                    <option value="13 Floor">
                                                        13 Floor
                                                    </option>

                                                    <option value="14 Floor">
                                                        14 Floor
                                                    </option>

                                                    <option value="15 Floor">
                                                        15 Floor
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- AREA SIZE -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Area Size
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="asize"
                                                    required
                                                    placeholder="Enter Area Size"
                                                >

                                            </div>

                                        </div>


                                        <!-- ADDRESS -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Address
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="loc"
                                                    required
                                                    placeholder="Enter Address"
                                                >

                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <!-- =================================================
                                     FEATURE
                                ================================================= -->

                                <div class="form-group row">

                                    <label
                                        class="col-lg-2 col-form-label"
                                    >
                                        Feature
                                    </label>

                                    <div class="col-lg-9">


                                        <textarea
                                            class="tinymce form-control"
                                            name="feature"
                                            rows="10"
                                            cols="30"
                                        ><!---feature area start--->
<div class="col-md-4">
    <ul>
        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Property Age :
            </span>
            10 Years
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Swiming Pool :
            </span>
            Yes
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Parking :
            </span>
            Yes
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                GYM :
            </span>
            Yes
        </li>
    </ul>
</div>

<div class="col-md-4">
    <ul>
        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Type :
            </span>
            Appartment
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Security :
            </span>
            Yes
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Dining Capacity :
            </span>
            10 People
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Temple :
            </span>
            Yes
        </li>
    </ul>
</div>

<div class="col-md-4">
    <ul>
        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                3rd Party :
            </span>
            No
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Alivator :
            </span>
            Yes
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                CCTV :
            </span>
            Yes
        </li>

        <li class="mb-3">
            <span class="text-secondary font-weight-bold">
                Water Supply :
            </span>
            Ground Water / Tank
        </li>
    </ul>
</div>
<!---feature area end----></textarea>


                                    </div>

                                </div>


                                <!-- =================================================
                                     IMAGE & STATUS
                                ================================================= -->

                                <h4 class="card-title mt-4">
                                    Image & Status
                                </h4>


                                <div class="row">


                                    <!-- LEFT COLUMN -->

                                    <div class="col-xl-6">


                                        <!-- IMAGE -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- IMAGE 2 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 2
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage2"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage2"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- IMAGE 4 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 4
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage4"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage4"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- IMAGE 6 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 6
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage6"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage6"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- IMAGE 8 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 8
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage8"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage8"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- STATUS -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Status
                                            </label>

                                            <div class="col-lg-9">

                                                <select
                                                    class="form-control"
                                                    required
                                                    name="status"
                                                >

                                                    <option value="">
                                                        Select Status
                                                    </option>

                                                    <option value="available">
                                                        Available
                                                    </option>

                                                    <option value="sold out">
                                                        Sold Out
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                    </div>


                                    <!-- RIGHT COLUMN -->

                                    <div class="col-xl-6">


                                        <!-- IMAGE 1 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 1
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage1"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage1"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- IMAGE 3 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 3
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage3"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage3"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- IMAGE 5 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 5
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage5"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage5"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                        <!-- IMAGE 7 -->

                                        <div class="form-group row">

                                            <label
                                                class="col-lg-3 col-form-label"
                                            >
                                                Image 7
                                            </label>

                                            <div class="col-lg-9">

                                                <input
                                                    class="form-control"
                                                    name="aimage7"
                                                    type="file"
                                                    required
                                                    accept="image/*"
                                                >

                                                <img
                                                    id="preview_aimage7"
                                                    class="agent-image-preview"
                                                    src=""
                                                    alt=""
                                                >

                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <!-- =================================================
                                     SUBMIT
                                ================================================= -->

                                <div class="row mt-4">

                                    <div class="col-md-12">

                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                            name="add"
                                        >

                                            Submit

                                        </button>

                                    </div>

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
        var preview = document.getElementById('preview_' + this.name);

        if(preview && this.files && this.files[0])
        {
            preview.src = URL.createObjectURL(this.files[0]);
            preview.style.display = 'block';
        }
    });
});

</script>


<script src="../js/custom.js"></script>


</body>

</html>