        <!-- 
          <div class="footer-wrap pd-20 mb-20 card-box">
            WebVysionSport - Par <a href="https://www.webvysion.fr" target="_blank">WebVysion</a>
          </div>
         -->

         <div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500 DelTxt"> </h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                  <form class="forms-sample" id="FormDel">
                    <input type="hidden" name="id" class="DelFormId" value="0">
                  </form>
                  <div class="col-6">
                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <span class="page_all_no"></span>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" id="btnDel"><i class="fa fa-check"></i></button>
                    <span class="page_all_yes"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modalRest" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500 RestTxt"> </h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                  <form class="forms-sample" id="FormRest">
                    <input type="hidden" name="id" class="RestFormId" value="0">
                  </form>
                  <div class="col-6">
                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <span class="page_all_no"></span>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" id="btnRest"><i class="fa fa-check"></i></button>
                    <span class="page_all_yes"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-30 d-none">
          <div class="pd-20 card-box text-center height-100-p">
            <h5 class="pt-20 h5 mb-30 errorData_ok_txt"></h5>
            <div class="max-width-200 mx-auto">
              <button type="button" class="btn mb-20 btn-primary btn-block" id="sa-success-distrix">Click me</button>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-30 d-none">
          <div class="pd-20 card-box text-center height-100-p">
            <h5 class="pt-20 h5 mb-30 errorData_ko"></h5>
            <div class="max-width-200 mx-auto">
              <button type="button" class="btn mb-20 btn-primary btn-block" id="sa-error-distrix">Click me</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <!-- <script src="vendors/scripts/layout-settings.js"></script> -->
    
    <!-- js -->
    <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
    <!-- bootstrap-dataTables js -->
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- bootstrap-cropper js -->
    <script src="src/plugins/cropperjs/dist/cropper.js"></script>
    <!-- bootstrap-tagsinput js -->
	  <script src="src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
    <!-- add dropzone in footer -->
    <script src="src/plugins/dropzone/src/dropzone.js"></script>

    <?php if (stripos($_SERVER['PHP_SELF'], 'main') !== false) { ?>
      <!-- dashboard -->
      <script src="vendors/scripts/dashboard.js"></script>
    <?php } else { ?>
      <!-- buttons for Export datatable -->
      <script src="src/plugins/air-datepicker/dist/js/datepicker.js"></script>
      <script src="src/plugins/air-datepicker/dist/js/i18n/datepicker.fr.js"></script>
      <!-- buttons for Export datatable -->
      <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
      <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
      <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
      <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
      <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
      <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
      <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
      <!-- Datatable Setting js -->
      <script src="vendors/scripts/datatable-setting.js"></script></body>
      <!-- Datatable Colorpicker js -->
      <script src="src/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
      <script src="src/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
      <script src="src/plugins/jquery-asColorPicker/jquery-asColorPicker.js"></script>
      <script src="vendors/scripts/colorpicker.js"></script>
    <?php } ?>

    <!-- js DistriX -->
    <script src="jsDistriX/main.js"></script>
    <script src="jsDistrix/profil.js"></script>

    <?php
      // Nutrition
      if (stripos($_SERVER['PHP_SELF'], 'nutritionMyCurrentsDiets')   !== false) { ?><script src="jsDistrix/nutritionMyCurrentsDiets.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'nutritionMyTemplatesDiets')  !== false) { ?><script src="jsDistrix/nutritionMyTemplatesDiets.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'nutritionMyRecipe')          !== false) { ?><script src="jsDistrix/nutritionMyRecipes.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'nutritionMyAliment')         !== false) { ?><script src="jsDistrix/nutritionMyAliments.js"></script><?php }

      // Admin User
      if (stripos($_SERVER['PHP_SELF'], 'adminUserList')          !== false) { ?><script src="jsDistrix/adminUsers.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'adminEnterpriseList')    !== false) { ?><script src="jsDistrix/adminEnterprises.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'adminUserTypeList')      !== false) { ?><script src="jsDistrix/adminUserTypes.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'adminRoleList')          !== false) { ?><script src="jsDistrix/adminRoles.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'adminRightList')         !== false) { ?><script src="jsDistrix/adminRights.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'adminApplication')       !== false) { ?><script src="jsDistrix/adminApplications.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'adminModule')            !== false) { ?><script src="jsDistrix/adminModules.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'adminFunctionality')     !== false) { ?><script src="jsDistrix/adminFunctionalities.js"></script><?php }
      
      // Food
      if (stripos($_SERVER['PHP_SELF'], 'foodFoodList')       !== false) { ?><script src="jsDistrix/foodFood.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'foodBrandList')      !== false) { ?><script src="jsDistrix/foodBrand.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'foodEcoScoreList')   !== false) { ?><script src="jsDistrix/foodEcoScore.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'foodNovaScoreList')  !== false) { ?><script src="jsDistrix/foodNovaScore.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'foodNutriScoreList') !== false) { ?><script src="jsDistrix/foodNutriScore.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'foodLabelList')      !== false) { ?><script src="jsDistrix/foodLabel.js"></script><?php }
      
      // Codes tables
      if (stripos($_SERVER['PHP_SELF'], 'codeTableWeightTypeList')  !== false) { ?><script src="jsDistrix/codeTableWeightType.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'codeTableFoodCategoryList')!== false) { ?><script src="jsDistrix/codeTableFoodCategory.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'codeTableNutritionalList') !== false) { ?><script src="jsDistrix/codeTableNutritional.js"></script><?php }
      if (stripos($_SERVER['PHP_SELF'], 'codeTableLanguageList')    !== false) { ?><script src="jsDistrix/codeTableLanguages.js"></script><?php }
    ?>

  <script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>
  </body>
</html>