<?php

include("config.php");

if(isset($_GET['id']) && !empty($_GET['id']))
{
    $id = intval($_GET['id']);

    $sql = "DELETE FROM contact WHERE cid='$id'";
    $result = mysqli_query($con, $sql);

    if($result)
    {
        header("Location:contactview.php?msg=" . urlencode("Contact Deleted"));
        exit();
    }
    else
    {
        header("Location:contactview.php?msg=" . urlencode("Contact Not Deleted"));
        exit();
    }
}

header("Location:contactview.php");
exit();

?>