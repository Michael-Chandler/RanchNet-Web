<?php
// get all pastures to list
$URL = API_URL
    ."pastures"
    ."?token=".API_SECRET
    ."&userId=".$_SESSION["userId"];

// using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
$result = curl_exec($ch);
curl_close($ch);

// get php object
$pastures = json_decode($result);

// get record to be updated -> fills the form and changes the Add button to updated
if(isset($_GET["edit"])) {
	$cattleId = $_GET["edit"];
	$edit_state = true;
	
	// set up vars
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&userId=".$_SESSION["userId"]
		."&cattleId=".$cattleId;
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
		$cattleName = $line->cattleName;
		$cattleSex = $line->cattleSex;
		$cattleTag = $line->cattleTag;
		$cattleRegisteredNumber = $line->cattleRegisteredNumber;
		$cattleElectronicId = $line->cattleElectronicId;
		$cattleAnimalType = $line->cattleAnimalType;
		$cattleSireName = $line->cattleSireName;
		$cattleDamName = $line->cattleDamName;
		$cattleDamRegisteredNumber = $line->cattleDamRegisteredNumber;
		$cattleSireRegisteredNumber = $line->cattleSireRegisteredNumber;
		$cattleDateOfBirth = $line->cattleDateOfBirth;
		$cattleContraception = $line->cattleContraception;
		$cattleBreeder = $line->cattleBreeder;
		$cattlePregnant = $line->cattlePregnant;
		$cattleHeight = $line->cattleHeight;
		$cattleWeight = $line->cattleWeight;
		$pastureId = $line->pastureId;
	}
}
?>