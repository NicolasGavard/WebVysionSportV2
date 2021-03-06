<?php
include(__DIR__ . "/Front/Home/_version.php");

$international  = 'register';
$i18cdlangue    = 'FR';
// If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
include("i18/_i18.php");
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
	<link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css?v=<?php echo APP_VERSION;?>">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css?v=<?php echo APP_VERSION;?>">
</head>

<body class="login-page">
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
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/fondPageLogin.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10">
						<div class="wizard-content">
							<form id="registerForm" class="col-md-12 col-lg-12 tab-wizard2 wizard-circle wizard" style="padding-left: 0px;">
								<h5><?php echo $registerAccount;?></h5>
								<section data-step="0">
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerEmail;?></label>
											<div class="col-sm-8">
												<input type="email" id="email" name="email" class="form-control required">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerUserCode;?></label>
											<div class="col-sm-8">
												<input type="text" id="username" name="username" class="form-control required">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerPassword;?></label>
											<div class="col-sm-8">
												<input type="password" id="password" name="password" class="form-control required">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerConfirmPassword;?></label>
											<div class="col-sm-8">
												<input type="password" id="confirmPassword" name="confirmPassword" class="form-control required">
											</div>
										</div>
									</div>
								</section>
								<!-- Step 2 -->
								<h5><?php echo $registerInfos;?></h5>
								<section data-step="1">
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerName;?></label>
											<div class="col-sm-8">
												<input type="text" id="personname" name="personname" class="form-control required">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerFirstname;?></label>
											<div class="col-sm-8">
												<input type="text" id="personfirstname" class="form-control required">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label"><?php echo $registerSex;?></label>
											<div class="col-sm-8">
												<div class="custom-control custom-radio custom-control-inline pb-0">
													<input type="radio" id="male" name="gender" class="custom-control-input">
													<label class="custom-control-label" for="male"><?php echo $registerMan;?></label>
												</div>
												<div class="custom-control custom-radio custom-control-inline pb-0">
													<input type="radio" id="female" name="gender" class="custom-control-input">
													<label class="custom-control-label" for="female"><?php echo $registerWoman;?></label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerCity;?></label>
											<div class="col-sm-8">
												<input type="text" id="personcity" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerCountry;?></label>
											<div class="col-sm-8">
												<input type="text" id="personcountry" class="form-control">
											</div>
										</div>
									</div>
								</section>
								<!-- Step 3 -->
								<h5><?php echo $registerFormulas;?></h5>
								<section data-step="2">
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label"><?php echo $registerFormula;?></label>
											<div class="col-sm-8">
												<select class="custom-select form-control required" id="formula" name="formula" title="S??lection de la Formule">
													<option value="1">Option 1</option>
													<option value="2">Option 2</option>
													<option value="3">Option 3</option>
												</select>
											</div>
										</div>
									</div>
								</section>
								<!-- Step 4 -->
								<h5><?php echo $registerConfirm;?></h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<ul class="register-info">
											<li>
												<div class="row">
													<div class="col-sm-6 weight-600"><?php echo $registerEmail;?></div>
													<div class="col-sm-6"><span id="confemail"></span></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-6 weight-600"><?php echo $registerUserCode;?></div>
													<div class="col-sm-6"><span id="confusername"></span></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-6 weight-600"><?php echo $registerName;?></div>
													<div class="col-sm-6"><span id="confpersonname"></span></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-6 weight-600"><?php echo $registerFirstname;?></div>
													<div class="col-sm-6"><span id="confpersonfirstname"></span></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-6 weight-600"><?php echo $registerFormula;?></div>
													<div class="col-sm-6"><span id="confformula"></span></div>
												</div>
											</li>
										</ul>
										<div class="custom-control custom-checkbox mt-4">
											<input type="checkbox" class="custom-control-input required" name="cbusage" id="cbusage">
											<label class="custom-control-label" for="cbusage"><?php echo $registerConditions;?></label>
										</div>
									</div>
								</section>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- success Popup html Start -->
	<button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">Launch modal</button>
	<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
			<div class="modal-content">
				<div class="modal-body text-center font-18">
					<h3 class="mb-20"><?php echo $registerSent;?></h3>
					<div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
					<?php echo $registerOk;?>
				</div>
				<div class="modal-footer justify-content-center">
					<a href="index.html" class="btn btn-primary"><?php echo $registerClose;?></a>
				</div>
			</div>
		</div>
	</div>
	<!-- success Popup html End -->
	<!-- js -->
	<script src="vendors/scripts/core.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="vendors/scripts/script.min.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="vendors/scripts/jquery.validate.min.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="vendors/scripts/process.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="vendors/scripts/layout-settings.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="src/plugins/jquery-steps/jquery.steps.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="src/plugins/bootstrap/popper.min.js?v=<?php echo APP_VERSION;?>"></script>
	<script src="jsWebVysionSport/steps-setting.js?v=<?php echo APP_VERSION;?>"></script>
</body>

</html>