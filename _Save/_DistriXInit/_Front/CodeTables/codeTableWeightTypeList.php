<?php
	session_start();

  $international  = 'CodeTables/codeTableWeightTypeList';
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
              <button type="button" class="btn btn-primary AddNewWeightType" data-toggle="modal" data-target="#modalAddWeightType"><i class="fa fa-plus"></i>&nbsp;<?php echo $page_all_add; ?></button>
        		</div>
					</div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table class="display responsive nowrap" width="100%" id="datatable">
							<thead>
                <input class="weightTypeType_solid"   type="hidden" value="<?php echo $page_solid_title; ?>">
                <input class="weightTypeType_liquid"  type="hidden" value="<?php echo $page_liquid_title; ?>">
                <input class="weightTypeType_other"   type="hidden" value="<?php echo $page_other_title; ?>">
              
                <tr>                 
                  <th width="15%" class="table-plus"><span><?php echo $page_abbreviation; ?></span></th>
                  <th width="55%"><span><?php echo $page_name; ?></span></th>
                  <th width="20%"><span><?php echo $page_type; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
      
      <div class="modal fade" id="modalAddWeightType" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?></h4>
              <div class="row">
                <input class="form-control AddWeightTypeFormIdWeightType"  type="hidden" name="id"         value="0">
                <input class="form-control AddWeightTypeFormTimestamp"     type="hidden" name="timestamp"  value="0">
                <input class="form-control AddWeightTypeFormStatut"        type="hidden" name="elemState"  value="0">

                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_abbreviation; ?></label>
                    <input class="form-control AddWeightTypeFormName" type="text" name="name" placeholder="<?php echo $page_abbreviation; ?>">
                    <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                  </div>
                </div>

                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_name; ?></label>
                    <input class="form-control AddWeightTypeFormName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                    <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                  </div>
                </div>

                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label><?php echo $page_name; ?></label>
                    <input class="form-control AddWeightTypeFormName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                    <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                  </div>
                </div>

                <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center col-md-12 col-lg-12" style="padding: 5px 0;">
                  <div class="select-role">
                    <label><?php echo $page_type; ?></label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn" style="padding-left: 10px; width: calc(33% - 10px);">
                        <input type="radio" name="weightTypeType" id="<?php echo $page_solid_title; ?>">
                        <span class="micon dw dw-house-1">&nbsp;<?php echo $page_solid_title; ?></span>
                      </label>
                      <label class="btn" style="padding-left: 10px; width: calc(33% - 10px);">
                        <input type="radio" name="weightTypeType" id="<?php echo $page_liquid_title; ?>">
                        <span class="micon dw dw-house-1">&nbsp;<?php echo $page_liquid_title; ?></span>
                      </label>
                      <label class="btn" style="padding-left: 10px; width: calc(33% - 10px);">
                        <input type="radio" name="weightTypeType" id="<?php echo $page_other_title; ?>">
                        <span class="micon dw dw-house-1">&nbsp;<?php echo $page_other_title; ?></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="padding-bottom-30 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddWeightType" id="btnAddWeightType"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_add; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('../Home/_headerFooter.php');
      ?>
      
      <script src="../../jsWebVysionSport/CodeTables/codeTableWeightType.js"></script>
  </body>
</html>

