<?php
include_once('../auth.php');


// HANDLE REPORTS BY THEIR TYPE THEN RETURN RESULT using $_SESSION TO REPORTS INDEX.PHP ezzz
// start with reportId=2 all male cattles table reportId

// initialize vars: different reportId's and returned report
$reportId = 0;
$_SESSION["report"] = "";

if(isset($_GET["report"])) {
	$reportId = $_GET["report"];
	
	// reportId = 2 -> All Male Cattles Report
	if($reportId == 2) {
		// set up returned SESSION variable
		$_SESSION["report"] = "	<div class=\"table-responsive\">
									<table class=\"table table-striped table-bordered table-hover\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
									<thead>
										<tr>
											<th>Tag</th>
											<th>Sex</th>
											<th>Sire Name</th>
											<th>Sire Registered Number</th>
											<th>Dam Name</th>
											<th>Dam Registered Number</th>
											<th>Date of Birth</th>
											<th>Weight</th>
										</tr>
									</thead>
									<tbody>";
		
		// set up URL
		$URL = API_URL
			."reports"
			."?token=".API_SECRET;
			."reportId=".$reportId;
	
		// using cURL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $URL);
		$result = curl_exec($ch);
		curl_close($ch);
		
		// get php object and create the contents
		$obj = json_decode($result);
		foreach ($obj as $line) {
			// Make Tag clickable to show full details
			$_SESSION["report"] .= "	<tr>
											<td> <a class=\"btn btn-primary\" href=\"index.php?more=$line->cattleId\">$line->cattleTag</a></td>
											<td> $line->cattleSex </td>
											<td> $line->cattleSireName </td>
											<td> $line->cattleSireRegisteredNumber </td>
											<td> $line->cattleDamName </td>
											<td> $line->cattleDamRegisteredNumber </td>
											<td> $line->cattleDateOfBirth </td>
											<td> $line->cattleWeight </td>
										</tr>
									</tbody>
									</table>
								</div>";
		}
	}
	
	// return to chosen report page
	header("Location: ".WEB_URL."/reports");
}
?>