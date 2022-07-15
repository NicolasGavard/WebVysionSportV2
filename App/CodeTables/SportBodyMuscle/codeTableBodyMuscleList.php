<?php
  session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/codeTableBodyMuscleList'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
  include("../../_util.php");
  
  $toScript["langueTxt"]          = $page_language;
  $toScript["nameTranslatedTxt"]  = $page_name_translated;
  $toScript["errorCodeTxt"]       = $errorData_txt_code;
  $toScript["errorNameTxt"]       = $errorData_txt_name;
  echo convertToScript($toScript);
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
              <button type="button" class="btn btn-primary AddNewBodyMuscle" data-toggle="modal" data-target="#modalAddBodyMuscle"><i class="fa fa-plus"></i>&nbsp;<?php echo $page_all_add; ?></button>
        		</div>
					</div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table id="BodyMuscleTable" class="display responsive nowrap" width="100%">
							<thead>
								<tr>                 
                  <th><span><?php echo $page_code; ?></span></th>
                  <th><span><?php echo $page_name; ?></span></th>
                  <th><span><?php echo $page_member; ?></span></th>
                  <th><span><?php echo $page_translation; ?></span></th>
                  <th><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
            </table>
					</div>
				</div>
			</div>
      
      <div class="modal fade" id="modalAddBodyMuscle" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-20 mb-20 weight-500 add_title d-none"><?php echo $page_add_title; ?></h4>
              <h4 class="padding-top-20 mb-20 weight-500 update_title d-none"><?php echo $page_update_title; ?></h4>
              
              <input class="form-control AddBodyMuscleFormIdBodyMuscle" type="hidden" name="id"         value="0">
              <input class="form-control AddBodyMuscleFormTimestamp"  type="hidden" name="timestamp"  value="0">
              <input class="form-control AddBodyMuscleFormStatut"     type="hidden" name="elemState"  value="0">
              
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_code; ?></label>
                    <input class="form-control AddBodyMuscleFormCode" id="AddBodyMuscleFormCode" type="text" code="codeShort" placeholder="<?php echo $page_code; ?>">
                    <div class="form-control-feed back danger-code has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_code; ?> </div>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_name; ?></label>
                    <input class="form-control AddBodyMuscleFormName" id="AddBodyMuscleFormName" type="text" code="bodyMuscleName" placeholder="<?php echo $page_name; ?>">
                    <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_member; ?></label>
                      <select class="custom-select2 form-control AddBodyMuscleMember" id="listBodyMuscleMembers" name="idBodyMuscleMember" style="width: 100%; height: 38px;">
                        <option value="0"><?php echo $page_all_choice; ?></option>
                      </select>
                      <div class="form-control-feed back danger-member has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_member; ?> </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                <label class="col-sm-12 col-md-12"><?php echo $page_languages; ?></label>
              </div>
              
              <div id="bodyMuscleLanguages"></div>
              
              <div class="padding-bottom-20 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddBodyMuscle" id="btnAddBodyMuscle"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_add; ?></button>
                  <button type="button" class="btn btn-primary btnUpdateBodyMuscle" id="btnUpdateBodyMuscle"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_update; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('../../Home/Template/_headerFooter.php');
      ?>
      <script src="codeTableBodyMuscleList.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>

