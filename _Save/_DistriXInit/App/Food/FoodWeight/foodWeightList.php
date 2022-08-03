<?php
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/foodWeightList'.$i18cdlangue.'.php');
?>

<div class="min-height-200px">
  <div class="pd-20 card-box mb-30">				
    <div class="clearfix">
      <div class="pull-right">
        <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-success disabled"><i class="icon-copy dw dw-checked"></i>&nbsp;<?php echo $page_all_active; ?></button>
        <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-warning"><i class="icon-copy dw dw-ban"></i>&nbsp;<?php echo $page_all_inactive; ?></button>
        <button type="button" style="margin-top: 5px; margin-right: 0px;" class="btn btn-primary AddNewFoodWeight" data-toggle="modal" data-target="#modalAddFoodWeight"><i class="fa fa-plus"></i>&nbsp;<?php echo $page_all_add; ?></button>
      </div>
    </div>
    <div class="pb-20"></div>
    <div class="pb-20">
      <table id="FoodWeightTable" class="display responsive nowrap" width="100%">
        <thead>
          <tr>                 
            <th width="20%" class="table-plus"><span><?php echo $page_picture; ?></span></th>
            <th width="35%"><span><?php echo $page_weight; ?></span></th>
            <th width="35%"><span><?php echo $page_weight_type; ?></span></th>
            <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddFoodWeight" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center font-18">
        <h4 class="padding-top-30 mb-30 weight-500 add_title"><?php echo $page_add_title; ?></h4>
        <h4 class="padding-top-30 mb-30 weight-500 update_title"><?php echo $page_update_title; ?></h4>
        <form class="FormAddFoodWeight" action="#" id="FormAddFoodWeight">
          <div class="row">
            <input class="form-control AddFoodWeightFormId"             type="hidden" name="id"         value="0">
            <input class="form-control AddFoodWeightFormIdFood"         type="hidden" name="idFood"     value="0">
            <input class="form-control AddFoodWeightFormTimestamp"      type="hidden" name="timestamp"  value="0">
            <input class="form-control AddFoodWeightFormStatus"         type="hidden" name="elemState"  value="0">
            <input class="form-control AddFoodWeightFormPictureBase64"  type="hidden" name="base64Img"  id="linkToPictureBase64">

            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label><?php echo $page_weight; ?></label>
                <input class="form-control AddFoodWeightFormWeight" type="text" name="weight" placeholder="<?php echo $page_weight; ?>">
                <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_weight; ?> </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label><?php echo $page_weight_type; ?></label>
                <select class="custom-select2 form-control AddFoodWeightFormWeightType" id="listWeightsNotApply" name="idWeightType" style="width: 100%; height: 38px;">  
                  <option value="0"><?php echo $page_all_choice; ?></option>
                </select>
                <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_weight_type; ?> </div>
              </div>
            </div>

            <div class="padding-top-20 padding-bottom-20 col-md-12 col-sm-12">
              <div class="form-group">
                <img src="" alt="" style="margin-top:20px; margin-bottom:20px; max-width:120px; max-height:150px; border-radius: 10px;" class="avatar-photo avatar-foodWeight">
                <div class="dropzoneNoImage d-none">
                  <input type="file" name="file" class="AddFoodWeightFormPicture" onchange="encodeImgtoBase64(this);" />
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
            <button type="button" class="btn btn-primary btnAddFoodWeight" id="btnAddFoodWeight"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_confirm; ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>