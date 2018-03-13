<?php
include_once('../auth.php');

// initialize form vars
$bullName = "";
$bullDam = "bull's Dam";
$bullSire = "bull's Sire";

$cowName = "";
$cowDam = "cow's Dam";
$cowSire = "cow's Sire";

if(isset($_POST["pair"])) {
	$bullName = $_POST["bullName"];
	$cowName = $_POST["cowName"];
	
	// cURL stuff for bull's parents
	$bURL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&userId=".$_SESSION["userId"]
		."&cattleName=".$bullName;
		
	$bullCH = curl_init();
	curl_setopt($bullCH, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($bullCH, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($bullCH, CURLOPT_URL, $bURL);
	$bResult = curl_exec($bullCH);
	curl_close($bullCH);
	
	$bull = json_decode($bResult);
	foreach($bull as $line) {
		$bullSire = $line->cattleSireName;
		$bullDam = $line->cattleDamName;
	}
	
	// cURL stuff for cow's parents
	$cURL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&userId=".$_SESSION["userId"]
		."&cattleName=".$cowName;
		
	$cowCH = curl_init();
	curl_setopt($cowCH, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($cowCH, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cowCH, CURLOPT_URL, $cURL);
	$cResult = curl_exec($cowCH);
	curl_close($cowCH);
	
	$cow = json_decode($cResult);
	foreach($cow as $row) {
		$cowSire = $row->cattleSireName;
		$cowDam = $row->cattleDamName;
	}
	
	// check parents
	if(($bullDam == $cowDam) || ($bullSire == $cowSire)) {
		$_SESSION["res"] = "NG Bull's Damn: " . $bullDam . ", Cow's Dam: " . $cowDam . ", Bull's Sire: " . $bullSire . ", Cow's Sire: " . $cowSire;
	}
	else {
		$_SESSION["res"] = "PS Bull's Damn: " . $bullDam . ", Cow's Dam: " . $cowDam . ", Bull's Sire: " . $bullSire . ", Cow's Sire: " . $cowSire;
	}
	
	header("Location: ".WEB_URL."/reports/pair.php");
}

?>


