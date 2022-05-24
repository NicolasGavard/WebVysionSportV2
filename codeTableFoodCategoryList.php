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
            <h4 class="card-title page_codeTables_food_category_title" style='text-transform: none;'></h4>
            
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text AddNewFoodCategory" data-bs-toggle="modal" data-bs-target="#modalAddFoodCategory" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-plus"></i>
                  <span class="page_codeTables_food_category_add_title"></span>
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=10%><span class="page_codeTables_food_category_code"></span></th>
                    <th width=75%><span class="page_codeTables_food_category_name"></span></th>
                    <th width=05%><span class="page_codeTables_food_category_status"></span></th>
                    <th width=10%><span class="page_codeTables_food_category_action"></span></th>
                  </tr>
                </thead>
                <tbody id="listFoodCategorysTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddFoodCategory" tabindex="-1" aria-labelledby="modalAddFoodCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_codeTables_food_category_add_title" id="modalAddFoodCategoryLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddFoodCategory">
            <input type="hidden" name="id"          class="AddFoodCategoryFormIdFoodCategoryName" value="0">
            <input type="hidden" name="idCategory"  class="AddFoodCategoryFormIdFoodCategory"     value="0">
            <input type="hidden" name="statut"      class="AddFoodCategoryFormStatut"             value="0">
            <input type="hidden" name="timestamp"   class="AddFoodCategoryFormTimestamp"          value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputFoodCategoryCode" class="page_codeTables_food_category_code"></label>
                  <input type="text" class="form-control AddFoodCategoryFormCode" id="InputFoodCategoryCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputFoodCategoryLanguage" class="page_codeTables_food_category_language"></label>
                  <select class="form-control AddFoodCategoryFormLanguage" id="InputFoodCategoryLanguage" name="idLanguage">
                  </select>
                </div>
                <div class="col-md-12">
                  <label for="InputFoodCategoryName" class="page_codeTables_food_category_name"></label>
                  <input type="text" class="form-control AddFoodCategoryFormName" id="InputFoodCategoryName" placeholder="Nom" name="name" value="">
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
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddFoodCategory"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelFoodCategory" tabindex="-1" aria-labelledby="modalDelFoodCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_food_category_delete_title" id="modalDelFoodCategoryLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelFoodCategory">
            <input type="hidden" name="id" class="DelFoodCategoryFormIdFoodCategory" value="0">
          </form>
          <p class="DelFoodCategoryTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelFoodCategory"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestFoodCategory" tabindex="-1" aria-labelledby="modalRestFoodCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_food_category_restore_title" id="modalRestFoodCategoryLabel" class="page_codeTables_food_category_restore_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestFoodCategory">
            <input type="hidden" name="id" class="RestFoodCategoryFormIdFoodCategory" value="0">
          </form>
          <p class="RestFoodCategoryTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-info page_all_restore" id="btnRestFoodCategory"></button>
        </div>
      </div>
    </div>
  </div>


      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/codeTableFoodCategory.js"></script>
  </body>
</html>