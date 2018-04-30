<?php
include_once('../auth.php');

// initialize form vars
$cattleId = 0;
$cattleName = "";
$cattleSex = "";
$cattleTag = "";
$cattleRegisteredNumber = "";
$cattleElectronicId = "";
$cattleAnimalType = "";
$cattleSireName = "";
$cattleDamName = "";
$cattleDamRegisteredNumber = "";
$cattleSireRegisteredNumber = "";
$cattleDateOfBirth = "";
$cattleContraception = "";
$cattleBreeder = "";
$cattlePregnant = "";
$cattleHeight = "";
$cattleWeight = "";
$pastureId = 0;

// POST - creates a new record
if(isset($_POST["add"])) {
	$cattleName = $_POST["cattleName"];
	$cattleSex = $_POST["cattleSex"];
	$cattleTag = $_POST["cattleTag"];
	$cattleRegisteredNumber = $_POST["cattleRegisteredNumber"];
	$cattleElectronicId = $_POST["cattleElectronicId"];
	$cattleAnimalType = $_POST["cattleAnimalType"];
	$cattleSireName = $_POST["cattleSireName"];
	$cattleDamName = $_POST["cattleDamName"];
	$cattleDamRegisteredNumber = $_POST["cattleDamRegisteredNumber"];
	$cattleSireRegisteredNumber = $_POST["cattleSireRegisteredNumber"];
	$cattleDateOfBirth = $_POST["cattleDateOfBirth"];
	$cattleContraception = $_POST["cattleContraception"];
	$cattleBreeder = $_POST["cattleBreeder"];
	$cattlePregnant = $_POST["cattlePregnant"];
	$cattleHeight = $_POST["cattleHeight"];
	$cattleWeight = $_POST["cattleWeight"];
	$pastureId = $_POST["pastureId"];
	
	// POST request to API (starting URL)
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET;
	
	// cURL stuff
	$curl = curl_init();
	$curl_post_data = http_build_query(array_filter(array(
					"cattleName" => $cattleName, "cattleSex" => $cattleSex, "cattleTag" => $cattleTag, 
					"cattleRegisteredNumber" => $cattleRegisteredNumber, "cattleElectronicId" => $cattleElectronicId, "cattleAnimalType" => $cattleAnimalType, 
					"cattleSireName" => $cattleSireName, "cattleDamName" => $cattleDamName, "cattleDamRegisteredNumber" => $cattleDamRegisteredNumber, 
					"cattleSireRegisteredNumber" => $cattleSireRegisteredNumber, "cattleDateOfBirth" => $cattleDateOfBirth, "cattleContraception" => $cattleContraception, 
					"cattleBreeder" => $cattleBreeder, "cattlePregnant" => $cattlePregnant, "cattleHeight" => $cattleHeight, 
					"cattleWeight" => $cattleWeight, "pastureId" => $pastureId, 
					"userId" => urlencode($_SESSION["userId"])
	), function($value) { return $value !== ''; }));
	
	// set cURL opts
	curl_setopt($curl, CURLOPT_URL, $URL);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	
	// exec and see if there are any errors and close connection
	$result = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	
	
	$_SESSION["msg"] = "New Cattle added";
	
	// return to cattle page
	header("Location: ".WEB_URL."/cattlemanager");
}

// PUT - updates chosen record
if(isset($_POST["update"])) {
	$cattleId = $_POST["cattleId"];
	$cattleName = $_POST["cattleName"];
	$cattleSex = $_POST["cattleSex"];
	$cattleTag = $_POST["cattleTag"];
	$cattleRegisteredNumber = $_POST["cattleRegisteredNumber"];
	$cattleElectronicId = $_POST["cattleElectronicId"];
	$cattleAnimalType = $_POST["cattleAnimalType"];
	$cattleSireName = $_POST["cattleSireName"];
	$cattleDamName = $_POST["cattleDamName"];
	$cattleDamRegisteredNumber = $_POST["cattleDamRegisteredNumber"];
	$cattleSireRegisteredNumber = $_POST["cattleSireRegisteredNumber"];
	$cattleDateOfBirth = $_POST["cattleDateOfBirth"];
	$cattleContraception = $_POST["cattleContraception"];
	$cattleBreeder = $_POST["cattleBreeder"];
	$cattlePregnant = $_POST["cattlePregnant"];
	$cattleHeight = $_POST["cattleHeight"];
	$cattleWeight = $_POST["cattleWeight"];
	$pastureId = $_POST["pastureId"];
	
	// PUT request to API (starting URL)
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&cattleId=".$cattleId;
	
	// cURL stuff
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	$data = http_build_query(array_filter(array(
			"cattleName" => $cattleName, "cattleSex" => $cattleSex, "cattleTag" => $cattleTag, 
			"cattleRegisteredNumber" => $cattleRegisteredNumber, "cattleElectronicId" => $cattleElectronicId, "cattleAnimalType" => $cattleAnimalType, 
			"cattleSireName" => $cattleSireName, "cattleDamName" => $cattleDamName, "cattleDamRegisteredNumber" => $cattleDamRegisteredNumber, 
			"cattleSireRegisteredNumber" => $cattleSireRegisteredNumber, "cattleDateOfBirth" => $cattleDateOfBirth, "cattleContraception" => $cattleContraception, 
			"cattleBreeder" => $cattleBreeder, "cattlePregnant" => $cattlePregnant, "cattleHeight" => $cattleHeight, 
			"cattleWeight" => $cattleWeight, "pastureId" => $pastureId, 
			"userId" => $_SESSION["userId"]
	), function($value) { return $value !== ''; }));
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	curl_close($ch);
	
	
	$_SESSION["msg"] = "Cattle updated";
	
	// return to cattle page
	header("Location: ".WEB_URL."/cattlemanager");
}

// DELETE - deletes chosen record
if(isset($_GET["del"])) {
	$cattleId = $_GET["del"];
	$userId = $_SESSION["userId"];
	
	// DELETE request to API (starting URL)
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&cattleId=".$cattleId
		."&userId=".$userId;
		
	// cURL stuff
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	$result = curl_exec($ch);
	curl_close($ch);
	
	
	$_SESSION["msg"] = "Cattle deleted";
	
	// return to cattle page
	header("Location: ".WEB_URL."/cattlemanager");
}

?>


