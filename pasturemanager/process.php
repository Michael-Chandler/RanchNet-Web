<?php
include_once('../auth.php');

// initialize form vars
$pastureName = "";
$pastureId = 0;
$edit_state = false;

// POST - creates new record
if(isset($_POST["add"])) {
	$pastureName = $_POST["pastureName"];
	
	// POST request to API (starting URL)
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
	
	
	$_SESSION["msg"] = "New Pasture added";
	
	// return to pasture page
	header("Location: ".WEB_URL."/pasturemanager");
}

// PUT - updates chosen record
if(isset($_POST["update"])) {
	$pastureName = $_POST["pastureName"];
	$pastureId = $_POST["pastureId"];
	
	// PUT request to API (starting URL)
	$URL = API_URL
		."pastures"
		."?token=".API_SECRET
		."&pastureId=".$pastureId;
	
	#cURL stuff
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	$data = array(
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

// DELETE - deletes chosen record
if(isset($_GET["del"])) {
	$pastureId = $_GET["del"];
	$userId = $_SESSION["userId"];
	
	// DELETE request to API (starting URL)
	$URL = API_URL
		."pastures"
		."?token=".API_SECRET
		."&pastureId=".$pastureId
		."&userId=".$userId;
		
	//cURL stuff
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	$result = curl_exec($ch);
	curl_close($ch);
	
	
	$_SESSION["msg"] = "Pasture deleted";
	
	// return to pasture page
	header("Location: ".WEB_URL."/pasturemanager");
}

?>


