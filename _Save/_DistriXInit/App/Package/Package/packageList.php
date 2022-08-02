<?php
	session_start();
  $international  = 'Nutrition/nutritionMyCurrentsDietsList';
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../i18/'.$i18cdlangue.'/header.php');
  include('../../i18/_i18.php');
  include('../Home/_header.php');
	include('../Home/_headerMenuTop.php');
	include('../Home/_headerMenuLeft.php');
?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<h4 class="mb-30 mt-30 text-blue h4">Les formules</h4>
				<div class="row">
					<div class="col-md-4 mb-30">
						<div class="card-box pricing-card-style2">
							<div class="pricing-icon">
								<img src="../../vendors/images/icon-Cash.png" alt="">
							</div>
							<div class="pricing-card-header">
								<div class="left">
									<h5>Standard</h5>
									<p>For small businesses</p>
								</div>
								<div class="right">
									<div class="pricing-price">
										€10<span>/month</span>
									</div>
								</div>
							</div>
							<div class="pricing-card-body">
								<div class="pricing-points">
									<ul>
										<li>2 TB of space</li>
										<li>120 days of file recovery</li>
										<li>Smart Sync</li>
										<li>Dropbox Paper admin tools</li>
										<li>Granular sharing permissions</li>
										<li>User and company-managed groups</li>
										<li>Live chat support</li>
									</ul>
								</div>
							</div>
							<div class="cta">
								<a href="#" class="btn btn-primary btn-rounded btn-lg">Get Started</a>
							</div>
						</div>
					</div>
					<div class="col-md-4 mb-30">
						<div class="card-box pricing-card-style2">
							<div class="pricing-icon">
								<img src="../../vendors/images/icon-debit.png" alt="">
							</div>
							<div class="pricing-card-header">
								<div class="left">
									<h5>Advanced</h5>
									<p>For big businesses</p>
								</div>
								<div class="right">
									<div class="pricing-price">
										€15<span>/month</span>
									</div>
								</div>
							</div>
							<div class="pricing-card-body">
								<div class="pricing-points">
									<ul>
										<li>Everything in Standard</li>
										<li>As much space as needed</li>
										<li>Advanced admin controls</li>
										<li>Dropbox Showcase</li>
										<li>Tiered admin roles</li>
										<li>Advanced user management tools</li>
										<li>Domain verification</li>
									</ul>
								</div>
							</div>
							<div class="cta">
								<a href="#" class="btn btn-primary btn-rounded btn-lg">Get Started</a>
							</div>
						</div>
					</div>
					<div class="col-md-4 mb-30">
						<div class="card-box pricing-card-style2">
							<div class="pricing-icon">
								<img src="../../vendors/images/icon-online-wallet.png" alt="">
							</div>
							<div class="pricing-card-header">
								<div class="left">
									<h5>Enterprise</h5>
									<p>For enterprises</p>
								</div>
								<div class="right">
									<div class="pricing-price">
										€25<span>/month</span>
									</div>
								</div>
							</div>
							<div class="pricing-card-body">
								<div class="pricing-points">
									<ul>
										<li>Everything in Advanced</li>
										<li>Account Capture</li>
										<li>Network control</li>
										<li>Enterprise management support</li>
										<li>Domain Insights</li>
										<li>Advanced training for end users</li>
										<li>24/7 phone support</li>
									</ul>
								</div>
							</div>
							<div class="cta">
								<a href="#" class="btn btn-primary btn-rounded btn-lg">Get Started</a>
							</div>
						</div>
					</div>
				</div>
			</div>
      
      <?php
        include('../Home/_headerFooter.php');
      ?>
      
  </body>
</html>