<?php require_once("modelo/seguridad.php"); ?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<title>Dashboard SisteDVN</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="" name="keywords">
		<meta content="" name="description">

		<!-- Favicon -->
		<link href="img/favicon.ico" rel="icon">

		<!-- Google Web Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
		
		<!-- Icon Font Stylesheet -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

		<!-- datatables lo puse yo -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
		

		<!-- Libraries Stylesheet -->
		<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
		<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

		<!-- Customized Bootstrap Stylesheet -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Template Stylesheet -->
		<link href="css/style.css" rel="stylesheet">
    </head>
	<body>
		<header>
			<?php
				$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
				$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"]:NULL;
				//include ("vista/cabe.php");
			?>			
		</header>
		<!-- Section Menu Interno -->
			
			<?php
				$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"]:NULL;
				include("vista/vmen.php");
				require_once 'controlador/ayudas.php';
			?>
		
			<?php moscon($pefid,$pg);?>
					
			<div class="container-fluid pt-4 px-4">
					<div class="bg-secondary rounded-top p-4">
						<div class="row">
							<div class="col-12 col-sm-6 text-center text-sm-start">
								&copy; <a href="#">Your Site Name</a>, All Right Reserved. 
							</div>
							<div class="col-12 col-sm-6 text-center text-sm-end">
								<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
								Designed By <a href="https://htmlcodex.com">HTML Codex</a>
								<br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Footer End -->
			</div>
        <!-- Content End -->
		</div>
		


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="lib/easing/easing.min.js"></script>
		<script src="lib/waypoints/waypoints.min.js"></script>
		<script src="lib/owlcarousel/owl.carousel.min.js"></script>
		<script src="lib/tempusdominus/js/moment.min.js"></script>
		<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
		<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

		<!-- datatables lo puse yo -->

		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>


		<!-- Template Javascript -->
		<script src="js/main.js"></script>
	</body>
</html>