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

// get record to be updated -> fills the form and changes the Add button to update
if(isset($_GET["edit"])) {
	$pastureId = $_GET["edit"];
	$edit_state = true;
	
	// set up vars
	$URL = API_URL
		."pastures"
		."?token=".API_SECRET
		."&pastureId=".$pastureId
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
	foreach ($obj as $line) {
		$pastureName = $line->pastureName;
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
        <h1 class="page-header">Pasture Manager</h1>
				<!-- DataTables card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Pasture Table</div>
                    <div class="card-body">
					
						<!-- Input Form -->
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Pasture</button>
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									
									<?php if($edit_state): ?>
										<h2>Edit Pasture</h2>
									<?php else: ?>
										<h2>Add Pasture</h2>
									<?php endif ?>
									
										<form method="POST" action="process.php">
											<input type="hidden" name="pastureId" value="<?php echo $pastureId; ?>">
											<label type="text" class="form-control-label">User ID: <?php echo $_SESSION["userId"]; ?></label>
											<!-- Pasture Name input -->
											<div class="form-group">
												<div class="form-row">
													<div class="col-md-12">
														<label for="pastureName" class="form-control-label"><strong>Pasture Name: </strong></label>
														<input type="text" class="form-control" id="pastureName" name="pastureName" maxlength="64" value="<?php echo $pastureName; ?>" placeholder="Enter Pasture Name here">
													</div>
												</div>
											</div>
											<!-- Form buttons -->
											<?php if($edit_state): ?>
												<button type="submit" class="form-control" id="update" name="update" class="btn">Update Pasture</button>
											<?php else: ?>
												<button type="submit" class="form-control" id="add" name="add" class="btn">Add Pasture</button>
											<?php endif ?>
											<a href="/pasturemanager" id="cancel" name="cancel" class="form-control btn">Cancel</a>
										</form>
								</div>
							</div>
						</div>
					
                        <div class="table-responsive">
							
							<!-- New pasture message (needs  -->
							<?php if(isset($_SESSION['msg'])): ?>
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>User ID</th>
										<th>Edit</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
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

// get php object
$obj = json_decode($result);
foreach ($obj as $line) { ?>
    <tr>
    <td><?php echo "$line->pastureId"; ?></td>
	<td><?php echo "$line->pastureName"; ?></td>
    <td><?php echo "$line->userId"; ?></td>
	<td><a class="btn btn-secondary" href="index.php?edit=<?php echo $line->pastureId; ?>">Edit</a></td>
	<td><a class="btn btn-primary" href="process.php?del=<?php echo $line->pastureId; ?>">Delete</a></td>
    </tr>
<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
	<!-- /.container-fluid-->

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

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script> 
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

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

</div>
<!-- /.content-wrapper-->
  
</body>

</html>




