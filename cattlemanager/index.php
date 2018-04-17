<?php
include_once('../auth.php');
include_once('process.php');

// cURL stuff for reports nav menu
// set up URL
$rURL = API_URL
    ."reports"
    ."?token=".API_SECRET;
// using cURL
$rch = curl_init();
curl_setopt($rch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($rch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($rch, CURLOPT_URL, $rURL);
$report = curl_exec($rch);
curl_close($rch);

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
// MORE at the nav menu

// get record to be updated -> fills the form and changes the Add button to updated
if(isset($_GET["edit"])) {
	$cattleId = $_GET["edit"];
	$edit_state = true;
	
	// set up vars
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&cattleId=".$cattleId
		."&userId=".$_SESSION["userId"];
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

// see more/full details of a cattle
if(isset($_GET["more"])) {
	$cattleId = $_GET["more"];
	
	// set up vars
	$mURL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&cattleId=".$cattleId
		."&userId=".$_SESSION["userId"];
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
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>RanchNet</title>

	<!-- Bootstrap core CSS-->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom fonts for this template-->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Page level plugin CSS-->
	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin.css" rel="stylesheet">
	
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="../cattlemanager">RanchNet</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cattle Manager">
            <a class="nav-link" href="/cattlemanager">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Cattle Manager</span>
            </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pasture Manager">
            <a class="nav-link" href="/pasturemanager">
                <i class="fa fa-fw fa-map"></i>
                <span class="nav-link-text">Pasture Manager</span>
            </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">Reports</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
				
				<!-- Available reports -->
				<?php 
				// get php object and create the nav menu
				$robj = json_decode($report);
				foreach ($robj as $rline) { ?>
					<li>
						<form method="POST" style=" margin-top: 1em;
													margin-bottom: 1em;
													border-width: 0px;
													margin-left: 2.75em;
													background-color: rgba(0,0,0,0);
													padding: 0px;
													
													"action="/reports<?php echo "$rline->reportUrl" ?>">
							<input type="hidden" name="reportId" id="reportId" value="<?php echo "$rline->reportId"; ?>"/>
						    <input type="submit" style="border-width: 0px;
						    							color: #868e96;
						    							color:hover: #adb5bd;
														background: rgba(0,0,0,0);
														padding-left: 0px;
														padding-top: .5em;
														padding-bottom: .5em;
						    							" value="<?php echo "$rline->reportName"; ?>" />
						</form>
					</li>
				<?php } ?>
				
            </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
            <a class="nav-link" href="../settings">
                <i class="fa fa-fw fa-wrench"></i>
                <span class="nav-link-text">Settings</span>
            </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
                <i class="fa fa-fw fa-angle-left"></i>
            </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="content-wrapper">
    <div class="container-fluid">
        <h1 class="page-header">Cattle Manager</h1>
				<!-- DataTables card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Cattle Table</div>
                    <div class="card-body">
					
                        <!-- Input Form -->
                        <?php include_once('../blocks/cattlemodal.php'); ?>
						
                        <div class="table-responsive">
						
							<?php if(isset($_SESSION["msg"])): ?>
								<div class="msg">
									<?php
										echo $_SESSION["msg"];
										unset($_SESSION["msg"]);
									?>
								</div>
							<?php endif ?>
							
                            <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tag</th>
                                        <th>Sex</th>
                                        <th>Sire Name</th>
                                        <th>Sire Registered Number</th>
                                        <th>Dam Name</th>
                                        <th>Dam Registered Number</th>
                                        <th>Date of Birth</th>
                                        <th>Weight <!-- Check measurement system chosen -->
										<?php 
										if(isset($_SESSION["measure"]) && $_SESSION["measure"] == "Metric") {
											echo "(kg.)";
										} else {
											echo "(lbs.)";
										}
										?>
										</th>
										<th>Edit</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
// set up vars
$URL = API_URL
    ."cattle"
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
$obj = json_decode($result);
foreach ($obj as $line) { ?>
    <tr>
    <td><a class="btn btn-primary" href="index.php?more=<?php echo $line->cattleId; ?>"><?php echo "$line->cattleTag"; ?></a></td>
    <td><?php echo "$line->cattleSex"; ?></td>
    <td><?php echo "$line->cattleSireName"; ?></td>
    <td><?php echo "$line->cattleSireRegisteredNumber"; ?></td>
    <td><?php echo "$line->cattleDamName"; ?></td>
    <td><?php echo "$line->cattleDamRegisteredNumber"; ?></td>
    <td><?php echo "$line->cattleDateOfBirth"; ?></td>
    <td>
	<?php
	if(isset($_SESSION["measure"]) && $_SESSION["measure"] == "Metric") {
		echo $line->cattleWeight * 0.453592;
	} else {
		echo "$line->cattleWeight";
	}
	?>
	</td>
	<td><a class="btn btn-secondary" href="index.php?edit=<?php echo $line->cattleId; ?>">Edit</a></td>
	<td><a class="btn btn-primary" href="process.php?del=<?php echo $line->cattleId; ?>">Delete</a></td>
    </tr>
<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
	<!-- /.container-fluid-->

<!-- Copyright footer -->
<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © RanchNet 2018</small>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<?php
echo "<a class=\"btn btn-primary\" href=".WEB_URL."/logout>Logout</a>";
?>

            </div>
        </div>
    </div>
</div>

<!-- Cattle Details Modal -->
<div class="modal fade" id="cattleModal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $cattleTag; ?> Full Details</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> 
			</div>
			<div class="modal-body">
				<!-- Name, Sex, Animal Type details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Name: </strong></label>
							<label class="form-control-label"><?php echo $mcattleName; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Sex: </strong></label>
							<label class="form-control-label"><?php echo $mcattleSex; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Animal Type: </strong></label>
							<label class="form-control-label"><?php echo $mcattleAnimalType; ?></label>
						</div>
					</div>
				</div>
				<!-- Tag, Reg Num, Elec ID details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Tag: </strong></label>
							<label class="form-control-label"><?php echo $mcattleTag; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $mcattleRegisteredNumber; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Electronic ID: </strong></label>
							<label class="form-control-label"><?php echo $mcattleElectronicId; ?></label>
						</div>
					</div>
				</div>
				<!-- Sire details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Sire Name: </strong></label>
							<label class="form-control-label"><?php echo $mcattleSireName; ?></label>
						</div>
						<div class="col-md-8">
							<label class="form-control-label"><strong>Sire Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $mcattleSireRegisteredNumber; ?></label>
						</div>
					</div>
				</div>
				<!-- Dam details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Dam Name: </strong></label>
							<label class="form-control-label"><?php echo $mcattleDamName; ?></label>
						</div>
						<div class="col-md-8">
							<label class="form-control-label"><strong>Dam Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $mcattleDamRegisteredNumber; ?></label>
						</div>
					</div>
				</div>
				<!-- DOB, Contraception, Breeder, Pregnant details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-3">
							<label class="form-control-label"><strong>Date of Birth: </strong></label>
							<label class="form-control-label"><?php echo $mcattleDateOfBirth; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Contraception: </strong></label>
							<label class="form-control-label"><?php echo $mcattleContraception; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Breeder: </strong></label>
							<label class="form-control-label"><?php echo $mcattleBreeder; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Pregnant: </strong></label>
							<label class="form-control-label">
							<?php 
							if($mcattlePregnant == 0) {
								echo "No";
							} else {
								echo "Yes";
							}
							?>
							</label>
						</div>
					</div>
				</div>
				<!-- Height, Weight, Pasture details -->
                <div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Height: </strong></label>
							<label class="form-control-label">
							<?php 
							if(isset($_SESSION["measure"]) && $_SESSION["measure"] == "Metric") {
								echo $mcattleHeight * 2.54;
							} else {
								echo $mcattleHeight;
							}
							?>
							</label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Weight: </strong></label>
							<label class="form-control-label">
							<?php 
							if(isset($_SESSION["measure"]) && $_SESSION["measure"] == "Metric") {
								echo $mcattleWeight * 0.453592;
							} else {
								echo $mcattleWeight;
							}
							?>
							</label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Pasture ID: </strong></label>
							<label class="form-control-label"><?php echo $mpastureId; ?></label>
						</div>
					</div>
				</div>               
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Finish</button>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script> 
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Custom scripts for table pages-->
<script src="js/sb-admin-datatables.min.js"></script>

<!-- Edit, More usage -->
<?php
if(isset($_GET["edit"])) {
	echo '<script type="text/javascript">';
	echo '    $(window).on(\'load\',function(){';
	echo '        $(\'#myModal\').modal(\'show\');';
	echo '    });';
	echo '</script>';
}

if(isset($_GET["more"])) {
	echo '<script type="text/javascript">';
	echo '    $(window).on(\'load\',function(){';
	echo '        $(\'#cattleModal\').modal(\'show\');';
	echo '    });';
	echo '</script>';
}
?>

</div>
<!-- /.content-wrapper-->

</body>
</html>








