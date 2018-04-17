<?php
include_once('../auth.php');
include_once('../cattlemanager/process.php');

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
		<div class="card card-register mx-auto mt-5">
			<div class="card-header">Settings</div>
			<div class="card-body">
			
				<form method="POST" action="../cattlemanager/process.php">
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label for="measure" class="form-control-label">Measurement System: </label>
								<select class="form-control" id="measure" name="measure">
									<option value="English">English</option>
									<option value="Metric">Metric</option>
								</select>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-secondary form-control" id="save" name="save">Save Settings</button>
				</form>
				
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
echo "<a class=\"btn btn-primary\" href=".WEB_URL."/logout>Logout</a>";
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




