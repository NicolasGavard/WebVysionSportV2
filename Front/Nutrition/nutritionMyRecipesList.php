<?php
	session_start();
  $international  = 'Nutrition/nutritionMyRecipesList';
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
				<!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
					<div class="clearfix">
            <div class="pull-left">
              <h4 class="text-blue h4"><?php echo $page_title; ?></h4>
            </div>
              
            <div class="pull-right">
              <!-- <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-info AddSearchMyRecipes" data-toggle="modal" data-target="#modalSearchMyRecipes"><i class="icon-copy dw-info dw dw-search"></i> <?php echo $page_all_filter; ?></buttons> -->
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i> <?php echo $page_all_active; ?></buttons>
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i> <?php echo $page_all_inactive; ?></button>
              <button type="button" style="margin-top: 5px; margin-right: 0px;" class="btn btn-primary AddNewMyRecipes" data-toggle="modal" data-target="#modalAddMyRecipe"><i class="fa fa-plus"></i> <?php echo $page_all_add; ?></button>
            </div>
          </div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
            <table class="table stripe hover nowrap" id="datatable">
							<thead>
								<tr>
                  <th width="20%" class="table-plus datatable-nosort"><span><?php echo $page_picture; ?></span></th>
                  <th width="15%"><span><?php echo $page_name; ?></span></th>
                  <th width="45%"><span><?php echo $page_info_nutritional; ?></span></th>
                  <th width="10%"><span><?php echo $page_rating; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
							<tbody id="listMyRecipesTbody">
							</tbody>
						</table>
            
            <div id="listMyRecipesModal">

					  </div>
					</div>
				</div>
			</div>
      
      <div class="modal fade bs-example-modal-lg" id="modalAddMyRecipeFood" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title"><?php echo $page_title_food; ?> <span class="InfoSuppTitle"></span></h4>

              <table class="table stripe hover nowrap" id="datatable2">
							<thead>
								<tr>
                  <th width="55%" class="table-plus datatable-nosort"><span><?php echo $page_food; ?></span></th>
                  <th width="15%"><span><?php echo $page_weight; ?></span></th>
                  <th width="20%"><span><?php echo $page_weightType; ?></span></th>
								</tr>
							</thead>
							<tbody id="listMyRecipeFoodTbody">
							</tbody>
						</table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade bs-example-modal-lg" id="modalAddMyRecipe" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?> <span class="InfoSuppTitle"></span></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?> <span class="InfoSuppTitle"></span></h4>
              <form class="FormAddMyRecipe" action="#" id="FormAddMyRecipe">
                <input class="form-control AddMyRecipeFormId"             type="hidden" name="id"           value="0">
                <input class="form-control AddMyRecipeFormIdUserCoatch"   type="hidden" name="idusercoach"  value="0">
                <input class="form-control AddMyRecipeFormTimestamp"      type="hidden" name="timestamp"    value="0">
                <input class="form-control AddMyRecipeFormStatut"         type="hidden" name="elemState"    value="0">
                <input class="form-control AddMyRecipeFormPictureBase64"  type="hidden" name="base64Img"    id="linkToPictureBase64">
                <div class="row">
                  
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_code; ?></label>
                      <input class="form-control AddMyRecipeFormCode" type="text" name="code" placeholder="<?php echo $page_code; ?>">
                      <div class="form-control-feed back danger-code has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_code; ?> </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_rating; ?></label>
                      <select class="custom-select col-12 AddMyRecipeFormRating" name="rating">
                        <option selected="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_name; ?></label>
                      <input class="form-control AddMyRecipeFormName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                      <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                    </div>
                  </div>
                  
                  <div class="padding-top-20 padding-bottom-20 col-md-12 col-sm-12">
                    <div class="form-group">
                      <img src="" alt="" style="margin-top:20px; margin-bottom:20px; max-width:120px; max-height:150px; border-radius: 10px;" class="avatar-photo AddMyRecipePicture">
                      <div class="dropzoneNoImage d-none">
                        <input type="file" name="file" class="AddMyRecipeFormPicture" onchange="encodeImgtoBase64(this);" />
                        </br>
                        <button type="button" class="btn btn-info btnChangeImageCancel"><i class="icon-copy dw dw-image1"></i>&nbsp;<?php echo $page_all_cancel; ?></button>
                      </div>
                      <div class="dropzoneImage d-none">
                        <button type="button" class="btn btn-info btnChangeImage"><i class="icon-copy dw dw-image1"></i>&nbsp;<?php echo $page_all_change_picture; ?></button>
                      </div>
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
      
      <script src="../../jsWebVysionSport/Nutrition/nutritionMyRecipesList.js"></script>
  </body>
</html>