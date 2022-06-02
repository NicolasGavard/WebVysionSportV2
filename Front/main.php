<?php
	session_start();
	$path = '../';
	include(__DIR__ . '/../i18/FR/header.php');
	include(__DIR__ . '/../i18/FR/main.php');
	include(__DIR__ . '/_header.php');
	include(__DIR__ . '/_headerLoader.php');
	include(__DIR__ . '/_headerMenuTop.php');
	include(__DIR__ . '/_headerMenuLeft.php');
?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-10 height-100-p mb-20">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="<?php echo $path.'vendors/images/banner-img.png'; ?>" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							<span><?php echo $hello; ?></span>
							<span class="InfoProfilFullName"></span>
							<span> !</span>
						</h4>
						<p class="font-18 max-width-600"><?php echo $welcome; ?></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 col-sm-6 col-12 mb-20">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">2020</div>
								<div class="weight-600 font-14">Contact</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 mb-20">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart2"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">4000</div>
								<div class="weight-600 font-14">Aliments</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 mb-20">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart3"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">350</div>
								<div class="weight-600 font-14">Elèves</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 mb-20">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart4"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">$6060</div>
								<div class="weight-600 font-14">Formules</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-8 mb-20">
					<div class="card-box height-100-p pd-10">
						<h2 class="h4 mb-20">Activités</h2>
						<div id="chart5"></div>
					</div>
				</div>
				<div class="col-xl-4 mb-20">
					<div class="card-box height-100-p pd-10">
						<h2 class="h4 mb-20">Cible principale</h2>
						<div id="chart6"></div>
					</div>
				</div>
			</div>
			
<?php
	include(__DIR__ . '/_headerFooter.php');
?>