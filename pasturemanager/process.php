<?php
include_once('../auth.php');

// initialize form vars
$pastureName = "";
$pastureId = 0;
$edit_state = false;

if(isset($_POST["add"])) {
	$pastureName = $_POST["pastureName"];
	
	// POST request to API 
	$URL = API_URL
		."pastures"
		."?token=".API_SECRET;
	
	// cURL stuff
	$curl = curl_init($URL);
	$curl_post_data = array(
					"pastureName" => $pastureName,
					"userId" => $_SESSION["userId"]
	);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	$result = curl_exec($curl);
	curl_close($curl);
	
	$_SESSION["msg"] = "New Pasture saved";
	
	// return to pasture page
	header("Location: ".WEB_URL."/pasturemanager");
}

if(isset($_POST["update"])) {
	$pastureName = $_POST["pastureName"];
	$pastureId = $_POST["pastureId"];
	
	// PUT request to API (starting URL)
	$URL = API_URL
		."pastures"
		."?token=".API_SECRET;
	
	#cURL stuff
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	$data = array(
			"pastureId" => $pastureId,
			"pastureName" => $pastureName,
			"userId" => $_SESSION["userId"]
	);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	$result = curl_exec($ch);
	curl_close($ch);
	
	
	$_SESSION["msg"] = "Pasture updated";
	
	// return to pasture page
	header("Location: ".WEB_URL."/pasturemanager");
}

?>
