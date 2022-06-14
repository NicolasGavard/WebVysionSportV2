<?php
include(__DIR__ . "/Front/Home/_version.php");
?>
<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>WebVysionSport</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css?v=<?php echo APP_VERSION;?>">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css?v=<?php echo APP_VERSION;?>">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css?v=<?php echo APP_VERSION;?>">
</head>

<body>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="index.html">
					<img src="images/WebVysionSport.png" alt="" style="max-width: 100px;">
					<h4 class="text-center text-primary"> WebVysionSport</h4>
				</a>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Mot de passe oublié</h2>
						</div>
						<h6 class="mb-20">Entrez votre adresse e-mail pour réinitialiser votre mot de passe</h6>
						<form>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
										-->
										<a class="btn btn-primary btn-lg btn-block" href="index.html">Valider</a>
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">Ou</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="index.html">Se connecter</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="vendors/scripts/script.min.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="vendors/scripts/process.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="vendors/scripts/layout-settings.js?v=<?php echo APP_VERSION;?>"></script>
</body>

</html>