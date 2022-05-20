<?php
	session_start();
	include('_header.php');
	include('_headerMenuTop.php');
	include('_headerMenuLeft.php');
?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				
        <div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4 page_food_brand_title"></h4>
						</div>
        
            <div class="pull-right">
              <button type="button" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i> Actifs</button>
              <button type="button" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i> Inactifs</button>
              <button type="button" class="btn btn-primary AddNewBrand" data-toggle="modal" data-target="#modalAddBrand"><i class="fa fa-plus"></i> Ajouter</button>
        		</div>
					</div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>                 
                  <th width="20%" class="table-plus datatable-nosort"><span class="page_food_brand_picture"></span></th>
                  <th width="70%"><span class="page_food_brand_name"></span></th>
                  <th width="10%" class="datatable-nosort"><span class="page_food_brand_action"></span></th>
								</tr>
							</thead>
							<tbody id="listBrandsTbody">            
							</tbody>
						</table>
					</div>
				</div>
			</div>
      
      <div class="modal fade" id="modalAddBrand" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 page_food_brand_add_title"> </h4>
              <div class="row">
                <div class="col-md-12 col-sm-12 d-none showPicture">
                  <div class="profile-photo">
                    <img src="" alt="" class="avatar-photo avatar-brand">
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label class="page_food_brand_name"></label>
                    <input class="form-control AddBrandFormName" type="text" name="name">
                    <div class="form-control-feed back danger-name has-danger errorData_txt_code" style='font-size: 14px;'></div>
                  </div>
                </div>
                
                <div class="col-md-12 col-sm-12">
                  <div class="pd-20 card-box mb-30">
                    <form class="dropzone FormAddBrand" action="#" id="FormAddBrand" style="max-height: 200px;">
                      <input class="form-control AddBrandFormIdBrand"       type="hidden" name="id"         value="0">
                      <input class="form-control AddBrandFormTimestamp"     type="hidden" name="timestamp"  value="0">
                      <input class="form-control AddBrandFormStatut"        type="hidden" name="statut"     value="0">
                      <input class="form-control AddBrandFormPictureBase64" type="hidden" name="base64Img"  id="base64Img">
                      <div class="fallback" style="margin: 1em 0;">
                        <input type="file" name="file" class="AddBrandFormPicture" />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                <div class="col-6">
                  <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                  <span class="page_all_close"></span>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn btnAddBrand" data-dismiss="modal" id="btnAddBrand"><i class="fa fa-check"></i></button>
                  <span class="page_all_add"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


<?php
	include('_headerFooter.php');
?>