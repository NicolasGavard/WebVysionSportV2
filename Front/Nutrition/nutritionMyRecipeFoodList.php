<?php
	session_start();
  $international  = 'Nutrition/nutritionMyRecipeFoodList';
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
			<div class="min-height-200px">

        <div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="../Nutrition/nutritionMyRecipesList.php"><?php echo $page_title_prev; ?></a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?> <span class='infoRecipeName'></span></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
					<div class="clearfix">
            <div class="pull-left">
              <h4 class="text-blue h4"><?php echo $page_title; ?> <span class='infoRecipeName'></span></h4>
            </div>
              
            <div class="pull-right">
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i> <?php echo $page_all_active; ?></buttons>
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i> <?php echo $page_all_inactive; ?></button>
              <button type="button" style="margin-top: 5px; margin-right: 0px;" class="btn btn-primary AddNewMyRecipeFood" data-toggle="modal" data-target="#modalAddMyRecipeFood"><i class="fa fa-plus"></i> <?php echo $page_all_add; ?></button>
            </div>
          </div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
            <table class="table stripe hover nowrap" id="datatable">
							<thead>
								<tr>
                  <th width="50%" class="table-plus"><span><?php echo $page_name; ?></span></th>
                  <th width="20%"><span><?php echo $page_weight; ?></span></th>
                  <th width="20%"><span><?php echo $page_weightType; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
							<tbody id="listMyRecipesTbody">
							</tbody>
						</table>
          </div>
				</div>
			</div>
      
      <div class="modal fade bs-example-modal-lg" id="modalAddMyRecipeFood" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?> <span class="infoRecipeName"></span></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?> <span class="infoRecipeName"></span></h4>
              <form class="FormAddMyRecipe" action="#" id="FormAddMyRecipe">
                <input class="form-control AddMyRecipeFormId"             type="hidden" name="id"         value="0">
                <input class="form-control AddMyRecipeFormIdRecipe"       type="hidden" name="idRecipe"   value="0">
                <input class="form-control AddMyRecipeFormTimestamp"      type="hidden" name="timestamp"  value="0">
                <input class="form-control AddMyRecipeFormStatut"         type="hidden" name="elemState"  value="0">
                <div class="row">
                  
                  <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_name; ?></label>
                      <select class="custom-select col-12 AddMyRecipeFormFood" name="idFood">
                        <option selected="">Choix</option>
                      </select>
                    </div>
                  </div>
                
                  <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_weight; ?></label>
                      <input class="form-control AddMyRecipeFormWeight" type="text" name="weight" placeholder="<?php echo $page_weight; ?>">
                      <div class="form-control-feed back danger-weight has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_weight; ?> </div>
                    </div>
                  </div>

                  <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_weightType; ?></label>
                      <select class="custom-select col-12 AddMyRecipeFormWeightType" name="idWeightType">
                        <option selected="">Choix</option>
                      </select>
                    </div>
                  </div>

                </form>
              </div>
              
              <div class="padding-bottom-30 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddMyRecipe" id="btnAddMyRecipe"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_confirm; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 

      <?php
        include('../Home/_headerFooter.php');
      ?>
      
      <script src="../../jsWebVysionSport/Nutrition/nutritionMyRecipeFoodList.js"></script>
  </body>
</html>