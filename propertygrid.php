<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");

///search code
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Homex template">
<meta name="keywords" content="">
<meta name="author" content="Unicoder">

<link rel="shortcut icon" href="images/favicon.ico">

<!-- Fonts
========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!-- Css Link
========================================================-->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">


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

/* Keep image and text properly aligned */
.property-grid-page .property_list_widget li {
    position: relative;
    min-height: 80px;
    overflow: hidden;
    padding-left: 84px;
}

/* Image stays fixed on the left */
.property-grid-page .property_list_widget li img {
    width: 72px;
    height: 72px;
    object-fit: cover;
    position: absolute;
    left: 0;
    top: 0;
    margin: 0;
}

/* Property name */
.property-grid-page .property_list_widget li h6 {
    margin: 0 0 5px 0;
    padding: 0;
    line-height: 1.4;
}

/* Property address */
.property-grid-page .property_list_widget li .font-14 {
    display: block;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    word-break: break-word;
}

/* Keep location icon aligned */
.property-grid-page .property_list_widget li .font-14 i {
    margin-right: 4px;
}


/* =========================================================
   GRID IMAGE / TOP BANNER
   SAME STYLE AS PROPERTY.PHP / PROPERTYIMG
========================================================= */

.page-banner {
    width: 100%;
    height: 420px;
    overflow: hidden;
    position: relative;
    background: #000;

    background-image: url('images/Gridimage.jpg') !important;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}

/* Same dark overlay as propertyimg */
.page-banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.25);
    z-index: 1;
}

/* Keep banner content above overlay */
.page-banner .container {
    position: relative;
    z-index: 2;
}

/* Remove empty bootstrap breadcrumb separator */
.page-banner .breadcrumb-item + .breadcrumb-item::before {
    display: none !important;
}

.page-banner .breadcrumb {
    display: none !important;
}

@media (max-width: 767px) {
    .page-banner {
        height: 350px;
        background-attachment: scroll;
    }
}

</style>


<!-- Title
=========================================================-->
<title>Homex - Real Estate Template</title>

</head>

<body>


<div id="page-wrapper">

    <div class="row"> 


        <!-- Header start -->

        <?php include("include/header.php");?>

        <!-- Header end -->
        

        
        <!-- =====================================================
             BANNER
        ====================================================== -->

        <div class="banner-full-row page-banner" id="houseBanner">

            <div class="container h-100 position-relative" style="z-index: 2;">
                <div class="row h-100 align-items-center">
                    <div class="col-md-6">
                        <h2 class="page-name text-uppercase mt-1 mb-0" style="color: #d6d6d6;">
                            <b>Properties</b>
                        </h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- Banner end -->
        


        <!-- =====================================================
             PROPERTY GRID
        ====================================================== -->

        <div class="full-row property-grid-page">

            <div class="container">

                <div class="row">
                

                    <!-- =================================================
                         PROPERTY LIST
                    ================================================= -->

                    <div class="col-lg-8">

                        <div class="row">
                        

                            <?php 
                            
                            if(isset($_REQUEST['filter']))
                            {

                                $type=$_REQUEST['type'];
                                $stype=$_REQUEST['stype'];
                                $city=$_REQUEST['city'];
                                
                                $sql="SELECT * FROM property WHERE type='{$type}' and stype='{$stype}' and city='{$city}'";
                                
                                $result=mysqli_query($con,$sql);
                            
                                if(mysqli_num_rows($result)>0)
                                {

                                    if($result == true)
                                    {

                                        while($row=mysqli_fetch_array($result))
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
                                            src="admin/property/<?php echo $row['18'];?>" 
                                            alt="pimage"
                                        >
                                        


                                        <!-- Sale / Rent -->

                                        <div class="sale bg-secondary text-white">

                                            For <?php echo $row['5'];?>

                                        </div>


                                        <!-- Price -->

                                        <div class="price text-primary text-capitalize">

                                            $<?php echo $row['13'];?> 

                                            <span class="text-white">

                                                <?php echo $row['12'];?> Sqft

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

                                                <a href="propertydetail.php?pid=<?php echo $row['0'];?>">

                                                    <?php echo $row['1'];?>

                                                </a>

                                            </h5>



                                            <!-- Property Location -->

                                            <span class="location text-capitalize">

                                                <i class="fas fa-map-marker-alt text-primary"></i>

                                                <span>

                                                    <?php echo $row['14'];?>

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

                                                echo isset($row['uname']) && $row['uname'] !== '' 

                                                    ? htmlspecialchars($row['uname']) 

                                                    : 'Admin'; 

                                                ?>

                                            </div>



                                            <div class="float-right">

                                                <i class="far fa-calendar-alt text-primary mr-1"></i> 

                                                6 Months Ago

                                            </div>


                                        </div>


                                    </div>


                                </div>

                            </div>


                            <?php 		
                                        } 

                                    }

                                }

                                else {

                                    echo "<h1 class='mb-5'><center>No Property Available</center></h1>";

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
                        ================================================== -->

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

                                    Calclute Instalment

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

                                $query=mysqli_query(
                                    $con,
                                    "SELECT * FROM `property` ORDER BY date DESC LIMIT 6"
                                );


                                while($row=mysqli_fetch_array($query))
                                {

                                ?>


                                <li>


                                    <!-- Recent Property Image -->

                                    <img 
                                        src="admin/property/<?php echo $row['18'];?>" 
                                        alt="pimage"
                                    >



                                    <!-- Recent Property Name -->

                                    <h6 class="text-secondary hover-text-primary text-capitalize">

                                        <a href="propertydetail.php?pid=<?php echo $row['0'];?>">

                                            <?php echo $row['1'];?>

                                        </a>

                                    </h6>



                                    <!-- Recent Property Address -->

                                    <span class="font-14">

                                        <i class="fas fa-map-marker-alt icon-primary icon-small"></i> 

                                        <?php echo $row['14'];?>

                                    </span>


                                </li>


                                <?php } ?>


                            </ul>


                        </div>


                    </div>


                </div>

            </div>

        </div>



        <!-- =================================================
             FOOTER
        ================================================== -->

        <?php include("include/footer.php");?>

        

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


<!-- Wrapper End --> 



<!-- =========================================================
     JS LINK
============================================================--> 

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

<script src="js/custom.js"></script>



<script>
window.addEventListener("scroll", function () {

    const banner = document.getElementById("houseBanner");

    if (!banner) {
        return;
    }

    const bannerRect = banner.getBoundingClientRect();

    let progress =
        (window.innerHeight - bannerRect.top) /
        (window.innerHeight + bannerRect.height);

    progress = Math.max(0, Math.min(1, progress));

    const moveY = -(progress * 150);

    banner.style.backgroundPosition =
        "center " + moveY + "px";
});
</script>

</body>
</html>