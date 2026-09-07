<?php

include("config.php");


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
   DELETE ONLY ADMIN-UPLOADED PROPERTY
========================================================= */

$sql = "DELETE FROM property
        WHERE pid = '$pid'
        AND uploaded_by = 'admin'";

$result = mysqli_query($con, $sql);


if($result == true)
{
    if(mysqli_affected_rows($con) > 0)
    {
        $msg = "<p class='alert alert-success'>Property Deleted</p>";
    }
    else
    {
        $msg = "<p class='alert alert-warning'>Property Not Deleted</p>";
    }

    header("Location:propertyview.php?msg=" . urlencode($msg));
    exit;
}
else
{
    $msg = "<p class='alert alert-warning'>Property Not Deleted</p>";

    header("Location:propertyview.php?msg=" . urlencode($msg));
    exit;
}


mysqli_close($con);

?>