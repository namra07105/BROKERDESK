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
    header("Location:propertyview.php");
    exit;
}


if(mysqli_num_rows($agentQuery) == 0)
{
    session_destroy();

    header("Location: login.php");
    exit;
}

$agent = mysqli_fetch_assoc($agentQuery);


/* =========================================================
   CHECK USER TYPE
========================================================= */

if(strtolower(trim($agent['utype'])) != 'agent')
{
    header("Location:../index.php");
    exit;
}


/* =========================================================
   GET PROPERTY ID
========================================================= */

if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location:propertyview.php");
    exit;
}

$pid = intval($_GET['id']);


if($pid <= 0)
{
    header("Location:propertyview.php");
    exit;
}


/* =========================================================
   CHECK PROPERTY OWNERSHIP
   Agent can delete ONLY his own property
========================================================= */

$checkProperty = mysqli_query(
    $con,
    "SELECT pid
     FROM property
     WHERE pid='$pid'
     AND uid='$uid'
     LIMIT 1"
);


if(!$checkProperty)
{
    header(
        "Location:propertyview.php?msg=" .
        urlencode("Property Not Deleted")
    );

    exit;
}


if(mysqli_num_rows($checkProperty) == 0)
{
    header(
        "Location:propertyview.php?msg=" .
        urlencode("Property Not Deleted")
    );

    exit;
}


/* =========================================================
   DELETE PROPERTY
========================================================= */

$sql = "
    DELETE FROM property
    WHERE pid='$pid'
    AND uid='$uid'
";


$result = mysqli_query($con, $sql);


/* =========================================================
   RESULT
========================================================= */

if($result == true)
{
    header(
        "Location:propertyview.php?msg=" .
        urlencode("Property Deleted")
    );

    exit;
}
else
{
    header(
        "Location:propertyview.php?msg=" .
        urlencode("Property Not Deleted")
    );

    exit;
}


mysqli_close($con);

?>