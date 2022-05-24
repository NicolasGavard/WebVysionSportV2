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
            <h4 class="card-title page_codeTables_language_title" style='text-transform: none;'></h4>
            
            <div class="row">
              <div class="col-md-9">
              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text AddNewLanguage" data-bs-toggle="modal" data-bs-target="#modalAddLanguage" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-plus"></i>
                  <span class="page_codeTables_language_add_title"></span>
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=5%><span class="page_codeTables_language_picture"></span></th>
                    <th width=10%><span class="page_codeTables_language_code"></span></th>
                    <th width=70%><span class="page_codeTables_language_name"></span></th>
                    <th width=05%><span class="page_codeTables_language_status"></span></th>
                    <th width=10%><span class="page_codeTables_language_action"></span></th>
                  </tr>
                </thead>
                <tbody id="listLanguagesTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddLanguage" tabindex="-1" aria-labelledby="modalAddLanguageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave page_codeTables_language_add_title" id="modalAddLanguageLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddLanguage">
            <input type="hidden" name="id"        class="AddLanguageFormIdLanguage" value="0">
            <input type="hidden" name="statut"    class="AddLanguageFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddLanguageFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputLanguageCode" class="page_codeTables_language_code"></label>
                  <input type="text" class="form-control AddLanguageFormCode" id="InputLanguageCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputLanguageName" class="page_codeTables_language_name"></label>
                  <input type="text" class="form-control AddLanguageFormName" id="InputLanguageName" placeholder="Nom" name="description" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="LanguageEpic">
                    <p>
                      <input type="file" class="LanguageEpicImage" accept="image/*" name="picture" id="picture"  onchange="loadFile(event); encodeImgtoBase64(this);" style="display: none;">
                      <input type="hidden" name="linkToPicture"       id="linkToPicture"      class="InfoProfilFormLinkToPicture"   value="">
                      <input type="hidden" name="linkToPictureBase64" id="linkToPictureBase64">
                    </p>
                    <p>
                      <label for="file" style="cursor: pointer;">
                      <img class="LanguageEpicImage InfoLanguagePicture" src="" width="150" height="100" alt="" id="base64Img"/>
                      <div class="LanguageEpicContent" onclick='$("#picture").click();'>
                        <span class="LanguageEpicIcon"><i class="menu-icon mdi mdi-camera"></i></span>
                        <span class="LanguageEpic_Text page_all_change_picture"></span>
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
          <button type="button" class="btn btn-primary page_all_add btnSave" id="btnAddLanguage"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelLanguage" tabindex="-1" aria-labelledby="modalDelLanguageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_language_delete_title" id="modalDelLanguageLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelLanguage">
            <input type="hidden" name="id" class="DelLanguageFormIdLanguage" value="0">
          </form>
          <p class="DelLanguageTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-danger page_all_delete" id="btnDelLanguage"></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestLanguage" tabindex="-1" aria-labelledby="modalRestLanguageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title page_codeTables_language_restore_title" id="modalRestLanguageLabel" class="page_codeTables_language_restore_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestLanguage">
            <input type="hidden" name="id" class="RestLanguageFormIdLanguage" value="0">
          </form>
          <p class="RestLanguageTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary page_all_close" data-bs-dismiss="modal"></button>
          <button type="button" class="btn btn-info page_all_restore" id="btnRestLanguage"></button>
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
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/codeTableLanguages.js"></script>
  </body>
</html>