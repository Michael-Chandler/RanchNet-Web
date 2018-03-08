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
$cattleSire = "";
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
	$cattleName = urlencode($_POST["cattleName"]);
	$cattleSex = urlencode($_POST["cattleSex"]);
	$cattleTag = urlencode($_POST["cattleTag"]);
	$cattleRegisteredNumber = urlencode($_POST["cattleRegisteredNumber"]);
	$cattleElectronicId = urlencode($_POST["cattleElectronicId"]);
	$cattleAnimalType = urlencode($_POST["cattleAnimalType"]);
	$cattleSire = urlencode($_POST["cattleSire"]);
	$cattleDamName = urlencode($_POST["cattleDamName"]);
	$cattleDamRegisteredNumber = urlencode($_POST["cattleDamRegisteredNumber"]);
	$cattleSireRegisteredNumber = urlencode($_POST["cattleSireRegisteredNumber"]);
	$cattleDateOfBirth = urlencode($_POST["cattleDateOfBirth"]);
	$cattleContraception = urlencode($_POST["cattleContraception"]);
	$cattleBreeder = urlencode($_POST["cattleBreeder"]);
	$cattlePregnant = urlencode($_POST["cattlePregnant"]);
	$cattleHeight = urlencode($_POST["cattleHeight"]);
	$cattleWeight = urlencode($_POST["cattleWeight"]);
	$pastureId = urlencode($_POST["pastureId"]);
	
	// POST request to API (starting URL)
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET;
	
	// cURL stuff
	$curl = curl_init();
	$curl_post_data = array(
					"cattleName" => $cattleName, "cattleSex" => $cattleSex, "cattleTag" => $cattleTag, 
					"cattleRegisteredNumber" => $cattleRegisteredNumber, "cattleElectronicId" => $cattleElectronicId, "cattleAnimalType" => $cattleAnimalType, 
					"cattleSire" => $cattleSire, "cattleDamName" => $cattleDamName, "cattleDamRegisteredNumber" => $cattleDamRegisteredNumber, 
					"cattleSireRegisteredNumber" => $cattleSireRegisteredNumber, "cattleDateOfBirth" => $cattleDateOfBirth, "cattleContraception" => $cattleContraception, 
					"cattleBreeder" => $cattleBreeder, "cattlePregnant" => $cattlePregnant, "cattleHeight" => $cattleHeight, 
					"cattleWeight" => $cattleWeight, "pastureId" => $pastureId, 
					"userId" => urlencode($_SESSION["userId"])
	);
	// set URL, number of vars, POST data
	curl_setopt($curl, CURLOPT_URL, $URL);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($curl_post_data));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// exec and close connection
	$result = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	
	if($result == "OK") {
		$_SESSION["msg"] = "New Cattle added";
		header("Location: ".WEB_URL."/cattlemanager");
	}
	else {
		$_SESSION["msg"] = "cURL ERROR #:" . $err;
		header("Location: ".WEB_URL."/cattlemanager");
	}
	
	
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
	$cattleSire = $_POST["cattleSire"];
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
	$data = array(
			"cattleName" => $cattleName, "cattleSex" => $cattleSex, "cattleTag" => $cattleTag, 
			"cattleRegisteredNumber" => $cattleRegisteredNumber, "cattleElectronicId" => $cattleElectronicId, "cattleAnimalType" => $cattleAnimalType, 
			"cattleSire" => $cattleSire, "cattleDamName" => $cattleDamName, "cattleDamRegisteredNumber" => $cattleDamRegisteredNumber, 
			"cattleSireRegisteredNumber" => $cattleSireRegisteredNumber, "cattleDateOfBirth" => $cattleDateOfBirth, "cattleContraception" => $cattleContraception, 
			"cattleBreeder" => $cattleBreeder, "cattlePregnant" => $cattlePregnant, "cattleHeight" => $cattleHeight, 
			"cattleWeight" => $cattleWeight, "pastureId" => $pastureId, 
			"userId" => $_SESSION["userId"]
	);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	$result = curl_exec($ch);
	curl_close($ch);
	
	
	$_SESSION["msg"] = "Cattle updated";
	
	// return to pasture page
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
	
	// return to pasture page
	header("Location: ".WEB_URL."/cattlemanager");
}

?>



