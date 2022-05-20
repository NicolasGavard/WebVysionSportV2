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
            <h4 class="card-title page_food_nova_score_title" style='text-transform: none;'></h4>
            
            <div class="row">
              <div class="col-md-9">
              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text AddNewNovaScore" data-bs-toggle="modal" data-bs-target="#modalAddNovaScore" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-plus"></i>
                  <span class="page_food_nova_score_add_title"></span>
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=5%><span class="page_food_nova_score_picture"></span></th>
                    <th width=10%><span class="page_food_nova_score_code"></span></th>
                    <th width=10%><span class="page_food_nova_score_color"></span></th>
                    <th width=60%><span class="page_food_nova_score_name"></span></th>
                    <th width=05%><span class="page_food_nova_score_status"></span></th>
                    <th width=10%><span class="page_food_nova_score_action"></span></th>
                  </tr>
                </thead>
                <tbody id="listNovaScoresTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddNovaScore" tabindex="-1" aria-labelledby="modalAddNovaScoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_food_nova_score_add_title" id="modalAddNovaScoreLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddNovaScore">
            <input type="hidden" name="id"        class="AddNovaScoreFormIdNovaScore" value="0">
            <input type="hidden" name="statut"    class="AddNovaScoreFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddNovaScoreFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="InputNovaScoreCode" class="page_food_nova_score_code"></label>
                  <input type="text" class="form-control AddNovaScoreFormCode" id="InputNovaScoreCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-4">
                  <label for="InputNovaScoreName" class="page_food_nova_score_name"></label>
                  <input type="text" class="form-control AddNovaScoreFormName" id="InputNovaScoreName" placeholder="Nom" name="description" value="">
                </div>
                <div class="col-md-4">
                  <label for="InputNovaScoreColor" class="page_food_nova_score_color"></label>
                  <input type="text" class="form-control input-lg pick-a-color AddNovaScoreFormColor" id="InputNovaScoreColor" placeholder="Color" name="color" value="#B3B3B3"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="NovaScoreEpic">
                    <p>
                      <input type="file" class="NovaScoreEpicImage" accept="image/*" name="picture" id="picture"  onchange="loadFile(event); encodeImgtoBase64(this);" style="display: none;">
                      <input type="hidden" name="linkToPicture"       id="linkToPicture"      class="InfoProfilFormLinkToPicture"   value="">
                      <input type="hidden" name="linkToPictureBase64" id="linkToPictureBase64">
                    </p>
                    <p>
                      <label for="file" style="cursor: pointer;">
                      <img class="NovaScoreEpicImage InfoNovaScorePicture" src="" style='max-width:100px; max-height:100px' alt="" id="base64Img"/>
                      <div class="NovaScoreEpicContent" onclick='$("#picture").click();'>
                        <span class="NovaScoreEpicIcon"><i class="menu-icon mdi mdi-camera"></i></span>
                        <span class="NovaScoreEpic_Text page_all_change_picture"></span>
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
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddNovaScore"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelNovaScore" tabindex="-1" aria-labelledby="modalDelNovaScoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_nova_score_delete_title" id="modalDelNovaScoreLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelNovaScore">
            <input type="hidden" name="id" class="DelNovaScoreFormIdNovaScore" value="0">
          </form>
          <p class="DelNovaScoreTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelNovaScore"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestNovaScore" tabindex="-1" aria-labelledby="modalRestNovaScoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_food_nova_score_restore_title" id="modalRestNovaScoreLabel" class="page_food_nova_score_restore_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestNovaScore">
            <input type="hidden" name="id" class="RestNovaScoreFormIdNovaScore" value="0">
          </form>
          <p class="RestNovaScoreTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-info page_all_restore" id="btnRestNovaScore"></button>
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