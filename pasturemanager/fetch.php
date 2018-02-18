<?php

// set up vars
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

// get php object (associative array)
$data = array();
while($obj = json_decode($result, true)) {
	$sub_array = array();
	$sub_array[] = '<div data-id"'.$obj["pastureId"].'" data-column="pastureId">' . $obj["pastureId"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$obj["pastureId"].'" data-column="pastureName">' . $obj["pastureName"] . '</div>';
	$sub_array[] = '<div data-id"'.$obj["pastureId"].'" data-column="userId">' . $obj["userId"] . '</div>';
	$sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$obj["pastureId"].'">Delete</button>';
	$data[] = $sub_array;
}

$output = array ("data" => $data);
echo json_encode($output);

?>
