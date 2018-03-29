<?php
include_once('../auth.php');
include_once('process.php');

// cURL stuff for reports nav menu
// set up URL
$URL = API_URL
    ."reports"
    ."?token=".API_SECRET;
	
// using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
$result = curl_exec($ch);
curl_close($ch);
// MORE at the nav menu

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
		$cattleName = $mline->cattleName;
		$cattleSex = $mline->cattleSex;
		$cattleTag = $mline->cattleTag;
		$cattleRegisteredNumber = $mline->cattleRegisteredNumber;
		$cattleElectronicId = $mline->cattleElectronicId;
		$cattleAnimalType = $mline->cattleAnimalType;
		$cattleSireName = $mline->cattleSireName;
		$cattleDamName = $mline->cattleDamName;
		$cattleDamRegisteredNumber = $mline->cattleDamRegisteredNumber;
		$cattleSireRegisteredNumber = $mline->cattleSireRegisteredNumber;
		$cattleDateOfBirth = $mline->cattleDateOfBirth;
		$cattleContraception = $mline->cattleContraception;
		$cattleBreeder = $mline->cattleBreeder;
		$cattlePregnant = $mline->cattlePregnant;
		$cattleHeight = $mline->cattleHeight;
		$cattleWeight = $mline->cattleWeight;
		$pastureId = $mline->pastureId;
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
            <a class="nav-link" href="../cattlemanager">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Cattle Manager</span>
            </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pasture Manager">
            <a class="nav-link" href="../pasturemanager">
                <i class="fa fa-fw fa-map"></i>
                <span class="nav-link-text">Pasture Manager</span>
            </a>
            </li>
			
			<!-- Reports Navigation Menu 
				1.) still cannot create the menu automatically (needs reportURL var in JSON)
				2.) create manually -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">Reports</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
                <li>
                <a href="../reports/pair">Pair Up</a>
                </li>
                <li>
                <a href="../reports/bullsweight">Weight of all Bulls</a>
                </li>
				
				<!-- Available reports -->
				<?php 
				// get php object and create the nav menu
				$obj = json_decode($result);
				foreach ($obj as $line) { ?>
					<li>
						<a href="process.php?report="<?php echo "$line->reportId"; ?>><?php echo "$line->reportName"; ?></a>
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
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-envelope"></i>
                <span class="d-lg-none">Messages
                    <span class="badge badge-pill badge-primary">12 New</span>
                </span>
                <span class="indicator text-primary d-none d-lg-block">
                    <i class="fa fa-fw fa-circle"></i>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">New Messages:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <strong>David Miller</strong>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <strong>Jane Smith</strong>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <strong>John Doe</strong>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all messages</a>
            </div>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-bell"></i>
                <span class="d-lg-none">Alerts
                    <span class="badge badge-pill badge-warning">6 New</span>
                </span>
                <span class="indicator text-warning d-none d-lg-block">
                    <i class="fa fa-fw fa-circle"></i>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">New Alerts:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <span class="text-success">
                        <strong>
                            <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                    </span>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <span class="text-danger">
                        <strong>
                            <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                    </span>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <span class="text-success">
                        <strong>
                            <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                    </span>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all alerts</a>
            </div>
            </li>
            <li class="nav-item">
            <!-- <form class="form-inline my-2 my-lg-0 mr-lg-2">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for...">
                    <span class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form> -->
            </li>
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
					
						<!-- Cannot change any male cattle record: READ ONLY -->
						
						<!-- ALL MAGIC SHOULD HAPPEN IN PROCESS.PHP's -->
						<?php 
							if(isset($_SESSION[])) {
								echo $_SESSION["report"];
							} else {
								echo "NO REPORT TO BE SHOWN";
							}
						?>
						
					</div>
				</div>
	</div>
	<!-- /.container-fluid -->
	
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
							<label class="form-control-label"><?php echo $cattleName; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Sex: </strong></label>
							<label class="form-control-label"><?php echo $cattleSex; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Animal Type: </strong></label>
							<label class="form-control-label"><?php echo $cattleAnimalType; ?></label>
						</div>
					</div>
				</div>
				<!-- Tag, Reg Num, Elec ID details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Tag: </strong></label>
							<label class="form-control-label"><?php echo $cattleTag; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $cattleRegisteredNumber; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Electronic ID: </strong></label>
							<label class="form-control-label"><?php echo $cattleElectronicId; ?></label>
						</div>
					</div>
				</div>
				<!-- Sire details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Sire Name: </strong></label>
							<label class="form-control-label"><?php echo $cattleSireName; ?></label>
						</div>
						<div class="col-md-8">
							<label class="form-control-label"><strong>Sire Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $cattleSireRegisteredNumber; ?></label>
						</div>
					</div>
				</div>
				<!-- Dam details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Dam Name: </strong></label>
							<label class="form-control-label"><?php echo $cattleDamName; ?></label>
						</div>
						<div class="col-md-8">
							<label class="form-control-label"><strong>Dam Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $cattleDamRegisteredNumber; ?></label>
						</div>
					</div>
				</div>
				<!-- DOB, Contraception, Breeder, Pregnant details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-3">
							<label class="form-control-label"><strong>Date of Birth: </strong></label>
							<label class="form-control-label"><?php echo $cattleDateOfBirth; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Contraception: </strong></label>
							<label class="form-control-label"><?php echo $cattleContraception; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Breeder: </strong></label>
							<label class="form-control-label"><?php echo $cattleBreeder; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Pregnant: </strong></label>
							<label class="form-control-label"><?php echo $cattlePregnant; ?></label>
						</div>
					</div>
				</div>
				<!-- Height, Weight, Pasture details -->
                <div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Height: </strong></label>
							<label class="form-control-label"><?php echo $cattleHeight; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Weight: </strong></label>
							<label class="form-control-label"><?php echo $cattleWeight; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Pasture ID: </strong></label>
							<label class="form-control-label"><?php echo $pastureId; ?></label>
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

</div>
<!-- /.content-wrapper -->

</body>
</html>