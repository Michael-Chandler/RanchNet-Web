<?php
// see more/full details of a cattle
if(isset($_GET["more"])) {
	$cattleId = $_GET["more"];
	
	// set up vars
	$mURL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&userId=".$_SESSION["userId"]
		."&cattleId=".$cattleId;
	// using cURL
	$mch = curl_init();
	curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($mch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($mch, CURLOPT_URL, $mURL);
	$mresult = curl_exec($mch);
	curl_close($mch);
	// get php object
	$mobj = json_decode($mresult);
	foreach($mobj as $mline) {
		$mcattleId = $mline->cattleId;
		$mcattleName = $mline->cattleName;
		$mcattleSex = $mline->cattleSex;
		$mcattleTag = $mline->cattleTag;
		$mcattleRegisteredNumber = $mline->cattleRegisteredNumber;
		$mcattleElectronicId = $mline->cattleElectronicId;
		$mcattleAnimalType = $mline->cattleAnimalType;
		$mcattleSireName = $mline->cattleSireName;
		$mcattleDamName = $mline->cattleDamName;
		$mcattleDamRegisteredNumber = $mline->cattleDamRegisteredNumber;
		$mcattleSireRegisteredNumber = $mline->cattleSireRegisteredNumber;
		$mcattleDateOfBirth = $mline->cattleDateOfBirth;
		$mcattleContraception = $mline->cattleContraception;
		$mcattleBreeder = $mline->cattleBreeder;
		$mcattlePregnant = $mline->cattlePregnant;
		$mcattleHeight = $mline->cattleHeight;
		$mcattleWeight = $mline->cattleWeight;
		$mpastureId = $mline->pastureId;
		$mpastureName = $mline->pastureName;
	}
}
?>
