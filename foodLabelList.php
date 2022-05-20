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
            <h4 class="card-title page_food_label_title" style='text-transform: none;'></h4>
            
            <div class="row">
              <div class="col-md-9">
              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text AddNewLabel" data-bs-toggle="modal" data-bs-target="#modalAddLabel" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-plus"></i>
                  <span class="page_food_label_add_title"></span>
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=5%><span class="page_food_label_picture"></span></th>
                    <th width=10%><span class="page_food_label_code"></span></th>
                    <th width=70%><span class="page_food_label_name"></span></th>
                    <th width=05%><span class="page_food_label_status"></span></th>
                    <th width=10%><span class="page_food_label_action"></span></th>
                  </tr>
                </thead>
                <tbody id="listLabelsTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddLabel" tabindex="-1" aria-labelledby="modalAddLabelLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_food_label_add_title" id="modalAddLabelLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddLabel">
            <input type="hidden" name="id"        class="AddLabelFormIdLabel" value="0">
            <input type="hidden" name="statut"    class="AddLabelFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddLabelFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputLabelCode" class="page_food_label_code"></label>
                  <input type="text" class="form-control AddLabelFormCode" id="InputLabelCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputLabelName" class="page_food_label_name"></label>
                  <input type="text" class="form-control AddLabelFormName" id="InputLabelName" placeholder="Nom" name="name" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="LabelEpic">
                    <p>
                      <input type="file" class="LabelEpicImage" accept="image/*" name="picture" id="picture"  onchange="loadFile(event); encodeImgtoBase64(this);" style="display: none;">
                      <input type="hidden" name="linkToPicture"       id="linkToPicture"      class="InfoProfilFormLinkToPicture"   value="">
                      <input type="hidden" name="linkToPictureBase64" id="linkToPictureBase64">
                    </p>
                    <p>
                      <label for="file" style="cursor: pointer;">
                      <img class="LabelEpicImage InfoLabelPicture" src="" width="150" height="100" alt="" id="base64Img"/>
                      <div class="LabelEpicContent" onclick='$("#picture").click();'>
                        <span class="LabelEpicIcon"><i class="menu-icon mdi mdi-camera"></i></span>
                        <span class="LabelEpic_Text page_all_change_picture"></span>
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
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddLabel"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelLabel" tabindex="-1" aria-labelledby="modalDelLabelLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_label_delete_title" id="modalDelLabelLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelLabel">
            <input type="hidden" name="id" class="DelLabelFormIdLabel" value="0">
          </form>
          <p class="DelLabelTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelLabel"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestLabel" tabindex="-1" aria-labelledby="modalRestLabelLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_label_restore_title" id="modalRestLabelLabel" class="page_food_label_restore_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestLabel">
            <input type="hidden" name="id" class="RestLabelFormIdLabel" value="0">
          </form>
          <p class="RestLabelTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-info page_all_restore" id="btnRestLabel"></button>
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