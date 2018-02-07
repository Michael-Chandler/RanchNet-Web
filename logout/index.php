<?php
include_once '../scripts/config.php';
session_destroy();
header("Location: ".WEB_URL);
?>
