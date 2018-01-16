<?php
//Setup config and create/resume session.
include_once "config.php";

//Redirect to login if not authenticated.
if(!isset($_SESSION["auth"])){
    #header("Location: ".URL."login");
}

?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">RanchNet</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="cattlemanager">Cattle Manager</a></li>
            <li class="nav-item"><a class="nav-link" href="pasturemanager">Pasture Manager</a></li>
            <li class="nav-item"><a class="nav-link" href="reports">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="settings">Settings</a></li>
        </ul>
    </div>
</nav>
