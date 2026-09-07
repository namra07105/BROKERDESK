<?php

session_start();

/* Clear session */
$_SESSION = array();

/* Destroy session */
session_destroy();

/* Redirect to Agent Login */
header("Location: /BROKERDESK/BROKERDESKMAIN/agent/login.php");
exit();

?>