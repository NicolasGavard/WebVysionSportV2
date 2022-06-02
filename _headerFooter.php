         <div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500"><?php echo $confirm_delete; ?></h4>
                <h4 class="mb-20 weight-500 DelTxt"> </h4>
                <div class="padding-bottom-20 row" style="max-width: 170px; margin: 0 auto;">
                  <form class="forms-sample" id="FormDel">
                    <input type="hidden" name="id" class="DelFormId" value="0">
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
                    <input type="hidden" name="id" class="RestFormId" value="0">
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
    <script src="jsWebVysionSport/main.js"></script>

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
