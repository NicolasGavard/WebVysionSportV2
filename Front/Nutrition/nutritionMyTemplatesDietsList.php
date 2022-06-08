<?php
	session_start();
  $international  = 'Nutrition/nutritionMyTemplatesDietsList';
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
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i> <?php echo $page_all_active; ?></buttons>
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i> <?php echo $page_all_inactive; ?></button>
              <button type="button" style="margin-top: 5px; margin-right: 0px;" class="btn btn-primary AddNewMyTemplatesDiets" data-toggle="modal" data-target="#modalAddMyTemplateDiet"><i class="fa fa-plus"></i> <?php echo $page_all_add; ?></button>
            </div>
          </div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
            <table class="table stripe hover nowrap" id="datatable">
							<thead>
								<tr>
                  <th width="30%" class="table-plus"><span><?php echo $page_name; ?></span></th>
                  <th width="20%"><span><?php echo $page_assigned_for; ?></span></th>
                  <th width="10%"><span><?php echo $page_duration; ?></span></th>
                  <th width="30%"><span><?php echo $page_tags; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_actions; ?></span></th>
								</tr>
							</thead>
							<tbody id="listMyTemplatesDietsTbody">
							</tbody>
						</table>
            
            <div id="listMyTemplatesDietsModal">

					  </div>
					</div>
				</div>
			</div>
      
      <div class="modal fade bs-example-modal-lg" id="modalAddMyTemplateDiet" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500"><?php echo $page_add_title; ?></h4>
              <h4 class="padding-top-30 mb-30 weight-500"><?php echo $page_update_title; ?></h4>
              <form class="FormAddMyTemplateDiet" action="#" id="FormAddMyTemplateDiet">
                <input class="form-control AddMyTemplatesDietsFormId"            type="hidden" name="id"           value="0">
                <input class="form-control AddMyTemplatesDietsFormIdUserCoatch"  type="hidden" name="idusercoach"  value="0">
                <input class="form-control AddMyTemplatesDietsFormTimestamp"     type="hidden" name="timestamp"    value="0">
                <input class="form-control AddMyTemplatesDietsFormStatut"        type="hidden" name="elemState"    value="0">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_name; ?></label>
                      <select class="custom-select2 form-control listMyTemplates" data-style="btn-outline-danger" id="listMyTemplates" name="idDietTemplate" style="width: 100%; height: 38px;">  
                        <option value="0"><?php echo $page_all_choice; ?></option>
                      </select>
                      <div class="form-control-feed back danger-template has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_template; ?> </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_list_assigned_for_one; ?></label>
                      <select class="custom-select2 form-control listStudents" id="listStudents" name="idUserStudent" style="width: 100%; height: 38px;">
                        <option value="0"><?php echo $page_all_choice; ?></option>
                      </select>
                      <div class="form-control-feed back danger-student has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_student; ?> </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_date_begin; ?></label>
                      <!-- <input class="form-control date-picker dateStart" id="dateStart" placeholder="<?php //echo $page_add_date_begin; ?>" type="text" name="date_start"> -->
                      <input class="form-control dateStart" id="dateStart" placeholder="<?php echo $page_add_date_begin; ?>" type="text" name="dateStart">
                      <div class="form-control-feed back danger-dateStart has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_dateStart; ?> </div>
                    </div>
                  </div>
                </form>
              </div>
              
              <div class="padding-bottom-30 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddMyTemplateDiet" id="btnAddMyTemplateDiet"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_confirm; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 

      <?php
        include('../Home/_headerFooter.php');
      ?>
      
      <script src="../../jsWebVysionSport/Nutrition/nutritionMyTemplatesDietsList.js"></script>
  </body>
</html>