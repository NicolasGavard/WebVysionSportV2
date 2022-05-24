<?php
  session_start();
  include('header.php');
  include('headerMenu.php');
?>

<div class="main-panel">        
  <div class="content-wrapper" style="background:#69a7c5; padding: 1.5rem 1.5rem 1.5rem 1.5rem;">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title page_codeTables_nutritional_title" style='text-transform: none;'></h4>
            
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text AddNewNutritional" data-bs-toggle="modal" data-bs-target="#modalAddNutritional" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-plus"></i>
                  <span class="page_codeTables_nutritional_add_title"></span>
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=10%><span class="page_codeTables_nutritional_code"></span></th>
                    <th width=75%><span class="page_codeTables_nutritional_name"></span></th>
                    <th width=05%><span class="page_codeTables_nutritional_status"></span></th>
                    <th width=10%><span class="page_codeTables_nutritional_action"></span></th>
                  </tr>
                </thead>
                <tbody id="listNutritionalsTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddNutritional" tabindex="-1" aria-labelledby="modalAddNutritionalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_codeTables_nutritional_add_title" id="modalAddNutritionalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddNutritional">
            <input type="hidden" name="id"            class="AddNutritionalFormIdNutritionalName" value="0">
            <input type="hidden" name="idNutritional" class="AddNutritionalFormIdNutritional"     value="0">
            <input type="hidden" name="statut"        class="AddNutritionalFormStatut"            value="0">
            <input type="hidden" name="timestamp"     class="AddNutritionalFormTimestamp"         value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputNutritionalCode" class="page_codeTables_nutritional_code"></label>
                  <input type="text" class="form-control AddNutritionalFormCode" id="InputNutritionalCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputNutritionalLanguage" class="page_codeTables_nutritional_language"></label>
                  <select class="form-control AddNutritionalFormLanguage" id="InputNutritionalLanguage" name="idLanguage">
                  </select>
                </div>
                <div class="col-md-12">
                  <label for="InputNutritionalName" class="page_codeTables_nutritional_name"></label>
                  <input type="text" class="form-control AddNutritionalFormName" id="InputNutritionalName" placeholder="Nom" name="name" value="">
                </div>
              </div>
            </div>
          </form>
          
          <!-- Success Alert -->
          <div class="alert alert-success alert-dismissible fade show" style='display:none;'>
            <strong class='errorData_ok'></strong>
            <br/>
            <p class='errorData_ok_txt'></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>

          <!-- Error Alert -->
          <div class="form-group">
            <div class="alert alert-danger alert-dismissible fade show" style='display:none;'>
              <strong class='errorData_ko'></strong>
              <br/>
              <p></p>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddNutritional"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelNutritional" tabindex="-1" aria-labelledby="modalDelNutritionalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_nutritional_delete_title" id="modalDelNutritionalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelNutritional">
            <input type="hidden" name="id" class="DelNutritionalFormIdNutritional" value="0">
          </form>
          <p class="DelNutritionalTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelNutritional"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestNutritional" tabindex="-1" aria-labelledby="modalRestNutritionalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_nutritional_restore_title" id="modalRestNutritionalLabel" class="page_codeTables_nutritional_restore_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestNutritional">
            <input type="hidden" name="id" class="RestNutritionalFormIdNutritional" value="0">
          </form>
          <p class="RestNutritionalTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-info page_all_restore" id="btnRestNutritional"></button>
        </div>
      </div>
    </div>
  </div>

      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/codeTableNutritional.js"></script>
  </body>
</html>