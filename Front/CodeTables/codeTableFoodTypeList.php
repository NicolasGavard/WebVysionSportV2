<?php
	session_start();
  $international  = 'CodeTables/codeTableFoodTypeList';
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
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4"><?php echo $page_title; ?></h4>
						</div>
        
            <div class="pull-right">
              <button type="button" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i>&nbsp;<?php echo $page_all_active; ?></button>
              <button type="button" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i>&nbsp;<?php echo $page_all_inactive; ?></button>
              <button type="button" class="btn btn-primary AddNewFoodType" data-toggle="modal" data-target="#modalAddFoodType"><i class="fa fa-plus"></i>&nbsp;<?php echo $page_all_add; ?></button>
        		</div>
					</div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table class="table stripe hover nowrap" id="datatable">
							<thead>
								<tr>                 
                  <th><span><?php echo $page_code; ?></span></th>
                  <th><span><?php echo $page_name; ?></span></th>
                  <th><span><?php echo $page_translation; ?></span></th>
                  <th><span><?php echo $page_status; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
							<tbody id="listFoodTypesTbody">            
							</tbody>
						</table>
					</div>
				</div>
			</div>
      
      <div class="modal fade" id="modalAddFoodType" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?></h4>
              <div class="row">
                <div class="col-md-12 col-sm-12 d-none showPicture">
                  <div class="profile-photo">
                    <img src="" alt="" class="avatar-photo avatar-FoodType">
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_name; ?></label>
                    <input class="form-control AddFoodTypeFormName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                    <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                  </div>
                </div>
                
                <div class="col-md-12 col-sm-12">
                  <div class="pd-20 card-box mb-30">
                    <form class="dropzone FormAddFoodType" action="#" id="FormAddFoodType" style="max-height: 200px;">
                      <input class="form-control AddFoodTypeFormIdFoodType"       type="hidden" name="id"         value="0">
                      <input class="form-control AddFoodTypeFormTimestamp"     type="hidden" name="timestamp"  value="0">
                      <input class="form-control AddFoodTypeFormStatut"        type="hidden" name="elemState"     value="0">
                      <input class="form-control AddFoodTypeFormPictureBase64" type="hidden" name="base64Img"  id="base64Img">
                      <div class="fallback" style="margin: 1em 0;">
                        <input type="file" name="file" class="AddFoodTypeFormPicture" />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <div class="padding-bottom-30 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddFoodType" id="btnAddFoodType"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_add; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('../Home/_headerFooter.php');
      ?>
      
      <script src="../../jsWebVysionSport/CodeTables/codeTableFoodType.js"></script>
  </body>
</html>
