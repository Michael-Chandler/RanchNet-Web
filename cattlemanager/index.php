<?php
include_once('../auth.php');
include_once('process.php');

// get record to be updated -> fills the form and changes the Add button to updated
if(isset($_GET["edit"])) {
	$cattleId = $_GET["edit"];
	$edit_state = true;
	
	// set up vars
	$URL = API_URL
		."cattle"
		."?token=".API_SECRET
		."&cattleId=".$cattleId
		."$userId=".$_SESSION["userId"];
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
		$cattleSire = $line->cattleSireName;
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

<!-- DataTables CDN -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom fonts for this template-->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">Reports</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
                <li>
                <a href="../reports/example1">Example Report 1</a>
                </li>
                <li>
                <a href="../reports/example2">Example Report 2</a>
                </li>
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
        <!-- Breadcrumbs
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Cattle Manager</li>
        </ol>
        -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Cattle Table</div>
                    <div class="card-body">
					
                        <!-- Input Form -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Cattle</button>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <h2>Add Cattle</h2>
									<form method="POST" action="process.php">
										<input type ="hidden" name="cattleId" value="<?php echo $cattleId; ?>">
										<label type="text" class="form-control-label">User ID: <?php echo $_SESSION["userId"]; ?></label>
										<div class="row">
										<label for="cattleName" class="form-control-label">Name: </label>
                                        <input type="text" class="form-control" id="cattleName" name="cattleName" maxlength="64" value="<?php echo $cattleName; ?>">                                    
                                        <label for="cattleSex" class="form-control-label">Sex: </label>
                                        <select class="form-control" id="cattleSex" name="cattleSex">
                                            <?php if($cattleSex == "M"): ?>
                                                <option value="M" selected>M</option>
                                                <option value="F">F</option>
                                            <?php else: ?>
                                                <option value="M">M</option>
                                                <option value="F" selected>F</option>
                                            <?php endif ?>
                                        </select>                                        
										<label for="cattleTag" class="form-control-label">Tag: </label>
                                        <input type="text" class="form-control" id="cattleTag" name="cattleTag" maxlength="128" value="<?php echo $cattleTag; ?>">                                                                            
										</div>
										<div class="row">
										<label for="cattleRegisteredNumber" class="form-control-label">Registered Number: </label>
										<input type="text" class="form-control" id="cattleRegisteredNumber" name="cattleRegisteredNumber" maxlength="128" value="<?php echo $cattleRegisteredNumber; ?>">                                    
                                        <label for="cattleElectronicId" class="form-control-label">Electronic ID: </label>
                                        <input type="text" class="form-control" id="cattleElectronicId" name="cattleElectronicId" maxlength="128" value="<?php echo $cattleElectronicId; ?>">                                    
                                        <label for="cattleAnimalType" class="form-control-label">Animal Type: </label>
                                        <input type="text" class="form-control" id="cattleAnimalType" name="cattleAnimalType" maxlength="128" value="<?php echo $cattleAnimalType; ?>">                                    
                                        </div>
										<div class="row">
										<label for="cattleSireName" class="form-control-label">Sire Name: </label>
                                        <input type="text" class="form-control" id="cattleSireName" name="cattleSireName" maxlength="64" value="<?php echo $cattleSireName; ?>">
										<label for="cattleSireRegisteredNumber" class="form-control-label">Sire Registered Number: </label>
                                        <input type="text" class="form-control" id="cattleSireRegisteredNumber" name="cattleSireRegisteredNumber" maxlength="128" value="<?php echo $cattleSireRegisteredNumber; ?>">
										</div>
										<div class="row">
                                        <label for="cattleDamName" class="form-control-label">Dam Name: </label>
                                        <input type="text" class="form-control" id="cattleDamName" name="cattleDamName" maxlength="64" value="<?php echo $cattleDamName; ?>">                                    
                                        <label for="cattleDamRegisteredNumber" class="form-control-label">Dam Registered Number: </label>
                                        <input type="text" class="form-control" id="cattleDamRegisteredNumber" name="cattleDamRegisteredNumber" maxlength="128" value="<?php echo $cattleDamRegisteredNumber; ?>">
										</div>
										<div class="row">
                                        <label for="cattleDateOfBirth" class="form-control-label">Date of Birth: </label>
                                        <input type="date" class="form-control" id="cattleDateOfBirth" name="cattleDateOfBirth" value="<?php echo date($cattleDateOfBirth); ?>">                                    
                                        <label for="cattleContraception" class="form-control-label">Contraception: </label>
                                        <input type="text" class="form-control" id="cattleContraception" name="cattleContraception" maxlength="64" value="<?php echo $cattleContraception; ?>">  
										</div>
										<div class="row">
                                        <label for="cattleBreeder" class="form-control-label">Breeder: </label>
                                        <input type="text" class="form-control" id="cattleBreeder" name="cattleBreeder" maxlength="64" value="<?php echo $cattleBreeder; ?>">                                    
                                        <label for="cattlePregnant" class="form-control-label">Pregnant: </label>
                                        <select class="form-control" id="cattlePregnant" name="cattlePregnant">
                                            <?php if($cattlePregnant == 0): ?>
                                                <option value="0" selected>0</option>
                                                <option value="1">1</option>
                                            <?php else: ?>
                                                <option value="0">0</option>
                                                <option value="1" selected>1</option>
                                            <?php endif ?>
                                        </select>
										</div>
										<div class="row">
                                        <label for="cattleHeight" class="form-control-label">Height: </label>
                                        <input type="text" class="form-control" id="cattleHeight" name="cattleHeight" maxlength="64" value="<?php echo $cattleHeight; ?>">                                    
                                        <label for="cattleWeight" class="form-control-label">Weight: </label>
                                        <input type="text" class="form-control" id="cattleWeight" name="cattleWeight" maxlength="64" value="<?php echo $cattleWeight; ?>">
										</div>
                                        <label for="pastureId" class="form-control-label">Pasture ID: </label>
                                        <input type="text" class="form-control" id="pastureId" name="pastureId" maxlength="11" value="<?php echo $pastureId; ?>">
										<div class="row">
										<?php if($edit_state == false): ?>
											<button type="submit" class="form-control" id="add" name="add" class="btn">Add Cattle</button>
										<?php else: ?>
											<button type="submit" class="form-control" id="update" name="update" class="btn">Update Cattle</button>
										<?php endif ?>
                                        <a href="/cattlemanager" id="cancel" name="cancel" class="form-control btn">Cancel</a>
										</div>
                                    </form>
                                </div>
                            </div>
                        </div>
						
                        <div class="table-responsive">
						
							<?php if(isset($_SESSION["msg"])): ?>
								<div class="msg">
									<?php
										echo $_SESSION["msg"];
										unset($_SESSION["msg"]);
									?>
								</div>
							<?php endif ?>
							
                            <table class="table table-striped table-bordered table-hover" id="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Tag</th>
                                        <th>Registered Number</th>
                                        <th>Electronic ID</th>
                                        <th>Animal Type</th>
                                        <th>Sire Name</th>
                                        <th>Dam Name</th>
                                        <th>Dam Registered Number</th>
                                        <th>Sire Registered Number</th>
                                        <th>Date of Birth</th>
                                        <th>Contraception</th>
                                        <th>Breeder</th>
                                        <th>Pregnant</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Pasture ID</th>
                                        <th>User ID</th>
										<th colspan="2">Action</th>		<!-- Edit and Delete columns -->
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
    <td><?php echo "$line->cattleId"; ?></td>
    <td><?php echo "$line->cattleName</td>"; ?></td>
    <td><?php echo "$line->cattleSex</td>"; ?></td>
    <td><?php echo "$line->cattleTag</td>"; ?></td>
    <td><?php echo "$line->cattleRegisteredNumber</td>"; ?></td>
    <td><?php echo "$line->cattleElectronicId</td>"; ?></td>
    <td><?php echo "$line->cattleAnimalType</td>"; ?></td>
    <td><?php echo "$line->cattleSireName</td>"; ?></td>
    <td><?php echo "$line->cattleDamName</td>"; ?></td>
    <td><?php echo "$line->cattleDamRegisteredNumber</td>"; ?></td>
    <td><?php echo "$line->cattleSireRegisteredNumber</td>"; ?></td>
    <td><?php echo "$line->cattleDateOfBirth</td>"; ?></td>
    <td><?php echo "$line->cattleContraception</td>"; ?></td>
    <td><?php echo "$line->cattleBreeder</td>"; ?></td>
    <td><?php echo "$line->cattlePregnant</td>"; ?></td>
    <td><?php echo "$line->cattleHeight</td>"; ?></td>
    <td><?php echo "$line->cattleWeight</td>"; ?></td>
    <td><?php echo "$line->pastureId</td>"; ?></td>
    <td><?php echo "$line->userId</td>"; ?></td>
	<td><a class="edit_btn" href="index.php?edit=<?php echo $line->cattleId; ?>">Edit</a></td>
	<td><a class="del_btn" href="process.php?del=<?php echo $line->cattleId; ?>">Delete</a></td>
    </tr>
<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables CDN -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Custom scripts for table pages-->
<script src="js/sb-admin-datatables.min.js"></script>

<!-- Edit usage -->
<?php
if(isset($_GET["edit"])) {
echo '<script type="text/javascript">';
echo '    $(window).on(\'load\',function(){';
echo '        $(\'#myModal\').modal(\'show\');';
echo '    });';
echo '</script>';
}
?>

<!-- Initialize DataTable -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#table").DataTable({
            responsive: true
        });
    });
</script>

</body>
</html>


