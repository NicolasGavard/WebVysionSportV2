<?php
	  session_start();
    $i18cdlangue    = 'FR';
    // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
    include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
    include('i18/'.$i18cdlangue.'/codeTableLanguageList'.$i18cdlangue.'.php');
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
              <button type="button" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i>&nbsp;<?php echo $page_all_active; ?></button>
              <button type="button" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i>&nbsp;<?php echo $page_all_inactive; ?></button>
              <button type="button" class="btn btn-primary AddNewLanguage" data-toggle="modal" data-target="#modalAddLanguage"><i class="fa fa-plus"></i>&nbsp;<?php echo $page_all_add; ?></button>
        		</div>
					</div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table class="display responsive nowrap" width="100%" id="datatable">
							<thead>
								<tr>                 
                  <th width="20%" class="table-plus datatable-nosort"><span><?php echo $page_picture; ?></span></th>
                  <th width="10%"><span><?php echo $page_code; ?></span></th>
                  <th width="70%"><span><?php echo $page_name; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
      
      <div class="modal fade" id="modalAddLanguage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?></h4>
              <form class="FormAddLanguage" action="#" id="FormAddLanguage">
                <input class="form-control AddLanguageFormIdLanguage"    type="hidden"  name="id"         value="0">
                <input class="form-control AddLanguageFormCode"          type="hidden"  name="code"       value="">
                <input class="form-control AddLanguageFormTimestamp"     type="hidden"  name="timestamp"  value="0">
                <input class="form-control AddLanguageFormTimestamp"     type="hidden"  name="timestamp"  value="0">
                <input class="form-control AddLanguageFormStatut"        type="hidden"  name="elemState"  value="0">
                <input class="form-control AddLanguageFormPictureBase64" type="hidden"  name="base64Img"  id="linkToPictureBase64">
                
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_code; ?></label>
                      <input class="form-control AddLanguageFormCodeShort" type="text" code="codeShort" placeholder="<?php echo $page_code; ?>">
                      <div class="form-control-feed back danger-code has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_code; ?> </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_name; ?></label>
                      <input class="form-control AddLanguageFormName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                      <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                    </div>
                  </div>
                  
                  <div class="padding-top-20 padding-bottom-20 col-md-12 col-sm-12">
                    <div class="form-group">
                      <img src="" alt="" style="margin-top:20px; margin-bottom:20px; max-width:120px; max-height:150px; border-radius: 10px;" class="avatar-photo AddLanguagePicture">
                      <div class="dropzoneNoImage d-none">
                        <input type="file" name="file" class="AddLanguageFormPicture" onchange="encodeImgtoBase64(this);" />
                        </br>
                        <button type="button" class="btn btn-info btnChangeImageCancel"><i class="icon-copy dw dw-image1"></i>&nbsp;<?php echo $page_all_cancel; ?></button>
                      </div>
                      <div class="dropzoneImage d-none">
                        <button type="button" class="btn btn-info btnChangeImage"><i class="icon-copy dw dw-image1"></i>&nbsp;<?php echo $page_all_change_picture; ?></button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              
              <div class="padding-bottom-30 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddLanguage" id="btnAddLanguage"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_add; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('../../Home/Template/_headerFooter.php');
      ?>
      
      <script src="codeTableLanguageList.js"></script>
  </body>
</html>

