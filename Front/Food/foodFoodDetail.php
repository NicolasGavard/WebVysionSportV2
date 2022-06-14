<?php
	session_start();

  $international  = 'Food/foodFoodDetail';
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../i18/'.$i18cdlangue.'/header.php');
  include("../../i18/_i18.php");
  include('../Home/_header.php');
	include('../Home/_headerMenuTop.php');
	include('../Home/_headerMenuLeft.php')
?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">

        <div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="../Food/foodFoodList.php"><?php echo $page_title_prev; ?></a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?> <span class='infoRecipeName'></span></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					
        <div class="clearfix">
          <div class="pull-left">
            <h4 class="text-blue h4"><?php echo $page_title; ?></h4>
          </div>
        </div>

        <div class="faq-wrap">
          <div id="accordion">
            <div class="card">
              <div class="card-header">
                <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                  <?php echo $page_group_label ?>
                </button>
              </div>
              <div id="faq1" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                  <?php include('../Food/foodFoodDetailLabel.php'); ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2">
                <?php echo $page_group_weight ?>
                </button>
              </div>
              <div id="faq2" class="collapse" data-parent="#accordion">
                <div class="card-body">
                <?php include('../Food/foodFoodDetailWeight.php'); ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq3">
                <?php echo $page_group_nutritional ?>
                </button>
              </div>
              <div id="faq3" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <?php include('../Food/foodFoodDetailNutritional.php'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script src="../../jsWebVysionSport/Food/foodFoodDetail.js"></script>

      <?php
        include('../Home/_headerFooter.php');
      ?>
  </body>
</html>