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
// MORE at the nav menu


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

	<!-- Custom styles for this template-->
	<link href="css/sb-admin.css" rel="stylesheet">
	
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/cattlemanager">RanchNet</a>
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
		<div class="card card-register mx-auto mt-5">
			<div class="card-header">Pair Cattles</div>
			<div class="card-body">
			
				<form method="POST" action="process.php">
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label for="bullName">Bull name</label>
								<input class="form-control" id="bullName" name="bullName" type="text" aria-describedby="nameHelp" placeholder="Enter bull name">
							</div>
							<div class="col-md-6">
								<label for="cowName">Cow name</label>
								<input class="form-control" id="cowName" name="cowName" type="text" aria-describedby="nameHelp" placeholder="Enter cow name">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-secondary form-control" id="pair" name="pair">Pair Up</button>
					<button type="reset" class="btn btn-secondary form-control" value="Reset">Clear Fields</button>
				</form>
				
				<br>
				<br>
				<br>
				
				<div class="text-center mt-4 mb-5">
					<?php if(isset($_SESSION["res"])): ?>
						<h4>RESULT</h4>
						<p>
							<?php 
								echo $_SESSION["res"];
								unset($_SESSION["res"]);
							?>
						</p>
					<?php endif ?>
				</div>
				
			</div>
		</div>
	</div>


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
echo "<a class=\"btn btn-primary\" href=\"/logout\">Logout</a>";
?>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

</div>

</body>
</html>




