         <div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500"><?php echo $confirm_delete; ?></h4>
                <h4 class="mb-20 weight-500 DelTxt"> </h4>
                <div class="padding-bottom-20 row" style="max-width: 170px; margin: 0 auto;">
                  <form class="forms-sample" id="FormDel">
                    <input type="hidden" name="id"    class="DelFormId"   value="0">
                    <input type="hidden" name="type"  class="DelFormType" value="0">
                  </form>
                </div>
                <div class="padding-top-10 row" style="margin: 0 auto;">
                  <div class="col-6">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;<?php echo $page_all_close; ?></button>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnDel"><i class="fa fa-check"></i><span>&nbsp;<?php echo $page_all_confirm; ?></button>
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
                <h4 class="padding-top-30 mb-30 weight-500"><?php echo $confirm_restore; ?></h4>
                <h4 class="mb-20 weight-500 RestTxt"> </h4>
                <div class="padding-bottom-20 row" style="max-width: 170px; margin: 0 auto;">
                  <form class="forms-sample" id="FormRest">
                    <input type="hidden" name="id"    class="RestFormId"    value="0">
                    <input type="hidden" name="type"  class="RestFormType"  value="0">
                  </form>
                </div>
                <div class="padding-top-10 row" style="margin: 0 auto;">
                  <div class="col-6">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;<?php echo $page_all_close; ?></button>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnRest"><i class="fa fa-check"></i><span>&nbsp;<?php echo $page_all_confirm; ?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-30 d-none">
          <div class="pd-20 card-box text-center height-100-p">
            <h5 class="pt-20 h5 mb-30"><?php echo $errorData_ok_txt; ?></h5>
            <div class="max-width-200 mx-auto">
              <button type="button" class="btn mb-20 btn-primary btn-block" id="sa-success-distrix">Open</button>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-30 d-none">
          <div class="pd-20 card-box text-center height-100-p">
            <h5 class="pt-20 h5 mb-30"><?php echo $errorData_ko; ?></h5>
            <div class="max-width-200 mx-auto">
              <button type="button" class="btn mb-20 btn-primary btn-block" id="sa-error-distrix">Open</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- js -->
    <script src="<?php echo FRONT_PATH;?>vendors/scripts/core.js?v=<?php echo APP_VERSION;?>"></script>
    <script src="<?php echo FRONT_PATH;?>vendors/scripts/script.min.js?v=<?php echo APP_VERSION;?>"></script>
    <script src="<?php echo FRONT_PATH;?>vendors/scripts/process.js?v=<?php echo APP_VERSION;?>"></script>
    <!-- <script src="../../vendors/scripts/layout-settings.js?v=<?php //echo APP_VERSION;?>"></script> -->
    
    <!-- js -->
    <script src="<?php echo FRONT_PATH;?>src/plugins/apexcharts/apexcharts.min.js?v=<?php echo APP_VERSION;?>"></script>
    <!-- bootstrap-dataTables js -->
    <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/jquery.dataTables.min.js?v=<?php echo APP_VERSION;?>"></script>
    <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/dataTables.bootstrap4.min.js?v=<?php echo APP_VERSION;?>"></script>
    <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/dataTables.responsive.min.js?v=<?php echo APP_VERSION;?>"></script>
    <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/responsive.bootstrap4.min.js?v=<?php echo APP_VERSION;?>"></script>
    <!-- bootstrap-cropper js -->
    <script src="<?php echo FRONT_PATH;?>src/plugins/cropperjs/dist/cropper.js?v=<?php echo APP_VERSION;?>"></script>
    <!-- add sweet alert js & css in footer -->
    <script src="<?php echo FRONT_PATH;?>src/plugins/sweetalert2/sweetalert2.all.js?v=<?php echo APP_VERSION;?>"></script>
    <script src="<?php echo FRONT_PATH;?>src/plugins/sweetalert2/sweet-alert.init.js?v=<?php echo APP_VERSION;?>"></script>
    <!-- add dropzone in footer -->
    <script src="<?php echo FRONT_PATH;?>src/plugins/dropzone/src/dropzone.js?v=<?php echo APP_VERSION;?>"></script>

    <?php if (stripos($_SERVER['PHP_SELF'], 'main') !== false) { ?>
      <!-- dashboard -->
      <script src="<?php echo FRONT_PATH;?>vendors/scripts/dashboard.js?v=<?php echo APP_VERSION;?>"></script>
    <?php } else { ?>
      <!-- buttons for Export datatable -->
      <script src="<?php echo FRONT_PATH;?>src/plugins/air-datepicker/dist/js/datepicker.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/air-datepicker/dist/js/i18n/datepicker.fr.js?v=<?php echo APP_VERSION;?>"></script>
      <!-- buttons for Export datatable -->
      <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/dataTables.buttons.min.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/buttons.bootstrap4.min.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/buttons.print.min.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/buttons.html5.min.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/buttons.flash.min.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/pdfmake.min.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/datatables/js/vfs_fonts.js?v=<?php echo APP_VERSION;?>"></script>
      <!-- Datatable Setting js -->
      <script src="<?php echo FRONT_PATH;?>vendors/scripts/datatable-setting.js?v=<?php echo APP_VERSION;?>"></script></body>
      <!-- Datatable Colorpicker js -->
      <script src="<?php echo FRONT_PATH;?>src/plugins/jquery-asColor/dist/jquery-asColor.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/jquery-asGradient/dist/jquery-asGradient.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>src/plugins/jquery-asColorPicker/jquery-asColorPicker.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>vendors/scripts/colorpicker.js?v=<?php echo APP_VERSION;?>"></script>
      <!-- bootstrap-wizardStep js -->
      <script src="<?php echo FRONT_PATH;?>src/plugins/jquery-steps/jquery.steps.js?v=<?php echo APP_VERSION;?>"></script>
	    <script src="<?php echo FRONT_PATH;?>vendors/scripts/steps-setting.js?v=<?php echo APP_VERSION;?>"></script>
      <!-- switchery js -->
      <script src="<?php echo FRONT_PATH;?>src/plugins/switchery/switchery.min.js?v=<?php echo APP_VERSION;?>"></script>
      <!-- bootstrap-tagsinput js -->
      <script src="<?php echo FRONT_PATH;?>src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js?v=<?php echo APP_VERSION;?>"></script>
      <!-- bootstrap-touchspin js -->
	    <script src="<?php echo FRONT_PATH;?>src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js?v=<?php echo APP_VERSION;?>"></script>
      <script src="<?php echo FRONT_PATH;?>vendors/scripts/advanced-components.js?v=<?php echo APP_VERSION;?>"></script>
      <!-- bootstrap-Video js -->
      <script src="<?php echo FRONT_PATH;?>src/plugins/plyr/dist/plyr.js?v=<?php echo APP_VERSION;?>"></script>
	    <script src="https://cdn.shr.one/1.0.1/shr.js"></script>
    <?php } ?>

    <!-- js DistriX -->
    <script src="<?php echo FRONT_PATH;?>App/Home/Template/main.js?v=<?php echo APP_VERSION;?>"></script>

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
