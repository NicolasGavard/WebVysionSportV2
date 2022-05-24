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
            <h4 class="card-title page_codeTables_weight_type_title" style='text-transform: none;'></h4>
            
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text AddNewWeightType" data-bs-toggle="modal" data-bs-target="#modalAddWeightType" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-plus"></i>
                  <span class="page_codeTables_weight_type_add_title"></span>
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=10%><span class="page_codeTables_weight_type_code"></span></th>
                    <th width=15%><span class="page_codeTables_weight_type_abbreviation"></span></th>
                    <th width=10%><span class="page_codeTables_weight_type_type"></span></th>
                    <th width=50%><span class="page_codeTables_weight_type_name"></span></th>
                    <th width=05%><span class="page_codeTables_weight_type_status"></span></th>
                    <th width=10%><span class="page_codeTables_weight_type_action"></span></th>
                  </tr>
                </thead>
                <tbody id="listWeightTypesTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddWeightType" tabindex="-1" aria-labelledby="modalAddWeightTypeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_codeTables_weight_type_add_title" id="modalAddWeightTypeLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddWeightType">
            <input type="hidden" name="id"            class="AddWeightTypeFormIdWeightTypeName" value="0">
            <input type="hidden" name="idWeightType"  class="AddWeightTypeFormIdWeightType"     value="0">
            <input type="hidden" name="statut"        class="AddWeightTypeFormStatut"           value="0">
            <input type="hidden" name="timestamp"     class="AddWeightTypeFormTimestamp"        value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="InputWeightTypeCode" class="page_codeTables_weight_type_code"></label>
                  <input type="text" class="form-control AddWeightTypeFormCode" id="InputWeightTypeCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-4">
                  <label for="InputWeightTypeLanguage" class="page_codeTables_weight_type_language"></label>
                  <select class="form-control AddWeightTypeFormLanguage" id="InputWeightTypeLanguage" name="idLanguage">
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="InputWeightTypeName" class="page_codeTables_weight_type_name"></label>
                  <input type="text" class="form-control AddWeightTypeFormName" id="InputWeightTypeName" placeholder="Nom" name="name" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputWeightTypeDescription" class="page_codeTables_weight_type_description"></label>
                  <input type="text" class="form-control AddWeightTypeFormDescription" id="InputWeightTypeDescription" placeholder="Description" name="description" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputWeightTypeAbbreviation" class="page_codeTables_weight_type_abbreviation"></label>
                  <input type="text" class="form-control AddWeightTypeFormAbbreviation" id="InputWeightTypeAbbreviation" placeholder="Abbreviation" name="abbreviation" value="">
                </div>
                <div class="col-md-12">
                  <label for="InputWeightTypeType" class="page_codeTables_weight_type_type"></label>
                  
                  <div class="form-group row" style="margin-bottom: 0.5rem;">
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input AddWeightTypeFormIsSolid" name="weightTypeType" id="InputWeightTypeTypeIsSolid" value="isSolid">
                          Solide
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input AddWeightTypeFormIsLiquid" name="weightTypeType" id="InputWeightTypeTypeIsLiquid" value="isLiquid">
                          Liquide
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input AddWeightTypeFormIsOther" name="weightTypeType" id="InputWeightTypeTypeIsOther" value="isOther">
                          Autre
                        </label>
                      </div>
                    </div>
                  </div>
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
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddWeightType"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelWeightType" tabindex="-1" aria-labelledby="modalDelWeightTypeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_weight_type_delete_title" id="modalDelWeightTypeLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelWeightType">
            <input type="hidden" name="id" class="DelWeightTypeFormIdWeightType" value="0">
          </form>
          <p class="DelWeightTypeTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelWeightType"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestWeightType" tabindex="-1" aria-labelledby="modalRestWeightTypeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_weight_type_restore_title" id="modalRestWeightTypeLabel" class="page_codeTables_weight_type_restore_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestWeightType">
            <input type="hidden" name="id" class="RestWeightTypeFormIdWeightType" value="0">
          </form>
          <p class="RestWeightTypeTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-info page_all_restore" id="btnRestWeightType"></button>
        </div>
      </div>
    </div>
  </div>


      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/codeTableWeightType.js"></script>
  </body>
</html>