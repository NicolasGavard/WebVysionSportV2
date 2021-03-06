<?php
  session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/foodNovaScoreList'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
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
              <button type="button" class="btn btn-success disabled"><i class="icon-copy dw dw-checked"></i>&nbsp;<?php echo $page_all_active; ?></button>
              <button type="button" class="btn btn-warning"><i class="icon-copy dw dw-ban"></i>&nbsp;<?php echo $page_all_inactive; ?></button>
              <button type="button" class="btn btn-primary AddNewNovaScore" data-toggle="modal" data-target="#modalAddNovaScore"><i class="fa fa-plus"></i>&nbsp;<?php echo $page_all_add; ?></button>
        		</div>
					</div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table class="display responsive nowrap" width="100%" id="datatable">
							<thead>
								<tr>                 
                  <th width="20%" class="table-plus datatable-nosort"><span><?php echo $page_picture; ?></span></th>
                  <th width="10%"><span><?php echo $page_color; ?></span></th>
                  <th width="60%"><span><?php echo $page_name; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
      
      <div class="modal fade" id="modalAddNovaScore" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?></h4>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_name; ?></label>
                    <input class="form-control AddNovaScoreFormName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                    <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_color; ?></label>
                    <input class="colorpicker form-control AddNovaScoreFormColor" type="text" name="color" placeholder="<?php echo $page_color; ?>">
                    <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_color; ?> </div>
                  </div>
                </div>
                
                <div class="dropzoneNoImage col-md-12 col-sm-12 d-none">
                  <div class="pd-20 card-box mb-30">
                    <form class="dropzone FormAddNovaScore" action="#" id="FormAddNovaScore" style="max-height: 200px;">
                      <input class="form-control AddNovaScoreFormIdNovaScore"       type="hidden" name="id"         value="0">
                      <input class="form-control AddNovaScoreFormTimestamp"     type="hidden" name="timestamp"  value="0">
                      <input class="form-control AddNovaScoreFormStatut"        type="hidden" name="elemState"     value="0">
                      <input class="form-control AddNovaScoreFormPictureBase64" type="hidden" name="base64Img"  id="base64Img">
                      <div class="fallback" style="margin: 1em 0;">
                        <input type="file" name="file" class="AddNovaScoreFormPicture" />
                      </div>
                    </form>
                    <button type="button" class="btn btn-info btnChangeImageCancel"><i class="icon-copy dw dw-image1"></i>&nbsp;<?php echo $page_all_cancel; ?></button>
                  </div>
                </div>
              </div>
              
              <div class="dropzoneImage padding-bottom-30 col-md-12 col-sm-12 d-none">
                <div class="profile-photo">
                  <img src="" alt="" style="max-width:180px; max-height:180px; border-radius: 10px;" class="avatar-photo avatar-NovaScore">
                </div>
                <button type="button" class="btn btn-info btnChangeImage"><i class="icon-copy dw dw-image1"></i>&nbsp;<?php echo $page_all_change_picture; ?></button>
              </div>

              <div class="padding-bottom-30 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddNovaScore" id="btnAddNovaScore"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_confirm; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('../../Home/Template/_headerFooter.php');
      ?>
      
      <script src="foodNovaScoreList.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>