<?php
//Setup config and create/resume session.
include_once "scripts/config.php";

//Redirect to login if not authenticated.
if(!isset($_SESSION["auth"])){
    header("Location: ".WEB_URL."/login");
}

?>
