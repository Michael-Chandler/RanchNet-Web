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

include_once('../blocks/editcattlemodal.php');
include_once('../blocks/detailscattlemodal.php');
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
    	
    	<!-- Main Navigation Bar -->
    	<?php include_once('../blocks/mainnavbar.php'); ?>
    	
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
                                        <th>Weight (lbs.)</th>
										<th>Pasture</th>
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
    <td><?php echo date("Y-m-d", strtotime($line->cattleDateOfBirth)); ?></td>
    <td><?php echo "$line->cattleWeight"; ?></td>
	<td><?php echo "$line->pastureName"; ?></td>
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
<?php include_once('../blocks/fulldetailsmodal.php'); ?>

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









