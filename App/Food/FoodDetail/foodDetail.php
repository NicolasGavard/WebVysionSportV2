<?php
  session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/foodDetail'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
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
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?> <span class='infoFoodName'></span></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					
        <div class="clearfix">
          <div class="pull-left">
            <h4 class="text-blue h4"><?php echo $page_title; ?> <span class='infoFoodName'></span></h4>
          </div>
        </div>
  
        <div class="faq-wrap padding-top-30">
          <div id="accordion">
            
            <div class="card">
              <div class="card-header">
                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#foodLabel">
                  <?php echo $page_group_label ?>
                </button>
              </div>
              <div id="foodLabel" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <?php include('../FoodLabel/FoodLabelList.php'); ?>
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#foodWeight">
                <?php echo $page_group_weight ?>
                </button>
              </div>
              <div id="foodWeight" class="collapse" data-parent="#accordion">
                <div class="card-body">
                <?php include('../FoodWeight/foodWeightList.php'); ?>
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#foodNutritional">
                <?php echo $page_group_nutritional ?>
                </button>
              </div>
              <div id="foodNutritional" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <?php include('../FoodNutritional/foodNutritionalList.php'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('../../Home/Template/_headerFooter.php');
      ?>
      
      <script src="foodDetail.js"></script>
      <script src="../FoodLabel/foodLabelList.js"></script>
      <script src="../FoodWeight/foodWeightList.js"></script>
      <script src="../FoodNutritional/foodNutritionalList.js"></script>
  </body>
</html>