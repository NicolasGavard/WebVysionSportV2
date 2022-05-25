<?php
	session_start();
  $international  = 'foodNutriScoreList';
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('i18/FR/header.php');
  include("i18/_i18.php");
  
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
							<h4 class="text-blue h4"><?php echo $page_title; ?></h4>
						</div>
        
            <div class="pull-right">
              <button type="button" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i> <?php echo $page_all_active; ?></button>
              <button type="button" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i> <?php echo $page_all_inactive; ?></button>
              <button type="button" class="btn btn-primary AddNewNutriScore" data-toggle="modal" data-target="#modalAddNutriScore"><i class="fa fa-plus"></i> <?php echo $page_all_add; ?></button>
        		</div>
					</div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>                 
                  <th width=20% class="table-plus datatable-nosort"><span><?php echo $page_picture; ?></span></th>
                  <th width=10% class="datatable-nosort"><span><?php echo $page_color; ?></span></th>
                  <th width=60% class="datatable-nosort"><span><?php echo $page_name; ?></span></th>
                  <th width=10% class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
							<tbody id="listNutriScoresTbody">            
							</tbody>
						</table>
					</div>
				</div>
			</div>
      
      <div class="modal fade" id="modalAddNutriScore" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
            <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?></h4>
            <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?></h4>
              <div class="row">
                <div class="col-md-12 col-sm-12 d-none showPicture">
                  <div class="profile-photo" style="height:70px;">
                    <img src="" alt="" class="avatar-photo avatar-Nutri_score" style="border-radius:10%">
                  </div>
                </div>

                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="InputNutriScoreName"><?php echo $page_name; ?></label>
                    <input class="form-control AddNutriScoreFormName" id="InputNutriScoreName" type="text" name="name" placeholder="<?php echo $page_name; ?>">
                  </div>
                </div>

                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="InputNutriScorNutrilor"><?php echo $page_color; ?></label>
                    <input type="text" class="colorpicker form-control AddNutriScoreFormColor" id="InputNutriScorNutrilor" placeholder="<?php echo $page_color; ?>" name="color" value="" />
                  </div>
                </div>
                
                <div class="col-md-12 col-sm-12">
                  <div class="pd-20 card-box mb-30">
                    <form class="dropzone FormAddNutriScore" action="#" id="FormAddNutriScore" style="max-height: 200px;">
                      <input class="form-control AddNutriScoreFormIdNutriScore"    type="hidden" name="id"         value="0">
                      <input class="form-control AddNutriScoreFormTimestamp"     type="hidden" name="timestamp"  value="0">
                      <input class="form-control AddNutriScoreFormStatut"        type="hidden" name="statut"     value="0">
                      <input class="form-control AddNutriScoreFormPictureBase64" type="hidden" name="base64Img"  id="base64Img">
                      <div class="fallback" style="margin: 1em 0;">
                        <input type="file" name="file" class="AddNutriScoreFormPicture" />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-sNutrindary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddNutriScore" data-dismiss="modal" id="btnAddNutriScore"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_add; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/foodNutriScore.js"></script>
  </body>
</html>