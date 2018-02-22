<?php
include_once('../auth.php');

// initialize form vars
$pastureName = "";

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
}

?>
