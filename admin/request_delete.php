<?php

include("config.php");

if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location:request_view.php");
    exit;
}

$id = intval($_GET['id']);

if($id <= 0)
{
    header("Location:request_view.php");
    exit;
}

$sql = "DELETE r
        FROM request r
        LEFT JOIN property p ON r.pid = p.pid
        WHERE r.rid = '$id'
        AND (
            r.pid IS NULL
            OR p.uploaded_by = 'admin'
        )";

$result = mysqli_query($con, $sql);

if($result && mysqli_affected_rows($con) > 0)
{
    $msg = "Request Deleted";
}
else
{
    $msg = "Request Not Deleted";
}

header("Location:request_view.php?msg=" . urlencode($msg));
exit;

?>
