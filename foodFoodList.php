<?php
  session_start();
  include('header.php');
  include('headerMenu.php');
?>

<style>
  .zeroPadding {
    padding: 0 !important;
  }
</style>

<div class="main-panel">        
  <div class="content-wrapper" style="background:#69a7c5; padding: 1.5rem 1.5rem 1.5rem 1.5rem;">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title page_food_food_title" style='text-transform: none;'></h4>
            
            <div class="row">
              <div class="col-md-10">
                <div class="row">
                  <?php
                    if (isset($_POST['idBrand']))      {$idBrand       = $_POST['idBrand'];      } else {$idBrand      = 0;}
                    if (isset($_POST['idScoreNutri'])) {$idScoreNutri  = $_POST['idScoreNutri']; } else {$idScoreNutri = 0;}
                    if (isset($_POST['idScoreNova']))  {$idScoreNova   = $_POST['idScoreNova'];  } else {$idScoreNova  = 0;}
                    if (isset($_POST['idScoreEco']))   {$idScoreEco    = $_POST['idScoreEco'];   } else {$idScoreEco   = 0;}
                  ?>

                  <input type="hidden" class="form-control FilterFoodByIdBrand"       id="InputFilterFoodByIdBrand"       name="idBrand"      value="<?php echo $idBrand; ?>">
                  <input type="hidden" class="form-control FilterFoodByIdScoreNutri"  id="InputFilterFoodByIdScoreNutri"  name="idScoreNutri" value="<?php echo $idScoreNutri; ?>">
                  <input type="hidden" class="form-control FilterFoodByIdScoreNova"   id="InputFilterFoodByIdScoreNova"   name="idScoreNova"  value="<?php echo $idScoreNova; ?>">
                  <input type="hidden" class="form-control FilterFoodByIdScoreEco"    id="InputFilterFoodByIdScoreEco"    name="idScoreEco"   value="<?php echo $idScoreEco; ?>">
                
                  <div class="col-md-3">
                    <label for="InputBrandName" class="page_food_food_brand"></label>
                    <select class="form-control" id="listBrandsFilter" name="idBrand">
                      <option value=""></option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="InputLabelName" class="page_food_food_labels"></label>
                    <select class="form-control" id="listLabelsFilter" name="idLabel">
                      <option value=""></option>
                    </select>
                  </div>

                  <div class="col-md-2">
                    <label for="InputScoreNutriName" class="page_food_food_score_nutri"></label>
                    <select class="form-control" id="listScoreNutriFilter" name="idScoreNutri">
                      <option value=""></option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="InputScoreNovaName" class="page_food_food_score_nova"></label>
                    <select class="form-control" id="listScoreNovaFilter" name="idScoreNova">
                      <option value=""></option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="InputScoreEcoName" class="page_food_food_score_eco"></label>
                    <select class="form-control" id="listScoreEcoFilter" name="idScoreEco">
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>
              
              
              <div class="col-md-2" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text AddNewFood" data-bs-toggle="modal" data-bs-target="#modalAddFood" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-plus"></i>
                  <span class="page_food_food_add_title"></span>
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=10% class="table-plus"><span class="page_food_food_name"></span></th>
                    <th width=10%><span class="page_food_food_brand"></span></th>
                    <th width=10%><span class="page_food_food_score_nutri"></span></th>
                    <th width=10%><span class="page_food_food_score_nova"></span></th>
                    <th width=10%><span class="page_food_food_score_eco"></span></th>
                    <th width=05%><span class="page_food_food_status"></span></th>
                    <th width=10%><span class="page_food_food_action"></span></th>
                  </tr>
                </thead>
                <tbody id="listFoodsTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Detail/Save Food -->
  <div class="modal fade" id="modalAddFood" tabindex="-1" aria-labelledby="modalAddLabelFood" aria-hidden="true">
    <!-- <div class="modal-dialog modal-xl"> -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_food_food_add_title" id="modalAddLabelFood"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddFood">
            <input type="hidden" name="id"        class="AddFoodFormIdFood" value="0">
            <input type="hidden" name="statut"    class="AddFoodFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddFoodFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputFoodCode" class="page_food_food_code"></label>
                  <input type="text" class="form-control AddFoodFormCode" id="InputFoodCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputFoodName" class="page_food_food_name"></label>
                  <input type="text" class="form-control AddFoodFormName" id="InputFoodName" placeholder="Nom" name="description" value="">
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
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddFood"></button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Detail/Save Weight Food -->
  <div class="modal fade" id="modalAddWeightFood" tabindex="-1" aria-labelledby="modalAddLabelWeightFood" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_food_food_add_weight" id="modalAddLabelWeightFood"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddWeightFood">
            <input type="hidden" name="id"        class="AddWeightFoodFormId"         value="0">
            <input type="hidden" name="idFood"    class="AddWeightFoodFormIdFood"     value="0">
            <input type="hidden" name="statut"    class="AddWeightFoodFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddWeightFoodFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputWeightFoodWeight" class="page_food_food_weight"></label>
                  <input type="text" class="form-control AddWeightFoodFormWeight" id="InputWeightFoodWeight" placeholder="Taille" name="weight" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputWeightFoodWeightType" class="page_food_food_weight_type"></label>
                  <select class="form-control AddWeightFoodFormWeightType" id="InputWeightFoodWeightType" name="idWeightType">
                    <option value=""></option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="FoodEpic">
                    <p>
                      <input type="file" class="FoodEpicImage" accept="image/*" name="picture" id="picture"  onchange="loadFile(event); encodeImgtoBase64(this);" style="display: none;">
                      <input type="hidden" name="linkToPicture"       id="linkToPicture"      class="InfoProfilFormLinkToPicture"   value="">
                      <input type="hidden" name="linkToPictureBase64" id="linkToPictureBase64">
                    </p>
                    <p>
                      <label for="file" style="cursor: pointer;">
                      <img class="FoodEpicImage InfoFoodPicture" src="" width="100" height="150" alt="" id="base64Img"/>
                      <div class="FoodEpicContent" onclick='$("#picture").click();'>
                        <span class="FoodEpicIcon"><i class="menu-icon mdi mdi-camera"></i></span>
                        <span class="FoodEpic_Text page_all_change_picture"></span>
                      </div>
                    </label>
                    </p>
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
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddWeightFood"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelFoodWeight" tabindex="-1" aria-labelledby="modalDelLabelFoodWeight" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_food_delete_title" id="modalDelLabelFoodWeight"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelFoodWeight">
            <input type="hidden" name="id" class="DelFoodWeightFormIdFoodWeight" value="0">
          </form>
          <p class="DelFoodWeightTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelFoodWeight"></button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalDelFoodLabel" tabindex="-1" aria-labelledby="modalDelLabelFoodLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_food_delete_title" id="modalDelLabelFoodLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelFoodLabel">
            <input type="hidden" name="id" class="DelFoodLabelFormIdFoodLabel" value="0">
          </form>
          <p class="DelFoodLabelTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelFoodLabel"></button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalDelFoodNutritional" tabindex="-1" aria-labelledby="modalDelNutritionalFoodNutritional" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_food_delete_title" id="modalDelNutritionalFoodNutritional"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelFoodNutritional">
            <input type="hidden" name="id" class="DelFoodNutritionalFormIdFoodNutritional" value="0">
          </form>
          <p class="DelFoodNutritionalTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelFoodNutritional"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelFood" tabindex="-1" aria-labelledby="modalDelLabelFood" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_food_delete_title" id="modalDelLabelFood"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelFood">
            <input type="hidden" name="id" class="DelFoodFormIdFood" value="0">
          </form>
          <p class="DelFoodTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelFood"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestFood" tabindex="-1" aria-labelledby="modalRestLabelFood" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_food_restore_title" id="modalRestLabelFood" class="page_food_food_restore_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestFood">
            <input type="hidden" name="id" class="RestFoodFormIdFood" value="0">
          </form>
          <p class="RestFoodTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-info page_all_restore" id="btnRestFood"></button>
        </div>
      </div>
    </div>
  </div>

  <script>
    var loadFile = function(event) {
      var image = document.getElementById('base64Img');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>

<?php
  include('headerFooter.php');
?>