<?php
// cattlSex -> Name and Weight in an array
include_once('../auth.php');

// init vars
$cattleArray = array();
$weightArray = array();

// set up URL
$URL = API_URL
	."cattle"
	."?token=".API_SECRET
	."&cattleSex=M"
	."&userId=".$_SESSION["userId"];

// using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
$result = curl_exec($ch);
curl_close($ch);

// get php object
$obj = json_decode($result);
foreach($obj as $line) {
	array_push($cattleArray, $line->cattleTag);
	array_push($weightArray, $line->cattleWeight);
}

?>