<?php
session_start();
$i18cdlangue = 'FR';
// If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
$errorTitle = "Erreur: 404 Page Non trouvée";
$errorTextLine1 = "Désolé, la page que vous cherchez à atteindre n'existe pas.";
$errorTextLine2 = "Pensez à vérifier l'adresse.";
$errorBack = "Page principale";
// if ($user->->getIdLanguage() == 2) {
// $errorTitle = "Error: 404 Page Not Found";
// $errorTextLine1 = "Sorry, the page you’re looking for does not exist.";
// $errorTextLine2 = "Either check the URL";
// $errorBack = "Back To Home";
// }
include(__DIR__ . "/Home/_version.php");
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>WebVysionSport</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css?v=<?php echo APP_VERSION;?>">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css?v=<?php echo APP_VERSION;?>">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css?v=<?php echo APP_VERSION;?>">
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="index.html">
					<img src="../images/WebVysionSport.png" alt="" style="max-width: 100px;">
					<h4 class="text-center text-primary"> WebVysionSport</h4>
				</a>
			</div>		
		</div>
	</div>
	<div class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="pd-10">
			<div class="error-page-wrap text-center">
				<h1>404</h1>
				<h3><?php echo $errorTitle;?></h3>
				<p><?php echo $errorTextLine1;?><br><?php echo $errorTextLine2;?></p>
				<div class="pt-20 mx-auto max-width-200">
					<a href="../index.html" class="btn btn-primary btn-block btn-lg"><?php echo $errorBack;?></a>
				</div>
			</div>
		</div>
	</div>

	<!-- js -->
	<script src="../vendors/scripts/core.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="../vendors/scripts/script.min.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="../vendors/scripts/process.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="../vendors/scripts/layout-settings.js?v=<?php echo APP_VERSION;?>"></script>
	<!-- add sweet alert js & css in footer -->
	<script src="../src/plugins/sweetalert2/sweetalert2.all.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="../src/plugins/sweetalert2/sweet-alert.init.js?v=<?php echo APP_VERSION;?>"></script>
</body>
</html>
