<?php
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/nutritionMyCurrentsDietsAdd'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
	
	include('Controllers/ListAdd.php');
	list($listMealTypeNames, $distriXNutritionTemplateDietData, $listMyRecipe, $listMyCurrentDietMealsFormFront) = listDietMeal($_GET['idDiet'], $_GET['idUser'], $_GET['idLanguage']);
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
									<li class="breadcrumb-item"><a href="../../MyCurrentsDiets/nutritionMyCurrentsDietsList.php"><?php echo $page_title_prev; ?></a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?> <span class='infoDietName'></span></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4"><?php echo $page_title_2; ?> <span class='infoDietName'></span></h4>
					</div>
					<div class="wizard-content">
						<form class="tab-wizard wizard-circle wizard">
							<?php
								for ($i = 1; $i < $distriXNutritionTemplateDietData->getDuration()+1; $i++) {
									?>
										<h5><?php echo $page_choice_day.' '.$i; ?></h5>
										<section>
											<div class="row">
												<?php
													foreach ($listMealTypeNames as $mealType) {
														?>
														<div class="col-md-6">
															<div class="form-group">
																<label><?php echo $mealType->getName(); ?> :</label>
																<select class="custom-select form-control">
																	<option value=""><?php echo $page_choice_recipe; ?></option>
																	<?php
																		foreach ($listMyRecipe as $recipe) {
																			foreach ($listMyCurrentDietMealsFormFront as $mealDiet) {
																				$selected = '';
																				if ($mealDiet->getDayNumber() == $i && $mealDiet->getIdMealType() == $mealType->getId() && $mealDiet->getIdDietRecipe() == $recipe->getId()){
																					$selected = 'selected';
																					break;
																				}
																			}
																			?><option value="<?php echo $recipe->getId(); ?>" <?php echo $selected; ?>><?php echo $recipe->getName(); ?></option><?php
																		}
																	?>
																</select>
															</div>
														</div>
														<?php
													}
												?>
											</div>
										</section>
									<?php
								}
							?>
						</form>
					</div>
				</div>
			</div>
      
      <?php
        include('../../Home/Template/_headerFooter.php');
      ?>
      
      <script src="nutritionMyCurrentsDietsAdd.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>