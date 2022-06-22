<?php
	session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/nutritionMyTemplatesDietsList'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
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
            <table class="display responsive nowrap" width="100%" id="datatable">
							<thead>
								<tr>
                  <th width="30%" class="table-plus"><span><?php echo $page_name; ?></span></th>
                  <th width="20%"><span><?php echo $page_assigned_for; ?></span></th>
                  <th width="10%"><span><?php echo $page_duration; ?></span></th>
                  <th width="30%"><span><?php echo $page_tags; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_actions; ?></span></th>
								</tr>
							</thead>
						</table>
          </div>
				</div>
			</div>
      
      <div class="modal fade bs-example-modal-lg" id="modalAddMyTemplateDiet" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title"><?php echo $page_add_title; ?> <span class="infoNameTemplateDiet"></span></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title"><?php echo $page_update_title; ?> <span class="infoNameTemplateDiet"></span></h4>
              <form class="FormAddMyTemplateDiet" action="#" id="FormAddMyTemplateDiet">
                <input class="form-control AddMyTemplatesDietsFormId"            type="hidden" name="id"           value="0">
                <input class="form-control AddMyTemplatesDietsFormIdUserCoatch"  type="hidden" name="idusercoach"  value="0">
                <input class="form-control AddMyTemplatesDietsFormTimestamp"     type="hidden" name="timestamp"    value="0">
                <input class="form-control AddMyTemplatesDietsFormStatut"        type="hidden" name="elemState"    value="0">
                
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_name; ?></label>
                      <input class="form-control AddMyTemplatesDietsFormName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                      <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_duration; ?></label>
                      <select class="custom-select col-12 AddMyTemplatesDietsFormDuration" name="duration">
                        <option selected="0">0</option>
                        <?php
                          $count = 0;
                          while ($count <= 40){
                            echo $count." ";
                            $count = $count + 1;
                            echo "<option value='".$count."'>".$count."</option>";
                          }
                        ?> 
                      </select>
                      <div class="form-control-feed back danger-duration has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_duration; ?> </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_tags; ?></label>
                      <input type="text" class="AddMyTemplatesDietsFormTags" value="" name="tags" data-role="tagsinput">
                      <div class="form-control-feed back danger-tags has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_tags; ?> </div>
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
        include('../../Home/Template/_headerFooter.php');
      ?>
      
      <script src="nutritionMyTemplatesDietsList.js"></script>
  </body>
</html>