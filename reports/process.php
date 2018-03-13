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
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&userId=".$_SESSION["userId"]
		."&cattleName=".$bullName;
		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $URL);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$obj = json_decode($result);
	foreach($obj as $line) {
		$bullDam = $line->cattleDamName;
		$bullSire = $line->cattleSireName;
	}
	
	// cURL stuff for cow's parents
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&userId=".$_SESSION["userId"]
		."&cattleName=".$cowName;
		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $URL);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$obj = json_decode($result);
	foreach($obj as $line) {
		$cowDam = $line->cattleDamName;
		$cowSire = $line->cattleSireName;
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

