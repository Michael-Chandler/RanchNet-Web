<?php
include_once('../auth.php');
include_once('process.php');
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
	<div class="content-wrapper">
		<div class="container-fluid">
			
			<!-- Weight of all Bulls - Bar Chart -->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-bar-chart"></i> Weight of all Bulls
				</div>
				<div class="card-body">
					<canvas id="barChart" width="100%" height="30"></canvas>
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
    
	<!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    
	<!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    
	<!-- Custom scripts for this page-->
    <script src="js/sb-admin-charts.js"></script>
	
	<!-- Charts.js usage -->
	<script type="text/javascript">
		var canvas = document.getElementById("barChart");
		var data = {
			labels: <?php echo json_encode($cattleArray); ?>,
			datasets: [{
				label: "Weight of all Bulls",
				backgroundColor: "rgba(2,117,216,1)",
				borderColor: "rgba(2,117,216,1)",
				data: <?php echo json_encode($weightArray); ?>
			}]
		};
		var option = {
			scales: {
				yAxes: [{
					stacked: true,
					gridLines: {
						display: true
					}
				}],
				xAxes: [{
					gridLines: {
						display: false
					}
				}]
			},
			legend: {
				display: false
			},
			animation: {
				duration: 1000
			}
		};
		var myBarChart = Chart.Bar(canvas, {
			data: data,
			options: option
		});
	</script>
	
	</div>
</body>

</html>