<?php
	session_start();
	$international  = 'nutritionMyRecipesList';
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('i18/'.$i18cdlangue.'/header.php');
  include("i18/_i18.php");
  
  include('_header.php');
	include('_headerMenuTop.php');
	include('_headerMenuLeft.php');
?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
					<div class="clearfix">
            <div class="pull-left">
              <h4 class="text-blue h4 page_nutrition_my_recipe_title"></h4>
            </div>

            <div class="pull-right">
              <select class="custom-select2 form-control InfoMyCurrentsDietsFormListStudents" name="state" style="width: 100%; height: 38px;">
                <option value="0">Choix</option>
              </select>
              <button type="button" style="margin-right: 5px;" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i> Actifs</buttons>
              <button type="button" style="margin-right: 5px;" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i> Inactifs</button>
              <button type="button" style="margin-right: 0px;" class="btn btn-primary AddNewMyCurrentsDiets" data-toggle="modal" data-target="#modalAddMyCurrentsDiets"><i class="fa fa-plus"></i> Ajouter</button>
            </div>
          </div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
                  <th width="15%"><span class="page_nutrition_my_recipe_name"></span></th>
                  <th width="20%"><span class="page_nutrition_my_recipe_assigned_for"></span></th>
                  <th width="10%"><span class="page_nutrition_my_recipe_duration"></span></th>
                  <th width="10%"><span class="page_nutrition_my_recipe_date_begin"></span></th>
                  <th width="20%"><span class="page_nutrition_my_recipe_tags"></span></th>
                  <th width="25%"><span class="page_nutrition_my_recipe_advancement"></span></th>
                  <th width="10%" class="datatable-nosort"><span class="page_nutrition_my_Diet_action"></span></th>
								</tr>
							</thead>
							<tbody id="listMyCurrentsDietsTbody">
							</tbody>
						</table>
            
            <div id="listMyCurrentsDietsModal">

					  </div>
					</div>
				</div>
			</div>
      
      <div class="modal fade bs-example-modal-lg" id="modalAddMyCurrentsDiets" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 page_nutrition_my_recipe_add_title"> </h4>
              <form class="FormAddMyCurrentsDiets" action="#" id="FormAddMyCurrentsDiets">
                <input class="form-control AddMyCurrentsDietsFormId"        type="hidden" name="id"         value="0">
                <input class="form-control AddMyCurrentsDietsFormTimestamp" type="hidden" name="timestamp"  value="0">
                <input class="form-control AddMyCurrentsDietsFormStatut"    type="hidden" name="statut"     value="0">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label class="page_nutrition_my_recipe_assigned_for"></label>
                      <select class="selectpicker form-control InfoMyCurrentsDietsFormListStudents" data-size="5" data-style="btn-outline-info" multiple data-actions-box="true" data-selected-text-format="count" name="assignedUsers">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label class="page_nutrition_my_recipe_duration"></label>
                      <select class="custom-select2 form-control InfoMyCurrentsDietsFormDuration" name="duration" style="width: 100%; height: 38px;">
                        <option value="0">Choix</option>
                        <option value="1">1 jours</option>
                        <option value="2">2 jours</option>
                        <option value="3">3 jours</option>
                        <option value="4">4 jours</option>
                        <option value="5">5 jours</option>
                        <option value="6">6 jours</option>
                        <option value="7">7 jours</option>
                        <option value="14">2 semaines</option>
                        <option value="21">3 semaines</option>
                        <option value="28">4 semaines</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label class="page_nutrition_my_recipe_date_begin"></label>
                      <input class="form-control date-picker page_nutrition_my_recipe_add_date_begin" placeholder="Sélectionnez une date" type="text" name="date_start">
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label class="page_nutrition_my_recipe_tags"></label>
                      <input type="text" class="page_nutrition_my_recipe_add_tag" value="" data-role="tagsinput" placeholder="Ajouter un tag" name="tags">
                    </div>
                  </div>
                </form>
              </div>
              
              <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                <div class="col-6">
                  <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                  <span class="page_all_close"></span>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn btnAddMyCurrentsDiets" data-dismiss="modal" id="btnAddMyCurrentsDiets"><i class="fa fa-check"></i></button>
                  <span class="page_all_add"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 

      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsWebVysionSport/Nutrition/nutritionMyRecipesList.js"></script>
  </body>
</html>